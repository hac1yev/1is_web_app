<head>

    <meta charset="utf-8" />
    <title>@yield('title','1is')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta content="1is | İdarəetmə paneli" name="description" />
    <meta content="KananMirza" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset($setting->favicon)}}">

    <!-- Bootstrap Css -->
    <link href="{{asset('back/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('back/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('back/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    @yield('css')
</head>
