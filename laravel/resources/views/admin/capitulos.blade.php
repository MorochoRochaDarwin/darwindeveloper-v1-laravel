@extends('admin.includes.base')

@section('title','Admin Capitulos '.$curso->id)


@section('content')

    <div class="container-fluid">
        <h2>Capitulos - {{$curso->id}}</h2>
        @include('auth.flash')
        <table id="data-table" class="display table-responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Curso</th>
                <th>Creada el</th>
                <th>Ultima actualización</th>
                <th>Editar/Eliminar</th>
            </tr>
            </thead>
        </table>


        <button type="button" href="#modal-new-cat" data-toggle="modal" class="btn btn-primary"><i
                    class="fa fa-plus-circle"></i> Nuevo Capitulo
        </button>
        <a class="btn btn-default" href="{{url('admin/cursos')}}"> Volver al listado de cursos</a>


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
                    <h3><i class="fa fa-plus-circle"></i> Nuevo Capitulo</h3>
                </div>
                <!--Body-->
                <div class="modal-body text-center">

                    <form id="form-n" action="{{url("/admin/cursos/nuevo-capitulo")}}" method="post">
                        {{ csrf_field() }}
                                <!--Naked Form-->
                        <div>


                            <!--Body-->
                            <div class="md-form text-left">
                                <label><i class="fa fa-pencil prefix"></i> Titulo del Capitulo</label>
                                <input required type="text" name="titulo" class="form-control">
                                <input type="text" name="curso" hidden value="{{$curso->id}}">
                            </div>


                            <div class="text-xs-center"><br>
                                <button type="submit" class="btn btn-primary btn-lg">CREAR CAPITULO</button>

                            </div>

                        </div>
                        <!--Naked Form-->
                    </form>

                </div>

            </div>
            <!--/.Content-->
        </div>
    </div>


    {!! Form::open(['action' => ['AdminCapitulosController@deletecapitulo'],'id' => 'form-delete']) !!}
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
                    <h3><i class="fa fa-plus-circle"></i> Edit Capitulo</h3>
                </div>
                <!--Body-->
                <div class="modal-body text-center">

                    <form id="form-e" action="{{url("/admin/cursos/edit-capitulo")}}" method="post">
                        {{ csrf_field() }}
                                <!--Naked Form-->
                        <div>


                            <!--Body-->
                            <div class="md-form text-left">
                                <label><i class="fa fa-pencil prefix"></i> Titulo del Capitulo</label>
                                <input id="titulo-cap" required type="text" name="titulo" class="form-control">
                                <input id="id-cap" type="number" name="id" hidden>
                            </div>


                            <div class="text-xs-center"><br>
                                <button type="submit" class="btn btn-default btn-lg">Actualizar CAPITULO</button>
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
                processing: true,
                serverSide: true,
                ajax: '{{url('admin/cursos/'.urlencode($curso->id).'/getdata')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'nombre', name: 'nombre'},
                    {data: 'curso', name: 'curso'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                "language": {
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
                title: 'Eliminar este capitulo?',
                content: 'Se eliminaran tambien las entradas de este capitulo',
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

        function edit_item(titulo,id) {
            $('#id-cap').val(id);
            $('#titulo-cap').val(titulo);
            $('#modal-edit-cat').modal('show');
        }
    </script>
@endsection