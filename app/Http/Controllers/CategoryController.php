<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Category::query();

            return DataTables::of($query)
                ->addColumn('group', function ($item) {
                    return $item->group ? $item->group->name : '';
                })
                ->addColumn('action', function ($item) {
                    $action = '';

                    if (role('SUPER ADMIN')) {
                        $action .=
                            '<a href="' . route('category.edit', $item->id) . '" class="btn btn-light" title="Edit"><i class="fas fa-pencil-alt"></i></a>';
                    }

                    return '<div class="btn-group" role="group">' . $action . '</div>';
                })
                ->rawColumns(['action', 'description'])
                ->make(true);
        }

        return view('pages.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $data = $request->all();

        $category = Category::create($data);

        return redirect()->route('category.index')->with('success', 'Kode Surat ' . $category->code . ' berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if (role('SUPER ADMIN')) {
            return view('pages.category.edit', ['data' => $category]);
        }

        abort('403');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCategoryRequest $request, Category $category)
    {
        $data = $request->all();

        $category->update($data);

        return redirect()->route('category.index')->with('success', 'Kode Surat ' . $category->code . ' berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')
            ->with('success', 'Kode Surat ' . $category->code . ' telah dihapus!');
    }


    // API
    public function populate(Request $request)
    {
        $data = Category::all();

        if ($q = $request->input('q')) {
            $data = Category::whereRaw("UPPER(TRIM(name)) LIKE UPPER(TRIM('%{$q}%'))", [$q])
                ->orWhereRaw("UPPER(TRIM(code)) LIKE UPPER(TRIM('%{$q}%'))", [$q])
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

    public function detail(Request $request)
    {
        $category = Category::findOrFail($request->id);
        return $category;
    }
}
