@extends('admin.includes.base')

@section('title','Nuevo Entrada')

@section('css')
    <link href="/ckeditor/plugins/codesnippet/lib/highlight/styles/default.css" rel="stylesheet">
@endsection

@section('content')

    <div class="container-fluid">
        <form action="" id="form_new_post">

            <h2 style="text-align: center">Nueva Entrada - {{$capitulo->curso}} - {{$capitulo->nombre}}</h2>

            <div class="col-md-12" style="padding: 0;">
                <input name="titulo" id="titulo" required type="text" class="form-control"
                       placeholder="titulo de la entrada">
            </div>

            <input id="capitulo_id" name="capitulo_id" type="text" hidden value="{{$capitulo->id}}">
            <textarea required class="form-control" style="height: 100px;" name="descripcion" id="descripcion" cols="30"
                      rows="10" placeholder="descripcion de la entrada..."></textarea>

            <div id="editor">
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 text-right" style="padding: 0;">
                <input id="pc" type="text" class="form-control" placeholder="palabras clave... ">
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 text-right" style="padding: 0;"><br>
                <a class="btn btn-default" href="{{url('admin/cursos/'.urlencode($capitulo->curso).'/'.$capitulo->id)}}"> Volver al listado</a>
                <button type="submit" class="btn btn-primary" style="font-size: 20px;"><i class="fa fa-save"></i>
                    GUARDAR
                </button>
            </div>
        </form>
    </div>
@endsection


@section('scripts')
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        var editor;
        $(function () {
            var config = {
                extraPlugins: 'codesnippet',
                codeSnippet_theme: 'monokai_sublime',
                height: 356
            };

            editor = CKEDITOR.replace('editor', config);


            $('#form_new_post').submit(function () {

                var titulo = $('#titulo').val();
                var categoria = $('#capitulo_id').val();
                var descripcion = $('#descripcion').val();
                var html = editor.getData();
                var fd = new FormData();
                fd.append('titulo', titulo);
                fd.append('capitulo_id', categoria);
                fd.append('descripcion', descripcion);
                fd.append('html', html);
                fd.append('pc', $('#pc').val());
                fd.append('_token', '{{csrf_token()}}');

                $.ajax({
                    url: '{{url('/admin/cursos/'.urlencode($capitulo->curso).'/'.$capitulo->id.'/nueva-entrada')}}',
                    type: 'post',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if ($.trim(data) === 'exito') {
                            $.notify(
                                    "EXITO",
                                    {
                                        className: "success",
                                        position: "bottom right",
                                    });
                            $('#form_new_post').trigger('reset');
                            editor.setData('');
                        } else {
                            alert(data);
                        }
                    }
                });
                return false;
            });
        });
    </script>
@endsection