<?php

namespace App\Exports;

use App\Outbox;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OutboxesExport implements
    FromView,
    Responsable,
    WithColumnFormatting,
    ShouldAutoSize,
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

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('exports.outboxes', [
            'data' => Outbox::all()
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
