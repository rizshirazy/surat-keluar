@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card p-3">

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3 class="">Pengguna</h3>
                        <a href="{{ route('user.create') }}" class="btn btn-success px-4">Tambah Data</a>
                    </div>

                    @include('includes.alert')

                    <div class="bg-white rounded mt-5">
                        <div class="table-responsive">
                            <table id="resultTable" class="table">
                                <thead>
                                    <tr>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Status</th>
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
{{-- <script>
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
            { data : 'action', name: 'action', className: 'text-right' },
        ],
        columnDefs: [
            { orderable: false, targets: [5,6] }
        ],
        order: [
            [1, 'desc'],
            [0, 'desc'],
        ]
    })
</script> --}}
@endpush