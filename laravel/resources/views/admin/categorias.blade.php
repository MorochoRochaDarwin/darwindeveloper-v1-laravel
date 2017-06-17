@extends('admin.includes.base')

@section('title','Admin Categorias')


@section('content')

    <div class="container-fluid">

        <h2>Categorias</h2>
        <table id="data-table" class="display table-responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Categoria</th>
                <th>Creada el</th>
                <th>Ultima actualización</th>
                <th>Editar/Eliminar</th>
            </tr>
            </thead>
        </table>


        <button type="button" href="#modal-new-cat" data-toggle="modal" class="btn btn-default"><i
                    class="fa fa-plus-circle"></i> Nueva Categoria
        </button>

    </div>

    <div class="modal fade cart-modal" id="modal-new-cat" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3><i class="fa fa-plus-circle"></i> Nueva Categoria</h3>
                </div>
                <!--Body-->
                <div class="modal-body text-center">

                    <form id="form-n" enctype="multipart/form-data" action="{{url('/admin/categorias')}}" method="post">
                        {{ csrf_field() }}
                                <!--Naked Form-->
                        <div>


                            <!--Body-->
                            <div class="md-form text-left">
                                <label for="nombre_n"><i class="fa fa-pencil prefix"></i> Nombre de la categoria</label>
                                <input required type="text" id="nombre_n" name="ncat" class="form-control">
                                <br>
                                <label for=""><i class="fa fa-photo"></i> Imagen</label>
                                <input required type="file" name="img">
                                <br>
                            </div>


                            <div class="text-xs-center">
                                <button type="submit" class="btn btn-default btn-lg">CREAR CATEGORIA</button>
                            </div>

                        </div>
                        <!--Naked Form-->
                    </form>

                </div>

            </div>
            <!--/.Content-->
        </div>
    </div>


    {!! Form::open(['action' => ['AdminCategoriasController@deletecategoria'],'id' => 'form-delete']) !!}
    {!! Form::close() !!}


    <div class="modal fade cart-modal" id="modal-edit-cat" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3><i class="fa fa-plus-circle"></i> Editar Categoria</h3>
                </div>
                <!--Body-->
                <div class="modal-body text-center">

                    <form id="form-n" enctype="multipart/form-data" action="{{url('/admin/edit-categoria')}}"
                          method="post">
                        {{ csrf_field() }}
                                <!--Naked Form-->
                        <div>

                            <input id="id-cat" type="text" hidden name="id">

                            <!--Body-->
                            <div class="md-form text-left">
                                <label for=""><i class="fa fa-photo"></i>Nueva Imagen</label>
                                <input required type="file" accept="image/jpeg" name="img">
                                <br>
                            </div>


                            <div class="text-xs-center">
                                <button type="submit" class="btn btn-default btn-lg">ACTUALIZAR CATEGORIA</button>
                            </div>

                        </div>
                        <!--Naked Form-->
                    </form>

                </div>

            </div>
            <!--/.Content-->
        </div>
    </div>


@endsection



@section('scripts')

    <script>

        var table;
        $(function () {
            $('#a-admin').addClass('active');


            table = $('#data-table').DataTable({
                "ajax": {

                    "url": "{{url('/admin/getcategorias')}}",
                    "data": {
                        "_token": "{{csrf_token()}}"
                    },
                    "type": "POST"
                }, "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
            });


        });


        function update() {
            table.ajax.reload();
        }

        function delete_item(id) {

            //mira la documentacion de jquery confirm https://craftpip.github.io/jquery-confirm/
            $.confirm({
                icon: 'fa fa-trash',
                title: 'Eliminar Categoria?',
                content: 'Se eliminaran tambien los libros, cursos y tutoriales vinculados',
                autoClose: 'cancel|6000',
                confirmButton: 'ELIMINAR',
                cancelButton: 'CANCELAR',
                confirm: function () {

                    var url = $('#form-delete').attr('action');
                    var data = $('#form-delete').serialize() + '&id=' + id;
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: data,
                        success: function (result) {
                            if ($.trim(result) === 'exito') {
                                $.notify(
                                        "Eliminado",
                                        {
                                            className: "success",
                                            position: "bottom right",
                                        });
                                $('#form-n').trigger('reset');
                                update();

                            } else {
                                alert(result);
                            }
                        }
                    });


                },
                cancel: function () {

                }
            });
        }

        function edit_item(id) {
            $('#id-cat').val(id);
            $('#modal-edit-cat').modal('show');
        }
    </script>
@endsection