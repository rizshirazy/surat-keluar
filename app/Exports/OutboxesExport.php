<?php

namespace App\Exports;

use App\Outbox;
use Maatwebsite\Excel\Concerns\FromCollection;

class OutboxesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Outbox::all();
    }
}
