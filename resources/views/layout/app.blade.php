<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <!-- CSS only -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"/>
    <title>MiniSend</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .app-header {
            margin-top:50px;

        }
        .h-link{
            text-decoration: none;
        }
        .h-link:hover{
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="/" class="h-link"><h1 class="app-header"><font color="lightblue">M</font>ini<font color="blue">S</font>end</h1></a>
    </div>
    <div id="app">
        <router-view>
        </router-view>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>
