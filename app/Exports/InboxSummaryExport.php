<?php

namespace App\Exports;

use App\Category;
use App\Inbox;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InboxSummaryExport implements
    FromView,
    WithDrawings,
    WithEvents,
    WithStyles,
    WithTitle,
    ShouldAutoSize
{
    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Ringkasan';
    }

    public function view(): View
    {
        $SD = $this->start_date ? $this->start_date->format('Y-m-d') : null;
        $ED = $this->end_date ? $this->end_date->format('Y-m-d') : null;

        if ($SD && $ED) {
            $totalOutbox = Inbox::selectRaw('category_id, count(1) qty')
                ->where('created_at', '>=', $SD)
                ->where('created_at', '<=', $ED)
                ->groupBy('category_id');
            $periode = $this->start_date->format('d-m-Y') . ' s.d ' . $this->end_date->format('d-m-Y');
        } else if ($SD) {
            $totalOutbox = Inbox::selectRaw('category_id, count(1) qty')
                ->where('created_at', '>=', $SD)
                ->groupBy('category_id');
            $periode = $this->start_date->format('d-m-Y') . ' s.d ' . date('d-m-Y');
        } else if ($ED) {
            $totalOutbox = Inbox::selectRaw('category_id, count(1) qty')
                ->where('created_at', '<=', $ED)
                ->groupBy('category_id');
            $periode = 'Awal s.d ' . $this->end_date->format('d-m-Y');
        } else {
            $totalOutbox = Inbox::selectRaw('category_id, count(1) qty')
                ->whereYear('created_at', date('Y'))
                ->groupBy('category_id');
            $periode = 'Tahun ' . date('Y');
        }

        $data = Category::select('id', 'name', 'code', 'qty')
            ->leftJoinSub($totalOutbox, 'totalOutbox', function ($join) {
                $join->on('totalOutbox.category_id', '=', 'categories.id');
            })->orderBy('id', 'asc')
            ->get();

        return view('exports.inboxes-summary', [
            'data' => $data,
            'periode' => $periode
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $last_column = $event->sheet->getHighestDataColumn();

                // calculate last row + 2 (total results + new row)
                $last_row = $event->sheet->getHighestDataRow() + 2;

                // set up a style array for cell formatting
                $style_text_center = [
                    'font' => [
                        'italic' => true,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ];

                $event->sheet->mergeCells(sprintf('A%d:%s%d', $last_row, $last_column, $last_row));
                $event->sheet->setCellValue(sprintf('A%d', $last_row), env('APP_NAME', 'SISUAR') . ' ' . URL::to('/') . ' | ' . env('APP_DEVELOPER', 'Muhammad Rizki, S.Si') . ' - 2021');
                $event->sheet->getStyle(sprintf('A%d', $last_row))->applyFromArray($style_text_center);
            },
            BeforeExport::class => function (BeforeExport $event) {
                $event->writer->getDelegate()->getSecurity()->setLockWindows(true);
                $event->writer->getDelegate()->getSecurity()->setLockStructure(true);
                $event->writer->getDelegate()->getSecurity()->setWorkbookPassword("admin");
                $event->writer->getProperties()->setCreator(env('APP_DEVELOPER', 'Muhammad Rizki, S.Si'));
            }
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestDataRow();
        $highestColumn = $sheet->getHighestDataColumn();
        $protection = $sheet->getProtection();
        $protection->setPassword('mentokpababar');
        $protection->setSheet(true);
        $protection->setSort(true);
        $protection->setInsertRows(true);
        $protection->setFormatCells(true);

        $sheet->getRowDimension(1)->setRowHeight(23);
        $sheet->getRowDimension(2)->setRowHeight(23);
        $sheet->getRowDimension(6)->setRowHeight(15);

        return [
            1   =>
            [
                'font' => [
                    'bold' => true,
                    'size' => 14
                ],
                'alignment' => [
                    'horizontal' => Alignment::VERTICAL_CENTER,
                ],
            ],
            2    =>
            [
                'font' => [
                    'bold' => true,
                    'size' => 14
                ],
                'alignment' => [
                    'horizontal' => Alignment::VERTICAL_CENTER,
                ],
            ],
            6   =>
            [
                'font' => [
                    'bold' => true
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_DISTRIBUTED,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'argb' => '4DA361',
                    ],
                ]
            ],
            'A'  =>
            [
                'alignment' => [
                    'horizontal' => Alignment::VERTICAL_CENTER,
                ]
            ],
            '4:5' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                ],
            ],
            'A6:' . $highestColumn . $highestRow  =>
            [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => [
                            'argb' => '000000',
                        ]
                    ],
                    'outline' => [
                        'borderStyle' => Border::BORDER_MEDIUM,
                        'color' => [
                            'argb' => '000000',
                        ]
                    ],
                ],
                'alignment' => [
                    'wrapText' => true,
                    'vertical' => Alignment::VERTICAL_TOP,
                ],
            ],
            $highestRow => [
                'font' => [
                    'bold' => true
                ],
            ]
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo Pengadilan Agama Mentok');
        $drawing->setPath(public_path('/images/logo_pamentok.png'));
        $drawing->setHeight(70);
        $drawing->setCoordinates('B1');

        return $drawing;
    }
}
