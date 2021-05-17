<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateOutboxRequest;
use App\Http\Requests\UpdateOutboxRequest;
use App\Outbox;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class OutboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Outbox::query();

            return DataTables::of($query)
                ->editColumn('date', function ($item) {
                    return  date('d-m-Y', strtotime($item->date));
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
                            '<a href="' . route('outbox.edit', $item->id) . '" class="btn btn-light" title="Edit"><i class="fas fa-pencil-alt"></i></a>';
                    }

                    $action .= '<a href="' . route('outbox.show', $item->id) . '" class="btn btn-light" title="Detail"><i class="fas fa-chevron-right"></i></a>';

                    return '<div class="btn-group" role="group">' . $action . '</div>';
                })
                ->rawColumns(['document', 'action'])
                ->make(true);
        }

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
        return view('pages.outbox.show', [
            'data' => $outbox
        ]);
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

        $today = Carbon::now()->startOfDay();
        $date = Carbon::parse($outbox->date);

        $editableDate = $today->lte($date);

        if (Auth::id() == $outbox->user_id) {
            return view('pages.outbox.edit', [
                'data' => $outbox,
                'editableDate' => $editableDate
            ]);
        }

        return redirect()->route('outbox.show', $outbox);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outbox  $outbox
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOutboxRequest $request, Outbox $outbox)
    {
        $data = $request->all();

        $today = Carbon::now()->startOfDay();
        $date = Carbon::parse($data['date']);

        $category = Category::findOrFail($data['category_id']);

        if ($date->format('Y-m-d') == $outbox->date) {
            $data['reff'] = "W28-A4/" . $outbox->index . $outbox->suffix . "/" . $category->code . "/" . romanic_number($date->month) . "/" . $date->year;
        } else {
            $suffix = null;

            if ($date->lt($today)) {

                $last_index = Outbox::where('date', '<=', $date->format('Y-m-d'))
                    ->where('id', '<>', $outbox->id)
                    ->whereYear('date', $date->year)
                    ->orderBy('index', 'desc')
                    ->orderBy('suffix', 'desc')
                    ->first();

                if (!$last_index) {
                    $last_index = Outbox::whereYear('date', $date->year)
                        ->where('id', '<>', $outbox->id)
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

            $data['suffix'] = $suffix;
            $data['reff'] = "W28-A4/" . $next_index . $suffix . "/" . $category->code . "/" . romanic_number($date->month) . "/" . $date->year;
            $data['index'] = $next_index;
        }

        if ($file = $request->file('document')) {

            $extention = $file->getClientOriginalExtension();

            if (in_array($extention, ['pdf'])) {
                $data['document'] = $file->store('assets/outbox', 'public');
            } else {
                return back()->withInput()->withErrors(['document' => 'Dokumen harus dalam bentuk pdf']);
            }
        }

        $data['date'] = $date->format('Y-m-d');
        $outbox->update($data);

        return redirect()->route('outbox.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Outbox  $outbox
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outbox $outbox)
    {
        $outbox->delete();

        return redirect()->route('outbox.index');
    }
}
