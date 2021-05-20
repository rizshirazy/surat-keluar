@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card glass-effect p-3" style="background-color: transparent; border:none">

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="text-white">Data Pengguna</h4>
                    </div>

                    <table class="table my-3">
                        <tr>
                            <th class="bg-light" width="20%">Nama</th>
                            <td class="bg-white">{{ $data->name }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">NIP</th>
                            <td class="bg-white">{{ $data->nip }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Jabatan</th>
                            <td class="bg-white">{{ $data->position }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Email</th>
                            <td class="bg-white">{{ $data->email }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Status</th>
                            <td class="bg-white">{{ $data->is_active == 'Y' ? 'Aktif' : 'Tidak Aktif' }}</td>
                        </tr>
                    </table>

                    <a href="{{ route('user.index') }}" class="btn btn-light px-3">Kembali</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection