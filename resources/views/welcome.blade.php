<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MI Quality Network</title>
    @vite(['resources/css/login.css', 'resources/js/app.js','resources/js/alerta.js'])

</head>
<div class="contenedor-alerta-olvide-contrasena">
    <img src="{{ asset('images/pregunta.png') }}" class="icono-alerta-olvide-contrasena">
    <h1 class="titulo-alerta-olvide-contrasena">¿Olvidaste tu contraseña?</h1>
    <h3>Le informamos que, para restablecer su contraseña, debe comunicarse con el Departamento de Calidad mediante correo electrónico.</h2>

    <button class ="btn-aceptar-alerta-olvide-contrasena">Aceptar</button>
</div>

<div class="contenedor-alerta-contrasena-incorrecta">
    <img src="{{ asset('images/pregunta.png') }}" class="icono-alerta-contrasena-incorrecta">
    <h1 class="titulo-alerta-contrasena-incorrecta">Contraseña o usuario incorrecto</h1>
    <h3>Verifique su contraseña o nombre anfitrión sea correctos </h2>

    <button class ="btn-aceptar-alerta-contrasena-incorrecta">Aceptar</button>
</div>
<body>
    <div class="page-container">
        <!-- Sección izquierda: Imagen -->
        <div class="left-section"></div>

        <!-- Sección derecha: Formulario -->
        <div class="right-section">
            <div class="form-container">
                <!-- Logo -->
                <div class="logo-container">
                    <img src="/images/logoMIinicio.png" alt="Logo My Quality Network" class="logo">
                </div>
                <!-- Título del formulario -->
                <h2>MI Quality Network</h2>
                <div class="title-decoration"></div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Grupo de entrada para el correo electrónico -->
                    <div class="input-group">
                        <label for="rfc" class="form-label">RFC</label>
                        <input type="text" id="rfc" name="rfc" placeholder="Ingresa tu RFC" class="input-field" required>
                    </div>
                    <!-- Grupo de entrada para la contraseña -->
                    <div class="input-group">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" class="input-field" required>
                    </div>
                    <!-- Mostrar mensaje de error -->
                    @if ($errors->any())
                            <div id="error-backend" class="error-message" data-error="true" style="display: none;">

                            {{ $errors->first() }}
                        </div>
                    @endif

                    <!-- Campo "Recuérdame" -->

                    <!-- Botón para iniciar sesión -->
                    <button type="submit" class="button-primary">INICIAR SESION</button>
                </form>
                <!-- Enlace "Olvidé mi contraseña" -->
                <div class="forgot-password">
                    <a href="#" class="alerta">Olvidé mi contraseña</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
