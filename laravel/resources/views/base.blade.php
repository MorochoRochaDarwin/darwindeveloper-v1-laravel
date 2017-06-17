<!DOCTYPE html>
<html lang="es">
<head>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-7777765013946493",
            enable_page_level_ads: true
        });
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/ico" href="{{asset('img/favicon.ico')}}"/>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main-style.css')}}">
    <link rel="stylesheet" href="{{asset('css/cards.css')}}">
    <link rel="stylesheet" href="{{asset('css/header.css')}}">

    <link rel="stylesheet" href="{{asset('css/dsmr-admin.css')}}">
    <link href="{{asset('ckeditor/plugins/codesnippet/lib/highlight/styles/monokai.css')}}" rel="stylesheet">
    <script src="{{asset('ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js')}}"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    @yield('css')

</head>
<body >

<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.8&appId=857879770992786";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>


@include('nav')


<div class="container-fluid">
    <div class="row">

        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs" id="left" style="padding-right: 0px;">
            <div class="dsmr-card">
                <img src="{{asset('img/darwindeveloperb.png')}}" alt="" width="100%"
                     style="padding: 20px 10px 0px 10px;">
                <hr>
                <div class="text-justify">
                    Este es un sitio web educativo sin fines de lucro. Aquí trato aquellos temas y dudas que surgen
                    durante
                    este proceso de formación como desarrollador web y movil.
                </div>
            </div>


            @yield('content-left')


            <div class="dsmr-card text-center">
                <b>Sigueme en mis redes sociales</b>
                <hr>


                <div class="fb-like" data-href="https://www.facebook.com/darwindevelopers/" data-layout="button_count"
                     data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                <hr>
                <!-- Place this tag in your head or just before your close body tag. -->
                <script src="https://apis.google.com/js/platform.js" async defer>
                    {
                        lang: 'es-419'
                    }
                </script>

                <!-- Place this tag where you want the widget to render. -->
                <div class="g-person" data-width="236" data-href="//plus.google.com/109422618267884023911"
                     data-showcoverphoto="false" data-rel="author"></div>

                <hr>
                <a class="twitter-follow-button"
                   href="https://twitter.com/DarwinDeveloper">
                    Follow @DarwinDeveloper</a>
            </div>

            <div class="dsmr-card text-center">
                <b>SUSCRIBETE A NUESTRO BOLETÍN</b>

                <p>Mantente enterado de nuestras ultimas publicaciones</p>

                @include('auth.flash')

                <form method="post" action="{{url('nuevo-suscriptor')}}">
                    {{csrf_field()}}
                    <input name="email" style="width: 60%; float: left" required type="email" class="form-control"
                           placeholder="tu email">
                    <button style="width: 40%" class="btn btn-info">SUSCRIBIRSE</button>
                </form>
            </div>


            <div class="dsmr-card text-center"><br>
                <b>&copy; Darwin Morocho</b>
                <hr>
                <a target="_blank" class="btn btn-primary btn-circle btn-lg"
                   href="https://es-la.facebook.com/darwindevelopers/"><i class="fa fa-2x fa-facebook"></i></a>
                <a target="_blank" class="btn btn-danger btn-circle btn-lg"
                   href="https://plus.google.com/109422618267884023911"><i class="fa fa-2x fa-google"></i></a>
                <a target="_blank" class="btn btn-success btn-circle btn-lg" href="https://github.com/darwin18091993"><i
                            class="fa fa-2x fa-github"></i></a>
                <a target="_blank" class="btn btn-info btn-circle btn-lg" href="https://twitter.com/DarwinDeveloper"><i
                            class="fa fa-2x fa-twitter"></i></a>

                <br><br>

                <p>Universidad Central del Ecuador<br>Ingeniería en Computación Grafica</p>
                <hr>
                <p>Todos los derechos reservados</p>
            </div>


            <div class="dsmr-card" style="background-color: tomato;">
                <h6 style="text-align: center; font-size: 20px; color: white;">Este sitio web fue creado con<br><b>LARAVEL
                        5.3</b></h6>
            </div>


            @yield('content-pu')

        </div>

        <div class="col-lg-9 col-md-9" style="min-height: 400px;">
            @yield('content')
        </div>

    </div>
