<!Doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    </head>
    <body>

        <div class="login-container">
        <h1>Inciar Sesión</h1>

        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div> <!-- dudas<----------------------- -->
        @endif <!-- dudas<----------------------- -->

        <form method="POST" action="{{ route('login.perform') }}"> <!-- dudas<----------------------- -->
            @csrf <!-- dudas<----------------------- -->

            <label>Correo Electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}"> <!-- dudas<----------------------- -->

            <label>Contraseña</label>
            <input type="password" name="password">

            <label><input type="checkbox" name="remember">Recuérdame</label>

            <button type="submit">Iniciar Sesión</button>

        </form>
        </div>
    </body>
</html>
