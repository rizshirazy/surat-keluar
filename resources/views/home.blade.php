@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card py-3">
                <div class="card-body">

                    @php
                    $today = Carbon\Carbon::now()->startOfDay();
                    @endphp

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-white shadow" style="border: none; background-color: #118ab2">
                                <div class="card-body">
                                    <span>Surat Keluar Tahun Ini</span>
                                    <h3 class="mt-2">{{ App\Outbox::whereYear('date', date('Y'))->count() }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card text-white shadow" style="border: none; background-color: #ef476f">
                                <div class="card-body">
                                    <span>Surat Keluar Seluruhnya</span>
                                    <h3 class="mt-2">{{ App\Outbox::count() }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card shadow" style="border: none; background-color: #ffd166">
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
                               class="btn btn-success px-4 my-3 float-right">
                                <i class="fas fa-plus-circle mr-3"></i> Tambah Surat Keluar</a>
                        </div>

                        <div class="col-md-12">

                            @php
                            $outboxes = App\Outbox::latest()->limit(5)->get();
                            @endphp

                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-3">5 Surat Keluar Terakhir</h4>

                                    <div class="table-responsive">
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
</div>
@endsection