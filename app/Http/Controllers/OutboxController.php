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

        $date = Carbon::parse($data['date']);

        $last_index = $this->getLastIndex($data);
        if ($last_index['message']) {
            return back()->withInput()->withErrors(['date' => 'Tanggal belum efektif']);
        }

        $category = Category::findOrFail($data['category_id']);

        $data['suffix'] = $last_index['suffix'];
        $data['index'] = $last_index['index'];
        $data['reff'] = "W28-A4/" . $last_index['index'] . $last_index['suffix'] . "/" . $category->code . "/" . romanic_number($date->month) . "/" . $date->year;
        $data['date'] = $date->format('Y-m-d');
        $data['user_id'] = Auth::id();

        $outbox = Outbox::create($data);

        return redirect()->route('outbox.edit', $outbox->id)->with('success', 'Nomor Surat ' . $outbox->reff . ' berhasil dibuat!');
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
        $date = Carbon::parse($outbox->created_at);

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

        $date = Carbon::parse($data['date']);
        $category = Category::findOrFail($data['category_id']);

        if ($date->format('Y-m-d') == $outbox->date) {
            $data['reff'] = "W28-A4/" . $outbox->index . $outbox->suffix . "/" . $category->code . "/" . romanic_number($date->month) . "/" . $date->year;
        } else {
            $last_index = $this->getLastIndex($data);

            if ($last_index['message']) {
                return back()->withInput()->withErrors(['date' => 'Tanggal belum efektif']);
            }

            $data['suffix'] = $last_index['suffix'];
            $data['index'] = $last_index['index'];
            $data['reff'] = "W28-A4/" . $last_index['index'] . $last_index['suffix'] . "/" . $category->code . "/" . romanic_number($date->month) . "/" . $date->year;
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

        return redirect()->route('outbox.index')->with('success', 'Nomor Surat ' . $outbox->reff . ' berhasil diperbarui!');
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

        return redirect()->route('outbox.index')
            ->with('success', 'Nomor Surat ' . $outbox->reff . ' telah dihapus!');
    }

    private function getLastIndex($data, $outbox = null)
    {
        $today = Carbon::now()->startOfDay();
        $date = Carbon::parse($data['date']);
        $suffix = null;

        $result['message'] = null;

        if ($date->gt($today)) {
            $result['message'] = 'Tanggal belum efektif';
        }

        /**
         * Kondisi penomoran index surat keluar:
         * A. Jika surat keluar dibuat untuk tanggal yang telah lewat
         *  A1. Jika ada surat keluar dari index terakhir, maka gunakan suffix
         *    A2. Jika index terakhir menggunakan suffix, maka melanjutkan suffix
         *    A3. Jika index terakhit tidak ada suffix, suffix di set menjadi "A"
         *  A4. Jika tidak ada surat keluar dari index terakhir, maka melanjutkan penomoran
         * B. Jika surat keluar dibuat di hari yang sama
         * 
         */

        //  KONDISI: A
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

            $countOutboxAfterLastIndex = 0;
            if ($last_index) {
                $countOutboxAfterLastIndex = Outbox::where('date', '>', $last_index->date)
                    ->count();
            }

            // KONDISI: A1
            if ($countOutboxAfterLastIndex > 0) {

                $next_index = $last_index ? $last_index->index : 1;
                // KONDISI: A2
                if ($last_index && $last_index->suffix) {
                    $suffix = Str::upper(++$last_index->suffix);
                } else if ($last_index) { // KONDISI: A3
                    $suffix = 'A';
                }
            } else { //KONDISI: A4
                $next_index = $last_index ? $last_index->index + 1 : 1;
            }
        } else { // KONDISI: B
            $last_index = Outbox::whereYear('date', $date->year)->orderBy('index', 'desc')->first();
            $next_index = $last_index ? $last_index->index + 1 : 1;
        }

        $result['index'] = $next_index;
        $result['suffix'] = $suffix;

        return $result;
    }
}
