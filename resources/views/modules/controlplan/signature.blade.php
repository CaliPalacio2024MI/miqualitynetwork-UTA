<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes de acción</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite('resources/css/signature.css')
    @vite('resources/js/signature.js')
</head>
<body>
    <form class="signature-pad-form" action="#" method="POST">
        <canvas height="100" width="300" class="signature-pad"></canvas>
        <p><a href="#" class="clear-button">Limpiar</a></p>
        <button class="submit-button" type="submit">GUARDAR</button>
    </form>
</body>
</html>