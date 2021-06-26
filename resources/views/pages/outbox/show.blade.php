@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card glass-effect p-3" style="background-color: transparent; border:none">

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="text-white">Surat Keluar</h4>
                    </div>

                    <table class="table my-3">
                        <tr>
                            <th class="bg-light" width="20%">Nomor Surat</th>
                            <td class="bg-white">{{ $confidential ? '' : $data->reff }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Tanggal</th>
                            <td class="bg-white"> {{ $data->date_locale }} </td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Kode Surat</th>
                            <td class="bg-white">
                                {{ $confidential ? '' : $data->category['code']." - ".$data->category['name']}}</td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Perihal</th>
                            <td class="bg-white">{{ $confidential ? '' : $data->subject }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Tujuan</th>
                            <td class="bg-white">{{ $confidential ? '' : $data->destination }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Sifat Surat</th>
                            <td class="bg-white">{{ $data->type->name }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Dokumen</th>
                            <td class="bg-white">
                                @if ($data->document && !$confidential)
                                <a href="{{ Storage::url($data->document) }}" target="_blank"
                                   class="btn btn-light text-danger" title="Lihat">
                                    <i class="fas fa-file-pdf"></i></a>

                                @else
                                <span class="text-muted"><em>Tidak ada dokumen</em></span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Nama Pegawai</th>
                            <td class="bg-white">{{ $data->user->name }}</td>
                        </tr>
                    </table>

                    <a href="{{ route('outbox.index') }}" class="btn btn-light px-3">Kembali</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection