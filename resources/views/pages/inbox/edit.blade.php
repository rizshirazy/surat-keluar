@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm p-3">

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4>Surat Masuk</h4>
                    </div>

                    @include('includes.alert')

                    {{-- FORM INBOX UPDATE --}}
                    <form id="inboxes-form" action="{{ route('inbox.update', $data->id) }}" class="my-4" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reff">Nomor Surat</label>
                                    <input type="text" id="reff" name="reff"
                                           class="form-control @error('reff') is-invalid @enderror"
                                           value="{{ old('reff') ?? $data->reff }}">

                                    @error('reff')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date">Tanggal Surat</label>
                                    <input type="text" id="date" name="date"
                                           class="form-control datepicker @error('date') is-invalid @enderror"
                                           data-provide="datepicker"
                                           value="{{ old('date') ?? Carbon\Carbon::parse($data->date)->format('d-m-Y') }} ">

                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id">Kode Surat</label>
                                    <select name="category_id" id="category_id"
                                            class="form-control select2 @error('category_id') is-invalid @enderror">
                                        <option value="{{$data->category['id']}}">
                                            {{ $data->category['code']." - ".$data->category['name']}}
                                        </option>
                                    </select>

                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject">Perihal</label>
                                    <input type="text" id="subject" name="subject"
                                           class="form-control @error('subject') is-invalid @enderror"
                                           value="{{ old('subject') ?? $data->subject }}">

                                    @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="origin">Asal Surat</label>
                                    <input type="text" id="origin" name="origin"
                                           class="form-control @error('origin') is-invalid @enderror"
                                           value="{{ old('origin') ?? $data->origin }}">

                                    @error('origin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="attachments">Lampiran</label>
                                    <input type="text" id="attachments" name="attachments"
                                           class="form-control @error('attachments') is-invalid @enderror"
                                           value="{{ old('attachments') ?? $data->attachments }}">

                                    @error('attachments')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type_id">Sifat Surat</label>
                                    <select name="type_id" id="type_id"
                                            class="form-control select2 @error('type_id') is-invalid @enderror">
                                        <option value="{{$data->type['id']}}">
                                            {{ $data->type['name'] }}
                                        </option>
                                    </select>
                                    @error('type_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="document">Dokumen</label>
                                    @if ($data->document)
                                    <a href="{{ Storage::url($data->document) }}" target="_blank"
                                       class="btn btn-sm btn-light ml-2">Lihat Dokumen</a>
                                    @endif
                                    <input type="file" id="document" name="document"
                                           class="form-control @error('document') is-invalid @enderror"
                                           accept=".pdf" aria-describedby="fileHelpBlock">
                                    <small id="fileHelpBlock" class="form-text text-muted">
                                        Upload ulang hanya jika ingin mengganti dokumen.
                                    </small>
                                    @error('document')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div id="card_desc" class="card bg-light my-3" style="display: none">
                                    <div class="card-body">
                                        <div id="spinner" style="display: none">
                                            <div class="justify-content-center p-3 d-flex">
                                                <div class="dot-spin"></div>
                                            </div>
                                        </div>
                                        <div id="category_desc"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- FORM DELETE --}}
                    <form id="delete-item" action="{{ route('inbox.destroy', $data->id) }}" method="POST"
                          class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>

                    @if ($data->status == 'BARU')
                    {{-- FORM DISPOSITION --}}
                    <form id="disposition-form" action="{{ route('disposition.store') }}" method="POST">
                        @csrf
                        <h5>Disposisi</h5>
                        <hr>
                        <input type="hidden" name="mail_id" value="{{ $data->id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_id">Pegawai</label>
                                    <select name="user_id" id="user_id"
                                            class="form-control select2 @error('user_id') is-invalid @enderror">
                                    </select>
                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif

                    <div class="row mt-3">
                        <div class="col">
                            @if ($data->status == 'BARU')
                            <button type="button" class="btn btn-success px-3"
                                    onclick="updateData()">Simpan</button>
                            <button type="button" class="btn btn-primary px-3"
                                    onclick="createDisposition()">Disposisi</button>
                            @endif
                            <a href="{{ route('inbox.index') }}" class="btn btn-light px-3">Kembali</a>


                            @if ($data->status == 'BARU')
                            <button type="button" class="btn btn-outline-danger px-3 float-right"
                                    onclick="onDelete()">
                                Hapus</button>
                            @endif
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

        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            language: 'id',
            autoclose: true,
            todayHighlight: true,
            daysOfWeekHighlighted: [0],
        });

        $('#category_id').select2({
            ajax: {
                placeholder: '-- Pilih --',
                    dalay: 100,
                        url: '{{ route('api.category.populate') }}',
                        dataType: 'json',
                        type: 'POST',
                        data: function (params){
                        return {
                            q: params.term,
                            };
                        },
                        processResults: function (data) {
                        return {
                        results: data.items
                    };
                }
            }
        });

        $('#type_id').select2({
            ajax: {
                placeholder: '-- Pilih --',
                    dalay: 100,
                        url: '{{ route('api.type.populate') }}',
                        dataType: 'json',
                        type: 'POST',
                        data: function (params){
                        return {
                            q: params.term,
                            };
                        },
                        processResults: function (data) {
                        return {
                        results: data.items
                    };
                }
            }
        });

        $('#user_id').select2({
            ajax: {
                placeholder: '-- Pilih --',
                    dalay: 100,
                        url: '{{ route('api.user.populate.user_disposiiton') }}',
                        dataType: 'json',
                        type: 'POST',
                        data: function (params){
                        return {
                            q: params.term,
                            };
                        },
                        processResults: function (data) {
                        return {
                        results: data.items
                    };
                }
            }
        });

        $('#category_id').change(function(){
            const url = "{{ route('api.category.detail') }}";
            let id = $('#category_id').val();

            $.ajax({
                type: 'POST',
                data: `id=${id}`,
                url: url,
                dataType: "json",
                statusCode: {
                    404: function(){
                        Swal.fire('Error', 'Data tidak ditemukan', 'error');
                    }
                },
                beforeSend: function() {
                    $('#card_desc').show();
                    $('#spinner').show();
                    $('#category_desc').text('');
                },
                success: function(data){
                    $('#spinner').hide();
                    $('#category_desc').text(data.description);
                }
            });
        });

        onDelete = () => {
            swalDanger.fire({
                title: 'Anda yakin untuk menghapus?',
                text: 'Data yang telah dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `Hapus`,
                cancelButtonText: `Batal`,
                reverseButtons: true,
                focusConfirm: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete-item').submit();
                    } 
                }
            )
        }

        createDisposition = () => {
            $('#disposition-form').submit();
        }

        updateData = () => {
            $('#inboxes-form').submit();
        }
    });
</script>
@endpush