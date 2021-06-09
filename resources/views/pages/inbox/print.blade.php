@extends('layouts.app')

@section('content')
<style>
    .text-header {
        text-align: center;
        font-size: 18px;
    }

    .text-subheader {
        text-align: center;
        font-weight: bold;
        font-size: 20px;

    }

    .text-brand {
        font-weight: bold;
        font-size: 23px;
    }

    th.text-header {
        font-size: 16px;
    }

    td.text-header {
        font-size: inherit;
    }

    @media print {

        body *,
        #main * {
            visibility: hidden;
        }

        #main,
        #main #print-area,
        #main #print-area * {
            visibility: visible;
        }

        table {
            border: solid #000 !important;
            border-width: 1px 0 0 1px !important;
        }

        th,
        td {
            border: solid #000 !important;
            border-width: 0 1px 1px 0 !important;
        }

        .table th,
        .table td {
            padding: 0.25rem !important;
        }

        table.table.table-borderless {
            border: none !important;
        }

        table.table.table-borderless th,
        table.table.table-borderless td {
            border: none !important;
        }
    }

    @page {
        size: auto;
        margin: 0mm;
    }
</style>

<div id="main" class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card p-3">

                <div class="card-body">
                    <div id="print-area">

                        <table class="table table-borderless">
                            <tr style="border-bottom:3px solid black">
                                <td>
                                    <img src="{{ asset('images/logo_pamentok.png') }}"
                                         alt="logo pengadilan agama mentok" style="width:130px">
                                </td>
                                <td colspan="5" style="vertical-align: middle">
                                    <div class="text-header text-brand">PENGADILAN AGAMA MENTOK</div>
                                    <div class="text-header">Komplek Pemda Kabupaten Bangka Barat</div>
                                    <div class="text-header">Mentok, Bangka Barat, Kepulauan Bangka Belitung. 33315
                                    </div>
                                    <div class="text-header">website: http://www.pa-mentok.go.id | email:
                                        pa-mentok@gmail.com | telp: 071621294</div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div class="text-subheader" style="padding-top: 30px">LEMBAR DISPOSISI</div>
                                    <div class="text-center font-weight-bold" style="padding-top: 15px">PERHATIAN:
                                        Dilarang memisahkan sebagian
                                        atau seluruh surat yang tergabung dalam berkas ini</div>
                                </td>
                            </tr>
                        </table>
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 15%">Nomor Agenda</th>
                                <td style="width: 40%">: {{ $data->index }}</td>
                                <th style="width: 15%">Sifat Surat</th>
                                <td style="width: 30%">: {{ $data->type->name }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Penerimaan</th>
                                <td>: {{ Carbon\Carbon::parse($data->created_at)->locale('id')->format('d F Y') }}</td>
                                <th>Tanggal Penyelesaian</th>
                                <td>:
                                    {{ Carbon\Carbon::parse($data->updated_at)->locale('id')->format('d F Y') }}
                                </td>
                            </tr>
                            <tr>
                                <th>Nomor Surat</th>
                                <td>: {{ $data->reff }}</td>
                                <th>Tanggal Surat</th>
                                <td>:
                                    {{ Carbon\Carbon::parse($data->date)->locale('id')->format('d F Y') }}
                                </td>
                            </tr>
                            <tr>
                                <th>Perihal</th>
                                <td>: {{ $data->subject }}</td>
                                <th>Kode Surat</th>
                                <td>: {{ $data->category['code']." - ".$data->category['name']}}</td>
                            </tr>
                            <tr>
                                <th>Asal Surat</th>
                                <td>: {{ $data->origin }}</td>
                                <th>Lampiran</th>
                                <td>: {{ $data->attachments ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Nama Petugas</th>
                                <td colspan="3">: {{ $data->user->name }}</td>
                            </tr>
                        </table>

                        <h5 class="mt-5">Disposisi</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-header">No</th>
                                    <th class="text-header">Pegawai</th>
                                    <th class="text-header">Catatan</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($data->disposition as $item)
                                <tr>
                                    <td class="text-header">{{ $loop->iteration }}</td>
                                    <td>
                                        <div>
                                            {{ $item->user->name }}
                                        </div>
                                        <div style="margin-bottom: 30px;">
                                            {{ $item->user->position }}
                                        </div>
                                    </td>
                                    <td>{{ $item->notes}}</td>
                                </tr>

                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('inbox.index') }}" class="btn btn-light px-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script-after')
<script>
    $(document).ready(function(){
        setTimeout(() => {
            window.print();
        }, 1000);
    });
</script>
@endpush