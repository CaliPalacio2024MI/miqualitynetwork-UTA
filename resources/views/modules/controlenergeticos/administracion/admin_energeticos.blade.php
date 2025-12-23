@extends('layouts.dashboard')

@section('title', 'Control de energéticos')

@section('content')

    <div>
        <h2 class="px-6 py-3 mb-6 text-2xl font-bold text-center bg-gray-300 rounded-full shadow-md">
            Control de Energéticos
        </h2>
    </div>

    <div class = "administrador">
        <a href="{{ route('controlenergeticos.energeticos') }}" class = "administrar-btn"><img src="{{ asset('images/modules/controlenergeticos/energéticos2.svg') }}"
                class="logo">Energéticos </a>

    </div>

@endsection
