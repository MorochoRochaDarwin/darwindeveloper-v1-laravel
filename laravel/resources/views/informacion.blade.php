@extends('base')

@section('title','Darwin Developer Informacion')

@section('meta')
    <meta name="description" charset="Darwin Developer Contactos">
@endsection


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.transitions.css">

    <style>
        .serviceBox {
            text-align: center;
            margin: 0 -15px;
        }

        .serviceBox img {
            width: 100%;
            height: auto;
        }

        .serviceBox .service-content {
            position: relative;
            background: #0099cc;
            color: #fff;
            padding: 50px 30px 30px;
        }

        .serviceBox .service-icon {
            display: block;
            width: 70px;
            height: 70px;
            background: #fff;
            border-radius: 10px;
            position: absolute;
            top: -35px;
            left: 0;
            right: 0;
            margin: auto;
            transform: rotate(45deg);
        }

        .serviceBox .service-icon i {
            font-size: 30px;
            line-height: 70px;
            color: #0099cc;
            transform: rotate(-45deg);
        }

        .serviceBox .title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .serviceBox .description {
            font-size: 14px;
            line-height: 25px;
            margin-bottom: 20px;
        }

        .serviceBox .read-more {
            display: inline-block;
            padding: 7px 20px;
            border: 1px solid #fff;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            color: #fff;
            background: #0099cc;
            text-transform: capitalize;
            transition: all 0.5s ease 0s;
        }

        .serviceBox .read-more:hover {
            color: #0099cc;
            background: #fff;
            text-decoration: none;
        }

        .serviceBox.middle .service-content {
            padding: 30px 30px 50px;
        }

        .serviceBox.middle .service-icon {
            bottom: -35px;
            top: auto;
        }

        @media only screen and (max-width: 990px) {
            .serviceBox .title {
                font-size: 17px;
            }
        }

        @media only screen and (max-width: 767px) {
            .serviceBox {
                margin: 0 0 30px 0;
            }
        }

        .testimonial {
            border-left: 3px solid #0099cc;
            padding: 100px 0 100px 275px;
            position: relative
        }

        .testimonial:before,
        .testimonial:after {
            content: "";
            width: 320px;
            height: 55px;
            border-right: 3px solid #0099cc;
            position: absolute;
            left: 0;
        }

        .testimonial:before {
            border-top: 3px solid #0099cc;
            top: 0;
        }

        .testimonial:after {
            border-bottom: 3px solid #0099cc;
            bottom: 0;
        }

        .testimonial .pic {
            width: 100px;
            height: 100px;
            position: absolute;
            top: 100px;
            left: 100px;
        }

        .testimonial .pic img {
            width: 100%;
            height: auto;
        }

        .testimonial .description {
            font-size: 14px;
            color: #7a7e82;
            line-height: 27px;
            position: relative;
        }

        .testimonial .description:before {
            content: "\f10d";
            font-family: fontawesome;
            position: absolute;
            top: -70px;
            left: 0;
            font-size: 20px;
            color: #7a7e82;
        }

        .testimonial .testimonial-title {
            font-size: 22px;
            font-weight: 800;
            color: #22272c;
            text-transform: capitalize;
        }

        .testimonial .post {
            display: block;
            font-size: 15px;
            font-weight: 700;
            color: #0099cc;
            margin-top: 10px;
        }

        .owl-theme .owl-controls {
            text-align: right;
            margin-top: 30px;
        }

        .owl-theme .owl-controls .owl-buttons div {
            background: #0099cc;
            border-radius: 0;
            opacity: 1;
            padding: 5px 10px;
        }

        .owl-prev:before,
        .owl-next:before {
            content: "\f053";
            font-family: 'FontAwesome';
            color: #fff;
        }

        .owl-next:before {
            content: "\f054";
        }

        @media only screen and (max-width: 990px) {
            .testimonial {
                padding: 80px 0 80px 265px;
            }
        }

        @media only screen and (max-width: 767px) {
            .testimonial {
                padding: 0;
                border: none;
            }

            .testimonial:before,
            .testimonial:after {
                border: none;
            }

            .testimonial .pic {
                position: relative;
                top: 0;
                left: 0;
            }

            .testimonial .description {
                margin-top: 15px;
            }

            .testimonial .description:before {
                content: "";
            }
        }
    </style>
