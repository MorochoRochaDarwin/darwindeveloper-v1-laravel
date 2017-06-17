@extends('admin.includes.base')

@section('title','Tus Cursos')

@section('content')

    <div class="row">

        <div class="col-md-7">
            <h1 style="text-align: center; padding: 10px; margin: 0; background-color: #00A1CB; color: #fff;">Cursos a
                los que estas suscrito</h1>
            @foreach($cursos as $curso)
                <div class="tree well">
                    <ul>

                        <li>
                        <span class="badge badge-warning"><i
                                    class="icon-folder-open"></i><h5
                                    style="padding: 0; margin: 9px;">{{$curso->curso}}</h5></span>
                            <a class="btn btn-success btn-default" target="_blank"
                               href="{{url('cursos/'.urlencode($curso->curso))}}"><i
                                        class="fa fa-eye"></i></a>

                            <ul>
                                @foreach($curso->capitulos as $capitulo)
                                    <li>
                                    <span class="badge badge-success"><i
                                                class="icon-minus-sign"></i> <h6>{{$capitulo->nombre}}</h6></span>

                                        <ul>
                                            @foreach($capitulo->entradas as $entrada)
                                                <li>
                                                    <span><i class="icon-leaf"></i> {{$entrada->titulo}}</span>
                                                    <a class="btn btn-sm btn-default" target="_blank"
                                                       href="{{url('cursos/'.urlencode($curso->curso).'/'.$capitulo->id.'/'.$entrada->id.'/'.urlencode($entrada->titulo))}}"><i
                                                                class="fa fa-eye"></i></a>

                                                    @if($entrada->vista==0)
                                                        <button data-toggle="tooltip"
                                                                data-placement="bottom"
                                                                title="NO guardado como visto"
                                                                class="btn btn-sm btn-danger"><i
                                                                    class="fa fa-close"></i>
                                                        </button>
                                                    @elseif($entrada->vista==1)
                                                        <button data-toggle="tooltip"
                                                                data-placement="bottom"
                                                                title="guardado como visto"
                                                                class="btn btn-sm btn-info"><i class="fa fa-check"></i>
                                                        </button>
                                                    @endif

                                                </li>



                                            @endforeach
                                        </ul>

                                    </li>
                                @endforeach
                            </ul>
                        </li>

                    </ul>

                </div>
            @endforeach
        </div>
        <div class="col-md-5">
            <h1 style="text-align: center; padding: 10px; margin: 0; background-color: #00BC8C; color: #fff;">
                Cursos disponibles</h1>

            @foreach($mas_cursos as $curso)
                <div class="col-md-6 col-sm-6 text-center" style="padding:0 5px;">
                    <a target="_blank" href="{{url('cursos/'.urlencode($curso->id))}}" class="btn btn-info"
                       style="margin-top: 10px; width: 100%;">
                        <img src="{{asset($curso->img)}}" alt="" width="100%"><br>
                        {{$curso->id}}
                    </a>
                </div>


            @endforeach
        </div>
    </div>

@endsection


@section('scripts')
    <script>
        $(function () {
            $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'minimizar');
            $('.tree li.parent_li > span').on('click', function (e) {
                var children = $(this).parent('li.parent_li').find(' > ul > li');
                if (children.is(":visible")) {
                    children.hide('fast');
                    $(this).attr('title', 'Expandir').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
                } else {
                    children.show('fast');
                    $(this).attr('title', 'minimizar').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
                }
                e.stopPropagation();
            });
        });
    </script>
@endsection