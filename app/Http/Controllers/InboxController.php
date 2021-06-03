<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInboxRequest;
use App\Inbox;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class InboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request()->ajax()) {
            $query = Inbox::query();

            return DataTables::of($query)
                ->editColumn('date', function ($item) {
                    return  date('d-m-Y', strtotime($item->date));
                })
                ->editColumn('index', function ($item) {
                    return  $item->index . $item->suffix;
                })
                ->editColumn('document', function ($item) {
                    if ($item->document) {
                        return  '<a href="' . Storage::url($item->document) . '" target="_blank" class="btn btn-light text-danger" title="Lihat"><i class="fas fa-file-pdf"></i></a>';
                    } else {
                        return '';
                    }
                })
                ->addColumn('category', function ($item) {
                    return $item->category->code . " " . $item->category->name;
                })
                ->addColumn('action', function ($item) {
                    $action = '';

                    if (Auth::id() == $item->user_id) {
                        $action .=
                            '<a href="' . route('inbox.edit', $item->id) . '" class="btn btn-light" title="Edit"><i class="fas fa-pencil-alt"></i></a>';
                    }

                    $action .= '<a href="' . route('inbox.show', $item->id) . '" class="btn btn-light" title="Detail"><i class="fas fa-chevron-right"></i></a>';

                    return '<div class="btn-group" role="group">' . $action . '</div>';
                })
                ->rawColumns(['document', 'action'])
                ->make(true);
        }

        return view('pages.inbox.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.inbox.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInboxRequest $request)
    {

        $data = $request->all();
        $today = Carbon::now()->startOfDay();
        $date = Carbon::parse($data['date']);

        $last_index = Inbox::whereYear('date', $today->year)
            ->orderBy('index', 'desc')
            ->first();

        $next_index = $last_index ? $last_index->index + 1 : 1;

        $data['index'] = $next_index;
        $data['date'] = $date->format('Y-m-d');
        $data['user_id'] = Auth::id();

        $inbox = Inbox::create($data);

        return redirect()->route('inbox.edit', $inbox->id)->with('success', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function show(Inbox $inbox)
    {
        return view('pages.inbox.edit', [
            'data' => $inbox
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function edit(Inbox $inbox)
    {
        return view('pages.inbox.edit', [
            'data' => $inbox
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inbox $inbox)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inbox $inbox)
    {
        //
    }
}
