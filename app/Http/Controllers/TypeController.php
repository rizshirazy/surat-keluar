<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    // API
    public function populate(Request $request)
    {
        $data = Type::all();

        if ($q = $request->input('q')) {
            $data = Type::whereRaw("UPPER(TRIM(name)) LIKE UPPER(TRIM('%{$q}%'))", [$q])
                ->get();
        }

        $i = 0;
        $rows = array();

        foreach ($data as $row) {
            $rows[$i]['id'] = $row->id;
            $rows[$i]['text'] = $row->name;
            $i++;
        }

        return [
            'items' => $rows
        ];
    }
}
