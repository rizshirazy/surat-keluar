@extends('layouts.app')

@section('content')
<div class="container main-container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card py-3" style="background-color: transparent; border:none">
                <div class="card-body">

                    @php
                    $today = Carbon\Carbon::now()->startOfDay();
                    @endphp

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-info text-white shadow">
                                <div class="card-body">
                                    <span>Surat Keluar Tahun Ini</span>
                                    <h3 class="mt-2">{{ App\Outbox::whereYear('date', date('Y'))->count() }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card bg-secondary text-white shadow">
                                <div class="card-body">
                                    <span>Surat Keluar Seluruhnya</span>
                                    <h3 class="mt-2">{{ App\Outbox::count() }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card bg-warning shadow">
                                <div class="card-body">
                                    <span>Surat Keluar Tanpa Salinan</span>
                                    <h3 class="mt-2">{{ App\Outbox::whereNull('document')->count() }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-5">
                        <div class="col-md-12">
                            <a href="{{ route('outbox.create') }}"
                               class="btn btn-success px-4 my-3 float-right shadow">
                                <i class="fas fa-plus-circle mr-3"></i> Tambah Surat Keluar</a>
                        </div>

                        <div class="col-md-12">

                            @php
                            $outboxes = App\Outbox::latest()->limit(5)->get();
                            @endphp

                            <div class="card shadow">
                                <div class="card-body">
                                    <h4 class="mb-3">5 Surat Keluar Terakhir</h4>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Nomor Surat</th>
                                                <th class="text-center">Tanggal</th>
                                                <th class="text-center">Perihal</th>
                                                <th class="text-center">Tujuan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($outboxes) > 0)
                                            @foreach ($outboxes as $item)
                                            <tr>
                                                <td>{{ $item->reff }}</td>
                                                <td class="text-center">
                                                    {{ Carbon\Carbon::parse($item->date)->format('d-m-Y') }}
                                                </td>
                                                <td>{{ $item->subject }}</td>
                                                <td>{{ $item->destination }}</td>
                                            </tr>
                                            @endforeach
                                            @else
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection