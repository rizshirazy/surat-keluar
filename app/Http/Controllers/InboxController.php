<?php

namespace App\Http\Controllers;

use App\Disposition;
use App\Http\Requests\CreateInboxRequest;
use App\Http\Requests\UpdateInboxRequest;
use App\Inbox;
use Carbon\Carbon;
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
                    return  $item->date_formatted;
                })
                ->editColumn('index', function ($item) {
                    return  $item->index . $item->suffix;
                })
                ->editColumn('subject', function ($item) {
                    $confidential = $item->type_id == 2 && !in_array(Auth::id(), explode(',', $item->user_disposition));

                    return $confidential ? '' : $item->subject;
                })
                ->editColumn('origin', function ($item) {
                    $confidential = $item->type_id == 2 && !in_array(Auth::id(), explode(',', $item->user_disposition));

                    return $confidential ? '' : $item->origin;
                })
                ->editColumn('reff', function ($item) {
                    $confidential = $item->type_id == 2 && !in_array(Auth::id(), explode(',', $item->user_disposition));

                    return $confidential ? '' : $item->reff;
                })
                ->editColumn('document', function ($item) {

                    $confidential = $item->type_id == 2 && !in_array(Auth::id(), explode(',', $item->user_disposition));

                    if (!$item->document || $confidential) {
                        return '';
                    }

                    return  '<a href="' . Storage::url($item->document) . '" target="_blank" class="btn btn-light text-danger" title="Lihat"><i class="fas fa-file-pdf"></i></a>';
                })
                ->addColumn('type', function ($item) {
                    return $item->type->name;
                })
                ->addColumn('action', function ($item) {
                    $action = '';

                    if (Auth::id() == $item->user_id && $item->status == 'BARU') {
                        $action .=
                            '<a href="' . route('inbox.edit', $item->id) . '" class="btn btn-light" title="Edit"><i class="fas fa-pencil-alt"></i></a>';
                    }

                    if ($item->status == 'SELESAI' && role('PETUGAS')) {
                        $action .= '<a href="' . route('inbox.print', $item->id) . '" class="btn btn-light" title="Cetak"><i class="fas fa-print"></i></a>';
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
        $date = Carbon::parse($data['date']);

        $last_index = Inbox::whereYear('created_at', date('Y'))
            ->orderBy('index', 'desc')
            ->first();

        $next_index = $last_index ? $last_index->index + 1 : 1;

        if ($file = $request->file('document')) {

            $extention = $file->getClientOriginalExtension();

            if (!in_array($extention, ['pdf'])) {
                return back()->withInput()->withErrors(['document' => 'Dokumen harus dalam bentuk pdf']);
            }

            $data['document'] = $file->store('assets/inbox', 'public');
        }

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
        $confidential = $inbox->type_id == 2 && !in_array(Auth::id(), explode(',', $inbox->user_disposition));

        return view('pages.inbox.show', [
            'data' => $inbox,
            'confidential' => $confidential
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
    public function update(UpdateInboxRequest $request, Inbox $inbox)
    {
        $data = $request->all();

        if ($file = $request->file('document')) {

            $extention = $file->getClientOriginalExtension();

            if (!in_array($extention, ['pdf'])) {
                return back()->withInput()->withErrors(['document' => 'Dokumen harus dalam bentuk pdf']);
            }

            $data['document'] = $file->store('assets/inbox', 'public');
        }

        $inbox->update($data);

        return redirect()->route('inbox.edit', $inbox->id)->with('success', 'Data berhasil diperbarui!');
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


    public function print($id)
    {
        $inbox = Inbox::findOrFail($id);

        return view('pages.inbox.print', [
            'data' => $inbox
        ]);
    }
}