@endsection



@section('content-pu')



    <!-- dd-index1 -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-7777765013946493"
         data-ad-slot="6835920968"
         data-ad-format="auto"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <!-- dd-index2 -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-7777765013946493"
         data-ad-slot="8312654161"
         data-ad-format="auto"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <br>
@endsection()


@section('content')



    <div class="dsmr-card">

        <div class="row text-center"><br>

            <h1 class="heading">¿Quienes Somos?</h1>

            <p style="font-size: 20px;">Somos una página web sin fines de lucro, con fines educativos orientados al área
                de la programación, en
                especial al campo de la programación web, móvil.
            </p>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                <div class="serviceBox">
                    <img src="{{asset('img/webdesing.jpg')}}">

                    <div class="service-content">
                    <span class="service-icon">
                        <i class="fa fa-html5"></i>
                    </span>

                        <h3 class="title">Diseño Web</h3>

                        <p class="description" style="text-align: justify">
                            Con sólidos conocimientos en el manejo de HTML5, Css y JavaScript. Además somos expertos en
                            el manejo del Framework Bootstrap para la creaciones de páginas web responsive con un diseño
                            único.
                        </p>

                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="serviceBox middle">
                    <div class="service-content">
                    <span class="service-icon">
                        <i class="fa fa-globe"></i>
                    </span>

                        <h3 class="title">Aplicaciones Web</h3>

                        <p class="description" style="text-align: justify">
                            Usamos los lenguajes de programación PHP y Python así como también los Framework Laravel y
                            Django, los cuales son las herramientas más usadas para la creación de aplicaciones web
                            seguras y poderosas.
                        </p>

                    </div>
                    <img src="{{asset('img/seo.jpg')}}">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="serviceBox">
                    <img src="{{asset('img/moviles.jpg')}}">

                    <div class="service-content">
                    <span class="service-icon">
                        <i class="fa fa-android"></i>
                    </span>

                        <h3 class="title">Aplicaciones Moviles</h3>

                        <p class="description" style="text-align: justify">
                            Creamos aplicaciones móviles nativas Android con el lenguaje de programación java. Usamos
                            Ionic el Framework que permite crear aplicaciones móviles multiplataforma para Android, IOS
                            y Windows Phone con gran rapidez.
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="dsmr-card">
        <div class="row">
            <div class="col-md-12">
                <div id="testimonial-slider" class="owl-carousel">
                    <div class="testimonial">
                        <div class="pic">
                            <img src="/img/darwin.jpg" alt="">
                        </div>
                        <div class="testimonial-content">
                            <p class="description" style="text-align: justify; color: black;">
                                Creador y administrador de este sitio web. Estudiante de la carrera de Ingeniería en
                                Computación Grafica de la Universidad Central del Ecuador. El presente sitio web es una
                                aplicación web creada con el Framework Laravel cumpliendo con los estándares y
                                seguridades de la programación web.
                            </p>

                            <h3 class="testimonial-title">Darwin Morocho
                                <small class="post">Desarrollador web y movil</small>
                            </h3>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <hr>
    </div>
@endsection



@section('scripts')

    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>


    <script>
        $(document).ready(function () {
            $('#a-informacion').addClass('active');
            $("#testimonial-slider").owlCarousel({
                items: 1,
                itemsDesktop: [1000, 2],
                itemsDesktopSmall: [979, 1],
                itemsTablet: [768, 1],
                pagination: false,
                navigation: true,
                slideSpeed: 1000,
                singleItem: true,
                transitionStyle: "goDown",
                navigationText: ["", ""],
                autoPlay: false
            });

        });
    </script>
@endsection