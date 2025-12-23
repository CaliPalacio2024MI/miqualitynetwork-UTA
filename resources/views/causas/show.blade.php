{{-- resources/views/causas/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow p-6 rounded mt-10">
    <h1 class="text-xl font-bold text-blue-900 mb-4">Detalle de la Causa</h1>
    <p><strong>Nombre:</strong> {{ $causa->nombre }}</p>
    <a href="{{ route('admin.causas.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">← Volver al listado</a>
</div>
@endsection