@extends('admin.includes.base')

@section('title','Admin SubCategorias')


@section('content')

    <div class="container-fluid">
        <h2>Sub Categorias</h2>


        <table id="data-table" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>SubCategoria</th>
                <th>Categoria</th>
                <th>Creada el</th>
                <th>Ultima actualización</th>
                <th>Editar/Eliminar</th>
            </tr>
            </thead>
        </table>
        <a href="#modal-new-scat" data-toggle="modal" class="btn btn-default"><i
                    class="fa fa-plus-circle"></i> Nueva SubCategoria</a>
    </div>


    <div class="modal fade cart-modal" id="modal-new-scat">
        <div class="modal-dialog modal-sm">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3><i class="fa fa-plus-circle"></i> Nueva SubCategoria</h3>
                </div>
                <!--Body-->
                <div class="modal-body text-center">

                    <form id="form-ns">
                        {{ csrf_field() }}
                                <!--Naked Form-->
                        <div class="card-block">


                            <!--Body-->
                            <div class="md-form text-left">

                                <label for="nombre_n"><i class="fa fa-pencil prefix"></i> Nombre de la subcategoria</label>
                                <input required type="text" id="nombre_n" name="ncat" class="form-control">

                            </div>

                            <div class="md-form text-left">
                                <select required name="cat" class="form-control">
                                    <option value="" disabled selected>Elija una Categoria</option>
                                    @foreach($categorias as $cat)
                                        <option value="{{$cat->id}}">{{$cat->id}}</option>
                                    @endforeach
                                </select>

                            </div>

                            <hr>
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



    {!! Form::open(['action' => ['AdminCategoriasController@deletesubcategoria'],'id' => 'form-delete2']) !!}
    {!! Form::close() !!}

@endsection



@section('scripts')


    <script>

        var table;
        $(function () {
            $('#a-admin').addClass('active');
            table = $('#data-table').DataTable({
                "ajax": {
                    "bProcessing": true,
                    "url": "{{url('/admin/getsubcategorias')}}",
                    "data": {
                        "_token": "{{csrf_token()}}"
                    },
                    "type": "POST"
                },
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




            $('#form-ns').submit(function () {
                var data = $('#form-ns').serialize();

                $.ajax({
                    url: '{{url('/admin/newsubcategoria')}}',
                    type: 'POST',
                    data: data,
                    success: function (result) {

                        if ($.trim(result) === 'exito') {
                            $('#modal-new-scat').modal('hide');
                            $.notify(
                                    "Sub categoria creada",
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
                return false;
            })

        });


        function update() {
            table.ajax.reload();
        }


        function delete_items(id) {

            //mira la documentacion de jquery confirm https://craftpip.github.io/jquery-confirm/
            $.confirm({
                icon: 'fa fa-trash',
                title: 'Eliminar Sub Categoria?',
                content: 'Se eliminaran tambien los libros, cursos y tutoriales vinculados',
                autoClose: 'cancel|6000',
                confirmButton: 'ELIMINAR',
                cancelButton: 'CANCELAR',
                confirm: function () {

                    var url = $('#form-delete2').attr('action');
                    var data = $('#form-delete2').serialize() + '&id=' + id;
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