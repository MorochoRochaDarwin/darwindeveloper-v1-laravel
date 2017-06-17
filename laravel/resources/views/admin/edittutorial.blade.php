@extends('admin.includes.base')

@section('title','Edicio Tutorial')

@section('css')
    <link href="/ckeditor/plugins/codesnippet/lib/highlight/styles/default.css" rel="stylesheet">
@endsection

@section('content')

    <div class="container-fluid">
        <form action="" id="form_edit_post">

            <h2 style="text-align: center">Edicion Tutorial - {{$tutorial->id}}</h2>

            <div class="col-md-12" style="padding: 0;">
                <input name="titulo" value="{{$tutorial->titulo}}" id="titulo" required type="text" class="form-control"
                       placeholder="titulo del post">
            </div>

            <textarea required class="form-control" style="height: 100px;" name="descripcion" id="descripcion" cols="30"
                      rows="10" placeholder="descripcion del post...">{{$tutorial->descripcion}}</textarea>

            <textarea id="editor">{{$tutorial->html}}
            </textarea>
            <div class="clearfix"></div>
            <div class="col-xs-12 text-right" style="padding: 0;">
                <input id="pc" value="{{$tutorial->palabras_clave}}" type="text" class="form-control" placeholder="palabras clave... ">
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 text-right" style="padding: 0;">
                <button type="submit" class="btn btn-primary" style="font-size: 20px;"><i class="fa fa-save"></i>
                    GUARDAR
                </button>
                <a href="{{url('/admin/subcategorias')}}" style="font-size: 20px;" class="btn btn-default">Sub Categorias</a>
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


            $('#form_edit_post').submit(function () {

                var titulo = $('#titulo').val();
                var descripcion = $('#descripcion').val();
                var html = editor.getData();
                var fd = new FormData();
                fd.append('titulo', titulo);
                fd.append('descripcion', descripcion);
                fd.append('html', html);
                fd.append('id',{{$tutorial->id}});
                fd.append('pc', $('#pc').val());
                fd.append('_token', '{{csrf_token()}}');

                $.ajax({
                    url: '{{url('/admin/edit-tutorial')}}',
                    type: 'post',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if ($.trim(data) === 'exito') {
                            $.notify(
                                    "ACTUALIZADO EXITO",
                                    {
                                        className: "success",
                                        position: "bottom right",
                                    });

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