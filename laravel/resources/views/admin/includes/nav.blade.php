<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('home')}}"><i class="fa  fa-dashboard"></i> HOME</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">


                @if(Auth::user()->type=='super')
                    <li>
                        <a href="{{url('admin/categorias')}}">
                            <i class="livicon" data-name="arrow-right" data-s="18"></i>
                            Categorias
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/subcategorias')}}">
                            <i class="livicon" data-name="arrow-right" data-s="18"></i>
                            SubCategorias
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/cursos')}}">
                            <i class="livicon" data-name="arrow-right" data-s="18"></i>
                            Cursos
                        </a>
                    </li>


                    <li>
                        <a href="{{url('admin/usuarios')}}">
                            <i class="livicon" data-name="arrow-right" data-s="18"></i>
                            Usuarios
                        </a>
                    </li>
                @endif


            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a target="_blank" href="/"><i class="fa fa-chrome"></i> WEB</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><i class="fa fa-user"></i> {{ Auth::user()->name }} <span
                                class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('home/password/reset') }}">Cambio de contraseña</a></li>
                        <li role="separator" class="divider"></li>
                        <li>

                            @if( Auth::user()->facebook_id != null)
                                <a href="{{ url('/log-out') }}">
                                    <i class="livicon" data-name="sign-out" data-s="18"></i>
                                    Cerrar Sesion
                                </a>
                            @else
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="livicon" data-name="sign-out" data-s="18"></i>
                                    Cerrar Sesion
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            @endif


                        </li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


