@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card p-3">

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4>Disposisi Surat Masuk</h4>
                    </div>

                    @include('includes.error')

                    <table class="table my-3">
                        <tr>
                            <th class="bg-light" width="20%">Nomor Surat</th>
                            <td class="bg-white">{{ $data->mail->reff }}</td>
                            <th class="bg-light" width="20%">Tanggal Surat</th>
                            <td class="bg-white"> {{ $data->mail->date_locale }} </td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Perihal</th>
                            <td class="bg-white">{{ $data->mail->subject }}</td>
                            <th class="bg-light" width="20%">Kode Surat</th>
                            <td class="bg-white">{{ $data->mail->category['code']." - ".$data->mail->category['name']}}
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Asal</th>
                            <td class="bg-white">{{ $data->mail->origin }}</td>
                            <th class="bg-light" width="20%">Lampiran</th>
                            <td class="bg-white">{{ $data->mail->attachments ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Dokumen</th>
                            <td class="bg-white">
                                @if ($data->mail->document)
                                <a href="{{ Storage::url($data->mail->document) }}" target="_blank"
                                   title="Lihat Dokumen"
                                   class="btn btn-sm btn-light text-danger" title="Lihat">
                                    <i class="fas fa-file-pdf"></i></a>

                                @else
                                <span class="text-muted"><em>Tidak ada dokumen</em></span>
                                @endif
                            </td>
                            <th class="bg-light" width="20%">Sifat Surat</th>
                            <td class="bg-white">{{ $data->mail->type->name }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light" width="20%">Nama Petugas</th>
                            <td class="bg-white" colspan="3">{{ $data->mail->user->name }}</td>
                        </tr>
                    </table>

                    <h5 class="mt-5">Disposisi</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Isi Disposisi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($data->mail->disposition as $item)
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

                            @endforelse
                        </tbody>
                    </table>

                    <form id="form-disposition" action="{{ route('disposition.update', $data->id )}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="notes">Isi Disposisi</label>
                                    <textarea name="notes" id="notes"
                                              class="form-control @error('notes') is-invalid @enderror"
                                              onchange="mirrorForm()">
                                            {{ old('notes') }}
                                            </textarea>
                                    @error('notes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_id">Disposisi Ke</label>
                                    <select name="user_id" id="user_id"
                                            class="form-control select2 @error('user_id') is-invalid @enderror">
                                    </select>
                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>

                    <button type="button" class="btn btn-success px-3"
                            onclick="completed()">Selesaikan Disposisi</button>
                    <button type="button" class="btn btn-primary px-3"
                            onclick="updateData()">Lanjutkan Disposisi</button>
                    <a href="{{ route('inbox.index') }}" class="btn btn-light px-3">Kembali</a>

                    <form id="form-complete" action="{{ route('disposition.complete', $data->id) }}"
                          method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="notes" id="hidden_notes">
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

        updateData = () => {
            $('#form-disposition').submit();
        }

        mirrorForm = () => {
            $('#hidden_notes').val($('#notes').val())
        }

        completed = () => {
            swalConfirm.fire({
                title: 'Disposisi Surat Masuk',
                text: 'Apakah Anda ingin mengakhiri proses disposisi?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: `Ya`,
                cancelButtonText: `Batal`,
                reverseButtons: false,
                focusConfirm: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-complete').submit();
                    } 
                }
            )
        }

        $('#user_id').select2({
            ajax: {
                placeholder: '-- Pilih --',
                    dalay: 100,
                        url: '{{ route('api.user.populate.user_disposition') }}',
                        dataType: 'json',
                        type: 'POST',
                        data: function (params){
                        return {
                                q: params.term,
                                id: {{ $data->id }},
                            };
                        },
                        processResults: function (data) {
                        return {
                            results: data.items
                    };
                }
            }
        });

    });
</script>
@endpush