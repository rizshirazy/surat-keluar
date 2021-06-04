<?php

namespace App\Http\Controllers;

use App\Disposition;
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
    public function store(Request $request)
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
     * @param  \App\Disposition  $disposition
     * @return \Illuminate\Http\Response
     */
    public function show(Disposition $disposition)
    {
        return view('pages.disposition.show', [
            'data' => $disposition
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Disposition  $disposition
     * @return \Illuminate\Http\Response
     */
    public function edit(Disposition $disposition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disposition  $disposition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disposition $disposition)
    {
        //
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


    // API
    public function populateByUser()
    {
        if (request()->ajax()) {
            $query = Disposition::with('mail')
                ->where('dispositions.status', 'OPEN')
                ->where('dispositions.user_id', Auth::id());

            return DataTables::of($query)
                ->editColumn('mail.date', function ($item) {
                    return  date('d-m-Y', strtotime($item->mail->date));
                })
                ->addColumn('action', function ($item) {

                    dd($item);

                    $action = '';

                    $action .= '<a href="' . route('disposition.show', $item->id) . '" class="btn btn-light" title="Detail"><i class="fas fa-chevron-right"></i></a>';

                    return '<div class="btn-group" role="group">' . $action . '</div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
