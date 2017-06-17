@extends('base')

@section('title','Guia de lenguajes de programacion')



@section('content')
    <div class="dsmr-card text-center">
        <div>
            <h1 class="heading">
                Todas nuestras categorias
            </h1>
        </div>
        <div class="content">
            <div class="container-fluid">

                @foreach($categorias as $categoria)
                    <div class="col-md-3 col-sm-6">
                        <a href="{{url('guia/'.urlencode($categoria->id))}}">
                            <img style="border-radius: 10px;" src="{{asset($categoria->img)}}" alt="{{$categoria->id}}" width="100%">
                            <h3 style="margin: 0;">{{$categoria->id}}</h3>
                            <br>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

@endsection


