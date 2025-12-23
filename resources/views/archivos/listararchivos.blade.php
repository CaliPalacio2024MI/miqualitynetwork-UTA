@extends('layouts.dashboard')
  <!-- ESTA VISTA NO TIENE FUNCION SE UTILIZO PARA PRUEBAS NOTA UTILIZAR VERCARPETA.BLADE.PHP -->

@section('content')
    <div class="w-full p-6">
        <h2>📂 Archivos en la carpeta: {{ $carpeta->nombre_carpeta }}</h2>

        @if ($archivos->isEmpty())
            <p>No hay archivos en esta carpeta.</p>
        @else
            <table class="table table-striped mt-3">
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
                                <a href="{{ route('archivos.download', ['id' => $archivo->id_archivo]) }}"
                                    class="btn btn-primary">⬇ Descargar</a>


                                <a href="{{ route('archivos.verPdf', $archivo->id_archivo) }}" class="btn btn-info"
                                    target="_blank">👁 Ver</a>
                                <form action="{{ route('archivos.destroy', $archivo->id_archivo) }}" method="POST"
                                    style="display:inline;">
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

        <a href="{{ route('archivos.index') }}" class="btn btn-secondary mt-3">⬅ Volver</a>

        <form action="{{ route('carpetas.destroy', $carpeta->id) }}" method="POST" style="display:inline;"
            onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta carpeta? Se eliminarán todos los archivos dentro.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mt-3">🗑 Eliminar Carpeta</button>
        </form>

    </div>
@endsection
        <!-- ESTA VISTA NO TIENE FUNCION AUN NOTAAAAAAAAAAAAAAAAAAA UTILIZAR VERCARPETA.BLADE.PHP -->
