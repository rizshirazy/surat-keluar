<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        body {
            background: url("{{ asset('images/background.jpg') }}") no-repeat;
            background-size: cover;
        }

        .glass-effect {
            box-shadow: 0 0 1rem 0 rgba(0, 0, 0, .2);
            border-radius: 5px;
            background-color: rgba(255, 255, 255, .15);
            filter: blur(5px);
            -webkit-filter: blur(5px);
        }

        .custom-card {
            display: flex;
            padding: 30px 50px;
            background: white;
            border-radius: 5px;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .code {
            border-right: 2px solid;
            font-size: 26px;
            padding: 0 15px 0 15px;
            text-align: center;
            align-self: center;
        }

        .message {
            font-size: 18px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="d-flex align-items-center flex-column">
            <div class="custom-card">
                <div class="code">
                    @yield('code')
                </div>

                <div class="message" style="padding: 10px;">
                    @yield('message')
                </div>
            </div>

            <a href="/" class="btn btn-light mt-4 px-4">Kembali ke Dashboard</a>
        </div>
    </div>
</body>

</html>