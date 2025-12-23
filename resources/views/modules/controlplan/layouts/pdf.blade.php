<head>

</head>

<body>

        <table id="previewtable" class="actions">
            <thead>
                <th>Origen</th>
                <th>Proceso</th>
                <th>Oportunidad de mejora</th>
                <th>Descripción de la solución</th>
                <th>Responsable</th>
                <th>Fecha de cumplimiento</th>    
            </thead>
            <tbody>
                @foreach($list as $item)
                <tr>
                    <td>{{ $item->origen }}</td>
                    <td>{{ $item->proceso }}</td>
                    <td>{{ $item->oportunidad }}</td>
                    <td>{{ $item->descripcion }}</td>
                    <td>{{ $item->responsable }}</td>
                    <td>{{ $item->fecha_cumplimiento }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>



        
        <br><img src="{{ $signature }}" alt="sign" style="padding-left: 30%;"/>
        <p>Responsable {{ $responsible }}</p>
        
        

</body>
