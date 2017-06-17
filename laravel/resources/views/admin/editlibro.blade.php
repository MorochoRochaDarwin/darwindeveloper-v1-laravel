@extends('admin.includes.base')

@section('title','Edit Libro')

@section('css')
<link href="/ckeditor/plugins/codesnippet/lib/highlight/styles/default.css" rel="stylesheet">
<link rel="stylesheet" href="/cropper/dist/cropper.css">
@endsection

@section('content')

<div class="container-fluid">
    <form action="" id="form_new_post" enctype="multipart/form-data">

        <h2 style="text-align: center">Edit Libro - {{$libro->categoria}}</h2>

        <div class="col-md-9" style="padding: 0;">
            <input name="titulo" id="titulo" required type="text" class="form-control"
                   placeholder="titulo del libro" value="{{$libro->titulo}}">
        </div>
        <div class="col-md-3">
            <button style="width: 100%" type="button" href="#modallogo" data-toggle="modal" class="btn btn-success">
                <i
                    class="fa fa-photo"></i> Imagen de portada
            </button>
        </div>


        <div class="modal fade" id="modallogo" tabindex="-1" role="dialog" aria-labelledby="label1">
            <div class="modal-dialog" role="document" style="margin-top: 0%;">
                <div class="modal-content">
                    <div class="modal-header"
                         style="text-align: center; font-weight: bold; background-color: #0099cc;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalLabel" style="color: #fff;">Subir imagen Principal</h4>
                    </div>
                    <div class="modal-body">
                        <div style="max-height: 400px;">
                            <img id="image" src="/img/darwindeveloper.png">
                        </div>
                    </div>
                    <div class="modal-footer docs-buttons" style="padding-top: 0; margin-top: 0;">
                        <div class="clearfix"></div>
                        <small>Cuando terminte de recortar la imagen clic en guardar</small>
                        <br>
                        <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                            <input type="file" class="sr-only" id="inputImage">
            <span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs">
              <span class="fa fa-upload"></span>
            </span>
                        </label>

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1"
                                    title="Zoom In">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, 0.1)">
              <span class="fa fa-search-plus"></span>
            </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1"
                                    title="Zoom Out">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, -0.1)">
              <span class="fa fa-search-minus"></span>
            </span>
                            </button>
                        </div>
                        <button id="getDataURL" type="button" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>


        <input id="categoria" name="categoria" type="text" hidden value="{{$libro->categoria}}">

        <div class="clearfix"></div>
        <br>

        <textarea id="editor">{{$libro->contenido}}
        </textarea>
        <div class="clearfix"></div>


        <div class="col-xs-12 text-right" style="padding: 0;">
            <button type="submit" class="btn btn-primary" style="font-size: 20px;"><i class="fa fa-save"></i>
                GUARDAR
            </button>
            <a href="{{url('/admin/libros/'.urlencode($libro->categoria))}}" style="font-size: 20px;" class="btn btn-default">Volver a
                libros</a>

        </div>
    </form>
</div>
@endsection


@section('scripts')
<script src="/cropper/dist/cropper.js"></script>
<script src="/ckeditor/ckeditor.js"></script>
<script>
    var editor, img64;
    $(function () {

        var $image = $('#image');
        var cropBoxData;
        var canvasData;

        $('#modallogo').on('shown.bs.modal', function () {
            $image.cropper({
                aspectRatio: 4 / 5,
                autoCropArea: 0.8,
                built: function () {
                    $image.cropper('setCanvasData', canvasData);
                    $image.cropper('setCropBoxData', cropBoxData);
                }
            });
        }).on('hidden.bs.modal', function () {
            cropBoxData = $image.cropper('getCropBoxData');
            canvasData = $image.cropper('getCanvasData');
            //$image.cropper('destroy');
        });

        var dataURLView = $("#dataURLView");
        $("#getDataURL").click(function () {

            // $canvas.toBlob($image.cropper('getCroppedCanvas'),"image/jpeg", 0.95);
            // alert($image.cropper('getCroppedCanvas').toDataURL());

            img64 = $image.cropper('getCroppedCanvas').toDataURL();
            //img64=$image.cropper('getCroppedCanvas', {width: 250,height: 250 }).toDataURL();
            $('#modallogo').modal('hide');


            $.notify(
                "Imagen Selecionada",
                {
                    className: "info",
                    position: "bottom left",
                });

        });


        // Import image
        var $inputImage = $('#inputImage');
        var URL = window.URL || window.webkitURL;
        var blobURL;

        if (URL) {
            $inputImage.change(function () {
                var files = this.files;
                var file;

                if (!$image.data('cropper')) {
                    return;
                }

                if (files && files.length) {
                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        blobURL = URL.createObjectURL(file);
                        $image.one('built.cropper', function () {

                            // Revoke when load complete
                            URL.revokeObjectURL(blobURL);
                        }).cropper('reset').cropper('replace', blobURL);
                        $inputImage.val('');
                    } else {
                        window.alert('Please choose an image file.');
                    }
                }
            });
        } else {
            $inputImage.prop('disabled', true).parent().addClass('disabled');
        }

        $('.docs-buttons').on('click', '[data-method]', function () {
            var $this = $(this);
            var data = $this.data();
            var $target;
            var result;

            if ($this.prop('disabled') || $this.hasClass('disabled')) {
                return;
            }

            if ($image.data('cropper') && data.method) {
                data = $.extend({}, data); // Clone a new one

                if (typeof data.target !== 'undefined') {
                    $target = $(data.target);

                    if (typeof data.option === 'undefined') {
                        try {
                            data.option = JSON.parse($target.val());
                        } catch (e) {
                            console.log(e.message);
                        }
                    }
                }

                if (data.method === 'rotate') {
                    $image.cropper('clear');
                }

                result = $image.cropper(data.method, data.option, data.secondOption);

                if (data.method === 'rotate') {
                    $image.cropper('crop');
                }

                switch (data.method) {
                    case 'scaleX':
                    case 'scaleY':
                        $(this).data('option', -data.option);
                        break;

                }


            }
        });


        var config = {
            extraPlugins: 'codesnippet',
            codeSnippet_theme: 'monokai_sublime',
            height: 356
        };

        editor = CKEDITOR.replace('editor', config);


        $('#form_new_post').submit(function () {

            var titulo = $('#titulo').val();
            var categoria = $('#categoria').val();
            var html = editor.getData();
            var fd = new FormData();
            fd.append('id',{{$libro->id}});
            fd.append('titulo', titulo);
            fd.append('categoria', categoria);
            fd.append('html', html);
            if(img64!=null){
                fd.append('img64', img64);
            }

            fd.append('_token', '{{csrf_token()}}');


            $.ajax({
                url: '{{url('/admin/edit-libro')}}',
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