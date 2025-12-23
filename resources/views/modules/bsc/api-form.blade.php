@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Consultar Datos de API</div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('api.fetch') }}">
                        @csrf

                        <div class="form-group">
                            <label for="api_url">URL de la API</label>
                            <input type="url" class="form-control" id="api_url" name="api_url" 
                                   value="{{ old('api_url', $exampleUrl ?? '') }}" 
                                   placeholder="Ingrese la URL completa de la API" required>
                            <small class="form-text text-muted">
                                Ejemplo: {{ $exampleUrl ?? 'Ingrese una URL válida' }}
                            </small>
                            @error('api_url')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Consultar Datos</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection