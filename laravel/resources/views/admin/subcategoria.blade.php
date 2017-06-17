@extends('admin.includes.base')

@section('title','Admin SubCategoria')



@section('content')

    <div class="container-fluid">
        <h2><a href="{{url('/admin/subcategorias')}}">{{$subcategoria->categoria}} - {{$subcategoria->nombre}}</a></h2>
        <table id="data-table" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Titulo</th>
                <th>Creada el</th>
                <th>Ultima actualización</th>
                <th>Editar/Eliminar</th>
            </tr>
            </thead>
        </table>


        <a href="{{url('/admin/nuevo-tutorial/'.tourl($subcategoria->nombre.' '.$subcategoria->categoria).'/'.$subcategoria->id)}}" class=" btn btn-primary">Nuevo Tutorial</a>

        <a href="{{url('/admin/subcategorias')}}" class="btn btn-default">Sub Categorias</a>

    </div>


    {!! Form::open(['action' => ['AdminCategoriasController@deletecategoria'],'id' => 'form-delete']) !!}
    {!! Form::close() !!}



@endsection



@section('scripts')

    <script>

        var table;
        $(function () {


            table = $('#data-table').DataTable({

                "ajax": {

                    "url": "{{url('/admin/tutoriales/'.$subcategoria->id)}}",
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

                $('#data-table2 input', this.footer()).on('keyup change', function () {
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

                    var data='_token={{csrf_token()}}&id='+id;

                    $.ajax({
                        url: '{{url('/admin/eliminar-tutorial')}}',
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
