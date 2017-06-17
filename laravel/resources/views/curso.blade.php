@extends('base')

@section('title','Curso '.$curso->id)


@section('content-left')
    <div class="panel panel-primary">
        <div id="heading-curso" class="panel-heading">
            <h2 style="padding: 10px; margin: 0;">{{$curso->id}}</h2>

            @if($user_curso)
                <span class="badge-ok" data-toggle="tooltip"
                      data-placement="bottom"
                      title="ESTE CURSO YA ESTA GUARDADO EN TU LISTA"><i class="fa fa-check"></i> Guardado en tu lista</span>
            @else

                <button id="btn-save" onclick="guardar_curso()" class="btn btn-info btn-sm"
                        data-toggle="tooltip" data-placement="bottom"
                        title="¿Guardar este curso en tu lista de favoritos?"
                        ><i class="fa fa-save"></i> Guardar curso en tu perfil
                </button>
            @endif

        </div>
        <div class="panel-body" style="padding: 0;">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                @foreach($capitulos as $cap)


                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <p class="panel-title">
                                <a data-toggle="collapse" href="#collapse{{$cap->id}}"
                                >
                                    {{$cap->nombre}}
                                </a>
                            </p>
                        </div>
                        <div id="collapse{{$cap->id}}" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="heading{{$cap->id}}">
                            <div class="panel-body" style="padding: 0;">
                                <div class="list-group">

                                    @foreach($json_entradas as $entrada)
                                        @if($entrada->capitulo==$cap->id)
                                            <div class="list-group-item" style="padding: 5px 0;">
                                                <div id="content-visto{{$entrada->id}}"
                                                     class="col-xs-2 text-center"
                                                     style="padding: 5px;"
                                                >

                                                    @if($entrada->vista==0)
                                                        <span onclick="entrada_vista({{$entrada->id}})"
                                                              class="badge-no-ok"
                                                              title="Click Marcar como visto"><i
                                                                    class="fa fa-close"></i></span>
                                                    @elseif($entrada->vista==1)
                                                        <span class="badge-ok" title="Guardado como visto"><i
                                                                    class="fa fa-check"></i></span>
                                                    @endif

                                                </div>
                                                <div class="col-xs-10">
                                                    <a href="{{url('cursos/'.urlencode($curso->id).'/'.$cap->id.'/'.$entrada->id.'/'.urlencode($entrada->titulo))}}">
                                                        {{$entrada->titulo}}</a>
                                                </div>
                                                <div class="clearfix"></div>

                                            </div>

                                        @endif

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>


                @endforeach
            </div>
        </div>
    </div>



@endsection





@section('content-pu')


    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-7777765013946493"
         data-ad-slot="6835920968"
         data-ad-format="auto"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <br>
@endsection


@section('content')
    <div class="container-fluid"><br>



            @yield('content-entrada')

    </div>

    <div class="modal fade cart-modal" id="modal-info">
        <div class="modal-dialog modal-sm">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3><i class="fa fa-info-circle"></i> Información</h3>
                </div>
                <!--Body-->
                <div class="modal-body text-center">

                    <p id="text-info"></p>
                </div>

            </div>
            <!--/.Content-->
        </div>
    </div>


    <div id="modal-loading" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">

                <div class="modal-body text-center">
                    <img src="{{asset('img/loading.gif')}}" alt="">

                    <p>Procesando petición...</p>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection


@section('scripts')


    <script>
        $(function () {
            $('#a-cursos').addClass('active');
        });
    </script>
    <script>
        function entrada_vista(entradaid) {
            @if(Auth::guest())
                $('#modal-info').modal('show');
            $('#text-info').html('Debes iniciar sesión para poder realizar esta acción y guardar este curso en tu lista de favoritos');

            @else
                @if($user_curso)
                 $.ajax({
                url: '{{url('guardar-entrada')}}',
                data: 'curso_id={{$curso->id}}&entrada_id=' + entradaid + '&_token={{csrf_token()}}',
                type: 'POST',
                success: function (data) {
                    $('#modal-loading').modal('hide');
                    if ($.trim(data) === 'exito') {
                        $('#btn-save').hide();
                        $('#content-visto' + entradaid + ' span').removeClass('badge-no-ok');
                        $('#content-visto' + entradaid + ' span').addClass('badge-ok');
                        $('#content-visto' + entradaid + ' span i').removeClass('fa-close');
                        $('#content-visto' + entradaid + ' span i').addClass('fa-check');
                    } else {
                        alert(data);
                    }
                }

            });
            @else
                $('#modal-info').modal('show');
            $('#text-info').html('Debes guardar este curso en tu lista de favoritos para poder realizar esta acción');
            @endif
        @endif








        }


        function guardar_curso() {
            @if(Auth::guest())
               $('#modal-info').modal('show');
            $('#text-info').html('Debes iniciar sesión para poder realizar esta acción');
            @else
            $('#modal-loading').modal('show');
            $.ajax({
                url: '{{url('guardar-curso')}}',
                data: 'curso_id={{$curso->id}}&_token={{csrf_token()}}',
                type: 'POST',
                success: function (data) {
                    $('#modal-loading').modal('hide');
                    if ($.trim(data) === 'exito') {
                        $('#btn-save').hide();
                        $('#heading-curso').append('<span class="badge-ok"><i class="fa fa-check"></i> Guardado en tu lista</span>');
                    } else {
                        alert(data);
                    }
                }

            });
            @endif







        }
    </script>


    @yield('scripts2')
@endsection