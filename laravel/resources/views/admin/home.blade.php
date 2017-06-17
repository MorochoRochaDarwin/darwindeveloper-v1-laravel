@extends('admin.includes.base')

@section('title','Darwin Developer Home admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Bienvenido {{Auth::user()->name}}
                    </div>

                    <div class="panel-body">
                        <a class="col-xs-6 col-sm-6 col-md-3 text-center" href="{{url('home/cursos')}}" style="padding: 20px;">
                            <img src="/img/cursos.jpg" alt="" width="100%"><br>
                            <b>TUS CURSOS</b><br>
                        </a>
                        <a class="col-xs-6 col-sm-6 col-md-3 text-center" href="{{url('home/tutoriales')}}" style="padding: 20px;">
                            <img src="/img/tutoriales.jpg" alt="" width="100%"><br>
                            <b>TUS TUTORIALES</b><br>
                        </a>

                        <a class="col-xs-6 col-sm-6 col-md-3 text-center" href="{{url('home/libros')}}" style="padding: 20px;">
                            <img src="/img/libros.jpg" alt="" width="100%"><br>
                            <b>LIBROS</b>
                        </a>

                        <a class="col-xs-6 col-sm-6 col-md-3 text-center" href="{{url('home/tu-cuenta')}}" style="padding: 20px;">
                            <img src="/img/usuario.jpg" alt="" width="100%"><br>
                            <b>TU CUENTA</b>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
