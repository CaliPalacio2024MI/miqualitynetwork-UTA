{{-- resources/views/seguridadysalud/reporte_pdf.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte Historial Clínico</title>
    <style>
        @page {
            margin: 0;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            background: url("{{ public_path('images/plantilla.png') }}") no-repeat top center;
            background-size: cover;
        }

        .content {
            margin: 120px 60px 80px 60px;
            background: rgba(255, 255, 255, 0.9);
            padding: 10px;
            border-radius: 4px;
        }

        h2 {
            text-align: center;
            color: #002448;
            font-size: 16px;
            margin-bottom: 8px;
        }

        .filtros {
            font-size: 10px;
            margin-bottom: 6px;
        }

        .filtros span {
            margin-right: 20px;
            display: inline-block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        thead th {
            background-color: #002448;
            color: #fff;
            padding: 6px;
            border: 1px solid #ccc;
            text-align: center;
        }

        tbody td {
            padding: 4px;
            border: 1px solid #ddd;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #e6f7ff;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    @php
    // Cuántas filas por página
    $limit = 25;
    // Troceamos la colección de registros
    $chunks = $registros->chunk($limit);
    @endphp

    @foreach($chunks as $chunkIndex => $slice)
    <div class="content">
        <h2>Reporte de Accidentes y incidentes</h2>
        <div class="filtros">
            <span><strong>Hotel:</strong> {{ $propiedad }}</span>
            <span><strong>Desde:</strong> {{ $fechaInicio }}</span>
            <span><strong>Hasta:</strong> {{ $fechaFin }}</span>
            <span><strong>Búsqueda:</strong> {{ $nombre }}</span>
            <span style="float:right;">Página {{ $chunkIndex + 1 }} de {{ count($chunks) }}</span>
        </div>
        <table>
            <thead>
                <tr>
                    <th style="width:5%;">#</th>
                    <th style="width:25%;">Nombre</th>
                    <th style="width:10%;">Edad</th>
                    <th style="width:30%;">Dirección</th>
                    <th style="width:15%;">Depto.</th>
                    <th style="width:15%;">Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($slice as $i => $r)
                <tr>
                    {{-- Calculamos el índice global --}}
                    <td align="center">{{ $chunkIndex * $limit + $i + 1 }}</td>
                    <td>{{ $r->nombre_lesionado }}</td>
                    <td align="center">{{ $r->edad_lesionado }}</td>
                    <td>{{ $r->direccion_particular }}</td>
                    <td>{{ $r->departamento_evento }}</td>
                    <td align="center">{{ \Carbon\Carbon::parse($r->fecha_evento)->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Si no es la última página, metemos un salto de página --}}
    @if(!$loop->last)
    <div class="page-break"></div>
    @endif

    @endforeach
</body>

</html>