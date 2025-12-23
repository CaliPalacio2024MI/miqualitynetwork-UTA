@if($archivos->isEmpty())
    <p class="text-center text-muted">No hay archivos en esta carpeta.</p>
@else
    <h3 class="text-lg font-bold my-3">📄 Archivos en: {{ $carpeta->nombre_carpeta }}</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Tamaño</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($archivos as $archivo)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $archivo->nombre_archivo }}</td>
                    <td>{{ number_format($archivo->tamano / 1024, 2) }} KB</td>
                    <td>{{ $archivo->tipoarchivo_mime }}</td>
                    <td>
                        <a href="{{ route('archivos.download', ['id' => $archivo->id_archivo]) }}" class="btn btn-primary">⬇ Descargar</a>

                        @if($archivo->tipoarchivo_mime === 'application/pdf')
                            <a href="{{ route('archivos.verPdf', $archivo->id_archivo) }}" class="btn btn-info" target="_blank">👁 Ver</a>
                        @endif

                        <form action="{{ route('archivos.destroy', $archivo->id_archivo) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">🗑 Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
