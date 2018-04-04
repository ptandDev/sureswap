<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>App Name</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Курсы вылют">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/default.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
    <div class="container">
        <div class="row col-md-12 div-top bmargin">
            <a class="sitename" href={{route('index')}}>Курсы валют</a>
            @if(Route::currentRouteName()=='index')
                <p class="city">Ваш город</p>
                @else
                    <div class="city visible-md visible-lg">
                        <span class="glyphicon glyphicon-map-marker"></span>
                        <a data-toggle="modal"  data-target=".bs-example-modal-lg">{{$currentCity}}</a>
                    </div>
                    <div class="city visible-xs visible-sm">
                        <span class="glyphicon glyphicon-map-marker"></span>
                        <a href={{route('index')}}>{{$currentCity}}</a>
                    </div>
            @endif
        </div>
    @yield('content')
    </div>
</body>
</html>