</div>


<img src="{{asset('img/jscsshtml.png')}}" alt="" width="100%">


<footer class="hidden-lg hidden-md">


    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <b>DArwin Developer</b>

                <p>Este es un sitio web educativo sin fines de lucro. Aquí trato aquellos temas y dudas que surgen
                    durante
                    este proceso de formación como desarrollador web y movil.</p>


            </div>

            <div class="col-md-4">
                <b>CONTACTOS</b>

                <p><i class="fa fa-map-marker"></i> Quito - Ecuador</p>

                <p><i class="fa fa-phone"></i> +593 9825 99240</p>

                <p><i class="fa fa-envelope"></i> dsmr.apps@gmail.com</p>
            </div>


            <div class="col-md-4 text-right">
                <b>SUSCRIBETE A NUESTRO BOLETÍN</b>

                <p>Mantente enterado de nuestras ultimas publicaciones</p>

                @include('auth.flash')

                <form method="post" action="{{url('nuevo-suscriptor')}}">
                    {{csrf_field()}}
                    <input name="email" style="width: 60%; float: left" required type="email" class="form-control"
                           placeholder="tu email">
                    <button style="width: 40%" class="btn btn-info">SUSCRIBIRSE</button>
                </form>
            </div>

            <div class="clearfix"></div>
            <hr>
            <b>&copy; Darwin Morocho</b><br>
            <a target="_blank" class="btn btn-primary btn-circle btn-xl"
               href="https://es-la.facebook.com/darwindevelopers/"><i class="fa fa-2x fa-facebook"></i></a>
            <a target="_blank" class="btn btn-danger btn-circle btn-xl"
               href="https://plus.google.com/109422618267884023911"><i class="fa fa-2x fa-google"></i></a>
            <a target="_blank" class="btn btn-success btn-circle btn-xl" href="https://github.com/darwin18091993"><i
                        class="fa fa-2x fa-github"></i></a>
            <a target="_blank" class="btn btn-info btn-circle btn-xl" href="https://twitter.com/DarwinDeveloper"><i
                        class="fa fa-2x fa-twitter"></i></a>


            <p>Universidad Central del Ecuador - Ingeniería en Computación Grafica</p>

            <p>Todos los derechos reservados</p>
        </div>
    </div>
</footer>


<div style="bottom: 10px; right: 10px; position: fixed;">
    <a id="toTop" href="javascript:;" class="btn btn-info" style="display: none">
        <i class="fa fa-arrow-up"></i>
    </a>
</div>
<script>window.twttr = (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
                t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);

        t._e = [];
        t.ready = function (f) {
            t._e.push(f);
        };

        return t;
    }(document, "script", "twitter-wjs"));</script>
<script type="text/javascript" src="{{asset('js/jquery.2.1.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('livicons/minified/raphael-min.js')}}" type="text/javascript"></script>
<script src="{{asset('livicons/minified/livicons-1.4.min.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function () {


        $('#opennav').click(function (e) {
            $('#main-nav div').toggleClass('open');
        });

        $('[data-toggle="tooltip"]').tooltip();

        $("#toTop").click(function () {
            //1 second of animation time
            //html works for FFX but not Chrome
            //body works for Chrome but not FFX
            //This strange selector seems to work universally
            $("html, body").animate({scrollTop: 0}, 400);
        });


        var scrollTop = 0;
        $(window).scroll(function () {
            scrollTop = $(window).scrollTop();
            var width = $(window).width();


            if (scrollTop >= 100) {
                $("#toTop").fadeIn('slow');
            } else {
                $("#toTop").fadeOut('slow');
            }


        });

        $('#main-content').click(function () {
            $('nav').removeClass('open');
        });


        $('[data-toggle=collapse-side]').click(function (e) {
            $('nav').toggleClass('open');
        });
    });


</script>
@yield('scripts')
</body>
</html>
