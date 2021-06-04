<?php

namespace App\Http\Controllers;

use App\UserRole;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    // API
    public function populate(Request $request)
    {
        $data = UserRole::all();

        if ($q = $request->input('q')) {
            $data = UserRole::whereRaw("UPPER(TRIM(name)) LIKE UPPER(TRIM('%{$q}%'))", [$q])
                ->get();
        }

        $i = 0;
        $rows = array();

        foreach ($data as $row) {
            $rows[$i]['id'] = $row->id;
            $rows[$i]['text'] = ucfirst($row->name);
            $i++;
        }

        return [
            'items' => $rows
        ];
    }
}
