@extends('admin.includes.base')

@section('title','Tus Tutoriales')

@section('content')

    <div class="col-md-12">
        @foreach($json as $categoria)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 style="padding: 0; margin: 0;">{{$categoria->categoria}}</h2>
                </div>
                <div class="panel-body">
                    <div class="tree" style="border: none; background: transparent;">
                        <ul>
                            @foreach($categoria->sub_categorias as $sub_categoria)


                                <li class="col-md-6">
                                     <span class="badge badge-warning"><i
                                                 class="icon-folder-open"></i><h5
                                                 style="padding: 0; margin: 9px;">{{$sub_categoria->nombre}}</h5></span>
                                    <ul>

                                        @foreach($sub_categoria->tutoriales as $tutorial)
                                            <li>
                                                <a target="_blank"
                                                   href="{{url('tutorial/'.$tutorial->id.'/'.urlencode($tutorial->titulo))}}"
                                                   class="badge badge-success"><i
                                                            class="icon-folder-open"></i><h5
                                                            style="padding: 0; margin: 4px;">{{$tutorial->titulo}}</h5>
                                                </a>

                                                @if($tutorial->vista==1)
                                                    <button data-toggle="tooltip"
                                                            data-placement="bottom" title="tutorial marcado como visto"
                                                            class="btn btn-primary"><i class="fa fa-check"></i></button>
                                                @else
                                                    <button data-toggle="tooltip"
                                                            data-placement="bottom" title="tutorial NO visto"
                                                            class="btn btn-danger"><i class="fa fa-close"></i></button>
                                                @endif

                                            </li>
                                        @endforeach

                                    </ul>
                                    <br>
                                </li>


                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

        @endforeach
    </div>

@endsection


@section('scripts')
    <script>
        $(function () {
            $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'ver tutoriales');
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