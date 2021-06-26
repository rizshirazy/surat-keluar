<nav class="navbar-1-1 navbar navbar-expand-md navbar-light bg-white shadow-sm p-4 px-md-4 mb-3">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="" style="width: 35px; margin-top: -3.5px">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @auth
                <li class="nav-item {{ (request()->is('inbox*')) ? 'active' : '' }}">
                    <a class="nav-link px-md-4"
                       href="{{ route('inbox.index') }}">Surat Masuk</a>
                </li>
                <li class="nav-item {{ (request()->is('outbox*')) ? 'active' : '' }}">
                    <a class="nav-link px-md-4"
                       href="{{ route('outbox.index') }}">Surat Keluar</a>
                </li>
                <li class="nav-item {{ (request()->is('category*')) ? 'active' : '' }}">
                    <a class="nav-link px-md-4 "
                       href="{{ route('category.index') }}">Kode Surat</a>
                </li>
                <li class=" nav-item {{ (request()->is('user*')) ? 'active' : '' }}">
                    <a class="nav-link px-md-4" href="{{ route('user.index') }}">Pengguna</a>
                </li>
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a href="{{ route('password.change.view') }}" class="dropdown-item">Ganti Password</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                                                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>