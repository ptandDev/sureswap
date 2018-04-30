<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Курсы валют - {{$currentCity}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Курсы валют банков в городе {{$currentCity}}. Лучшие курсы валют. Выгодные курсы вылют. Курсы ЦБ">

    <link href="https://fonts.googleapis.com/css?family=East+Sea+Dokdo" rel="stylesheet">
    <link href="{{ secure_asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/default.css') }}" rel="stylesheet">

    <script src="{{ secure_asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ secure_asset('js/bootstrap.min.js') }}"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter48373526 = new Ya.Metrika({
                        id:48373526,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/48373526" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

</head>
<body>
    <div class="container">
        <div class="row div-top bmargin">
            <div class="col-md-12">
                <a style="text-decoration: none!important;" class="sitename" href={{route('index')}}><img src="{{ secure_asset('css/images/logo.png') }}"></a>
                @if(Route::currentRouteName()=='index')
                    <div class="city">
                        <span class="glyphicon glyphicon-map-marker"></span>
                        Город
                    </div>
                @else
                    <div class="city visible-md visible-lg">
                        <span class="glyphicon glyphicon-map-marker"></span>
                        <a style="text-decoration: none!important;" data-toggle="modal"  data-target=".bs-example-modal-lg">{{$currentCity}}</a>
                    </div>
                    <div class="city visible-xs visible-sm">
                        <span class="glyphicon glyphicon-map-marker"></span>
                        <a href={{route('index')}}>{{$currentCity}}</a>
                    </div>
                @endif
            </div>
        </div>
        @yield('content')
    </div>
</body>
</html>