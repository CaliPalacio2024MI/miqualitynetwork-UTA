<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Empleados Filtrado</title>
    <style>
        /* Estilos CSS proporcionados anteriormente por el usuario */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 11pt;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f4; /* Un gris muy claro similar a #BABABA */
            color: #071829; /* Un tono oscuro similar */
        }

        #form-container {
            width: 100%;
            margin: 0 auto;
            overflow: visible;
            height: auto;
            box-sizing: border-box;
        }

        .Titulo {
            border-bottom: 4px solid #092034;
            padding-bottom: 5px; /* Espaciado para el título */
        }

        h1 {
            font-family: "Poppins", sans-serif;
            margin: 10px 0;
            text-align: center; /* Centrar el título del reporte */
            color: #092034;
        }

        table {
            width: 100%;
            border-collapse: collapse; /* Elimina líneas blancas entre filas */
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px; /* Espacio entre tablas de diferentes empleados */
        }

        .border-inferior {
            border-left: 1px solid black;
            border-right: 1px solid black;
            border-bottom: 1px solid black;
            padding: 8px;
        }

        .no-border-inferior {
            border-left: 1px solid black;
            border-right: 1px solid black;
            border-bottom: none;
        }

        .table-container {
            border: 1px solid #ddd; /* Borde general para la tabla */
            border-radius: 15px;
            background: white;
            padding: 10px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden; /* Para que border-radius funcione con thead/tbody */
        }

        th {
            border: none;
            padding: 8px;
            text-align: center;
            font-size: 14px;
            background-color: rgb(11, 42, 70);
            color: white;
            font-weight: bold;
            margin-top: 20px;
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        td {
            border: none;
            padding: 12px;
            text-align: center;
            font-size: 14px;
            font-family: "Poppins", sans-serif;
            font-weight: 300;
            font-style: normal;
        }

        .section-title {
            background-color: #092034;
            color: white;
            font-weight: bold;
            text-align: left;
            padding: 5px;
            font-size: 16px;
            font-family: "Poppins", sans-serif;
            font-weight: 600;
            font-style: italic;
        }

        /* Alinear correctamente el texto de los agentes */
        .agents-list td {
            text-align: left;
            padding-left: 10px;
        }
        /* Alinear correctamente el texto de los agentes para la segunda seccion */
        .agents-list-antecedentes td {
            text-align: left;
            padding-left: 10px;
        }

        .encabezado {
            width: 100%;
            display: flex; /* Flexbox no es totalmente soportado por Dompdf, usar tablas para layout */
            justify-content: flex-end;
            align-items: center;
            padding: 0 20px;
        }
        .letrasNegritas {
            font-weight: bold;
            color: #092034; /* El azul oscuro para resaltar texto */
        }

        /* Estilos para impresión */
        @media print {
            body { font-size: 10pt; margin: 10mm; } /* Ajustar márgenes para impresión */
            table { border: 0.5px solid #000; page-break-inside: auto; } /* Borde más fino para impresión */
            tr { page-break-inside: avoid; page-break-after: auto; }
            thead { display: table-header-group; } /* Repetir encabezados de tabla en cada página */
            th, td { border: 0.5px solid #000; padding: 5px; } /* Borde más fino y padding para impresión */
            input, select, textarea { border: none !important; } /* Elimina bordes en inputs y selects */
            .table-container { box-shadow: none; border: none; } /* Eliminar sombras y bordes extra en impresión */
            .section-title { border-radius: 0; } /* Eliminar border-radius en impresión */
        }
    </style>
</head>
<body>
    <div id='form-container'>
        <div class="Titulo">
            <h1>REPORTE DE EMPLEADOS FILTRADO</h1>
        </div>

        <table class="table-container">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Género</th>
                    <th>Propiedad</th>
                    <th>Departamento</th>
                    <th>Puesto Aspirante</th>
                    <th>Fecha de Creación</th>
                    <th>Última Actualización</th>
                </tr>
            </thead>
            <tbody>
                @if ($personas->count() > 0)
                    @foreach ($personas as $persona)
                        <tr>
                            <td>{{ $persona->nombre ?? 'N/A' }}</td>
                            <td>{{ $persona->genero ?? 'N/A' }}</td>
                            <td>{{ $persona->razon_social ?? 'N/A' }}</td>
                            <td>{{ $persona->departamento ?? 'N/A' }}</td>
                            <td>{{ $persona->puesto_aspirante ?? 'N/A' }}</td>
                            <td>{{ $persona->created_at ? $persona->created_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                            <td>{{ $persona->updated_at ? $persona->updated_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 20px;">
                            No se encontraron empleados con los criterios de filtro especificados.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
