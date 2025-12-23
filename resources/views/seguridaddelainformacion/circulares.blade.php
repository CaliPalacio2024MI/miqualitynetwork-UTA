@extends('layouts.dashboard')

@section('title', 'Circulares')
@vite(['resources/css/carpetas.css'])

@section('content')
    <div class="container p-4 mx-auto">
        <div class="container min-h-screen px-6 py-8 mx-auto">
            <h2 class="px-6 py-3 mb-6 text-2xl font-bold text-center bg-gray-300 rounded-full shadow-md">
                Circulares
            </h2>

            @if (session('success'))
                <div class="text-center alert alert-success alert-dismissible fade show w-75" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- 🔹 Sección para mostrar Carpetas -->
            <div class="flex-wrap gap-3 d-flex">
                @foreach ($carpetas as $carpeta)
                    @if (is_null($carpeta->parent_id)) {{-- Solo mostrar carpetas principales --}}
                        <div class="folder-container">
                            <a href="{{ route('circulares.carpetas', ['carpeta_id' => $carpeta->id]) }}"
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
@endsection