@extends('base')

@section('title','Cursos')



@section('content')
    <section class="wrapper dsmr-card">
        <div class="container-fostrap">
            <div>
                <h1 class="heading">
                    Nuestros Cursos
                </h1>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="grid">
                        @if(count($cursos)>0)

                            @foreach($cursos as $curso)

                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">

                                    <div class="card">
                                        <a class="img-card"
                                           href="{{url('cursos/'.urlencode($curso->id))}}">
                                            <img src="{{asset($curso->img)}}"/>
                                        </a>

                                        <div class="card-content  text-center">
                                            <h4 class="card-title text-center" style="height: 40px;">
                                                <a href="{{url('cursos/'.urlencode($curso->id))}}">
                                                    {{$curso->id}}
                                                </a>
                                            </h4>

                                            <p class=" text-center">
                                                Ultima Actualización:<br>{{$curso->updated_at}}
                                            </p>
                                        </div>
                                        <div class="card-read-more">
                                            <a href="{{url('cursos/'.urlencode($curso->id))}}"
                                               class="btn btn-link btn-block">
                                                Ver Curso
                                            </a>
                                        </div>
                                    </div>

                                </div>


                            @endforeach

                            <div class="clearfix"></div>
                            {{ $cursos->links() }}
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


@section('scripts')
    <script>
        $(function(){
            $('#a-cursos').addClass('active');
        });
    </script>
@endsection