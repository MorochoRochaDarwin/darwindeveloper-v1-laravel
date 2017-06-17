@extends('base')

@section('title','Incio de sesion / nueva cuenta de usuario')

@section('content')




    <div class="dsmr-card">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab1" aria-controls="home" role="tab" data-toggle="tab"><i
                            class="fa fa-sign-in"></i>
                    Ingresar
                    a tu cuenta</a></li>
            <li role="presentation"><a href="#tab2" aria-controls="profile" role="tab" data-toggle="tab"><i
                            class="fa fa-user-plus"></i>
                    Crear nuevo
                    usuario</a></li>

        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="tab1"><br>

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail:</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email"
                                   value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Contraseña:</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Recordarme
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-sign-in"></i> Entrar
                            </button>

                            <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                Olvido su contraseña?
                            </a>
                        </div>
                    </div>
                </form>

                <hr>

                <div class="text-center">
                    <p>Tambien puedes iniciar sesión con:</p>


                    <div class="fb-login-button" data-max-rows="1" data-size="xlarge" data-show-faces="false"
                         data-auto-logout-link="false" scope="public_profile,email" onlogin="checkLoginState();">
                        Ingresar con Facebook
                    </div>

                    <hr>

                    <a class="btn btn-danger btn-lg " href="{{url('login/google')}}"><i
                                class="fa fa-google"></i> Ingresar con Google</a>
                    <a class="btn btn-success btn-lg " href="{{url('login/github')}}"><i
                                class="fa fa-github"></i> Ingresar con GitHub</a>

                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="tab2"><br>
                @include('auth.flash')
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Nombre de Usuario</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                   required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail:</label>

                        <div class="col-md-4">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                   required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Contraseña:</label>

                        <div class="col-md-4">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirmación Contraseña</label>

                        <div class="col-md-4">
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check"></i> Registrar
                            </button>
                        </div>
                    </div>

                    <hr>
                    <h6 style="text-align: center">También puedes crear tu cuenta con Facebook, Google y GitHub. Simplementa da clic en la pestaña "Ingresar a tu cuenta"</h6>
                </form>

            </div>

        </div>

    </div>


@endsection


@section('scripts')
    <script>


        // This is called with the results from from FB.getLoginStatus().
        function statusChangeCallback(response) {
            console.log('statusChangeCallback');
            console.log(response);
            // The response object is returned with a status field that lets the
            // app know the current login status of the person.
            // Full docs on the response object can be found in the documentation
            // for FB.getLoginStatus().
            if (response.status === 'connected') {
                // Logged into your app and Facebook.
                testAPI();
            } else if (response.status === 'not_authorized') {
                // The person is logged into Facebook, but not your app.
                document.getElementById('status').innerHTML = 'Please log ' +
                        'into this app.';
            } else {
                // The person is not logged into Facebook, so we're not sure if
                // they are logged into this app or not.
                document.getElementById('status').innerHTML = 'Please log ' +
                        'into Facebook.';
            }
        }

        // This function is called when someone finishes with the Login
        // Button.  See the onlogin handler attached to it in the sample
        // code below.
        function checkLoginState() {
            FB.getLoginStatus(function (response) {
                statusChangeCallback(response);
            });
        }

        window.fbAsyncInit = function () {
            FB.init({
                appId: '1151244811595531',
                cookie: true,  // enable cookies to allow the server to access
                               // the session
                xfbml: true,  // parse social plugins on this page
                version: 'v2.8' // use graph api version 2.8
            });

            // Now that we've initialized the JavaScript SDK, we call
            // FB.getLoginStatus().  This function gets the state of the
            // person visiting this page and can return one of three states to
            // the callback you provide.  They can be:
            //
            // 1. Logged into your app ('connected')
            // 2. Logged into Facebook, but not your app ('not_authorized')
            // 3. Not logged into Facebook and can't tell if they are logged into
            //    your app or not.
            //
            // These three cases are handled in the callback function.

            FB.getLoginStatus(function (response) {
                statusChangeCallback(response);
            });

        };

        // Load the SDK asynchronously
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        // Here we run a very simple test of the Graph API after login is
        // successful.  See statusChangeCallback() for when this call is made.
        function testAPI() {
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me?fields=id,name,email,permissions', function (response) {
                var email = response.email;
                var username = response.name;
                var id = response.id;


                login(email, username, id)

            });
        }


        function login(email, username, id) {


            var data = 'email=' + email + '&username=' + username + '&facebook_id=' + id + '&_token={{csrf_token()}}';


            $.ajax({
                url: '{{url('loginfacebook')}}',
                data: data,
                type: 'POST',
                success: function (data) {
                    if ($.trim(data) === "exito") {
                        window.location = '{{url('home')}}';
                    }
                    else {
                        // alert(data)
                    }
                }

            });


        }
    </script>
@endsection