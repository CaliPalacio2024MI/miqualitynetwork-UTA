@extends('layouts.dashboard')

@section('title', 'Departamentos')

@section('content')
    @vite(['resources/css/usuario.css'])
    
    {{-- Meta tag para el CSRF token, necesario para peticiones AJAX --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

   <style>
    /* Contenedor general */
    .wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 24px;
        padding: 30px;
        justify-content: center;
        align-items: flex-start;
        background-color: #f4f6f8;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Columnas */
    .left-column, .right-column {
        background-color: #ffffff;
        padding: 10px;
        border-radius: 16px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.06);
        flex: 1;
        min-width: 320px;
        max-width: 520px;
        transition: box-shadow 0.3s ease;
    }

    .left-column:hover, .right-column:hover {
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
    }

    /* Encabezado */
    .header {
        text-align: center;
        margin-bottom: 30px;
    }

    .header h2 {
        font-size: 2rem;
        color: #2c3e50;
        font-weight: 700;
    }

    /* Formulario */
    .form-group {
        margin-bottom: 20px;
    }

    .line-input, .line-input-select {
        width: 100%;
        padding: 14px 16px;
        margin-top: 10px;
        border: 1px solid #ccd1d9;
        border-radius: 10px;
        font-size: 1rem;
        color: #333;
        background-color: #fafafa;
    }

    .line-input::placeholder {
        color: #bbb;
    }

    .line-input:focus, .line-input-select:focus {
        border-color: #3498db;
        outline: none;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        background-color: #fff;
    }

    /* Botón agregar */
    .button-agregar {
        background-color: #092034;
        color: #fff;
        padding: 14px;
        border: none;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        width: 100%;
        margin-top: 25px;
        transition: background-color 0.3s ease;
    }

    .button-agregar:hover {
        background-color: #BC8A55;
    }

    /* Lista de puestos */
    .listaPuestos h3 {
        font-size: 1.6rem;
        color: #2c3e50;
        margin-bottom: 20px;
        text-align: center;
        font-weight: 700;
    }

    .puestos-container {
        max-height: 420px;
        overflow-y: auto;
        background-color: #fefefe;
        border: 1px solid #e1e8ed;
        border-radius: 12px;
        padding: 12px;
    }

    #departamentos-list {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    #departamentos-list li {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 18px;
        background-color: #ffffff;
        border-radius: 10px;
        margin-bottom: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    #departamentos-list li:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    }

    #departamentos-list li span {
        font-size: 1.05rem;
        color: #34495e;
        flex-grow: 1;
        margin-right: 20px;
    }

    .btn-container-right {
        display: flex;
        gap: 10px;
    }

    .btn-editar, .btn-eliminar {
        background: none;
        border: none;
        cursor: pointer;
        padding: 6px;
        border-radius: 6px;
        transition: background-color 0.3s ease;
    }

    .btn-editar:hover {
        background-color: #e3f2fd;
    }

    .btn-eliminar:hover {
        background-color: #fdecea;
    }

    .btn-editar img, .btn-eliminar img {
        width: 22px;
        height: 22px;
    }

    /* Modal */
    .custom-modal-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.55);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .custom-modal-content {
        background: #fff;
        padding: 30px;
        border-radius: 16px;
        max-width: 440px;
        width: 90%;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        animation: fadeIn 0.3s ease;
        text-align: center;
    }

    .custom-modal-content p {
        font-size: 1.1rem;
        margin-bottom: 20px;
        color: #2c3e50;
    }

    .custom-modal-content input {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        font-size: 1rem;
    }

    .custom-modal-buttons button {
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        margin: 0 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .confirm-btn {
        background-color: #3498db;
        color: white;
    }

    .confirm-btn:hover {
        background-color: #2980b9;
    }

    .cancel-btn {
        background-color: #95a5a6;
        color: white;
    }

    .cancel-btn:hover {
        background-color: #7f8c8d;
    }

    .hidden {
        display: none;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .wrapper {
            flex-direction: column;
            padding: 20px;
        }

        .left-column, .right-column {
            width: 100%;
        }
    }
    .wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
            padding: 30px;
            justify-content: center;
            align-items: flex-start;
            background-color: #f4f6f8;
        }

        .left-column, .right-column {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.06);
            flex: 1;
            min-width: 320px;
            max-width: 520px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            font-size: 2rem;
            color: #2c3e50;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .line-input, .line-input-select {
            width: 100%;
            padding: 14px 16px;
            margin-top: 10px;
            border: 1px solid #ccd1d9;
            border-radius: 10px;
            font-size: 1rem;
            color: #333;
            background-color: #fafafa;
        }

        .button-agregar {
            background-color: #092034;
            color: #fff;
            padding: 14px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            margin-top: 25px;
        }

        .listaPuestos h3 {
            font-size: 1.6rem;
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 700;
        }

        .puestos-container {
            max-height: 420px;
            overflow-y: auto;
            background-color: #fefefe;
            border: 1px solid #e1e8ed;
            border-radius: 12px;
            padding: 12px;
        }

        #departamentos-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        #departamentos-list li {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 18px;
            background-color: #ffffff;
            border-radius: 10px;
            margin-bottom: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
        }

        .btn-container-right {
            display: flex;
            gap: 10px;
        }

        .btn-editar img, .btn-eliminar img {
            width: 22px;
            height: 22px;
        }

        .custom-modal-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.55);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .custom-modal-content {
            background: #fff;
            padding: 30px;
            border-radius: 16px;
            max-width: 440px;
            width: 90%;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        .hidden { display: none; }

        @media (max-width: 768px) {
            .wrapper { flex-direction: column; padding: 20px; }
            .left-column, .right-column { width: 100%; }
        }
    </style>

    <div>
        <h2 class="text-2xl font-bold mb-6 bg-gray-300 text-center rounded-full py-3 px-6 shadow-md">
            Administración de Departamentos
        </h2>
    </div>

    <div class="wrapper">
        <div class="left-column">
            <div class="header">
                <h2>Agregar Departamento</h2>
            </div>
            <form action="{{ route('departamentos.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class='listaPuestos' for="propiedad">Propiedad:</label>
                    <select class='line-input-select' name="propiedad_id" id="propiedad" required>
                        @php
                            $propiedades = App\Models\Propiedades::all();
                        @endphp
                        @foreach($propiedades as $propiedad)
                            <option value="{{ $propiedad->id_propiedad }}">{{ $propiedad->nombre_propiedad }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class='listaPuestos' for="proceso_id">Proceso asociado:</label>
                    <select class='line-input-select' id="proceso_id" name="proceso_id">
                        <option value="">-- Selecciona un proceso --</option>
                        @foreach ($procesos as $proceso)
                            <option value="{{ $proceso->id_proceso }}">{{ $proceso->nombre_proceso }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class='listaPuestos' for="departamento">Ingrese el nuevo Departamento:</label>
                    <input class='line-input' type="text" name="departamento" id="departamento" placeholder="Ingrese el Nuevo Departamento" required>
                </div>

                <button type="submit" class="button-agregar">Agregar Departamento</button>
            </form>
        </div>

        <div class="right-column">
            <div class='listaPuestos'>
                <h3>Lista de Departamentos</h3>
            </div>
            <div>
                <input class='line-input' id="filtro-departamento" placeholder="Busca por nombre del departamento">
            </div>
            <div class="puestos-container">
                <ul id="departamentos-list">
                    <li class="loading-indicator">Cargando departamentos...</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Modal personalizado --}}
    <div id="custom-modal-container" class="custom-modal-container hidden">
        <div class="custom-modal-content">
            <p id="custom-modal-message"></p>
            <input type="text" id="custom-modal-input" class="hidden" placeholder="Escribe aquí...">
            <div class="custom-modal-buttons">
                <button id="custom-modal-confirm-btn" class="confirm-btn"></button>
                <button id="custom-modal-cancel-btn" class="cancel-btn"></button>
            </div>
        </div>
    </div>

    <script>
        window.departamentosStoreRoute = "{{ route('departamentos.store') }}";
        window.editIconPath = "{{ Vite::asset('resources/imagenes/editar.PNG') }}";
        window.deleteIconPath = "{{ Vite::asset('resources/imagenes/eliminar.PNG') }}";
    </script>

    @vite(['resources/js/modules/historialclinico/moduloDepartamentos.js'])
@endsection