@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm p-3">

                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h3>Surat Keluar</h3>
                            <a href="{{ route('outbox.create') }}" class="btn btn-primary px-4">Tambah</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
