@extends('layouts.dashboard')

@section('title', 'Control Documental')
@vite(['resources/css/carpetas.css'])

@section('content')
    <div class="grid grid-rows-[100px_1fr] h-full gap-0">
        <!-- Título con fondo y bordes redondeados -->
        <div class="flex items-center justify-center">
            <div class="w-full max-w-4xl p-4 bg-gray-200 rounded-lg">
                <h1 class="text-4xl font-bold text-center">Control Documental</h1>
            </div>
        </div>

        <!-- Contenedor de los botones -->
        <div class="flex justify-center">
            <div class="grid grid-cols-2 gap-6 mt-8 md:grid-cols-3 lg:grid-cols-4">
                <!-- Botón 1 -->
                <a href="{{ route('controldoc.lmdistribucion') }}"
                    class="group flex flex-col justify-center items-center border border-gray-300 rounded-lg bg-[#092034] text-white hover:bg-[#BC8A55] hover:scale-105 transition-transform duration-200 w-[400px] h-[200px]">
                    <img src="/images/listamaestraBLANCO.png" alt="Lista Maestra" class="w-16 h-16">
                    <span class="px-1 text-base text-center truncate sm:whitespace-normal sm:overflow-visible sm:text-lg md:text-xl lg:text-2xl">LMD</span>
                    <span class="hidden mt-2 text-sm text-center text-white group-hover:block">Lista Maestra de Distribución</span>
                </a>

                <!-- Botón 2 -->
                <a href="{{ route('controldoc.lminternaexterna') }}"
                    class="group flex flex-col justify-center items-center border border-gray-300 rounded-lg bg-[#092034] text-white hover:bg-[#BC8A55] hover:scale-105 transition-transform duration-200 w-[400px] h-[200px]">
                    <img src="/images/listaexternainternaBLANCO.png" alt="Lista Maestra" class="w-16 h-16">
                    <span class="px-1 text-base text-center truncate sm:whitespace-normal sm:overflow-visible sm:text-lg md:text-xl lg:text-2xl">LMCIDIYE</span>
                    <span class="hidden mt-2 text-sm text-center text-white group-hover:block">Lista Maestra Control Interna y Externa</span>
                </a>

                <!-- Botón 3 -->
                <a href="{{ route('controldoc.lmcontrolcambios') }}"
                    class="group flex flex-col justify-center items-center border border-gray-300 rounded-lg bg-[#092034] text-white hover:bg-[#BC8A55] hover:scale-105 transition-transform duration-200 w-[400px] h-[200px]">
                    <img src="/images/listamodificadosBLANCO.png" alt="Lista Maestra" class="w-16 h-16">
                    <span class="px-1 text-base text-center truncate sm:whitespace-normal sm:overflow-visible sm:text-lg md:text-xl lg:text-2xl">LMCC</span>
                    <span class="hidden mt-2 text-sm text-center text-white group-hover:block">Lista Maestra de Control de Cambios</span>
                </a>

                <!-- Botón 4 -->
                <a href="{{ route('controldoc.lmeliminada') }}"
                    class="group flex flex-col justify-center items-center border border-gray-300 rounded-lg bg-[#092034] text-white hover:bg-[#BC8A55] hover:scale-105 transition-transform duration-200 w-[400px] h-[200px]">
                    <img src="/images/listaeliminadosBLANCO.png" alt="Lista Maestra" class="w-16 h-16">
                    <span class="px-1 text-base text-center truncate sm:whitespace-normal sm:overflow-visible sm:text-lg md:text-xl lg:text-2xl">LMCIDEIYE</span>
                    <span class="hidden mt-2 text-sm text-center text-white group-hover:block">Lista Maestra de Información Documentada Eliminada</span>
                </a>
            </div>
        </div>
    </div>
@endsection