<!DOCTYPE html>
<html lang="pt-br">
    <head>
    	<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="google-site-verification" content="QmIWiV6myEkzAONZs45zJROviJCSlA-6kSCE4bQjTNY" />

    	<title>{{ $header_title ?? 'Mosaic' }}</title>

        <base href="{{ url('/') }}">
        <link rel="canonical" href="{{ $header_canonical ?? url()->current() }}" />
    	<link rel="shortcut icon" href="{{ asset('images/icon-infochat.png') }}">
    	<meta name="theme-color" content="#756ff1">
        <meta name="csrf-token" content="{!! csrf_token() !!}">

    	<!-- SEO META TAGS -->
    	@if (isset($header_keywords))
    		<meta name="keywords" content="{{ $header_keywords }}" />
    	@else
    		<meta name="keywords" content="infochat, estabelecimentos, profissionais, atendimento" />
    	@endif

    	<meta name="description" content="{{ $header_desc ?? 'O atendimento online da sua cidade.' }}" />
    	<meta itemprop="name" content="{{ $header_title ?? 'Infochat' }}" />
    	<meta itemprop="description" content="{{ $header_desc ?? 'O atendimento online da sua cidade.' }}" />
    	<meta itemprop="image" content="{{ $header_image ?? asset('images/social-infochat.png') }}" />

    	<meta name="twitter:card" content="summary_large_image" />
    	<meta name="twitter:title" content="{{ $header_title ?? 'Infochat' }}" />
    	<meta name="twitter:description" content="{{ $header_desc ?? 'O atendimento online da sua cidade.' }}" />
    	<!-- imagens largas para o Twitter Summary Card precisam ter pelo menos 280x150px  -->
    	<meta name="twitter:image" content="{{ $header_image ?? asset('images/social-infochat.png') }}" />

    	<meta property="og:title" content="{{ $header_title ?? 'Infochat' }}" />
    	<meta property="og:type" content="website" />
    	<meta property="og:url" content="{{ url()->current() }}" />
    	<meta property="og:image" content="{{ $header_image ?? asset('images/social-infochat.png') }}" />
        <meta property="og:image:secure_url" content="{{ $header_image ?? asset('images/social-infochat.png') }}" />
        <meta property="og:description" content="{{ $header_desc ?? 'O atendimento online da sua cidade.' }}" />
    	<meta property="og:site_name" content="Infochat" />
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="fb:app_id" content="2156565304635391" />

        <style>body{opacity:0;}</style>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">

        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
    </head>
    <body class="{{ $body_class ?? '' }}">
        @yield ('content')

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.8/jquery.mask.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-load-image/2.24.0/load-image.all.min.js"></script>

        <script>
            @if (Auth::check())
                var user_logged = true;
            @else
                var user_logged = false;
            @endif
        </script>

        <script src="{{ mix('js/app.js') }}"></script>

        @if (session('session_flash'))
            <script>
                modalAlert("{!! session('session_flash') !!}");
            </script>
        @endif

        @yield ('script')
    </body>
</html>
