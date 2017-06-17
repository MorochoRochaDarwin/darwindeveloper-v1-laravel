@extends('admin.includes.base')

@section('title','Nuevo Tutorial')

@section('css')
    <link href="/ckeditor/plugins/codesnippet/lib/highlight/styles/default.css" rel="stylesheet">
@endsection

@section('content')

    <div class="container-fluid">
        <form action="" id="form_new_post">

            <h2 style="text-align: center">Nuevo Tutorial - {{$cat}}</h2>
            <div class="col-md-12" style="padding: 0;">
                <input name="titulo" id="titulo" required type="text" class="form-control" placeholder="titulo del post">
            </div>

            <input id="sub_id" name="sub_id" type="text" hidden value="{{$sub_id}}">
            <textarea required class="form-control" style="height: 100px;" name="descripcion" id="descripcion" cols="30" rows="10" placeholder="descripcion del post..."></textarea>
            <div id="editor">
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 text-right" style="padding: 0;">
                <input id="pc" type="text" class="form-control" placeholder="palabras clave... ">
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 text-right" style="padding: 0;">
                <button type="submit" class="btn btn-primary" style="font-size: 20px;"><i class="fa fa-save"></i> GUARDAR</button>
                <a href="{{url('/admin/subcategorias')}}" style="font-size: 20px;" class="btn btn-default">Sub Categorias</a>

            </div>
        </form>
    </div>
@endsection


@section('scripts')
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        var editor;
        $(function(){
            var config = {
                extraPlugins: 'codesnippet',
                codeSnippet_theme: 'monokai_sublime',
                height: 356
            };

            editor=CKEDITOR.replace( 'editor', config );


            $('#form_new_post').submit(function(){

                var titulo=$('#titulo').val();
                var categoria=$('#sub_id').val();
                var descripcion=$('#descripcion').val();
                var html=editor.getData();
                var fd=new FormData();
                fd.append('titulo',titulo);
                fd.append('subcat',categoria);
                fd.append('descripcion',descripcion);
                fd.append('html',html);
                fd.append('pc',$('#pc').val());
                fd.append('_token','{{csrf_token()}}');

                $.ajax({
                    url:'{{url('/admin/nuevo-tutorial')}}',
                    type: 'post',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if($.trim(data)==='exito'){
                            $.notify(
                                    "EXITO",
                                    {
                                        className: "success",
                                        position: "bottom right",
                                    });
                            $('#form_new_post').trigger('reset');
                            editor.setData('');
                        }else{
                            alert(data);
                        }
                    }
                });
                return false;
            });
        });
    </script>
@endsection