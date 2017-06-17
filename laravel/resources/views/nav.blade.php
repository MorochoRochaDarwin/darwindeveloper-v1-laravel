<div id="header">
    <!-- Top Bar Start-->
    <nav id="top" class="htop navbar-fixed-top">
        <div class="container-fluid">
            <div class="row">
                <button id="opennav" type="button" class="nav-toggle">
                    <i class="fa fa-bars"></i> MENU
                </button>

                <div id="main-nav" class="pull-left flip left-top">
                    <div class="links">
                        <ul>
                            <li><a id="a-inicio" href="/"><i class="fa fa-windows"></i> Inicio</a></li>
                            <li><a id="a-cursos" href="{{url('cursos')}}">Cursos</a></li>
                            <li><a id="a-tutoriales" href="{{url('tutoriales')}}">Tutoriales</a></li>
                            <li><a id="a-libros" href="{{url('libros')}}">Libros</a></li>
                            <li><a id="a-informacion" href="{{url('informacion')}}">Información</a></li>
                            <li><a id="a-contactos" href="{{url('contactos')}}">Contactos</a></li>
                        </ul>
                    </div>

                </div>
                <div id="top-links" class="nav pull-right flip">
                    <ul>
                        <li><a id="a-guia" href="{{url('guia')}}"><i class="fa fa-list"></i> GUIA</a></li>
                        <li>
                            @if(Auth::guest())
                                <a id="a-users"  href="{{url('login')}}"><i class="fa fa-users"></i><span> Usuarios</span></a>
                            @else
                                <a id="a-users"  href="{{url('home')}}"><i class="fa fa-dashboard"></i><span> Tu Perfil</span></a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Top Bar End-->

    <!-- Header Start-->
    <header class="header-row" style="margin-top: 0px;">
        @include('nav2')

    </header>
    <!-- Header End-->

</div>