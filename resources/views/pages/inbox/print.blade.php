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

    .table th,
    .table td {
        padding: 0.25rem !important;
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
                                <th
                                    style="width: 15%; vertical-align: bottom;">
                                    Nomor Urut</th>
                                <td style="width: 40%; vertical-align: bottom">
                                    <span
                                          style="font-size: 24px; font-weight: bold; font-family: Arial, Helvetica, sans-serif">
                                        {{ $data->index }}</span>
                                </td>

                                <th style="width: 15%; vertical-align: bottom">Kode</th>
                                <td style="width: 30%; vertical-align: bottom">
                                    <span
                                          style="font-size: 24px; font-weight: bold; font-family: Arial, Helvetica, sans-serif">
                                        {{ $data->category->group->code }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal Surat</th>
                                <td> {{ $data->date_locale }} </td>
                                <th>Tgl. Penerimaan</th>
                                <td> {{ $data->created_at_locale }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Surat</th>
                                <td> {{ $data->reff }}</td>
                                <th>Tgl. Penyelesaian</th>
                                <td> {{ $data->updated_at_locale }} </td>
                            </tr>
                            <tr>
                                <th>Asal</th>
                                <td> {{ $data->origin }}</td>
                                <th>Sifat</th>
                                <td> {{ $data->type->name }}</td>
                            </tr>
                            <tr>
                                <th>Perihal</th>
                                <td colspan="3"> {{ $data->subject }}</td>
                            </tr>
                            <tr>
                                <th>Lampiran</th>
                                <td colspan="3"> {{ $data->attachments ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th colspan="2">Isi Disposisi :</th>
                                <th colspan="2">Diteruskan Kepada :</th>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    @foreach ($data->disposition->unique('notes')->reverse() as $item)
                                    <div class="px-4 py-2">{{ $item->notes}}
                                    </div>
                                    @endforeach
                                </td>
                                <td colspan="2">
                                    @foreach ($data->disposition->unique('user_id')->reverse() as $item)
                                    <div class="px-4 py-1 d-flex">
                                        <div class="mr-1">
                                            {{ $loop->iteration }}.
                                        </div>
                                        <div>
                                            {{ $item->user->name }}
                                            <br>
                                            {{ $item->user->position }}
                                            <span class="text-muted">
                                                <em>({{ Carbon\Carbon::parse($item->updated_at)->format('d/m/y') }})</em>
                                            </span>
                                        </div>
                                    </div>
                                    @endforeach
                                </td>
                            </tr>
                            <tr style="border-top: 1px solid black">
                                <th colspan="4" class="text-center font-weight-bold">
                                    <div class="my-3" style="text-decoration: underline">
                                        Sesudah digunakan harap segera dikembalikan
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <td colspan="2">Kepada :</td>
                                <td colspan="2">Tanggal :</td>
                            </tr>
                        </table>

                        <div style="border-top: 3px dashed black; margin: 50px 0px;"></div>

                        <div style="position: relative">
                            <img src="{{ asset('images/logo_pamentok.png') }}"
                                 alt="logo pengadilan agama mentok"
                                 style="width:75px; position: absolute; top: -25px; left: 50px; z-index: 99">
                            <table class="table table-borderless" style="position: relative">
                                <tr>
                                    <td colspan="4">
                                        <div class="text-subheader">KARTU KENDALI SURAT MASUK</div>
                                        <div class="font-weight-bold text-center mb-3">PENGADILAN AGAMA MENTOK</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th
                                        style="width: 15%; vertical-align: bottom;">
                                        Nomor Urut</th>
                                    <td style="width: 40%; vertical-align: bottom">
                                        <span
                                              style="font-size: 24px; font-weight: bold; font-family: Arial, Helvetica, sans-serif">
                                            {{ $data->index }}</span>
                                    </td>
                                    <th style="width: 15%; vertical-align: bottom">Kode</th>
                                    <td style="width: 30%; vertical-align: bottom">
                                        <span
                                              style="font-size: 24px; font-weight: bold; font-family: Arial, Helvetica, sans-serif">
                                            {{ $data->category->group->code }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Surat</th>
                                    <td> {{ $data->date_locale }} </td>
                                    <th>Tgl. Penerimaan</th>
                                    <td> {{ $data->created_at_locale }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor Surat</th>
                                    <td> {{ $data->reff }}</td>
                                    <th>Tgl. Penyelesaian</th>
                                    <td> {{ $data->updated_at_locale }} </td>
                                </tr>
                                <tr>
                                    <th>Asal</th>
                                    <td> {{ $data->origin }}</td>
                                    <th>Sifat</th>
                                    <td> {{ $data->type->name }}</td>
                                </tr>
                                <tr>
                                    <th>Perihal</th>
                                    <td colspan="3"> {{ $data->subject }}</td>
                                </tr>
                                <tr>
                                    <th>Lampiran</th>
                                    <td> {{ $data->attachments ?? '-' }}</td>
                                    <th>Pelaksana</th>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <th>Catatan</th>
                                    <td>:</td>
                                    <th>Paraf</th>
                                    <td>:</td>
                                </tr>
                            </table>
                        </div>
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