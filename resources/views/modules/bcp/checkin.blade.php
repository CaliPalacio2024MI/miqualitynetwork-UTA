@extends('layouts.dashboard')

@section('title', 'Checkin')
@vite([
    'resources/css/modules/bcp/menu.css',
    'resources/css/modules/bcp/checkin.css',
    'resources/js/modules/bcp/checkin.js'
])
@section('content')
@include('modules.bcp.layouts.app')


    <form>
        <h2 class="titulo-formulario">CHECK IN</h2>
        <div class="formulario-grid">
  <!-- Fila 1 -->
  <div class="columna-formulario">
    <label>1. Código de reservación <span class="obligatorio"></span></label><input type="text" required>
  </div>
  <div class="columna-formulario">
    <label>2. Nombre <span class="obligatorio"></span></label><input type="text" required>
  </div>
  <!-- Campo 3: ¿Tiene acompañante? -->
<div class="columna-formulario">
  <label for="switchAcompanante">3. Acompañante (C)</label>
  <label class="switch">
    <input type="checkbox" id="switchAcompanante">
    <span class="slider"></span>
  </label>
</div>

<!-- Campos acompañante (inicialmente oculto) -->
<!-- CONTENIDO DENTRO DE .formulario-grid -->

<!-- Campo 6: Nombre del Acompañante debajo de Código de reservación -->
<div class="columna-formulario" id="acompNombreField" style="display: none;">
  <label>3.1 Nombre del Acompañante</label>
  <input type="text" id="acompNombre">
</div>

<!-- Campo 7: Correo debajo de Nombre -->
<div class="columna-formulario" id="acompMailField" style="display: none;">
  <label>3.2 Correo electrónico</label>
  <input type="email" id="acompMail">
</div>

<!-- Campo 8: Teléfono debajo de Acompañante (switch) -->
<div class="columna-formulario" id="acompTelField" style="display: none;">
  <label>3.3 Teléfono</label>
  <input type="text" id="acompTel">
</div>

<!-- Campo 9: Calle debajo de Tipo de habitación -->
<div class="columna-formulario" id="acompCalleField" style="display: none;">
  <label>3.4 Calle y Colonia</label>
  <input type="text" id="acompCalle">
</div>

<!-- Campo 10: Ciudad debajo de Garantizado -->
<div class="columna-formulario" id="acompCiudadField" style="display: none;">
  <label>3.5 Municipio/Ciudad</label>
  <input type="text" id="acompCiudad">
</div>

<!-- Campo 11: Estado -->
<div class="columna-formulario" id="acompEstadoField" style="display: none;">
  <label>3.6 Estado</label>
  <input type="text" id="acompEstado">
</div>

<!-- Campo 12: C.P. -->
<div class="columna-formulario" id="acompCPField" style="display: none;">
  <label>3.7 C.P.</label>
  <input type="text" id="acompCP">
</div>






  <!-- Fila 2 -->
  <div class="columna-formulario">
    <label>4. Tpo <span class="obligatorio"></span></label>
    <select required>
      <option value=""disabled selected hidden>Seleccionar</option>
      <option value="BAF">BAF - VIP BONO AUTOFIN</option>
  <option value="C89">C89 - CLUB 89</option>
  <option value="CIM">CIM - SOCIO CLUB IMPERIAL</option>
  <option value="DEC">DEC - PQT DECORACION CONCIERGE</option>
  <option value="FC">FC - FULL CREDIT</option>
  <option value="FRE">FRE - FRECUENTE</option>
  <option value="NOR">NOR - NORMAL</option>
  <option value="NSH">NSH - NO SHOW</option>
  <option value="PRE">PRE - PAQUETE PREMIUM</option>
  <option value="SA">SA - ATENCION ESPECIAL</option>
  <option value="V1">V1 - DUEÑO - DIRECCION GENERAL</option>
  <option value="V2">V2 - DE GTE GENERAL DIRECCION COME</option>
  <option value="V3">V3 - VISITA DE INSPECCION FAM TRIP</option>
  <option value="V4">V4 - LUNAMELEROS, CUMPLEAÑEROS</option>
  <option value="V5">V5 - HUESPED CON INCIDENTES</option>
  <option value="VAF">VAF - VIP BONO AUTOFIN</option>
  <option value="VIM">VIM - SOCIO CLUB IMPERIAL</option>
  <option value="VIP">VIP - VIP</option>
    </select>
  </div>
  <div class="columna-formulario">
    <label>5. Garantizado (G) <span class="obligatorio"></span></label>
    <select required>
      <option value=""disabled selected hidden>Seleccionar</option>
      <option value="True">True</option>
      <option value="False">False</option>
    </select>
  </div>
  <div class="columna-formulario">
    <label>6. Segmento <span class="obligatorio"></span></label>
