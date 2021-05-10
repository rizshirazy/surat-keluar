@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm p-3">

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4>Surat Keluar</h4>
                    </div>

                    <table class="table mt-3">
                        <tr>
                            <th width="20%">Nomor Surat</th>
                            <td>{{ $data->reff }}</td>
                        </tr>
                        <tr>
                            <th width="20%">Tanggal</th>
                            <td>{{ Carbon\Carbon::parse($data->date)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <th width="20%">Kode Surat</th>
                            <td>{{ $data->category['code']." - ".$data->category['name']}}</td>
                        </tr>
                        <tr>
                            <th width="20%">Perihal</th>
                            <td>{{ $data->subject }}</td>
                        </tr>
                        <tr>
                            <th width="20%">Tujuan</th>
                            <td>{{ $data->destination }}</td>
                        </tr>
                        <tr>
                            <th width="20%">Dokumen</th>
                            <td>
                                @if ($data->document)
                                <a href="{{ Storage::url($item->document) }}" target="_blank"
                                   class="btn btn-light text-danger" title="Lihat">
                                    <i class="fas fa-file-pdf"></i></a>

                                @else
                                <span class="text-muted"><em>Tidak ada dokumen</em></span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th width="20%">Nama Pegawai</th>
                            <td>{{ $data->user->name }}</td>
                        </tr>
                    </table>

                    <a href="{{ route('outbox.index') }}" class="btn btn-light px-3">Kembali</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection