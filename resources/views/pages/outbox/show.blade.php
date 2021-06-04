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
                            <td class="bg-white">{{ $data->reff }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Tanggal</th>
                            <td class="bg-white">
                                {{ Carbon\Carbon::parse($data->date)->locale('id_ID')->format('d F Y') }}
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Kode Surat</th>
                            <td class="bg-white">{{ $data->category['code']." - ".$data->category['name']}}</td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Perihal</th>
                            <td class="bg-white">{{ $data->subject }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Tujuan</th>
                            <td class="bg-white">{{ $data->destination }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Dokumen</th>
                            <td class="bg-white">
                                @if ($data->document)
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