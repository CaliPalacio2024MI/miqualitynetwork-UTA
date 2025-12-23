@extends('layouts.dashboard')

@section('title', 'Ver Archivo')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-center">📄 {{ $archivo->nombre_archivo }}</h1>

        <div class="d-flex justify-content-center mb-3">
            <a href="{{ route('archivos.download', ['id' => $archivo->id_archivo]) }}" class="btn btn-success">
                📥 Descargar PDF
            </a>
        </div>

        <!-- Mostrar el PDF -->
        <div class="text-center">
            <iframe src="{{ route('archivos.verPdf', ['id' => $archivo->id_archivo]) }}" width="100%" height="600px"></iframe>
        </div>
    </div>
@endsection
