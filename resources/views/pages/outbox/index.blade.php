@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card p-3">

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3 class="">Surat Keluar</h3>
                        <a href="{{ route('outbox.create') }}" class="btn btn-success px-4">Tambah Data</a>
                    </div>

                    @include('includes.alert')

                    <div class="bg-white rounded mt-5">
                        <div class="table-responsive">
                            <table id="resultTable" class="table">
                                <thead>
                                    <tr>
                                        <th>Index</th>
                                        <th>Nomor Surat</th>
                                        <th>Tanggal</th>
                                        <th>Kode Surat</th>
                                        <th>Perihal</th>
                                        <th>Tujuan</th>
                                        <th>Salinan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
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
    const dataTable = $('#resultTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        scrollX: true,
        scroller: true,
        ajax: {
            url: '{!! url()->current() !!}'
        },
        columns: [
            { data : 'index', name: 'index', className: 'text-center' },
            { data : 'reff', name: 'reff', width: '120' },
            { data : 'date', name: 'date', width: '80' },
            { data : 'category', name: 'category' },
            { data : 'subject', name: 'subject', width: '200' },
            { data : 'destination', name: 'destination', width: '200' },
            { data : 'document', name: 'document', className: 'text-center' },
            { data : 'action', name: 'action', className: 'text-right' },
        ],
        columnDefs: [
            { orderable: false, targets: [6,7] }
        ],
        order: [
            [2, 'desc'],
            [0, 'desc'],
        ]
    })
</script>
@endpush