@vite(['resources/css/administrarcionAnfitrion.css', 'resources/js/secciones.js', 'resources/js/mostrar_privilegios.js', 'resources/js/privilegios_registro_usuarios.js', 'resources/js/alerta_administracion.js','resources/js/buscador_nombres.js'])


<div class="contenedor-edicion-anfitrion">
    <div class="contenedor-buscador-nombre">
        <form action="{{ route('dashboard.crearuser') }}">
            <input type="submit"value="↻" class="btn-recargar-pagina">
        </form>

        <h1 class="text-2xl font-bold titulo-anfitriones-registrados">Anfitriones registrados</h1>
        <form class="formulario-busqueda-anfitriones">
            <input type="text" name="query" placeholder="Buscar por nombre..."
                class="w-5/6 px-4 py-2 text-gray-700 rounded-l-lg input-nombre-buscador focus:outline-none focus:ring focus:ring-blue-400"
            >
            <button type="submit" class="btn-buscar">
                Buscar
            </button>
        </form>
    </div>

    <div class="contenedor-formulario-edicion-anfitrion">
        <div class="form-nombres-apellidos-departamento">
            <div class ="form-group-nombre-apellido-departamento">
                <label for="name" class="form-label">Nombre</label>
            </div>
            <div class ="form-group-nombre-apellido-departamento">
                <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
            </div>
            <div class ="form-group-nombre-apellido-departamento">
                <label for="departamento" class="form-label">Departamento</label>
            </div>
        </div>
        @if ($usuarios->isEmpty())
            <p class="text-red-500">No se encontraron Anfitriones con ese nombre.</p>
        @endif
        @foreach ($usuarios as $usuario)
            <div class="contenedor-informacion-general-anfitriones" id="{{$usuario->name}}">
                @csrf
                <input type="hidden" name="id" value="{{ $usuario->id }}">

                <div class="form-group-row">

                    <input class="nombre-apellido-departamento-responsivo" type="text" name="name"
                        value="{{ $usuario->name }} {{ $usuario->apellido_paterno }} {{ $usuario->departamento }}"
                        required id="name" readonly>

                    <div class="form-group">
                        <input class="form-input" type="text" name="name" value="{{ $usuario->name }}" required
                            id="name" readonly>
                    </div>
                    <div class="form-group">
                        <input class="form-input" type="text" name="apellido_paterno"
                            value="{{ $usuario->apellido_paterno }}"readonly>
                    </div>
                    <div class="form-group">
                        <input class="form-input" type="text" name="departamento"
                            value="{{ $usuario->departamento }}" readonly>
                        <label for="propiedad_id" style="display:none;">Propiedad:</label>
                        <input style="display:none;" type="number" name="propiedad_id"
                            value="{{ $usuario->propiedad_id }}" required>
                    </div>

                </div>
                <div class="botones-borrar">
                    <a href="{{ route('Administracion.editarAnfitrion', ['id' => $usuario->id]) }}"
                        class="btn-modificar-principal"><img src="{{ asset('images/botoneditar.png') }}"
                            class="icono"></a>
                    <div class="contenedor-btn-borrar-anfitrion">
                        <form action="{{ route('borrar.user') }}" method="POST" class="form-borrar">
                            @csrf
                            <input type="hidden" name="id" value="{{ $usuario->id }}">
                            <button type="submit" class="btn-modificar-principal"><img
                                    src="{{ asset('images/iconodeborrar.png') }}" class="icono"></button>
                        </form>
                    </div>
                </div>
                
                
            </div>
            <hr class="linea-dorada" id="{{$usuario->name}}">
        @endforeach
    </div>
</div>
