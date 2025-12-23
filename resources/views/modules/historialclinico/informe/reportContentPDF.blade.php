<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

th, td {
    padding: 12px 10px;
    text-align: center;
    border-bottom: 1px solid #e2e8f0;
}

th {
    background-color: #092034;
    color: #ffffff;
    font-weight: 600;
}

tr:nth-child(even) {
    background-color: #f8fafc;
}
    </style>
    <title>Reporte PDF</title>
</head>
<body>
    <h2>Control de Registros</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Género</th>
                <th>Propiedad</th>
                <th>Puesto</th>
                <th>Realización</th>
                <th>Actualización</th>
            </tr>
        </thead>
        <tbody>
            @forelse($personas as $persona)
                <tr>
                    <td>{{ $persona->nombre }}</td>
                    <td>{{ $persona->genero ?? 'N/A' }}</td>
                    <td>{{ $persona->razon_social ?? 'N/A' }}</td>
                    <td>{{ $persona->puesto_aspirante ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($persona->created_at)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($persona->updated_at)->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay datos para mostrar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
