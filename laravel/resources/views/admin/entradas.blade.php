@extends('admin.includes.base')

@section('title','Admin Entradas '.$capitulo->nombre)


@section('content')

    <div class="container-fluid">
        <h2>Entradas - {{$capitulo->curso}} - {{$capitulo->nombre}}</h2>
        @include('auth.flash')
        <table id="data-table" class="display table-responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Capitulo</th>
                <th>Creada el</th>
                <th>Ultima actualización</th>
                <th>Editar/Eliminar</th>
            </tr>
            </thead>
        </table>


        <a href="{{url('admin/cursos/'.$capitulo->curso.'/'.$capitulo->id.'/nueva-entrada')}}"
           class="btn btn-primary"><i
                    class="fa fa-plus-circle"></i> Nueva Entrada
        </a>
        <a class="btn btn-default" href="{{url('admin/cursos/'.urlencode($capitulo->curso))}}"> Volver al listado de
            capitulos</a>


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
                ajax: '{{url('admin/cursos/'.urlencode($capitulo->curso).'/'.$capitulo->id.'/getdata')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'titulo', name: 'titulo'},
                    {data: 'capitulo', name: 'capitulo'},
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
                title: 'Eliminar esta Entrada?',
                autoClose: 'cancel|6000',
                confirmButton: 'ELIMINAR',
                cancelButton: 'CANCELAR',
                confirm: function () {

                    var url = '{{url('admin/cursos/'.urlencode($capitulo->curso).'/'.$capitulo->id.'/delete-entrada')}}';
                    var data = '_token={{csrf_token()}}&id=' + id;
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

        function url_open(id) {

            window.open('{{url('admin/cursos/'.$capitulo->curso.'/'.$capitulo->id.'/edit-entrada')}}' + '/' + id, '_top');
        }


    </script>
@endsection