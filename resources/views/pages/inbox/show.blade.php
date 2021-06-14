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
                            <td class="bg-white">{{ $confidential ? '' : $data->reff }}</td>
                            <th class="bg-light" width="20%">Tanggal</th>
                            <td class="bg-white">{{ $data->date_locale }}
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Perihal</th>
                            <td class="bg-white">{{$confidential ? '' : $data->subject }}</td>
                            <th class="bg-light" width="20%">Kode Surat</th>
                            <td class="bg-white">
                                {{ $confidential ? '' : $data->category['code']." - ".$data->category['name']}}</td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Asal Surat</th>
                            <td class="bg-white">{{ $confidential ? '' : $data->origin }}</td>
                            <th class="bg-light" width="20%">Lampiran</th>
                            <td class="bg-white">{{ $data->attachments ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Dokumen</th>
                            <td class="bg-white">
                                @if ($data->document && !$confidential)
                                <a href="{{ Storage::url($data->document) }}" target="_blank"
                                   class="btn btn-light btn-sm text-danger" title="Lihat Dokumen">
                                    <i class="fas fa-file-pdf"></i></a>
                                @else
                                <span class="text-muted"><em>Tidak ada dokumen</em></span>
                                @endif
                            </td>
                            <th class="bg-light" width="20%">Sifat Surat</th>
                            <td class="bg-white">{{ $data->type->name }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Nama Petugas</th>
                            <td class="bg-white" colspan="3">{{ $data->user->name }}</td>
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
                            @if ($confidential)
                            {{-- Rahasia --}}
                            <tr>
                                <td colspan="3" class="text-center text-muted">Rahasia</td>
                            </tr>
                            @else
                            {{-- Tidak Rahasia --}}

                            @forelse ($data->disposition as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>
                                    @if ($item->status == 'OPEN')
                                    <span class="text-muted"><em>Dalam proses</em></span>
                                    @else
                                    {{ $item->notes}}
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted"><em>Tidak ada data</em></td>
                            </tr>

                            @endforelse
                            {{-- Akhir --}}
                            @endif
                        </tbody>
                    </table>

                    <a href="{{ route('inbox.index') }}" class="btn btn-light px-3">Kembali</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection