@extends('layouts.app')
@section('title', 'Check-in')
@section('content')

@vite(['resources/css/bcp/app.css', 'resources/js/bcp/app.js'])
@include('seguridaddelainformacion.bcp.layouts.barra')

@if(session('success'))
<div id="modalSuccess" class="modal">
    <div class="modal-content">
        <p>{{ session('success') }}</p>
        <button id="btn-modal">Cerrar</button>
    </div>
</div>
@endif

@if ($errors->any())
<div id="modalError" class="modal">
    <div class="modal-content">
        <ul>
            @foreach ($errors->all() as $e)
            <li>{{ $e }}</li>
            @endforeach
        </ul>
        <button id="btn-modal">Cerrar</button>
    </div>
</div>
@endif

<div class="container_entero">
    <form action="{{ route('checkin.store') }}" method="POST">
        @csrf
        <!-- Formulario -->
        <div class="formulario-grid-doble">

            <div class="columna-formulario primera-columna">
                <h2 class="titulo-formulario">Check in</h2>
                <!-- Falta revisar la validación de la clave primaria -->
                <label>1. Cve. Reserv. <span class="obligatorio"></span> </label><input type="text" name="Cve_Reserv" value="{{ old('Cve_Reserv') }}" required>
                <label>2. Nombre <span class="obligatorio"></span> </label><input type="text" name="Nombre" value="{{ old('Nombre') }}" required>
                <label>3. C</label><input type="text" name="C" value="{{ old('C') }}">
                <label>4. Tpo <span class="obligatorio"></span> </label>
                <select name="Tpo" required>
                    <option value="">Seleccionar</option>
                    <option value="BAF" {{ old('Tpo') == 'BAF' ? 'selected' : '' }}>VIP BONO AUTOFIN</option>
                    <option value="C89" {{ old('Tpo') == 'C89' ? 'selected' : '' }}>CLUB 89</option>
                    <option value="CIM" {{ old('Tpo') == 'CIM' ? 'selected' : '' }}>SOCIO CLUB IMPERIAL</option>
                    <option value="DEC" {{ old('Tpo') == 'DEC' ? 'selected' : '' }}>PQT DECORACION CONCIERGE</option>
                    <option value="FC" {{ old('Tpo') == 'FC' ? 'selected' : '' }}>FULL CREDIT</option>
                    <option value="DRE" {{ old('Tpo') == 'DRE' ? 'selected' : '' }}>FRECUENTE</option>
                    <option value="NOR" {{ old('Tpo') == 'NOR' ? 'selected' : '' }}>NORMAL</option>
                    <option value="NSH" {{ old('Tpo') == 'NSH' ? 'selected' : '' }}>NO SHOW</option>
                    <option value="PRE" {{ old('Tpo') == 'PRE' ? 'selected' : '' }}>PAQUETE PREMIUM</option>
                    <option value="SA" {{ old('Tpo') == 'SA' ? 'selected' : '' }}>ATENCION ESPECIAL</option>
                    <option value="V1" {{ old('Tpo') == 'V1' ? 'selected' : '' }}>DUEÑO - DIRECCION GENERAL</option>
                    <option value="V2" {{ old('Tpo') == 'V2' ? 'selected' : '' }}>DE GTE GENERAL DIRECCION COME</option>
                    <option value="V3" {{ old('Tpo') == 'V3' ? 'selected' : '' }}>VISITA DE INSPECCION FAM TRIP</option>
                    <option value="V4" {{ old('Tpo') == 'V4' ? 'selected' : '' }}>LUNAMIELEROS, CUMPLEAÑEROS</option>
                    <option value="V5" {{ old('Tpo') == 'V5' ? 'selected' : '' }}>HUESPED CON INCIDENTES</option>
                    <option value="VAF" {{ old('Tpo') == 'VAF' ? 'selected' : '' }}>VIP BONO AUTOFIN</option>
                    <option value="VIM" {{ old('Tpo') == 'VIM' ? 'selected' : '' }}>SOCIO CLUB IMPERIAL</option>
                    <option value="VIP" {{ old('Tpo') == 'VIP' ? 'selected' : '' }}>VIP</option>
                </select>
                <label>5. G <span class="obligatorio"></span> </label>
                <select name="G" required>
                    <option value="">Seleccionar</option>
                    <option value="BAR" {{ old('G') == 'BAR' ? 'selected' : '' }}>BAR</option>
                    <option value="COR" {{ old('G') == 'COR' ? 'selected' : '' }}>COR</option>
                    <option value="DES" {{ old('G') == 'DES' ? 'selected' : '' }}>DES</option>
                    <option value="MAN" {{ old('G') == 'MAN' ? 'selected' : '' }}>MAN</option>
                    <option value="MEM" {{ old('G') == 'MEM' ? 'selected' : '' }}>MEM</option>
                    <option value="OTA" {{ old('G') == 'OTA' ? 'selected' : '' }}>OTA</option>
                    <option value="PAQ" {{ old('G') == 'PAQ' ? 'selected' : '' }}>PAQ</option>
                    <option value="SOC" {{ old('G') == 'SOC' ? 'selected' : '' }}>SOC</option>
                </select>
                <label>6. Seg <span class="obligatorio"></span> </label>
                <select name="Seg" required>
                    <option value="">Seleccionar</option>
                    <option value="True" {{ old('Seg') == 'True' ? 'selected' : '' }}>True</option>
                    <option value="False" {{ old('Seg') == 'False' ? 'selected' : '' }}>False</option>
                </select>
                <label>7. T.Hab. <span class="obligatorio"></span> </label>
                <select name="THab" required>
                    <option value="">Seleccionar</option>
                    <option value="HDOA" {{ old('THab') == 'HDOA' ? 'selected' : '' }}>HNDCAP DBL INT</option>
                    <option value="HKOA" {{ old('THab') == 'HKOA' ? 'selected' : '' }}>HNDCAP KING INT</option>
                    <option value="IKOA" {{ old('THab') == 'IKOA' ? 'selected' : '' }}>IMP KING INT</option>
                    <option value="JDOA" {{ old('THab') == 'JDOA' ? 'selected' : '' }}>JR DBL INTERIOR</option>
                    <option value="JDUA" {{ old('THab') == 'JDUA' ? 'selected' : '' }}>JR DBL EXTERIOR</option>
                    <option value="JKOA" {{ old('THab') == 'JKOA' ? 'selected' : '' }}>JR KING INTERIO</option>
                    <option value="JKUA" {{ old('THab') == 'JKUA' ? 'selected' : '' }}>JR KING EXTERIO</option>
                    <option value="MKOA" {{ old('THab') == 'MKOA' ? 'selected' : '' }}>MSTR KING INTER</option>
                    <option value="MKUA" {{ old('THab') == 'MKUA' ? 'selected' : '' }}>MSTR KING EXTER</option>
                    <option value="PDOA" {{ old('THab') == 'PDOA' ? 'selected' : '' }}>PH DBL INTERIOR</option>
                    <option value="PKOA" {{ old('THab') == 'PKOA' ? 'selected' : '' }}>PH KING EXT</option>
                    <option value="PKUA" {{ old('THab') == 'PKUA' ? 'selected' : '' }}>PH KING INT</option>
                    <option value="SDUA" {{ old('THab') == 'SDUA' ? 'selected' : '' }}>SUP DBL EXT</option>
                    <option value="SKUA" {{ old('THab') == 'SKUA' ? 'selected' : '' }}>SUP KING EXT</option>
                    <option value="TDOA" {{ old('THab') == 'TDOA' ? 'selected' : '' }}>CLUB 89 DBL INT</option>
                    <option value="TDUA" {{ old('THab') == 'TDUA' ? 'selected' : '' }}>CLUB 89 DBL EXT</option>
                    <option value="TKOA" {{ old('THab') == 'TKOA' ? 'selected' : '' }}>CLUB 89 KING INT</option>
                    <option value="TKUA" {{ old('THab') == 'TKUA' ? 'selected' : '' }}>CLUB 89 KING EXT</option>
                    <option value="WKOA" {{ old('THab') == 'WKOA' ? 'selected' : '' }}>OWN KING INT</option>
                    <option value="XDOA" {{ old('THab') == 'XDOA' ? 'selected' : '' }}>DLX DBL INT</option>
                    <option value="XKOA" {{ old('THab') == 'XKOA' ? 'selected' : '' }}>DLX KING INT</option>
                </select>
                <label>8. Hb <span class="obligatorio"></span> </label><input type="text" name="Hb" value="{{ old('Hb') }}" required>
                <label>9. P <span class="obligatorio"></span> </label>
                <select name="P" required>
                    <option value="">Seleccionar</option>
                    <option value="True" {{ old('P') == 'True' ? 'selected' : '' }}>True</option>
                    <option value="False" {{ old('P') == 'False' ? 'selected' : '' }}>False</option>
                </select>
                <label>10. N. Hab. <span class="obligatorio"></span> </label><input type="text" name="NHab" value="{{ old('NHab') }}" required>
                <label>11. Plan <span class="obligatorio"></span> </label><input type="text" name="Plan" value="{{ old('Plan') }}" required>
                <label>12. TP <span class="obligatorio"></span> </label>
                <select name="TP" required>
                    <option value="">Seleccionar</option>
                    <option value="HD" {{ old('TP') == 'HD' ? 'selected' : '' }}>HD</option>
                    <option value="MP" {{ old('TP') == 'MP' ? 'selected' : '' }}>MP</option>
                    <option value="NO" {{ old('TP') == 'NO' ? 'selected' : '' }}>NO</option>
                    <option value="PC" {{ old('TP') == 'PC' ? 'selected' : '' }}>PC</option>
                </select>
                <label>13. In</label><input type="text" name="In" value="{{ old('In') }}">
                <label>14. #A</label><input type="text" name="Valor_A" value="{{ old('Valor_A') }}">
                <label>15. #N</label><input type="text" name="Valor_N" value="{{ old('Valor_N') }}">
                <label>16. #J</label><input type="text" name="Valor_J" value="{{ old('Valor_J') }}">
                <label>17. #MG</label><input type="text" name="Valor_MG" value="{{ old('Valor_MG') }}">
                <label>18. #I</label><input type="text" name="Valor_I" value="{{ old('Valor_I') }}">
                <label>19. Fecha de Salida <span class="obligatorio"></span> </label><input type="date" name="FechaSal" value="{{ old('FechaSal') }}" required>
                <label>20. Noc <span class="obligatorio"></span> </label><input type="text" name="Noc" value="{{ old('Noc') }}" required>
                <label>21. Edo <span class="obligatorio"></span> </label><input type="text" name="Edo" value="{{ old('Edo') }}" required>
            </div>


            <div class="columna-formulario segunda-columna">
                <div class="form-button">
                    <a href="rack">
                        <button type="button" class="btn-volver">Volver ↩</button>
                    </a>
                </div>
                <label>22. F.Pgo <span class="obligatorio"></span> </label>
                <select name="FPgo" required>
                    <option value="">Seleccionar</option>
                    <option value="AX" {{ old('FPgo') == 'AX' ? 'selected' : '' }}>AX</option>
                    <option value="CXC" {{ old('FPgo') == 'CXC' ? 'selected' : '' }}>CXC</option>
                    <option value="EFE" {{ old('FPgo') == 'EFE' ? 'selected' : '' }}>EFE</option>
                    <option value="TAR01" {{ old('FPgo') == 'TAR01' ? 'selected' : '' }}>TAR01</option>
                    <option value="TAR02" {{ old('FPgo') == 'TAR02' ? 'selected' : '' }}>TAR02</option>
                    <option value="TAR03" {{ old('FPgo') == 'TAR03' ? 'selected' : '' }}>TAR03</option>
                </select>
                <label>23. Tarifa <span class="obligatorio"></span> </label><input type="text" name="Tarifa" value="{{ old('Tarifa') }}" required>
                <label>24. Agencia <span class="obligatorio"></span> </label>
                <select name="Agencia" required>
                    <option value="">Seleccionar</option>
                    <option value="ACAFUN VIAJES CXC" {{ old('Agencia') == 'ACAFUN VIAJES CXC' ? 'selected' : '' }}>ACAFUN VIAJES CXC</option>
                    <option value="ASPA - ASOCIACION SINDICAL DE" {{ old('Agencia') == 'ASPA - ASOCIACION SINDICAL DE' ? 'selected' : '' }}>ASPA - ASOCIACION SINDICAL DE</option>
                    <option value="BODA MAURICIO TOBIAS Y AARON H" {{ old('Agencia') == 'BODA MAURICIO TOBIAS Y AARON H' ? 'selected' : '' }}>BODA MAURICIO TOBIAS Y AARON H</option>
                    <option value="BONO AUTOFIN" {{ old('Agencia') == 'BONO AUTOFIN' ? 'selected' : '' }}>BONO AUTOFIN</option>
                    <option value="BOOKING.COM - PAGO EN DESTINO" {{ old('Agencia') == 'BOOKING.COM - PAGO EN DESTINO' ? 'selected' : '' }}>BOOKING.COM - PAGO EN DESTINO</option>
                    <option value="CALL CENTER" {{ old('Agencia') == 'CALL CENTER' ? 'selected' : '' }}>CALL CENTER</option>
                    <option value="DESPEGAR - CXC" {{ old('Agencia') == 'DESPEGAR - CXC' ? 'selected' : '' }}>DESPEGAR - CXC</option>
                    <option value="DESPEGAR - PAGO EN DESTINO" {{ old('Agencia') == 'DESPEGAR - PAGO EN DESTINO' ? 'selected' : '' }}>DESPEGAR - PAGO EN DESTINO</option>
                    <option value="EASY WAY" {{ old('Agencia') == 'EASY WAY' ? 'selected' : '' }}>EASY WAY</option>
                    <option value="ESCALABEDS" {{ old('Agencia') == 'ESCALABEDS' ? 'selected' : '' }}>ESCALABEDS</option>
                    <option value="EXPEDIA - CXC" {{ old('Agencia') == 'EXPEDIA - CXC' ? 'selected' : '' }}>EXPEDIA - CXC</option>
                    <option value="EXPEDIA - PAGO EN DESTINO" {{ old('Agencia') == 'EXPEDIA - PAGO EN DESTINO' ? 'selected' : '' }}>EXPEDIA - PAGO EN DESTINO</option>
                    <option value="HOTELBEDS - CXC" {{ old('Agencia') == 'HOTELBEDS - CXC' ? 'selected' : '' }}>HOTELBEDS - CXC</option>
                    <option value="MEMBRESIA CLUB IMPERIAL PLATIN" {{ old('Agencia') == 'MEMBRESIA CLUB IMPERIAL PLATIN' ? 'selected' : '' }}>MEMBRESIA CLUB IMPERIAL PLATIN</option>
                    <option value="MEMBRESIA CLUB IMPERIAL SILVER" {{ old('Agencia') == 'MEMBRESIA CLUB IMPERIAL SILVER' ? 'selected' : '' }}>MEMBRESIA CLUB IMPERIAL SILVER</option>
                    <option value="NACXSHETRAVEL" {{ old('Agencia') == 'NACXSHETRAVEL' ? 'selected' : '' }}>NACXSHETRAVEL</option>
                    <option value="OMNIBEES PAGO CXC" {{ old('Agencia') == 'OMNIBEES PAGO CXC' ? 'selected' : '' }}>OMNIBEES PAGO CXC</option>
                    <option value="PAGINA WEB" {{ old('Agencia') == 'PAGINA WEB' ? 'selected' : '' }}>PAGINA WEB</option>
                    <option value="PRICETRAVEL - CXC" {{ old('Agencia') == 'PRICETRAVEL - CXC' ? 'selected' : '' }}>PRICETRAVEL - CXC</option>
                    <option value="TARIFA COLABORADORES AUTO FIN" {{ old('Agencia') == 'TARIFA COLABORADORES AUTO FIN' ? 'selected' : '' }}>TARIFA COLABORADORES AUTO FIN</option>
                    <option value="TARIFA CONFIRMADA MXN" {{ old('Agencia') == 'TARIFA CONFIRMADA MXN' ? 'selected' : '' }}>TARIFA CONFIRMADA MXN</option>
                    <option value="WORLD TO MEET PAGO CXC" {{ old('Agencia') == 'WORLD TO MEET PAGO CXC' ? 'selected' : '' }}>WORLD TO MEET PAGO CXC</option>
                </select>
                <label>25. Grupo</label><input type="text" name="Grupo" value="{{ old('Grupo') }}">
                <label>26. Compañía</label>
                <select name="Compania">
                    <option value="">Seleccionar</option>
                    <option value="ACA FUN VIAJES" {{ old('Compania') == 'ACA FUN VIAJES' ? 'selected' : '' }}>ACA FUN VIAJES</option>
                    <option value="ACTION TRAVEL - EUA" {{ old('Compania') == 'ACTION TRAVEL - EUA' ? 'selected' : '' }}>ACTION TRAVEL - EUA</option>
                    <option value="ASPA - ASOCIACION SI" {{ old('Compania') == 'ASPA - ASOCIACION SI' ? 'selected' : '' }}>ASPA - ASOCIACION SI</option>
                    <option value="BODA MAURICIO TOBIAS" {{ old('Compania') == 'BODA MAURICIO TOBIAS' ? 'selected' : '' }}>BODA MAURICIO TOBIAS</option>
                    <option value="BOOKING" {{ old('Compania') == 'BOOKING' ? 'selected' : '' }}>BOOKING</option>
                    <option value="BOOKING.COM" {{ old('Compania') == 'BOOKING.COM' ? 'selected' : '' }}>BOOKING.COM</option>
                    <option value="BONO AUTOFIN" {{ old('Compania') == 'BONO AUTOFIN' ? 'selected' : '' }}>BONO AUTOFIN</option>
                    <option value="Booking.Com" {{ old('Compania') == 'Booking.Com' ? 'selected' : '' }}>Booking.Com</option>
                    <option value="CLUB IMPERIAL" {{ old('Compania') == 'CLUB IMPERIAL' ? 'selected' : '' }}>CLUB IMPERIAL</option>
                    <option value="CLUB IMPERIAL PLATIN" {{ old('Compania') == 'CLUB IMPERIAL PLATIN' ? 'selected' : '' }}>CLUB IMPERIAL PLATIN</option>
                    <option value="CLUB IMPERIAL SILVER" {{ old('Compania') == 'CLUB IMPERIAL SILVER' ? 'selected' : '' }}>CLUB IMPERIAL SILVER</option>
                    <option value="COLABORADOR AUTOFIN" {{ old('Compania') == 'COLABORADOR AUTOFIN' ? 'selected' : '' }}>COLABORADOR AUTOFIN</option>
                    <option value="Colaborador Autofin" {{ old('Compania') == 'Colaborador Autofin' ? 'selected' : '' }}>Colaborador Autofin</option>
                    <option value="DESPEGAR" {{ old('Compania') == 'DESPEGAR' ? 'selected' : '' }}>DESPEGAR</option>
                    <option value="DESPEGAR.COM" {{ old('Compania') == 'DESPEGAR.COM' ? 'selected' : '' }}>DESPEGAR.COM</option>
                    <option value="DIRECCION GENERAL" {{ old('Compania') == 'DIRECCION GENERAL' ? 'selected' : '' }}>DIRECCION GENERAL</option>
                    <option value="EASY WAY" {{ old('Compania') == 'EASY WAY' ? 'selected' : '' }}>EASY WAY</option>
                    <option value="EXPEDIA" {{ old('Compania') == 'EXPEDIA' ? 'selected' : '' }}>EXPEDIA</option>
                    <option value="EXPEDIA.COM" {{ old('Compania') == 'EXPEDIA.COM' ? 'selected' : '' }}>EXPEDIA.COM</option>
                    <option value="GERENCIA DE OPERACIO" {{ old('Compania') == 'GERENCIA DE OPERACIO' ? 'selected' : '' }}>GERENCIA DE OPERACIO</option>
                    <option value="HOTELBEDS" {{ old('Compania') == 'HOTELBEDS' ? 'selected' : '' }}>HOTELBEDS</option>
                    <option value="IMACOP TOURS - MX" {{ old('Compania') == 'IMACOP TOURS - MX' ? 'selected' : '' }}>IMACOP TOURS - MX</option>
                    <option value="MARIACHI GAMA 1000" {{ old('Compania') == 'MARIACHI GAMA 1000' ? 'selected' : '' }}>MARIACHI GAMA 1000</option>
                    <option value="MARIACHI IMPERIAL AZ" {{ old('Compania') == 'MARIACHI IMPERIAL AZ' ? 'selected' : '' }}>MARIACHI IMPERIAL AZ</option>
                    <option value="MARIACHI LOS ORDAZ" {{ old('Compania') == 'MARIACHI LOS ORDAZ' ? 'selected' : '' }}>MARIACHI LOS ORDAZ</option>
                    <option value="MARIACHI VARGAS DE T" {{ old('Compania') == 'MARIACHI VARGAS DE T' ? 'selected' : '' }}>MARIACHI VARGAS DE T</option>
                    <option value="NacXsheTravel" {{ old('Compania') == 'NacXsheTravel' ? 'selected' : '' }}>NacXsheTravel</option>
                    <option value="OLR MAYORISTA - MX" {{ old('Compania') == 'OLR MAYORISTA - MX' ? 'selected' : '' }}>OLR MAYORISTA - MX</option>
                    <option value="PEPE AGUILAR" {{ old('Compania') == 'PEPE AGUILAR' ? 'selected' : '' }}>PEPE AGUILAR</option>
                    <option value="PRICE TRAVEL" {{ old('Compania') == 'PRICE TRAVEL' ? 'selected' : '' }}>PRICE TRAVEL</option>
                    <option value="PRICETRAVEL" {{ old('Compania') == 'PRICETRAVEL' ? 'selected' : '' }}>PRICETRAVEL</option>
                </select>
                <label>27. Mensajes Recepción</label><input type="text" name="MensajesRecepcion" value="{{ old('MensajesRecepcion') }}">
                <label>28. Cod.Reserva <span class="obligatorio"></span> </label><input type="text" name="Cod_Reserva" value="{{ old('Cod_Reserva') }}" required>
                <label>29. Pre Check In Web</label><input type="text" name="PreCheckInWeb" value="{{ old('PreCheckInWeb') }}">
                <label>30. Fecha de Llegada <span class="obligatorio"></span> </label><input type="date" name="FechaLlegada" value="{{ old('FechaLlegada') }}" required>
                <label>31. Mail</label><input type="email" name="Mail" value="{{ old('Mail') }}">
                <label>32. Calle # - Colonia</label><input type="text" name="Calle_Colonia" value="{{ old('Calle_Colonia') }}">
                <label>33. Municipio/Ciudad</label><input type="text" name="Municipio_Ciudad" value="{{ old('Municipio_Ciudad') }}">
                <label>34. Estado</label><input type="text" name="Estado" value="{{ old('Estado') }}">
                <label>35. C.P.</label><input type="text" name="CP" value="{{ old('CP') }}">


                <label>36. Telefono</label><input type="text" name="Telefono" value="{{ old('Telefono') }}">
                <label>37. Brazalete</label>
                <select name="Brasalete">
                    <option value="">Seleccionar</option>
                    <option value="AZULES" {{ old('Brasalete') == 'AZULES' ? 'selected' : '' }}>AZULES</option>
                    <option value="BLANCO" {{ old('Brasalete') == 'BLANCO' ? 'selected' : '' }}>BLANCO</option>
                    <option value="PLATA" {{ old('Brasalete') == 'PLATA' ? 'selected' : '' }}>PLATA</option>
                    <option value="DORADO" {{ old('Brasalete') == 'DORADO' ? 'selected' : '' }}>DORADO</option>
                    <option value="TERRACOTA" {{ old('Brasalete') == 'TERRACOTA' ? 'selected' : '' }}>TERRACOTA</option>
                    <option value="TURQUESA" {{ old('Brasalete') == 'TURQUESA' ? 'selected' : '' }}>TURQUESA</option>
                    <option value="VERDE" {{ old('Brasalete') == 'VERDE' ? 'selected' : '' }}>VERDE</option>
                    <option value="ACUA" {{ old('Brasalete') == 'ACUA' ? 'selected' : '' }}>ACUA</option>
                    <option value="AMARILLO" {{ old('Brasalete') == 'AMARILLO' ? 'selected' : '' }}>AMARILLO</option>
                    <option value="Azul" {{ old('Brasalete') == 'Azul' ? 'selected' : '' }}>Azul</option>
                    <option value="BLANCO MENORES" {{ old('Brasalete') == 'BLANCO MENORES' ? 'selected' : '' }}>BLANCO MENORES</option>
                </select>
                <label>38. Late Check Out</label>
                <select name="LateCheckOut">
                    <option value="">Seleccionar</option>
                    <option value="Si" {{ old('LateCheckOut') == 'Si' ? 'selected' : '' }}>Si</option>
                    <option value="No" {{ old('LateCheckOut') == 'No' ? 'selected' : '' }}>No</option>
                </select>
                <label>39. Pax</label><input type="text" name="Pax" value="{{ old('Pax') }}">
                <label>40. Crédito Inicial</label><input type="text" name="CreditoInicial" value="{{ old('CreditoInicial') }}">
                <label>41. Crédito Disponible</label><input type="text" name="CreditoDisponible" value="{{ old('CreditoDisponible') }}">

                <div class="form-button">
                    <button type="submit" class="btn-registrar">Registrar</button>
                </div>
            </div>


        </div>
    </form>
</div>
@endsection