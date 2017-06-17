@extends('base')

@section('title','Libros')



@section('content')
    <section class="wrapper dsmr-card">
        <div class="container-fostrap">
            <div>
                <h1 class="heading">
                    Libros por categorias
                </h1>
            </div>
            <div class="content">
                <div class="container-fluid">

                    @foreach($categorias as $categoria)
                        <div class="col-md-3 col-sm-6">
                            <a href="{{url('libros/'.urlencode($categoria->id))}}">
                                <img style="border-radius: 10px;" src="{{asset($categoria->img)}}" alt="{{$categoria->id}}" width="100%">
                                <h3 style="margin: 0;">{{$categoria->id}}</h3>
                                <br>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

@endsection


@section('scripts')
    <script>
        $(function(){
            $('#a-libros').addClass('active');
        });
    </script>
@endsection