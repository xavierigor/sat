<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Navicon -->
    <link rel="shortcut icon" href="{{asset("images/favicon.png")}}">

    <title>@yield('title') - {{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href={{asset('css/main.css')}}>
    <link rel="stylesheet" href={{asset('css/sidebar.css')}}>
    <link rel="stylesheet" href={{asset('css/admin.css')}}>
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
</head>
<body>
    @include('includes.navs.navbar')
    @include('includes.navs.sidebar')
    
    <div class="container-fluid" id="main">
        <div class="header">
            @yield('header', config('app.name'))
        </div>
        <section class="shadow-sm">
            @yield('content')
        </section>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
    <!-- cdn plugin para tratar campo de arquivos bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    

    <!-- plugin para tratar campo de arquivos bootstrap -->
    <script >
        $(document).ready(function () {
            bsCustomFileInput.init()
        })
    </script>

    @yield('scripts')
    @include('includes.messages')
</body>
</html>