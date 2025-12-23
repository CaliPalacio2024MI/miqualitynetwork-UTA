<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Informe de Estadísticas</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }

        .chart {
            margin-bottom: 30px;
            text-align: center;
        }

        h2 {
            font-size: 16px;
            margin-bottom: 8px;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <h1 style="text-align:center;">Informe de Estadísticas</h1>

    @if($mostrar=='todas' || $mostrar=='departamento')
    <div class="chart">
        <h2>Accidentes por Departamento</h2>
        <img src="{{ $imgDepartamento }}" alt="Depto">
    </div>
    @endif

    @if($mostrar=='todas' || $mostrar=='mes')
    <div class="chart">
        <h2>Accidentes por Mes</h2>
        <img src="{{ $imgMes }}" alt="Mes">
    </div>
    @endif

    @if($mostrar=='todas' || $mostrar=='dias')
    <div class="chart">
        <h2>Días Perdidos por Incapacidad</h2>
        <img src="{{ $imgDias }}" alt="Días">
    </div>
    @endif

    {{-- CUARTA GRÁFICA: PARTES DEL CUERPO --}}
    @if($mostrar=='todas' || $mostrar=='partes')
    <div class="chart">
        <h2>Partes del cuerpo afectadas</h2>
        <img src="{{ $imgPartes }}" alt="Partes del cuerpo">
    </div>
    @endif
</body>

</html>