<select required>
  <option value="" disabled selected hidden>Seleccionar</option>
  <option value="BAR">BAR</option>
  <option value="COR">COR</option>
  <option value="DES">DES</option>
  <option value="MAN">MAN</option>
  <option value="MEM">MEM</option>
  <option value="OTA">OTA</option>
  <option value="PAQ">PAQ</option>
  <option value="SOC">SOC</option>
</select>

  </div>

  <!-- Fila 3 -->
  <div class="columna-formulario">
    <label>7. Categoría (T.Hab.) <span class="obligatorio"></span></label>
<select required>
  <option value="" disabled selected hidden>Seleccionar</option>
  <option value="HDOA">HDOA - HNDCP DBL INT</option>
  <option value="HKOA">HKOA - HNDCP KING INT</option>
  <option value="IKOA">IKOA - IMP KING INT</option>
  <option value="JDOA">JDOA - JR DBL INTERIOR</option>
  <option value="JDUA">JDUA - JR DBL EXTERIOR</option>
  <option value="JKOA">JKOA - JR KING INTERIOR</option>
  <option value="JKUA">JKUA - JR KING EXTERIOR</option>
  <option value="MKOA">MKOA - MSTR KING INTERIOR</option>
  <option value="MKUA">MKUA - MSTR KING EXTERIOR</option>
  <option value="PHOA">PHOA - PH DBL INTERIOR</option>
  <option value="PKOA">PKOA - PH KING EXT</option>
  <option value="SKOA">SKOA - SUP DBL EXT</option>
  <option value="SKUA">SKUA - SUP KING EXT</option>
  <option value="TDOA">TDOA - CLUB 89 DBL INT</option>
  <option value="TDUA">TDUA - CLUB 89 DBL EXT</option>
  <option value="TJOA">TJOA - CLUB 89 KING INT</option>
  <option value="TKOA">TKOA - CLUB 89 KING EXT</option>
  <option value="TWOA">TWOA - OWN KING INT</option>
  <option value="UKOA">UKOA - DLX KING INT</option>
</select>

  </div>
  <div class="columna-formulario">
    <label>8. No. de habitaciones (Hb) <span class="obligatorio"></span></label><input type="number" class="input-pequeno" required>
  </div>
  <div class="columna-formulario">
    <label>9. Pre-registro (P) <span class="obligatorio"></span></label>
    <select required>
      <option value=""disabled selected hidden>Seleccionar</option>
      <option value="True">True</option>
      <option value="False">False</option>
    </select>
  </div>

  <!-- Fila 4 -->
  <div class="columna-formulario">
    <label>10. Numero de Habitación (N. Hab.) <span class="obligatorio"></span></label><input type="number" class="input-pequeno" required>
  </div>
  <div class="columna-formulario">
    <label>11. Plan de Alimentos (Plan) <span class="obligatorio"></span></label><input type="text" required>
  </div>
  <div class="columna-formulario">
<label>12. Tipo de pensión (TP) <span class="obligatorio"></span></label>
<select required>
  <option value="" disabled selected hidden>Seleccionar</option>
  <option value="HD">HD</option>
  <option value="MP">MP</option>
  <option value="NO">NO</option>
  <option value="PC">PC</option>
