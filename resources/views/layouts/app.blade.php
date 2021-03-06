<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <script src="https://kit.fontawesome.com/052f42c09c.js" crossorigin="anonymous"></script>


    <!-- Styles -->
    @include('includes.material-icons')
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/threedots/three-dots.min.css') }}" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
          integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
          crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
          href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-html5-1.6.5/r-2.2.7/datatables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .datepicker table tr td.highlighted {
            background: none;
            color: red;
        }

        .select2-container .select2-selection--single {
            height: calc(1.5em + 0.75rem + 2px);
            border: 1px solid #d8dbe0;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            margin: 2px 0 2px 0;
            color: #768192;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(1.5em + 0.75rem);
        }

        div.dataTables_wrapper div.dataTables_length select {
            width: 55px;
        }

        .is-invalid~.select2-container .select2-selection--single {
            border-color: #e55353;
        }

        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

        .navbar-1-1.navbar-light .navbar-nav .nav-item:hover {
            border-bottom: 3px solid #2fa360;
        }

        .navbar-1-1.navbar-light .navbar-nav .nav-item.active {
            color: #092a33;
            font-weight: 600;
            border-bottom: 3px solid #2fa360;
        }

        .glass-effect {
            box-shadow: 0 0 1rem 0 rgba(0, 0, 0, .2);
            border-radius: 5px;
            background-color: rgba(255, 255, 255, .15);

            backdrop-filter: blur(5px);
        }
    </style>

    <style>
        body {
            background: #D6D8D5 url("{{ asset('images/background.jpg') }}") no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <div id="app">
        @include('includes.navbar')

        <main class="py-4">
            @yield('content')
        </main>

        <!-- Modal -->
        <div class="modal fade" id="mainModal" tabindex="-1" aria-labelledby="mainModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content data">

                </div>
            </div>
        </div>

    </div>
    <!-- Scripts -->
    @stack('script-before')

    <script src="{{ asset('vendor/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
            integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.id.min.js"
            integrity="sha512-zHDWtKP91CHnvBDpPpfLo9UsuMa02/WgXDYcnFp5DFs8lQvhCe2tx56h2l7SqKs/+yQCx4W++hZ/ABg8t3KH/Q=="
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-html5-1.6.5/r-2.2.7/datatables.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.1/chart.min.js"
            integrity="sha512-tOcHADT+YGCQqH7YO99uJdko6L8Qk5oudLN6sCeI4BQnpENq6riR6x9Im+SGzhXpgooKBRkPsget4EOoH5jNCw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        const swalConfirm = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success px-4 mr-2',
                cancelButton: 'btn btn-outline-secondary px-4 mr-2',
            },
            buttonsStyling: false
        });

        const swalDanger = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-danger px-4 mr-2',
                cancelButton: 'btn btn-light px-4 mr-2',
            },
            buttonsStyling: false,
        });
    </script>

    @stack('script-after')
</body>

</html>