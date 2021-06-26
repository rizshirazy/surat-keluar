<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Excel;

class InboxesExport implements
    Responsable,
    WithMultipleSheets
{
    use Exportable;

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = 'Laporan Surat Masuk Pengadilan Agama Mentok.xlsx';

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
     * @return array
     */
    public function sheets(): array
    {
        return [
            new InboxDetailExport($this->start_date, $this->end_date),
            new InboxSummaryExport(
                $this->start_date,
                $this->end_date
            )
        ];
    }
}
