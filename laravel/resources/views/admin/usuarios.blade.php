@extends('admin.includes.base')

@section('title','Admin Usuarios')



@section('content')

    <div class="container-fluid">
        <h2>Usuarios</h2>
        <table id="data-table" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>E-mail</th>
                <th>Creado el</th>
                <th>Ultima actualización</th>
                <th>Editar/Eliminar</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th><input type="text"></th>
                <th><input type="text"></th>
                <th><input type="text"></th>
                <th><input type="text"></th>
                <th></th>

            </tr>
            </tfoot>

        </table>

    </div>


    <div id="modal-loading" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">

                <div class="modal-body text-center">
                    <img src="/img/loading.gif" alt="">
                    <p>Procesando petición...</p>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



@endsection



@section('scripts')

    <script>

        var table;
        $(function () {


            table = $('#data-table').DataTable({
                "ajax": {

                    "url": "{{url('/admin/usuarios')}}",
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

            // Apply the search
            table.columns().every(function () {
                var that = this;

                $('input', this.footer()).on('keyup change', function () {
                    if (that.search() !== this.value) {
                        that
                                .search(this.value)
                                .draw();
                    }
                });
            });

        });


        function update() {
            table.ajax.reload();
        }

        function eliminar(id) {

            //mira la documentacion de jquery confirm https://craftpip.github.io/jquery-confirm/
            $.confirm({
                icon: 'fa fa-trash',
                title: 'Eliminar Tutorial?',
                content: 'confirmacion requerida',
                autoClose: 'cancel|6000',
                confirmButton: 'ELIMINAR',
                cancelButton: 'CANCELAR',
                confirm: function () {

                    $('#modal-loading').modal('show');
                    var data='_token={{csrf_token()}}&id='+id;

                    $.ajax({
                        url: '{{url('/admin/eliminar-usuario')}}',
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
                                $('#modal-loading').modal('hide');
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

    </script>
@endsection
