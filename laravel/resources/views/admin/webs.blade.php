@extends('admin.includes.base')

@section('title','Edit webs '.$categoria->id)

@section('css')
<link href="/ckeditor/plugins/codesnippet/lib/highlight/styles/default.css" rel="stylesheet">

@endsection

@section('content')

<div class="container-fluid">
    <form action="" id="form_new_post" enctype="multipart/form-data">

        <h2 style="text-align: center">Edit Libro - {{$categoria->id}}</h2>


        <input type="text" id="categoria" value="{{$categoria->id}}" hidden>



        <textarea id="editor">{{$categoria->webs}}
        </textarea>
        <div class="clearfix"></div>


        <div class="col-xs-12 text-right" style="padding: 0;">
            <button type="submit" class="btn btn-primary" style="font-size: 20px;"><i class="fa fa-save"></i>
                GUARDAR
            </button>
            <a href="{{url('/admin/categorias')}}" style="font-size: 20px;" class="btn btn-default">Volver a
                categorias</a>

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


            var categoria = $('#categoria').val();
            var html = editor.getData();
            var fd = new FormData();
            fd.append('categoria', categoria);
            fd.append('html', html);


            fd.append('_token', '{{csrf_token()}}');


            $.ajax({
                url: '{{url('/admin/webs/'.urlencode($categoria->id))}}',
                type: 'post',
                data: fd,
                processData: false,
                contentType: false,
                success: function (data) {
                    if ($.trim(data) === 'exito') {
                        $.notify(
                            "Actualizado con EXITO",
                            {
                                className: "success",
                                position: "bottom right",
                            });
                        // $('#form_new_post').trigger('reset');
                        // editor.setData('');
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