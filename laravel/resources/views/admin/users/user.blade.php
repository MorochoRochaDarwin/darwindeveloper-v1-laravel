@extends('admin.includes.base')

@section('title','Tu Cuenta')

@section('content')

    <div class="container ">

        <div class="text-center">
            <span class="fa fa-user" style="font-size: 100px;"></span><br>
            Usuario: {{$user->name}}
            <br><br>
            Miembro desde: {{$user->created_at}}
            <br><br>
            Ultima actualización: {{$user->updated_at}}
            <br><br>
            @if($user->facebook_id !=null)
                Tipo de login: Via Facebook
            @elseif($user->google_id !=null)
                Tipo de login: Via Google
            @elseif($user->github_id !=null)
                Tipo de login: Via GitHub
            @elseif($user->twitter_id !=null)
                Tipo de login: Via twitter
            @else
                Tipo de login: Via E-mail
            @endif


            <br><br>
            Tipo de usuario: {{$user->type}}


        </div>
    </div>

@endsection


@section('scripts')
    <script>

    </script>
@endsection