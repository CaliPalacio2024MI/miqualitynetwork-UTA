@extends('layouts.dashboard')
@section('title','Ver Accidente')
@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Accidente: {{ $accidente->nombre }}</h2>
    <p><strong>ID:</strong> {{ $accidente->id }}</p>
    <a href="{{ route('admin.accidentes.index') }}" class="btn btn-secondary mt-4">Volver</a>
</div>
@endsection