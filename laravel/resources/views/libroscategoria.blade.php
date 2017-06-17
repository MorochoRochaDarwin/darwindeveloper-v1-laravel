@extends('base')

@section('title','Libros '.$categoria)



@section('content')
    <div class="dsmr-card text-center">
        <h1 class="heading">
            Libros {{$categoria}}
        </h1>

        @if(count($libros)>0)
            @foreach($libros as $libro)
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <a href="{{url('libros/'.urlencode($categoria).'/'.urlencode($libro->titulo))}}">
                        <img style="border-radius: 10px; border: 1px solid #0099cc;" src="{{asset($libro->portada)}}" alt="{{$libro->titulo}}"
                             width="100%">

                        <h3>{{$libro->titulo}}</h3>
                        <br>
                    </a>
                </div>
            @endforeach

        @else
            <h4 style="font-size: 30px;">Opps aun No hay algo por aquÃ­</h4>
        @endif
        <div class="clearfix"></div>

    </div>
@endsection


@section('scripts')
    <script>
        $(function () {
            $('#a-libros').addClass('active');
        });
    </script>
@endsection