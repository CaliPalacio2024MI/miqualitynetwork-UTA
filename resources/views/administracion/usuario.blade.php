@extends('layouts.dashboard')

@section('title', 'usuario')
<!-- ESTA VISTA SOLO MUESTRA LOS BOTONES QUE ENVIA A LAS 4 SECCIONES DE ADMINISTRAR USUARIOS, PROPIEDADES ,CARPETAS Y PROCESOS-->
@section('content')
@vite(['resources/css/usuario.css'])

<div>
    <h2 class="px-6 py-3 mb-6 text-2xl font-bold text-center bg-gray-300 rounded-full shadow-md">
        Administracion
    </h2>
</div>

<div class="botonesadmin">
    <div class="administrador">
        <a href="{{ route('dashboard.propiedades') }}" class="administrar-btn">
            <img src="{{ asset('images/edificio.png') }}" class="logo">Propiedades
        </a>
    </div>

    <div class="procesos">
        <a href="{{ route('dashboard.procesos') }}" class="procesos-btn">
            <img src="{{ asset('images/archivo.png') }}" class="logo">Procesos
        </a>
    </div>

    <div class="administrador">
        <a href="{{ route('admin.departamentos') }}" class="administrar-btn">
            <img src="{{ asset('images/depto.svg') }}" class="logo">Departamentos
        </a>
    </div>

    <div class="administrador">
        <a href="{{ route('puestos.index') }}" class="administrar-btn">
            <img src="{{ asset('images/puestos.svg') }}" class="logo">Puestos
        </a>
    </div>

    <div class="creador">
        <a href="{{ route('dashboard.crearuser') }}" class="crear-btn">
            <img src="{{ asset('images/crear.png') }}" class="logo">Anfitriones
        </a>
    </div>

    <div class="archivos">
        <a href="{{ route('dashboard.index') }}" class="archivos-btn">
            <img src="{{ asset('images/archivo.svg') }}" class="logo">Archivos
        </a>
    </div>

    <div class="administrador">
        <a href="{{ route('mire.administracion.admin_eventos') }}" class="administrar-btn">
            <img src="{{ asset('images/modules/mire/reservacion.svg') }}" class="logo">Reservación de Eventos
        </a>
    </div>

    <div class="administrador">
        <a href="{{ route('residuos.administracion.admin_residuos') }}" class="administrar-btn">
            <img src="{{ asset('images/modules/residuos/residuos.svg') }}" class="logo">Control de Residuos
        </a>
    </div>

    <div class="administrador">
        <a href="{{ route('controlenergeticos.admin_energeticos') }}" class="administrar-btn">
            <img src="{{ asset('images/modules/controlenergeticos/energéticos.svg') }}" class="logo">Control de Energéticos
        </a>
    </div>

    <div class="administrador">
        <a href="{{ route('bcp.admin') }}" class="administrar-btn">
            <img src="{{ asset('images/modules/bcp/Rack.svg') }}" class="logo">Rack de habitaciones
        </a>
    </div>

    <div class="administrador">
        <a href="{{ route('historialclinico.admin_historial') }}" class="administrar-btn">
            <img src="{{ asset('images/modules/historialclinico/historial.svg') }}" class="logo">Historial Clínico
        </a>
    </div>

    <div class="administrador">
        <a href="{{ route('accidentes.enfermedades') }}" class="administrar-btn btn-accidentes">
            <img src="{{ asset('images/icono_accidentes_enfermedades.png') }}" class="logo" alt="">
            <span>Accidentes y<br>Enfermedades</span>
        </a>
    </div>

    <div class="administrador">
        <a href="{{ route('responsable.index') }}" class="administrar-btn">
            <img src="{{ asset('images/responsable2.png') }}" class="logo">Responsable
        </a>
    </div>

    <!-- Nuevo botón para energéticos -->
    <div class="energeticos">
        <a href="{{ route('dashboard.energeticos') }}" class="energeticos-btn">
            <img src="{{ asset('images/energia.png') }}" class="logo">Energéticos
        </a>
    </div>

@endsection
