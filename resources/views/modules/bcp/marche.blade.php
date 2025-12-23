@extends('layouts.dashboard')

@section('title', 'Marche')
@vite([
    'resources/css/modules/bcp/menu.css',
    'resources/css/modules/bcp/marche.css',
    'resources/js/modules/bcp/marche.js'
])
@section('content')
@include('modules.bcp.layouts.app')
    

    <div class="formulario-container">
<table class="tabla-informacion">
    <tr>
        <td><b>Propiedad:</b></td>
        <td>Palacio Mundo Imperial</td>
    </tr>
    <tr>
        <td><b>Centro consumo:</b></td>
        <td>Marche</td>
    </tr>
    <tr>
        <td><b>Habitación:</b></td>
        <td><input type="num" id="habitacion" name="habitacion" maxlength="4" pattern="\d{4}" required style="text-align: center;"></td>
    </tr>
    <tr>
        <td><b>Huésped:</b></td>
        <td>-</td>
    </tr>
    <tr>
        <td><b>Tipo:</b></td>
        <td>-</td>
    </tr>
    <tr>
        <td><b>Plan:</b></td>
        <td>-</td>
    </tr>
    <tr>
        <td><b>Brazalete:</b></td>
        <td>-</td>
    </tr>
    <tr>
        <td><b>F. Llegada:</b></td>
        <td>-</td>
    </tr>
    <tr>
        <td><b>F. Salida:</b></td>
        <td>- </td>
    </tr>
    <tr>
        <td><b>Late Check Out:</b></td>
        <td>- </td>
    </tr>
    <tr>
        <td><b>Pax:</b></td>
        <td>-</td>
    </tr>
    <tr>
        <td><b>Grupo:</b></td>
        <td>-</td>
    </tr>
    <tr>
        <td><b>Crédito Disponible:</b></td>
        <td>-</td>
    </tr>
    <tr>
        <td><b>Mesa:</b></td>
        <td><input type="number" id="mesa" name="mesa" required style="text-align: center;"></td>
    </tr>
    <tr>
        <td><b>Mesero:</b></td>
        <td><input type="text" id="mesero" name="mesero" required style="text-align: center;"></td>
    </tr>
    <tr>
        <td><b>Forma de pago:</b></td>
        <td><select name="forma_pago" id="forma-pago" required>
            <option value="" disabled selected hidden>Seleccionar</option>
            <option value="EFE">EFE</option>
            <option value="C-H">C-H</option>
            <option value="CXC">CXC</option>
            <option value="OID">OID</option>
            <option value="PMQ">PMQ</option>
            <option value="TAR01">TAR01</option>
            <option value="TAR02">TAR02</option>
            <option value="TAR03">TAR03</option>
            <option value="TAR06">TAR06</option>
            <option value="TAR07">TAR07</option>
            <option value="BEBINC">BEBINC</option>
            <option value="CENINC">CENINC</option>
            <option value="COMINC">COMINC</option>
            <option value="DESINC">DESINC</option>
            <option value="GIPAL">GIPALA</option>
            <option value="GIPRIN">GIPRIN</option>
            <option value="GIPIER">GIPIER</option>
        </select></td></tr>
        <tr><td><b>Propina:</b></td>
        <td><input type="number" name="propina" id="propina" style="text-align: center;"></td></tr>
        <tr><td><b>Descuento:</b></td>
    <td><input type="number" name="descuento" id="descuento" style="text-align: center;"></td>
    </tr>
</table><br>
        <div class="botones-container">
        <button type="button" class="btn" id="abrir-cuenta">Abrir cuenta</button>
        <button type="button" class="btn" id="generar-cheque">Generar cheque</button>
        <button type="button" class="btn" id="cerrar-cheque">Cerrar cheque</button>
        <button type="button" class="btn" id="generar-tira">Generar tira de venta</button>
        
    </div><br>

    <!-- TABLA DE PEDIDOS -->
    <div class="tabla-pedidos-contenedor" id="tabla-pedidos-contenedor" style="display: none;">
    <table class="tabla-pedidos">
        <thead>
            <tr>
                <th>Categoría</th>
                <th>Cantidad</th>
                <th>Descripción</th>
                <th>Importe</th>
                <th>Mesa</th>
                
            </tr>
        </thead>
        <tbody>
            <tr>
    <td>
        <select name="categoria" id="categoria" required>
            <option value="" disabled selected hidden>Seleccionar</option>
            <option value="alimento">Alimento</option>
            <option value="bebida">Bebida</option>
        </select>
    </td>
    <td><input type="number" name="cantidad" id="cantidad" min="1"></td>
    <td><input type="text" name="descripcion" id="descripcion"></td>
    <td><input type="text" name="importe" id="importe"></td>
    <td><input type="number" name="mesa" id="mesa-ayb"></td>
    
</tr>
        </tbody>
    </table>
    <div><button type="button" class="btn-registrar" id="registrar-ayb">Registrar A&B</button></div>
    

</div>


<div class="tabla-container">
<div class="buscador-container" id="buscador-bloque">
    <input type="text" id="buscador" placeholder="Buscar mesa" class="buscador-input">
    <button type="button" class="buscador-btn" onclick="buscarMesa()">Buscar</button>
    <button type="button" class="buscador-btn" onclick="ocultarTabla()">Registrar</button>
</div>

    <table id="tabla-cuentas">
        <thead>
            <tr>
                <th>Mesa</th>
                <th>Habitación</th>
                <th>Pax</th>
                <th>Mesero</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody id="tabla-cuentas-marche">
        {{-- Se llenará dinámicamente con JS --}}
    </tbody>
    </table>
    

</div>
<div id="detalle-pedidos">
  <h3>Pedidos de la mesa <span id="mesa-numero"></span></h3>
  <ul id="lista-pedidos">
    <!-- Aquí se insertarán los productos con JS -->
  </ul>
  <button onclick="regresar()">← Regresar</button>
</div>
<div id="detalle-modal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%);
 background:white; padding:20px; border:1px solid #ccc; box-shadow:0 0 10px rgba(0,0,0,0.3); z-index:9999; max-width: 400px;">
    <div id="detalle-modal-content"></div>
    <div id="detalle-contenido"></div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
<img id="logo-marche" src="{{ asset('images/marche.png') }}" style="display: none;">


@endsection
