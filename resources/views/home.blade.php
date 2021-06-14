@extends('layouts.app')

@section('content')
<style>
    .clickable-row {
        cursor: pointer;
    }

    .clickable-row:hover {
        background-color: rgba(0, 0, 0, 0.1)
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card py-3">
                <div class="card-body">

                    @php
                    $today = Carbon\Carbon::now()->startOfDay();
                    @endphp

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card text-white shadow"
                                 style="border: none; background-color:  #ff6384">
                                <div class="card-body">
                                    <span>Surat Keluar Bulan Ini</span>
                                    <h3 class="mt-2">
                                        {{ App\Outbox::whereYear('date', date('Y'))->whereMonth('date', date('m'))->count() }}
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card text-white shadow"
                                 style="border: none; background-color: #36a2eb">
                                <div class="card-body">
                                    <span>Surat Masuk Bulan Ini</span>
                                    <h3 class="mt-2">
                                        {{ App\Inbox::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->count() }}
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card text-white shadow"
                                 style="border: none; background-color: #ffce56 ">
                                <div class="card-body">
                                    <span>Surat Keluar Tahun Ini</span>
                                    <h3 class="mt-2">{{ App\Outbox::whereYear('date', date('Y'))->count() }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card text-white shadow"
                                 style="border: none; background-color: #4bc0c0">
                                <div class="card-body">
                                    <span>Surat Masuk Tahun Ini</span>
                                    <h3 class="mt-2">
                                        {{ App\Inbox::whereYear('created_at', date('Y'))->count() }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col mx-auto">
                            <canvas id="groupCategoryChart"></canvas>
                        </div>
                    </div>

                    @php
                    $group = App\Outbox::select(App\Outbox::raw('count(1) as count'),
                    'group_categories.name')->whereYear('date', date('Y'))
                    ->join('categories', 'outboxes.category_id', '=', 'categories.id')
                    ->join('group_categories', 'group_categories.id', '=', 'categories.group_category_id')
                    ->groupBy('group_categories.name')->get();

                    $label = [];
                    $value = [];

                    foreach ($group as $key) {
                    $label = array_merge($label, [$key->name]);
                    $value = array_merge($value, [$key->count]);
                    }

                    $label = json_encode($label);
                    $value = json_encode($value);

                    @endphp

                    <div class="row mt-5">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-3">Surat Yang Perlu Disposisi Anda</h4>
                                    @php
                                    $dispositions = App\Disposition::select(
                                    'dispositions.id as d_id',
                                    'inboxes.*'
                                    )
                                    ->join('inboxes', 'inboxes.id', '=', 'dispositions.mail_id')
                                    ->where('dispositions.status', 'OPEN')
                                    ->where('dispositions.user_id', Auth::id())
                                    ->get();
                                    @endphp

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Nomor Surat</th>
                                                    <th class="text-center">Tanggal</th>
                                                    <th class="text-center">Perihal</th>
                                                    <th class="text-center">Asal Surat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($dispositions as $item)
                                                <tr class="clickable-row" title="Disposisi"
                                                    data-href="{{ route('disposition.edit', $item->d_id) }}">
                                                    <td>{{$item->reff}}</td>
                                                    <td class="text-center">
                                                        {{ Carbon\Carbon::parse($item->date)->format('d-m-Y') }}</td>
                                                    <td>{{ $item->subject }}</td>
                                                    <td>{{ $item->origin }}</td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td class="text-muted text-center" colspan="4">
                                                        <em>Tidak Ada Data</em>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            @php
                            $outboxes = App\Outbox::latest()->limit(5)->get();
                            @endphp
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="mb-3">5 Surat Keluar Terakhir</h4>
                                        <a href="{{ route('outbox.create') }}"
                                           class="btn btn-success px-4 mt-1 mb-3 float-right">
                                            <i class="fas fa-plus-circle mr-3"></i> Tambah Surat Keluar</a>
                                    </div>

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

                                                @forelse ($outboxes as $item)
                                                <tr>
                                                    <td>{{ $item->reff }}</td>
                                                    <td class="text-center">
                                                        {{ Carbon\Carbon::parse($item->date)->format('d-m-Y') }}
                                                    </td>
                                                    <td>{{ $item->subject }}</td>
                                                    <td>{{ $item->destination }}</td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td class="text-muted text-center" colspan="4">
                                                        <em>Tidak Ada Data</em>
                                                    </td>
                                                </tr>
                                                @endforelse
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

@push('script-after')
<script>
    $(document).ready(function(){
        $('.clickable-row').click(function(){
            window.location = $(this).data('href');
        });
    });

    const ctx = document.getElementById('groupCategoryChart');
    const myChart = new Chart(ctx, {
        type: 'bar',
        responsive: true,
        data: {
            labels: {!! $label !!},
            datasets: [{
                label: 'Kuantitas ',
                data: {!! $value !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 2,
                borderRadius: 5,
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Jumlah Surat Keluar Berdasarkan Klasifikasi Tahun '+ <?= date('Y ') ?>
                },
                legend: {
                    display: false,
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                },
            }
        }
    });
</script>
@endpush