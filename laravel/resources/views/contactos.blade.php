@extends('base')

@section('title','Darwin Developer Contactos')

@section('meta')
<meta name="description" charset="Darwin Developer Contactos">
@endsection








@section('content')


    <div class="jumbotron jumbotron-sm" style="background-color: #0875B0; color: white;">
        <div class="container" >
            <div class="row">
                <div class="col-sm-12 col-lg-12" >
                    <h2 style="padding: 0; margin: 0;">
                        Contactanos, <small style="color: white; font-size: 28px;">Sientase libre de comunicarse con nosotros</small></h2>
                </div>
            </div>


        </div>

    </div>
    <div class="container-fluid">
        @if(session('sms enviado'))
            <div class="alert alert-success">
                {{session('sms enviado')}}
            </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <div class="well well-sm">
                    <form method="post" action="{{url('contactos')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">
                                        Tu Nombre</label>
                                    <input name="name" type="text" class="form-control" id="name" placeholder="Ingrese su nombre" required="required" />
                                </div>
                                <div class="form-group">
                                    <label for="email">
                                        E-mail</label>
                                    <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                        <input name="email" type="email" class="form-control" id="email" placeholder="Ingrese su email" required="required" /></div>
                                </div>
                                <div class="form-group">
                                    <label for="subject">
                                        Asunto</label>
                                    <select id="subject" name="subject" class="form-control" required="required">
                                        <option value="na" selected="">Eliga una Opcion:</option>
                                        <option value="service">Contratar nuestros servivios</option>
                                        <option value="suggestions">Sugerencias</option>
                                        <option value="product">Soporte de Productos</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">
                                        Mensaje</label>
                            <textarea name="sms" id="message" class="form-control" rows="9" cols="25" required="required"
                                      placeholder="Escriba su mensaje aqui..."></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">
                                    Enviar Mensaje</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <form>
                    <legend><span class="glyphicon glyphicon-globe"></span> Nosotros</legend>
                    <address>
                        <strong>DarwinDeveloper, Inc.</strong><br>
                        Quito - Univerdidad Central del Ecuador<br>
                        Cayambe - Pedro moncayo<br>
                        <abbr title="Phone">
                            EC:</abbr>
                        (+593) 982-599-240
                    </address>
                    <address>
                        <strong>Email:</strong><br>
                        <a href="mailto:#">dsmr.apps@gmail.com</a>
                    </address>
                </form>
            </div>
        </div>
    </div>

@endsection



@section('scripts')

    <script>
        $(function(){
            $('#a-contactos').addClass('active');
        });
    </script>
@endsection