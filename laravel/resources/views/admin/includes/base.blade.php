<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- global css -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!-- end of global css -->
    <link rel="stylesheet" href="/datatables/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/datatables/media/css/dataTables.bootstrap.css">
    <link rel="stylesheet" href="/jquery-confirm/css/jquery-confirm.css">
    <link rel="shortcut icon" type="image/ico" href="/img/favicon.ico"/>

    <link rel="stylesheet" href="/css/dsmr-admin.css">
    @yield('css')
</head>

<body class="skin-josh">
@include('admin.includes.nav')
<div class="">
    <!-- Left side column. contains the logo and sidebar -->


    <aside class="" style="padding-top: 60px;">

        <section class="content">
            @yield('content')
        </section>

    </aside>
    <!-- right-side -->

    <hr>

    <img src="/img/jscsshtml.png" alt="" width="100%">
    <footer style="background: #fff; color: #000; padding-top: 20px;">


        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <b>DARWIN DEVELOPER</b>

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
                <b>&copy; Darwin Morocho</b>

                <p>Universidad Central del Ecuador - Ingeniería en Computación Grafica</p>

                <p>Todos los derechos reservados</p>
            </div>
        </div>
    </footer>

</div>


<button type="button" style="position: fixed; bottom: 20px; right: 20px; z-index: 999;" id="back-to-top" class="btn btn-primary btn-lg back-to-top" role="button">
    <i class="fa fa-arrow-up"></i>
</button>
<!-- global js -->
<script src="/js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="/js/bootstrap.min.js" type="text/javascript"></script>
<!--livicons-->




<script src="/jquery-confirm/js/jquery-confirm.js"></script>
<script src="/js/notify.js"></script>
<script src="/datatables/media/js/jquery.dataTables.min.js"></script>

<!-- end of global js -->
<script>
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $("#back-to-top").click(function () {
            //1 second of animation time
            //html works for FFX but not Chrome
            //body works for Chrome but not FFX
            //This strange selector seems to work universally
            $("html, body").animate({scrollTop: 0}, 400);
        });
    });
</script>
@yield('scripts')
</body>
</html>
