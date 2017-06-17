@extends('admin.includes.base')

@section('title','Libros')

@section('content')

    <div class="col-md-12">
        @foreach($json as $categoria)
            <div class="panel panel-default text-center">
                <div class="panel-heading">
                    <h3 style="padding: 0; margin: 0;">{{$categoria->categoria}}</h3>
                </div>
                <div class="panel-body">
                    @foreach($categoria->libros as $libro)
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
                            <a target="_blank" href="{{url('libros/'.urlencode($categoria->categoria).'/'.urlencode($libro->titulo))}}">
                                <img src="{{asset($libro->portada)}}" alt="" width="100%">
                                <p>{{$libro->titulo}}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

@endsection


@section('scripts')

@endsection