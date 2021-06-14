<?php

namespace App\Http\Controllers;

use App\Disposition;
use App\Http\Requests\CompleteDispositionRequest;
use App\Http\Requests\CreateDispositionRequest;
use App\Http\Requests\UpdateDispositionRequest;
use App\Inbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DispositionController extends Controller
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
    public function store(CreateDispositionRequest $request)
    {
        $data = $request->all();

        $inbox = Inbox::findOrFail($data['mail_id']);

        $data['status'] = 'OPEN';

        Disposition::create($data);


        $inbox->update([
            'status' => 'PROSES DISPOSISI'
        ]);

        return redirect()->route('inbox.index')->with('success', 'Disposisi berhasil dikirim');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Disposition::with('mail')
            ->where('id', $id)
            ->where('status', 'OPEN')
            ->firstOrFail();

        return view('pages.disposition.show', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Disposition::with('mail')
            ->where('id', $id)
            ->where('status', 'OPEN')
            ->firstOrFail();

        return view('pages.disposition.edit', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDispositionRequest $request, $id)
    {
        $data = $request->all();

        $update = Disposition::findOrFail($id);
        $update->update([
            'status'    => 'CLOSED',
            'notes'     => $data['notes']
        ]);

        Disposition::create([
            'user_id'   => $data['user_id'],
            'status'    => 'OPEN',
            'mail_id'   => $update['mail_id']
        ]);

        return redirect()->route('inbox.index')->with('success', 'Disposisi berhasil dikirim');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disposition  $disposition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disposition $disposition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id id of disposition
     * @return \Illuminate\Http\Response
     */
    public function complete(CompleteDispositionRequest $request, $id)
    {

        $data = $request->validated();

        $update = Disposition::findOrFail($id);
        $update->update([
            'status'    => 'CLOSED',
            'notes'     => $data['notes']
        ]);

        $inbox = Inbox::findOrFail($update['mail_id']);
        $inbox->update([
            'status'    => 'SELESAI'
        ]);

        return redirect()->route('inbox.index')->with('success', 'Disposisi berhasil diakhiri');
    }


    // API
    public function populateByUser()
    {
        if (request()->ajax()) {
            $query = Disposition::select(
                'dispositions.id as d_id',
                'inboxes.*'
            )
                ->join('inboxes', 'inboxes.id', '=', 'dispositions.mail_id')
                ->where('dispositions.status', 'OPEN')
                ->where('dispositions.user_id', Auth::id());

            return DataTables::of($query)
                ->editColumn('date', function ($item) {
                    return  date('d-m-Y', strtotime($item->date));
                })
                ->addColumn('action', function ($item) {

                    $action = '';

                    $action .= '<a href="' . route('disposition.edit', $item->d_id) . '" class="btn btn-light" title="Detail"><i class="fas fa-chevron-right"></i></a>';

                    return '<div class="btn-group" role="group">' . $action . '</div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
