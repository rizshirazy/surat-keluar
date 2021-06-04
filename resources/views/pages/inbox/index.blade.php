@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card p-3">

                <div class="card-body">

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-data-tab" data-toggle="tab" href="#nav-data"
                               role="tab"
                               aria-controls="nav-data" aria-selected="true">Data</a>
                            <a class="nav-item nav-link" id="nav-disposition-tab" data-toggle="tab"
                               href="#nav-disposition"
                               role="tab"
                               aria-controls="nav-disposition" aria-selected="false">Disposisi</a>
                        </div>
                    </nav>

                    @include('includes.alert')

                    <div class="tab-content" id="nav-tabContent">
                        {{-- NAV DATA --}}
                        <div class="tab-pane fade show active" id="nav-data" role="tabpanel"
                             aria-labelledby="nav-data-tab">
                            <div class="d-flex justify-content-between mt-3">
                                <h3 class="">Surat Masuk</h3>
                                <div>
                                    <a href="{{ route('inbox.create') }}" class="btn btn-success px-4">Tambah Data</a>
                                    <button onclick="showModal('report', 1)"
                                            class="btn btn-warning px-4">Laporan</button>
                                </div>
                            </div>

                            <div class="bg-white rounded mt-3">
                                <div class="table-responsive">
                                    <table id="resultTable" class="table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Index</th>
                                                <th>Nomor Surat</th>
                                                <th>Tanggal Surat</th>
                                                <th>Kode Surat</th>
                                                <th>Perihal</th>
                                                <th>Asal</th>
                                                <th>Status</th>
                                                <th>Dokumen</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-disposition" role="tabpanel"
                             aria-labelledby="nav-disposition-tab">
                            <div class="d-flex justify-content-between mt-3">
                                <h3 class="">Disposisi Surat Masuk</h3>
                            </div>

                            <div class="bg-white rounded mt-3">
                                <div class="table-responsive">
                                    <table id="resultTableDisposiiton" class="table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Nomor Surat</th>
                                                <th>Tanggal Surat</th>
                                                <th>Perihal</th>
                                                <th>Asal</th>
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
            { data : 'origin', name: 'origin', width: '200' },
            { data : 'status', name: 'status' },
            { data : 'document', name: 'document', className: 'text-center' },
            { data : 'action', name: 'action', className: 'text-right' },
        ],
        columnDefs: [
            { orderable: false, targets: [6,7] }
        ],
        order: [
            [0, 'desc'],
        ]
    })

    const dataTable2 = $('#resultTableDisposiiton').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        scrollX: true,
        scroller: true,
        ajax: {
            url: '{{ route('disposition.populate_by_user') }}'
        },
        columns: [
            { data : 'mail.reff', name: 'mail.reff', width: '120' },
            { data : 'mail.date', name: 'mail.date', width: '80' },
            { data : 'mail.subject', name: 'mail.subject', width: '200' },
            { data : 'mail.origin', name: 'mail.origin', width: '200' },
            { data : 'status', name: 'status' },
            { data : 'action', name: 'action', className: 'text-right' },
        ],
        columnDefs: [
            { orderable: false, targets: [5] }
        ],
        order: [
            [1, 'asc'],
        ]
    })

    function showModal(type, id) {
        $("#mainModal").modal({backdrop: "static", keyboard: false});
        $("#mainModal .data").html('<div class="justify-content-center p-5 d-flex"><div class="dot-spin"></div></div>');
        $.ajax({
            type: "POST",
            url: '{{ route('outbox.modal') }}',
            data: "_token={{ csrf_token() }}&id=" + id + "&type=" + type + "",
            success: function (data) {
                $("#mainModal .data").html(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#mainModal').modal('hide');
                console.error(xhr);
                Swal.fire('Error', ajaxOptions + " - " + thrownError, 'error');
            }
        });
    }

    function sizeModal(type) { //type = full, lg, sm, default
        $("#mainModal .modal-dialog").removeClass("modal-full modal-lg modal-sm");
        if (type != "default") {
            $("#mainModal .modal-dialog").addClass("modal-" + type);
        }
    }


</script>
@endpush