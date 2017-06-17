@extends('base')

@section('title','Tutoriales')



@section('content')
    <div id="main-content" class="dsmr-card">

        <br>

        <div class="container-fluid">
            @if(count($subcategorias)>0)
                @foreach($subcategorias as $sub)
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <!--Panel-->
                        <div class="text-center" style="margin-bottom: 20px;">
                            <button style="width: 100%"
                                    onclick="getTutoriales({{$sub->id}},'{{$sub->nombre}}-{{$sub->categoria}}')"
                                    class="btn padding-10 btn-info">
                                <h2>{{$sub->nombre}}<br>({{$sub->categoria}})</h2>
                            </button>

                        </div>
                        <!--/.Panel-->
                    </div>




                @endforeach
            @endif
        </div>
    </div>


    <div class="modal fade cart-modal" id="modal-tutoriales">
        <div class="modal-dialog">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header text-center info-color white-text">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 id="modal-titulo" class="white-text"></h3>
                </div>

                <!--Body-->
                <div class="modal-body text-center">

                    <div id="content-modal"></div>

                </div>

            </div>
            <!--/.Content-->
        </div>
    </div>


@endsection


@section('scripts')

    <script>
        $(function () {
            $('#a-tutoriales').addClass('active');
        });
    </script>
    <script>
        function getTutoriales(subid, titulo) {

            $('#modal-tutoriales').modal('show');
            $('#modal-titulo').html(titulo);
            $.ajax({
                url: '{{url('/tutoriales')}}',
                type: 'POST',
                data: '_token={{csrf_token()}}&subid=' + subid,
                success: function (result) {
                    $('#content-modal').html(result);
                }
            });
        }
    </script>
@endsection