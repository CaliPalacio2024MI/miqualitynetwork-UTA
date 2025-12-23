@extends('layouts.dashboard')

@section('title', 'MI Reservación de Eventos')

@section('content')

<div>
        <h2 class="px-6 py-3 mb-6 text-2xl font-bold text-center bg-gray-300 rounded-full shadow-md">
            Reservación de Eventos
        </h2>
    </div>

<div class = "administrador">
            <a href="{{ route('mire.administracion.eventos') }}" class = "administrar-btn"><img src="{{ asset('images/modules/mire/eventos.svg') }}"
                    class="logo">Eventos </a>
        </div>
@endsection
