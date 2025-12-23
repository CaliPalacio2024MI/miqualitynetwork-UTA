@extends('layouts.dashboard')

@section('title', 'Historial Clínico')

@section('head')
    @vite(['resources/css/carpetas.css'])
    @vite(['resources/css/modules/historialclinico/formulario.css'])
@endsection

@section('content')
    @include('seguridadysalud.partials.top_navigation')
    <div class="content" id="mainContent">
        <div class="container mx-auto p-4">
            <div class="container mx-auto px-6 py-8 min-h-screen">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center w-75" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="d-flex flex-wrap gap-3">
                    @foreach ($carpetas as $carpeta)
                        @if (is_null($carpeta->parent_id)) {{-- Solo mostrar carpetas principales --}}
                            <div class="folder-container">
                                <a href="{{ route('historialclinico.carpetas', ['carpeta_id' => $carpeta->id]) }}"
                                   class="btn-carpeta">
                                    <img src="{{ asset('images/carpeta.png') }}" alt="Carpeta" class="folder-icon">
                                    <span>{{ $carpeta->nombre_carpeta }}</span>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>

                @if ($carpetas->isEmpty())
                    <p class="text-center text-muted">No hay carpetas en esta subsección.</p>
                @endif
            </div>
        </div>
    </div>
@endsection