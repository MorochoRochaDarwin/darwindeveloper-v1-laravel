<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmacion de cuenta</title>
</head>
<body>
<h1>darwindeveloper.com te da la bienvenida a nuestra comunidad</h1>
<h2>Verifica tu cuenta en el siguiente enlace</h2>
<a href="{{url("register/confirm/$user->id/$user->verify_token")}}"> verifique su email aqui</a>
</body>
</html>