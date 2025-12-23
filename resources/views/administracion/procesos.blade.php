@extends('layouts.dashboard')

@section('title', 'Gestión de Procesos')

@vite(['resources/css/procesos.css', 'resources/js/alerta_administracion.js'])

@section('content')
    <div class="tamaño-titulo">
        <h1 class="text-2xl font-bold titulo">Administración de Procesos</h1>
    </div>

    <div class="contenedor-alerta-registro-proceso">
        <h1 class="titulo-alerta-registrado">Registrado</h1>
        <h1>Proceso registrado</h1>
        <img src="{{ asset('images/giftcompletado.gif') }}" class="icono-completado-registro-alerta">
        <button class="btn-aceptar-boton-registro-alerta">Aceptar</button>
    </div>

    <div class="contenedor-alerta-eliminacion-proceso">
        <h1 class="titulo-alerta-proceso-eliminado">Eliminar ⚠️</h1>
        <h1>¿Esta seguro de eliminar este proceso?</h1>
        <br>
        <h1>No se podran revertir los cambios</h1>
        <img src="{{ asset('images/advertencia.png') }}" class="icono-completado-eliminiar-alerta-proceso">
        <div class="contenedo-aceptar-cancelar">
            <button class="btn-borrar-proceso-alerta">Aceptar</button>
            <button class="btn-cancelar-proceso-alerta">Cancelar</button>
        </div>
    </div>

    <div class="contenedor-alerta-modificar-proceso">
        <h1 class="titulo-alerta-proceso-modificar">Modificación</h1>
        <h1>¿Esta seguro de modificar el nombre de este proceso?</h1>
        <div class="contenedo-aceptar-cancelar">
            <button class="btn-aceptar-proceso-alerta">Aceptar</button>
            <button class="btn-cancelar-modificacion-proceso-alerta">Cancelar</button>
        </div>
    </div>
    <div class="Contenido-procesos-registro-edicion">
        <div class="formulario-registro-procesos w-full max-w-xl mx-auto p-8 bg-white rounded-xl shadow-lg flex flex-col gap-6">
            <form action="{{ route('crear.proceso') }}" method="POST" class="form-registro-procesos">
                @csrf

                <div class="campo">
                    <label for="nombre" class="nombre-registro">Registro de Procesos</label>
                    <input type="text" id="nombre_proceso" name="nombre" class="input-text" required />
                </div>

                <div class="campo">
                    <label for="tipo" class="nombre-registro">Tipo de Proceso</label>
                    <select name="tipo" class="input-text" required>
                        <option value="apoyo">Apoyo</option>
                        <option value="operativo">Operativo</option>
                    </select>
                </div>

                <div class="campo">
                    <input type="submit" value="Registrar Proceso" class="btn-registro_proceso" />
                </div>
            </form>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>


        <div class="contenedor-procesos-edicion">
            <div class="campo">
                <label class="nombre-registro">Procesos registrados</label>
            </div>
            <div class="formulario-edicion">
                <div class="grupo-proceso-eliminacion-modificacion">
                    <div class="seccion-procesos">
                        <a class="txt-tipo-proceso">Tipo proceso</a>
                        <a class="txt-nomb-proceso">Nombre proceso</a>
                    </div>
                    @foreach ($datos as $dato)
                        <form action='{{route('modificar.proceso')}}' method='POST'
                            class='formulario-modificacion-nombre-proceso'>
                            @csrf
                            <input type="text" value="{{$dato->tipo}}" class="input-tipo-proceso" readonly>
                            <input type="hidden" name="id_procesos" value="{{ $dato->id_proceso }}">
                            <input type="text" value="{{ $dato->nombre_proceso }}" class="input-nombre-proceso"
                                name="nombre_proceso" id="{{ $dato->nombre_proceso }}" />
                            <button type="submit" class="btn-actualizar"><img src="{{ asset('images/check.png') }}"
                                    class="icono-modificacion"></button>
                        </form>


                        <form action='{{route('borrar.proceso')}}' method='POST' class='formulario-borrar-proceso'>
                            @csrf
                            <input type="hidden" name="id" value="{{ $dato->id_proceso }}">
                            <button type="submit" class="btn-borrar"><img src="{{ asset('images/iconodeborrar.png') }}"
                                    class="icono-eliminacion"></button>
                        </form>
                        <hr class="linea-dorada-procesos">
                    @endforeach
                </div>


                <!-- Success and Error Messages -->
                @if (session('terminado'))
                    <div class="alert alert-success">{{ session('terminado') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
