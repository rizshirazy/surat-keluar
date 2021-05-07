<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateOutboxRequest;
use App\Outbox;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        $suffix = null;

        if ($date->lt($today)) {
            $last_index = Outbox::where('date', '<=', $date->format('Y-m-d'))
                ->whereYear('date', $date->year)
                ->orderBy('index', 'desc')
                ->orderBy('suffix', 'desc')
                ->first();

            if (!$last_index) {
                $last_index = Outbox::whereYear('date', $date->year)
                    ->orderBy('index', 'asc')
                    ->orderBy('suffix', 'desc')
                    ->first();
            }

            $next_index = $last_index ? $last_index->index : 1;

            if ($last_index && $last_index->suffix) {
                $suffix = Str::upper(++$last_index->suffix);
            } else if ($last_index) {
                $suffix = 'A';
            }
        } else {
            $last_index = Outbox::whereYear('date', $date->year)->orderBy('index', 'desc')->first();
            $next_index = $last_index ? $last_index->index + 1 : 1;
        }

        $category = Category::findOrFail($data['category_id']);

        $data['suffix'] = $suffix;
        $data['reff'] = "W28-A4/" . $next_index . $suffix . "/" . $category->code . "/" . romanic_number($date->month) . "/" . $date->year;
        $data['date'] = $date->format('Y-m-d');
        $data['index'] = $next_index;
        $data['user_id'] = Auth::id();

        $outbox = Outbox::create($data);

        return redirect()->route('outbox.edit', $outbox->id);
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
        $outbox = Outbox::with('category')->findOrFail($outbox->id);

        return view('pages.outbox.edit', $outbox);
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
