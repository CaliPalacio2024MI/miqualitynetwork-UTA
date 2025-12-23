@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Resultados de la API</div>

                <div class="card-body">
                    <div class="mb-4">
                        <h5>URL consultada:</h5>
                        <code>{{ $apiUrl }}</code>
                    </div>

                    @if(empty($data))
                        <div class="alert alert-warning">No se encontraron datos en la respuesta.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach(array_keys($data[0] ?? $data) as $key)
                                            <th>{{ ucfirst($key) }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($data[0])) 
                                        {{-- Si es un array de objetos --}}
                                        @foreach($data as $item)
                                            <tr>
                                                @foreach($item as $value)
                                                    <td>{{ is_array($value) ? json_encode($value) : $value }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    @else
                                        {{-- Si es un objeto simple --}}
                                        <tr>
                                            @foreach($data as $value)
                                                <td>{{ is_array($value) ? json_encode($value) : $value }}</td>
                                            @endforeach
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            <h5>Respuesta JSON completa:</h5>
                            <pre>{{ json_encode($data, JSON_PRETTY_PRINT) }}</pre>
                        </div>
                    @endif

                    <a href="{{ route('api.form') }}" class="btn btn-secondary mt-3">Nueva Consulta</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection