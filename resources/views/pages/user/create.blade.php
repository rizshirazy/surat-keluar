@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm p-3">

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4>Tambah Pengguna</h4>
                    </div>

                    @include('includes.error')

                    <form action="{{ route('user.store') }}" class="my-4" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="text" id="nip" name="nip"
                                           class="form-control @error('nip') is-invalid @enderror"
                                           value="{{ old('nip') }}">

                                    @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" id="name" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name') }}">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="position">Jabatan</label>
                                    <input type="text" id="position" name="position"
                                           class="form-control @error('position') is-invalid @enderror"
                                           value="{{ old('position') }}">

                                    @error('position')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select name="is_active" id="is_active" class="form-control select2">
                                        <option value="N">Tidak Aktif</option>
                                        <option value="Y">Aktif</option>
                                    </select>

                                    @error('is_active')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department_id">Departemen</label>
                                    <select name="department_id" id="department_id" class="form-control select2">
                                        <option value=""></option>
                                        <option value="1">Kesekretariatan</option>
                                        <option value="2">Kepaniteraan</option>
                                    </select>

                                    @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password"
                                           class="form-control @error('password') is-invalid @enderror">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirm">Konfirmasi Password</label>
                                    <input type="password" id="password_confirm" name="password_confirm"
                                           class="form-control @error('password_confirm') is-invalid @enderror">

                                    @error('password_confirm')
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
                                <a href="{{ route('user.index') }}" class="btn btn-light px-3">Batal</a>
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

        $('.select2').select2();

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