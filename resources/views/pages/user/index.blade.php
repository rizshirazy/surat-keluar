@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card p-3">

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3 class="">Pengguna</h3>
                        @if (role('SUPER ADMIN'))
                        <a href="{{ route('user.create') }}" class="btn btn-success px-4">Tambah Data</a>
                        @endif
                    </div>

                    @include('includes.alert')

                    <div class="bg-white rounded mt-5">
                        <div class="table-responsive">
                            <table id="resultTable" class="table w-100">
                                <thead>
                                    <tr>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Email</th>
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
            { data : 'nip', name: 'nip' },
            { data : 'name', name: 'name' },
            { data : 'email', name: 'email' },
            { data : 'position', name: 'position' },
            { data : 'is_active', name: 'is_active' },
            { data : 'action', name: 'action', className: 'text-right' },
        ],
        columnDefs: [
            { orderable: false, targets: [5] }
        ],
        order: [
            [4, 'desc'],
            [1, 'asc'],
        ]
    })
</script>
@endpush