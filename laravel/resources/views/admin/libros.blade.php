@extends('admin.includes.base')

@section('title','Admin Libros '.$categoria)


@section('content')

    <div class="container-fluid">

        <h2>Libros {{$categoria}}</h2>
        <table id="data-table" class="display table-responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Creado el</th>
                <th>Ultima actualización</th>
                <th>Editar/Eliminar</th>
            </tr>
            </thead>
        </table>


        <a href="{{url('admin/libros/'.$categoria.'/nuevo-libro')}}" class="btn btn-default"><i
                    class="fa fa-plus-circle"></i> Nuevo Libro
        </a>

    </div>



    {!! Form::open(['action' => ['AdminLibros@eliminarLibro'],'id' => 'form-delete']) !!}
    {!! Form::close() !!}




@endsection



@section('scripts')

    <script>

        var table;
        $(function () {
            $('#a-admin').addClass('active');

            table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('admin/libros/'.urlencode($categoria)).'/get'}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'titulo', name: 'titulo'},
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
                title: 'Eliminar Libro?',
                content: 'No se podra deshacer la accion',
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