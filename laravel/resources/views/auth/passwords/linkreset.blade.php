<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reset Link</title>
</head>
<body>
<h1>DarwinDeveloper Password Reset</h1>
<h2>Hola Hemos recibido una solicitud de recuperacion de contraseña</h2>
<a href="{{url('password/reset/'.$token)}}">Click aqui para restablecer su contraseña</a>
<p>Si usted no realizo la solicitud de recuperacion de contraseña ignore este mensaje</p>
</body>
</html>