@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card p-3">

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4>Surat Masuk</h4>
                    </div>

                    <table class="table my-3">
                        <tr>
                            <th class="bg-light" width="20%">Nomor Surat</th>
                            <td class="bg-white">{{ $data->reff }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Tanggal</th>
                            <td class="bg-white">{{ Carbon\Carbon::parse($data->date)->locale('id')->format('d F Y') }}
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
                            <th class="bg-light" width="20%">Asal</th>
                            <td class="bg-white">{{ $data->origin }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Lampiran</th>
                            <td class="bg-white">{{ $data->attachments ?? '-' }}</td>
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
                            <th class="bg-light" width="20%">Sifat Surat</th>
                            <td class="bg-white">{{ $data->type->name }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Nama Petugas</th>
                            <td class="bg-white">{{ $data->user->name }}</td>
                        </tr>
                    </table>

                    <h5 class="mt-5">Disposisi</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($disposition as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->notes }}</td>
                            </tr>

                            @empty

                            @endforelse
                        </tbody>
                    </table>

                    <a href="{{ route('inbox.index') }}" class="btn btn-light px-3">Kembali</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection