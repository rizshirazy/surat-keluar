@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 90vh">
        <div class="col-md-7 col-sm-12">
            <div class="card p-3">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('images/logo.png')}}" alt="" style="width: 10em;">
                    </div>
                    <h3 class="text-center">Sistem Informasi Tata Naskah Dinas</h3>
                    <h4 class="text-center mb-4">Pengadilan Agama Mentok</h4>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                <input id="email" type="email"
                                       class="form-control col-md-8 @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                       placeholder="Username">

                                @error('email')
                                <div class="invalid-feedback text-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-flex justify-content-center">
                                <input id="password" type="password"
                                       class="form-control col-md-8 @error('password') is-invalid @enderror"
                                       name="password"
                                       required autocomplete="current-password"
                                       placeholder="Password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-info text-white btn-block col-md-8">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection