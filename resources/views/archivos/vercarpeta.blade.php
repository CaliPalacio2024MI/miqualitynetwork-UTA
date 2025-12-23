@extends('layouts.dashboard')

@section('title', "Carpeta: $carpeta->nombre_carpeta")
@vite(['resources/css/carpetas.css'])
@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">📂 {{ $carpeta->nombre_carpeta }}</h2>

        @if ($archivos->isEmpty() && $subcarpetas->isEmpty())
            <p class="text-center text-gray-500">No hay archivos ni subcarpetas en esta carpeta.</p>
        @else
            <!--Barra de búsqueda y filtros -->
            <div class="flex flex-col md:flex-row gap-4 mb-6">
                <div class="w-full md:w-1/2">
                    <input type="text" id="search"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="🔍 Buscar archivo...">
                </div>
                <div class="w-full md:w-1/4">
                    <select id="fileTypeFilter"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">📂 Todos los tipos de archivo</option>
                        <option value="pdf">PDF</option>
                        <option value="docx">Word</option>
                        <option value="xlsx">Excel</option>
                        <option value="pptx">PowerPoint</option>
                        <option value="txt">Texto</option>
                        <option value="img">Imágenes</option>
                    </select>
                </div>
            </div>

            <!--Subcarpetas dentro de esta carpeta -->
            @if (!$subcarpetas->isEmpty())
                <h3 class="text-lg font-bold my-3">📁 Subcarpetas</h3>
                <div class="d-flex flex-wrap gap-3">
                    @foreach ($subcarpetas as $subcarpeta)
                        <div class="folder-container">
                            <a href="{{ route(request()->route()->getName(), ['carpeta_id' => $subcarpeta->id]) }}"
                                class="btn-carpeta">
                                <img src="{{ asset('images/carpeta.png') }}" alt="Carpeta" class="folder-icon">
                                <span>{{ $subcarpeta->nombre_carpeta }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif


            <!--Archivos dentro de la carpeta -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6" id="fileContainer">
                @foreach ($archivos->where('visible', true) as $archivo)
                    @include('partials.archivo-card', ['archivo' => $archivo])
                @endforeach

            </div>
        @endif
    </div>

    <script src="{{ asset('js/fileFilter.js') }}"></script> <!-- script para filtros de búsqueda -->
@endsection
