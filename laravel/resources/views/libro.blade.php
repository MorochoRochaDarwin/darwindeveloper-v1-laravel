@extends('base')

@section('title',$libro->titulo)


@section('content-left')

        <div class="dsmr-card text-center">
            <img src="{{asset($libro->portada)}}" alt="{{$libro->titulo}}" width="100%">
            <p>{{$libro->titulo}}</p>
            Publicado el {{$libro->updated_at}}
        </div>

@endsection()



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

    <br>
@endsection()


@section('content')
    <div class="dsmr-card">
        <h1 class="heading">
            {{$libro->titulo}}
        </h1>

            {!! $libro->contenido !!}

    </div>


@endsection


@section('scripts')
    <script>
        $(function () {
            $('#a-libros').addClass('active');
        });
    </script>
@endsection