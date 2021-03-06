@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm p-3">

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4>Tambah Surat Masuk</h4>
                    </div>

                    <form action="{{ route('inbox.store') }}" class="my-4" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reff">Nomor Surat</label>
                                    <input type="text" id="reff" name="reff"
                                           class="form-control @error('reff') is-invalid @enderror"
                                           value="{{ old('reff') }}">

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
                                           value="{{ old('date') ?? date('d-m-Y')}} ">

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
                                           value="{{ old('subject') }}">

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
                                           value="{{ old('origin') }}">

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
                                           value="{{ old('attachments') }}">

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
                                    <input type="file" id="document" name="document"
                                           class="form-control @error('document') is-invalid @enderror"
                                           accept=".pdf">

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
                        <div class="row mt-3">
                            <div class="col">
                                <button type="submit" class="btn btn-success px-3 mr-1">Simpan</button>
                                <a href="{{ route('inbox.index') }}" class="btn btn-light px-3">Batal</a>
                            </div>
                        </div>
                    </form>
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
        
    });
</script>
@endpush