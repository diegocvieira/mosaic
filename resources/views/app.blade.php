<!DOCTYPE html>
<html lang="pt-br">
    <head>
    	<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="robots" content="noindex">

    	<title>{{ $header_title ?? 'Mosaic' }}</title>

        <base href="{{ url('/') }}">
        <link rel="canonical" href="{{ $header_canonical ?? url()->current() }}" />
    	<link rel="shortcut icon" href="{{ asset('images/icon-mosaic.png') }}">
    	<meta name="theme-color" content="#fff">
        <meta name="csrf-token" content="{!! csrf_token() !!}">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
    </head>
    <body class="{{ $body_class ?? '' }}">
        <div class="loading"></div>

        @if (session('flash_message'))
            <div class="alert alert-info" role="alert">
                {{ session('flash_message') }}
            </div>
        @endif

        @yield ('content')

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <script src="{{ mix('js/app.js') }}"></script>

        @yield ('script')
    </body>
</html>
