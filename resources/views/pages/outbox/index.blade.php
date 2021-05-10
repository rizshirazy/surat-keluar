@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card glass-effect p-3" style="background-color: transparent; border:none">

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3 class="text-white">Surat Keluar</h3>
                        <a href="{{ route('outbox.create') }}" class="btn btn-success px-4">Tambah Data</a>
                    </div>

                    @include('includes.alert')

                    <div class="bg-white rounded p-3 mt-3 ">
                        <div class="table-responsive mt-3">
                            <table id="resultTable" class="table">
                                <thead>
                                    <tr>
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
            { data : 'reff', name: 'reff' },
            { data : 'date', name: 'date', width: '80' },
            { data : 'category', name: 'category' },
            { data : 'subject', name: 'subject', width: '200' },
            { data : 'destination', name: 'destination', width: '200' },
            { data : 'document', name: 'document', className: 'text-center' },
            { data : 'action', name: 'action' },
        ],
        columnDefs: [
            { orderable: false, targets: 5 }
        ],
        order: [
            [1, 'desc'],
            [0, 'desc'],
        ]
    })
</script>
@endpush