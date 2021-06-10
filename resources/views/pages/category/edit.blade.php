@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm p-3">

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4>Kode dan Klasifikasi Surat</h4>
                    </div>

                    @include('includes.error')

                    <form action="{{ route('category.update', $data->id) }}" class="my-4" method="POST"
                          autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="group_category_id">Klasifikasi Surat</label>
                                    <select name="group_category_id" id="group_category_id"
                                            class="form-control select2 @error('group_category_id') is-invalid @enderror">
                                        <option value="{{ $data->group_category_id}}">{{ $data->group->name }}</option>
                                    </select>

                                    @error('group_category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code">Kode Surat</label>
                                    <input type="text" id="code" name="code"
                                           class="form-control @error('code') is-invalid @enderror"
                                           value="{{ old('code') ?? $data->code }}">

                                    @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Keterangan</label>
                                    <input type="text" id="name" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name') ?? $data->name }}">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea name="description" id="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              rows="3">{{ old('description') ?? $data->description }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <button type="submit" class="btn btn-success px-3 mr-1">Simpan</button>
                                <a href="{{ route('category.index') }}" class="btn btn-light px-3">Batal</a>

                                @if (role('SUPER ADMIN'))
                                <button type="button" class="btn btn-outline-danger px-3 float-right"
                                        onclick="onDelete()">
                                    Hapus</button>
                                @endif

                            </div>
                        </div>
                    </form>

                    <form id="delete-item" action="{{ route('category.destroy', $data->id) }}" method="POST"
                          class="d-none">
                        @csrf
                        @method('DELETE')
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

        $('.select2').select2();

        $('#group_category_id').select2({
            ajax: {
                placeholder: '-- Pilih --',
                    dalay: 100,
                        url: '{{ route('api.group_category.populate') }}',
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

    });
</script>
@endpush