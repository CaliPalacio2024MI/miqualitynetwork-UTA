{{-- filepath: b:\Archivos Proyecto Myqualitynetwork\MyQualityNetWorkRe 0602252\resources\views\calidad\documentacionmi.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Documentación MI')
@vite(['resources/css/carpetas.css'])

@section('content')
@php
    $accesoApoyo = auth()->user()->privilegios && auth()->user()->privilegios->acceso_procesosdeapoyo;
    $accesoOperativos = auth()->user()->privilegios && auth()->user()->privilegios->acceso_procesosoperativos;
    $soloUno = ($accesoApoyo xor $accesoOperativos); // true si solo tiene acceso a uno de los dos procesos
@endphp
<div class="container mx-auto p-4">
    <div class="container mx-auto px-6 py-8 h-auto scrollable-mobile">
        <h2 class="text-2xl font-bold mb-6 bg-gray-300 text-center rounded-full py-3 px-6 shadow-md">
            Documentación MI
        </h2>
        <div class="flex flex-col md:flex-row gap-6">
            {{-- Procesos de Apoyo --}}
            @if ($accesoApoyo)
            <div class="{{ $soloUno ? 'w-full' : 'w-full md:w-1/2' }} bg-white rounded-lg shadow-md p-4">
                <h2 class="text-2xl font-bold mb-6 bg-gray-300 text-center rounded-full py-3 px-6 shadow-md">
                    Procesos de apoyo
                </h2>
                {{-- ...contenido... --}}
                <div class="d-flex flex-wrap gap-3">
                    @foreach ($carpetas_apoyo as $carpeta)
                        @if (is_null($carpeta->parent_id))
                            <div class="folder-container">
                                <a href="{{ route('procesosdeapoyo.carpetas', ['carpeta_id' => $carpeta->id]) }}"
                                   class="btn-carpeta">
                                    <img src="{{ asset('images/carpeta.png') }}" alt="Carpeta" class="folder-icon">
                                    <span>{{ $carpeta->nombre_carpeta }}</span>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
                @if ($carpetas_apoyo->isEmpty())
                    <p class="text-center text-muted">No hay carpetas en esta subsección.</p>
                @endif
            </div>
            @endif

            {{-- Procesos Operativos --}}
            @if ($accesoOperativos)
            <div class="{{ $soloUno ? 'w-full' : 'w-full md:w-1/2' }} bg-white rounded-lg shadow-md p-4">
                <h2 class="text-2xl font-bold mb-6 bg-gray-300 text-center rounded-full py-3 px-6 shadow-md">
                    Procesos operativos
                </h2>
                {{-- ...contenido... --}}
                <div class="d-flex flex-wrap gap-3">
                    @foreach ($carpetas_operativos as $carpeta)
                        @if (is_null($carpeta->parent_id))
                            <div class="folder-container">
                                <a href="{{ route('procesosoperativos.carpetas', ['carpeta_id' => $carpeta->id]) }}"
                                   class="btn-carpeta">
                                    <img src="{{ asset('images/carpeta.png') }}" alt="Carpeta" class="folder-icon">
                                    <span>{{ $carpeta->nombre_carpeta }}</span>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
                @if ($carpetas_operativos->isEmpty())
                    <p class="text-center text-muted">No hay carpetas en esta subsección.</p>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