</select>
  </div>

  <!-- Fila 5 -->
  <div class="columna-formulario">
    <label>13. In </label><input type="text">
  </div>
  <div class="columna-formulario">
    <label>14. Adultos (#A) </label><input type="number" class="input-pequeno" value="0">
  </div>
  <div class="columna-formulario">
    <label>15. Niños (#N)</label><input type="number" class="input-pequeno" value="0">
  </div>

  <!-- Fila 6 -->
  <div class="columna-formulario">
    <label>16. Juniors (#J) </label><input type="number" class="input-pequeno" value="0">
  </div>
  <div class="columna-formulario">
    <label>17. #MG </label><input type="number" class="input-pequeno" value="0">
  </div>
  <div class="columna-formulario">
    <label>18. Infantes (#I) </label><input type="number" class="input-pequeno" value="0">
  </div>

  <!-- Fila 7 -->
  <div class="columna-formulario">
    <label>19. Fecha de Salida del huésped <span class="obligatorio"></span></label><input type="date" required>
  </div>
  <div class="columna-formulario">
    <label>20. Número de noches (Noc) <span class="obligatorio"></span></label><input type="number" class="input-pequeno" required>
  </div>
  <div class="columna-formulario">
    <label>21. Estado de vivienda (Edo)<span class="obligatorio"></span></label><input type="text" required>
  </div>

  <!-- Fila 8 -->
  <div class="columna-formulario">
<label>22. Tipo de pago (F.Pgo) <span class="obligatorio"></span></label>
<select required>
  <option value="" disabled selected hidden>Seleccionar</option>
  <option value="AX">AX</option>
  <option value="CXC">CXC</option>
  <option value="EFE">EFE</option>
  <option value="TAR01">TAR01</option>
  <option value="TAR02">TAR02</option>
  <option value="TAR03">TAR03</option>
</select>

  </div>
  <div class="columna-formulario">
    <label>23. Tarifa <span class="obligatorio"></span></label><input type="text" required>
  </div>
  <div class="columna-formulario">
    <label>24. Agencia <span class="obligatorio"></span></label>
<select required>
  <option value="" disabled selected hidden>Seleccionar</option>
  <option value="ACAFUN VIAJES CXC">ACAFUN VIAJES CXC</option>
  <option value="ASPA - ASOCIACION SINDICAL DE">ASPA - ASOCIACION SINDICAL DE</option>
  <option value="BODA MAURICIO TOBIAS Y AARON H">BODA MAURICIO TOBIAS Y AARON H</option>
  <option value="BONO AUTOFIN">BONO AUTOFIN</option>
  <option value="BOOKING.COM - PAGO EN DESTINO">BOOKING.COM - PAGO EN DESTINO</option>
  <option value="CALL CENTER">CALL CENTER</option>
  <option value="DESPEGAR - CXC">DESPEGAR - CXC</option>
  <option value="DESPEGAR - PAGO EN DESTINO">DESPEGAR - PAGO EN DESTINO</option>
  <option value="EASY WAY">EASY WAY</option>
  <option value="ESCALABEDS">ESCALABEDS</option>
  <option value="EXPEDIA - CXC">EXPEDIA - CXC</option>
  <option value="EXPEDIA - PAGO EN DESTINO">EXPEDIA - PAGO EN DESTINO</option>
  <option value="HOTELEBEDS - CXC">HOTELEBEDS - CXC</option>
  <option value="MEMBRESIA CLUB IMPERIAL PLATIN">MEMBRESIA CLUB IMPERIAL PLATIN</option>
  <option value="MEMBRESIA CLUB IMPERIAL SILVER">MEMBRESIA CLUB IMPERIAL SILVER</option>
  <option value="NACXSHETRAVEL">NACXSHETRAVEL</option>
  <option value="ONMIBEES PAGO CXC">ONMIBEES PAGO CXC</option>
  <option value="PAGINA WEB">PAGINA WEB</option>
  <option value="PRICETRAVEL - CXC">PRICETRAVEL - CXC</option>
  <option value="TARIFA COLABORADORES AUTO FIN">TARIFA COLABORADORES AUTO FIN</option>
  <option value="TARIFA CONFIRMADA MXN">TARIFA CONFIRMADA MXN</option>
  <option value="WORLD TO MEET PAGO CXC">WORLD TO MEET PAGO CXC</option>
</select>
  </div>

  <!-- Fila 9 -->
  <div class="columna-formulario">
    <label>25. Grupo</label><input type="text">
  </div>
  <div class="columna-formulario">
    <label>26. Compañía</label>
<select>
  <option value="" disabled selected hidden>Seleccionar</option>
  <option value="ACA FUN VIAJES">ACA FUN VIAJES</option>
  <option value="ACTION TRAVEL - EUA">ACTION TRAVEL - EUA</option>
  <option value="ASPA - ASOCIACION SI">ASPA - ASOCIACION SI</option>
  <option value="BODA MAURICIO TOBIAS">BODA MAURICIO TOBIAS</option>
  <option value="BOOKING">BOOKING</option>
  <option value="BOOKING.COM">BOOKING.COM</option>
  <option value="Bono Autofin">Bono Autofin</option>
  <option value="Booking.Com">Booking.Com</option>
  <option value="CLUB IMPERIAL">CLUB IMPERIAL</option>
  <option value="CLUB IMPERIAL PLATIN">CLUB IMPERIAL PLATIN</option>
  <option value="CLUB IMPERIAL SILVER">CLUB IMPERIAL SILVER</option>
  <option value="COLABORADOR AUTOFIN">COLABORADOR AUTOFIN</option>
  <option value="Colaborador Autofin">Colaborador Autofin</option>
  <option value="DESPEGAR">DESPEGAR</option>
  <option value="DESPEGAR.COM">DESPEGAR.COM</option>
  <option value="DIRECCION GENERAL">DIRECCION GENERAL</option>
  <option value="EASY WAY">EASY WAY</option>
  <option value="EXPEDIA">EXPEDIA</option>
  <option value="EXPEDIA.COM">EXPEDIA.COM</option>
  <option value="GERENCIA DE OPERACIO">GERENCIA DE OPERACIO</option>
  <option value="HOTELBEDS">HOTELBEDS</option>
  <option value="IMACOP TOURS - MX">IMACOP TOURS - MX</option>
  <option value="MARIACHI GAMA 1000">MARIACHI GAMA 1000</option>
  <option value="MARIACHI IMPERIAL AZ">MARIACHI IMPERIAL AZ</option>
  <option value="MARIACHI LOS ORDAZ">MARIACHI LOS ORDAZ</option>
  <option value="MARIACHI VARGAS DE T">MARIACHI VARGAS DE T</option>
  <option value="NacXsheTravel">NacXsheTravel</option>
  <option value="OLR MAYORISTA - MX">OLR MAYORISTA - MX</option>
  <option value="PEPE AGUILAR">PEPE AGUILAR</option>
  <option value="PRICE TRAVEL">PRICE TRAVEL</option>
  <option value="PRICETRAVEL">PRICETRAVEL</option>
</select>    
  </div>
  <div class="columna-formulario">
    <label>27. Mensajes Recepción</label><input type="text">
  </div>

  <!-- Fila 10 -->
  <div class="columna-formulario">
    <label>28. Cod.Reserva externa <span class="obligatorio"></span></label><input type="text" required>
  </div>
  <div class="columna-formulario">
    <label>29. Pre Check In Web</label><input type="text">
  </div>
  <div class="columna-formulario">
    <label>30. Fecha de Llegada<span class="obligatorio"></span></label><input type="date" required>
  </div>

  <!-- Fila 11 -->
  <div class="columna-formulario">
    <label>31. Mail</label><input type="email">
  </div>
  <div class="columna-formulario">
    <label>32. Calle # - Colonia</label><input type="text">
  </div>
  <div class="columna-formulario">
    <label>33. Municipio/Ciudad</label><input type="text">
  </div>

  <!-- Fila 12 -->
  <div class="columna-formulario">
    <label>34. Estado</label><input type="text">
  </div>
  <div class="columna-formulario">
    <label>35. C.P.</label><input type="text">
  </div>
  <div class="columna-formulario">
    <label>36. Telefono</label><input type="text">
  </div>

  <!-- Fila 13 -->
  <div class="columna-formulario">
    <label>37. Brazalete</label>
<select>
  <option value="" disabled selected hidden>Seleccionar</option>
  <option value="AZULES">AZULES</option>
  <option value="BLANCO">BLANCO</option>
  <option value="PLATA">PLATA</option>
  <option value="DORADO">DORADO</option>
  <option value="TERRACOTA">TERRACOTA</option>
  <option value="TURQUESA">TURQUESA</option>
  <option value="VERDE">VERDE</option>
  <option value="ACUA">ACUA</option>
  <option value="AMARILLO">AMARILLO</option>
  <option value="AZUL">AZUL</option>
  <option value="BLANCO MENORES">BLANCO MENORES</option>
</select>

  </div>
  <div class="columna-formulario">
    <label>38. Late Check Out</label>
    <select>
      <option value=""disabled selected hidden>Seleccionar</option>
      <option>Si</option>
      <option>No</option>
    </select>
  </div>
  <div class="columna-formulario">
    <label>39. Pax</label><input type="text">
  </div>

  <!-- Fila 14 -->
  <div class="columna-formulario">
    <label>40. Crédito Inicial</label><input type="text">
  </div>
  <div class="columna-formulario">
    <label>41. Crédito Disponible</label><input type="text">
  </div>
  <div class="form-button">
  <button type="submit" class="btn-registrar">Registrar</button>
</div>
</div>

<!-- Botón final -->


            </div>
        </div>
    </form>
    @endsection


