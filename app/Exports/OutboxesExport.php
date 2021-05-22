<?php

namespace App\Exports;

use App\Outbox;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OutboxesExport implements
    FromView,
    Responsable,
    ShouldAutoSize,
    WithColumnFormatting,
    WithEvents,
    WithStyles
{
    use Exportable;

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = 'surat-keluar.xlsx';

    /**
     * Optional Writer Type
     */
    private $writerType = Excel::XLSX;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
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

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $data = Outbox::whereYear('date', date('Y'));

        return view('exports.outboxes', [
            'data' => $data
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function styles(Worksheet $sheet)
    {

        $highestRow = $sheet->getHighestDataRow();
        $protection = $sheet->getProtection();
        $protection->setPassword('admin');
        $protection->setSheet(true);
        $protection->setSort(true);
        $protection->setInsertRows(true);
        $protection->setFormatCells(true);

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
            4    =>
            [
                'font' => [
                    'italic' => true,
                ],
            ],
            5   =>
            [
                'font' => [
                    'bold' => true
                ],
                'alignment' => [
                    'horizontal' => Alignment::VERTICAL_CENTER,
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
            'C:D'  =>
            [
                'alignment' => [
                    'horizontal' => Alignment::VERTICAL_CENTER,
                ]
            ],
            'F4:H4'  =>
            [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_RIGHT,
                ]
            ],
            'A5:H' . $highestRow  =>
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
            ],
        ];
    }
}
