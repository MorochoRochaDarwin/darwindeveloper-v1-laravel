@extends('base')

@section('title','Tutoriales, cursos y libros de '.$lenguaje)



@section('content')
    <div class="dsmr-card">
        <div class="panel-body">
            <a class="col-xs-6 col-sm-6 col-md-3 text-center" href="{{url('cursos')}}" style="padding: 20px;">
                <img src="/img/cursos.jpg" alt="" width="100%"><br>
                <b style="text-transform: uppercase">CURSOS {{$lenguaje}}</b><br>
            </a>
            <a class="col-xs-6 col-sm-6 col-md-3 text-center" href="{{url('tutoriales')}}" style="padding: 20px;">
                <img src="/img/tutoriales.jpg" alt="" width="100%"><br>
                <b style="text-transform: uppercase">TUTORIALES {{$lenguaje}}</b><br>
            </a>

            <a class="col-xs-6 col-sm-6 col-md-3 text-center" href="{{url('libros/'.urlencode($lenguaje))}}" style="padding: 20px;">
                <img src="/img/libros.jpg" alt="" width="100%"><br>
                <b style="text-transform: uppercase">LIBROS {{$lenguaje}}</b>
            </a>

            <a class="col-xs-6 col-sm-6 col-md-3 text-center" href="{{url('webs/'.urlencode($lenguaje))}}" style="padding: 20px;">
                <img src="/img/website.png" alt="" width="100%"><br>
                <b style="text-transform: uppercase">WEBS RECOMENDADAS</b>
            </a>
        </div>
    </div>

@endsection


