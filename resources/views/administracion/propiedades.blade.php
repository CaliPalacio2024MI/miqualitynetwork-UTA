@extends('layouts.dashboard')
<!-- ESTA ES LA PAGINA PARA CREAR Y BORRAR PROPIEDADES-->
@section('title', 'administraruser')

@section('content')
    @vite(['resources/css/administracionPropiedades.css','resources/js/alerta_administracion.js'])
    <div class="tamaño-titulo">
        <h1 class="text-2xl font-bold titulo">Administrador de Propiedades</h1>
    </div>


    <div class="contenedor-alerta-registro-propiedad">
    <h1 class="titulo-alerta-registrado-propiedad">Registrado</h1>
    <h1>Propiedad registrada</h1>
    <img src="{{ asset('images/giftcompletado.gif') }}" class="icono-completado-registro-alerta-propiedad">
    <button class ="btn-aceptar-propiedad-registro-alerta">Aceptar</button>
    </div>


    <div class="contenedor-alerta-eliminacion-propiedades">
        <h1 class="titulo-alerta-propiedades-eliminado">Eliminar ⚠️</h1>
        <h1>¿Esta seguro de eliminar esta Propiedad?</h1>
        <br>
        <h1>No se podran revertir los cambios</h1>
        <img src="{{ asset('images/advertencia.png') }}" class="icono-completado-eliminiar-alerta-propiedades">
        <div class = "contenedor-aceptar-cancelar">
            <button class ="btn-borrar-propiedades-alerta">Aceptar</button>
            <button class ="btn-cancelar-propiedades-alerta">Cancelar</button>
        </div>
    </div>

    <div class="contenedor-alerta-modificar-propiedad">
        <h1 class="titulo-alerta-propiedad-modificar">Modificación</h1>
        <h1>¿Esta seguro de modificar el nombre de esta propiedad?</h1>
       
        <div class = "contenedor-aceptar-cancelar">
            <button class ="btn-aceptar-propiedad-modificacion">Aceptar</button>
            <button class ="btn-cancelar-modificacion-propiedad-alerta">Cancelar</button>
        </div>
    </div>

    <div class="contenedor-propiedades">

        <div class="formulario-registro-de-propiedades">
            <form action="{{ route('crear.propiedad') }}" method="POST" class="form-registro-propiedades">
                @csrf

                <div class="campo">
                    <label for="nombre" class="nombre-registro">Registro de propiedades</label>
                    <input type="text" id="nombre_propiedad" name="nombre" class="input-text" required />
                </div>

                <div class="div-registro-boton">
                    <input type="submit" value="Registrar Propiedad" class="btn-registro" />
                </div>
            </form>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
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

        <div class="contenedor-formulario-edicion-propiedades">
            <div class="campo-titulo-formulario-actualizacion">
                <label for="nombre" class="nombre-registro">Propiedades Registradas</label>
            </div>

            <div class="formulario-edicion">
                @foreach ($datos as $dato)
                    <div class="grupo">

                        <form action='{{route('actualizar.propiedad')}}' method='POST'class='form-modificacion-propiedad'>
                            @csrf
                            <input type="hidden" readonly value="{{ $dato->id_propiedad }}" id="id_propiedad" name="id_propiedad"/>
                            <input type="text" id="nombre_propiedad" name="nombre_propiedad" value="{{ $dato->nombre_propiedad }}" class="nombre-propiedad-text" />
                            <button type="submit" class="btn-actualizar-propiedad"><img src="{{ asset('images/check.png') }}" class="icono-eliminacion" id="icono_modificacion"></button>
                        </form>

                        <form action="{{ route('borrar.propiedad') }}" method="POST" class="form-eliminacion-propiedad">
                            @csrf
                            <input type="hidden" name="id" value="{{ $dato->id_propiedad }}" id="id">
                            <button type="submit" class="btn-cambio"><img src="{{ asset('images/iconodeborrar.png') }}" class="icono-eliminacion"></button>
                        </form>

                    </div>
                @endforeach
                @if (session('terminado'))
                    <div class="alert alert-success">
                        {{ session('terminado') }}
                    </div>
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
