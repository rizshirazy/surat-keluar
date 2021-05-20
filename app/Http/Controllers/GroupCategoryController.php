<?php

namespace App\Http\Controllers;

use App\GroupCategory;
use Illuminate\Http\Request;

class GroupCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GroupCategory  $groupCategory
     * @return \Illuminate\Http\Response
     */
    public function show(GroupCategory $groupCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GroupCategory  $groupCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupCategory $groupCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroupCategory  $groupCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupCategory $groupCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GroupCategory  $groupCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupCategory $groupCategory)
    {
        //
    }

    // API
    public function populate(Request $request)
    {
        $data = GroupCategory::orderBy("code", "asc")->get();

        if ($q = $request->input('q')) {
            $data = GroupCategory::whereRaw("UPPER(TRIM(name)) LIKE UPPER(TRIM('%{$q}%'))", [$q])
                ->orWhereRaw("UPPER(TRIM(code)) LIKE UPPER(TRIM('%{$q}%'))", [$q])
                ->orderBy("code", "asc")
                ->get();
        }

        $i = 0;
        $rows = array();

        foreach ($data as $row) {
            $rows[$i]['id'] = $row->id;
            $rows[$i]['text'] = $row->code . " - " . $row->name;
            $i++;
        }

        return [
            'items' => $rows
        ];
    }
}
