<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOutboxRequest;
use App\Outbox;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.outbox.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.outbox.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOutboxRequest $request)
    {
        $data = $request->all();

        $today = Carbon::now()->startOfDay();
        $date = Carbon::parse($data['date']);

        if ($date->lt($today)) {
            $last_index = Outbox::where('date', '<=', $date['date'])
                ->orderBy('index', 'desc')
                ->orderBy('suffix', 'desc')
                ->first();
            $next_index = 0;
        } else {
            $last_index = Outbox::whereYear('date', $date->year)->orderBy('index', 'desc')->first()->index;
            $next_index = $last_index ? $last_index + 1 : 1;
        }

        dump($last_index);
        dump($next_index);
        die();

        $data['date'] = $date->format('Y-m-d');
        $data['index'] = $next_index;
        $data['user_id'] = Auth::id();

        Outbox::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Outbox  $outbox
     * @return \Illuminate\Http\Response
     */
    public function show(Outbox $outbox)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Outbox  $outbox
     * @return \Illuminate\Http\Response
     */
    public function edit(Outbox $outbox)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outbox  $outbox
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outbox $outbox)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Outbox  $outbox
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outbox $outbox)
    {
        //
    }
}
