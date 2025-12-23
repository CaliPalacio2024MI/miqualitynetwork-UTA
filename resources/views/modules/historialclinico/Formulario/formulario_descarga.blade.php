<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial Clínico</title>
    <style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 11pt;
    margin: 20px;
    padding: 0;
    background-color: #f4f4f4; /* Un gris muy claro similar a #BABABA */
    color: #071829; /* Un tono oscuro similar */
}

#form-container {
    width: 100%;
    margin: 0 auto;
    overflow: visible;
    height: auto;
    box-sizing: border-box;
}

.Titulo{

border-bottom: 4px solid #092034;
}

h1 {
font-family: "Poppins", sans-serif;
margin: 10px 0;
}

table {
width: 100%;
border-collapse: collapse; /* Elimina líneas blancas entre filas */
text-align: center;
margin-top: 20px;
}

.border-inferior {
border-left: 1px solid black; 
border-right: 1px solid black; 
border-bottom: 1px solid black;
padding: 8px;
}

.no-border-inferior {
border-left: 1px solid black; 
border-right: 1px solid black; 
border-bottom: none;
}

.table-container {
border: none;
border-radius: 15px;
background: white;
padding: 10px;
box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
}

th {
border: none;
padding: 8px;
text-align: center;
font-size: 14px;
background-color: rgb(11, 42, 70);
color: white;
font-weight: bold;
margin-top: 20px;
font-family: "Poppins", sans-serif;
font-weight: 400;
font-style: normal;
}


td {
border: none;
padding: 12px;
text-align: center;
font-size: 14px;
font-family: "Poppins", sans-serif;
font-weight: 300;
font-style: normal;
}

.section-title {
background-color: #092034;
color: white;
font-weight: bold;
text-align: left;
padding: 5px;
font-size: 16px;
border-top-left-radius: 10px;
border-top-right-radius: 10px;
font-family: "Poppins", sans-serif;
font-weight: 600;
font-style: italic;
}


/* Alinear correctamente el texto de los agentes */
.agents-list td {
text-align: left;
padding-left: 10px;
}
/* Alinear correctamente el texto de los agentes para la segunda seccion */
.agents-list-antecedentes td {
    text-align: left;
    padding-left: 10px;
    }

.encabezado{
    width: 100%;
    display: flex;
    justify-content: flex-end; /* Alineación a la derecha */
    align-items: center; /* Alinea verticalmente el botón */
    padding: 0 20px; /* Espaciado alrededor */
}
.letrasNegritas{
    font-weight: bold;
    color: #092034; /* El azul oscuro para resaltar texto */
}

        /* Estilos para impresión */
        @media print {
            body { font-size: 12pt; }
            table { border: 1px solid #000; }
            th, td { border: 1px solid #000; }
            input, select, textarea { border: none !important; } /* Elimina bordes en inputs y selects */
        }
    </style>
</head>
<body>
    <div id='form-container'>
        <div>
            <div class="Titulo">
                <h1 id="form-title">HISTORIAL CLÍNICO - COPIA</h1>
            </div>
            <table class="table-container">
                <tr>
                    <th class="section-title">Propiedad / Razón Social:</th>
                    <td colspan="4">{{ $datos['razon-social'] }}</td>
                </tr>
                <tr>
                    <th class="col-small">No. Zapato</th>
                    <th class="col-medium">Talla Playera</th>
                    <th class="col-medium">Talla Pantalón</th>
                    <th class="col-large">Tel. en caso de accidente</th>
                </tr>
                <tr>
                    <td>{{ $datos['no-zapato'] }}</td>
                    <td>{{ $datos['talla-playera'] }}</td>
                    <td>{{ $datos['talla-pantalon'] }}</td>
                    <td>{{ $datos['tel-emergencia'] }}</td>
                </tr>
            </table>

            <table class="table-container">
                <tr>
                    <th colspan="6" class="section-title">1) FICHA DE IDENTIFICACIÓN</th>
                </tr>
                <tr class="agents-list">
                    <td class="letrasNegritas">Nombre: </td>
                    <td>{{ $datos['nombre'] }}</td>
                    <td class="letrasNegritas">Edad:</td>
                    <td> {{ $datos['edad'] }}</td>
                    <td class="letrasNegritas">Género:</td>
                    <td> {{ $datos['genero'] }}</td>
                </tr>
                <tr class="agents-list">
                    <td class="letrasNegritas">Estado Civil:</td>
                    <td> {{ $datos['estado-civil'] }}</td>
                    <td class="letrasNegritas">Fecha de nacimiento:</td>
                    <td> {{ $datos['fecha-nacimiento'] }}</td>
                </tr>
                <tr class="agents-list">
                    <td class="letrasNegritas">Dirección:</td>
                     <td> {{ $datos['direccion'] }}</td>
                    <td class="letrasNegritas">Teléfono:</td>
                    <td> {{ $datos['telefono'] }}</td>
                </tr>
                <tr class="agents-list">
                    <td class="letrasNegritas">Escolaridad:</td>
                    <td> {{ $datos['escolaridad'] }}</td>
                    <td class="letrasNegritas">Puesto Aspirante: </td>
                    <td>{{ $datos['puesto-aspirante'] }}</td>
                </tr>
            </table>

            <table class="table-container">
                <tr>
                    <th colspan="5" class="section-title">2) ANTECEDENTES LABORALES</th>
                </tr>
                <tr>
                    <th>Edad de Inicio de Labores:</th>
                    <td>{{ $datos['edad-inicio-labores'] }}</td>
                </tr>
                <tr>
                    <th>Empresa</th>
                    <th>Puesto</th>
                    <th>Tiempo</th>
                    <th></th>
                    <th>Agentes</th>
                </tr>
                @php
                    $empresas = $datos['empresa'] ?? [];
                    $puestos = $datos['puesto'] ?? [];
                    $tiempos = $datos['tiempo'] ?? [];
                    $agentes = $datos['agentesFinal'] ?? []; // Obtener la matriz de agentes
                @endphp
                @foreach($empresas as $index => $empresa)
                    <tr class="agents-list-antecedentes">
                        <td>{{ $empresa }}</td>
                        <td>{{ $puestos[$index] ?? '' }}</td>
                        <td>{{ $tiempos[$index] ?? '' }}</td>
                        <td></td>
                        <td>{{ $agentes[$index] ?? '' }}</td>
                    </tr>
                @endforeach
            </table>

<table class="table-container">
    <tr>
        <th colspan="9" class="section-title">3) ANTECEDENTES HEREDO FAMILIARES</th>
    </tr>

    <tr class="no-border-bottom">
        <td class="letrasNegritas">Fímicos</td>
        <td>{{ $datos['fimicos-heredofamiliares']  ?? '' }}</td>
        <td class="letrasNegritas">Cardiópatas</td>
        <td>{{ $datos['cardiopatas-heredofamiliares']  ?? '' }}</td>
        <td class="letrasNegritas">Malformaciones</td>
        <td>{{ $datos['malformaciones-heredofamiliares'] ?? '' }}</td>
    </tr>
    <tr class="no-border-bottom">
    <td class="letrasNegritas">Lueticos</td>
        <td>{{ $datos['lueticos-heredofamiliares']  ?? '' }}</td>
    <td class="letrasNegritas">Epilepticos</td>
        <td>{{ $datos['epilepticos-heredofamiliares']  ?? '' }}</td>
    <td class="letrasNegritas">Atopicos</td>
        <td>{{ $datos['atopicos-heredofamiliares']  ?? '' }}</td>
    </tr>
    <tr>
    <td class="letrasNegritas">Diabeticos</td>    
        <td>{{ $datos['diabeticos-heredofamiliares']  ?? '' }}</td>
    <td class="letrasNegritas">Oncológicos</td>    
        <td>{{ $datos['oncologicos-heredofamiliares']  ?? '' }}</td>
    </tr>
    <tr>
        <td class="letrasNegritas">Otros</td>
        <td colspan="8">{{ $datos['otro-heredofamiliares']  ?? '' }}</td>
    </tr>
</table>
<br>
<br>
<table class="table-container">
    <tr>
        <th colspan="9" class="section-title">4) ANTECEDENTES PERSONALES PATOLÓGICOS</th>
    </tr>

    <tr class="no-border-bottom">
        <td class="letrasNegritas">Fímicos</td>
        <td>{{ $datos['fimicos-personales'] ?? ''  }}</td>
        <td class="letrasNegritas">Cardiacos</td>
        <td>{{ $datos['cardiacos-personales'] ?? ''  }}</td>
        <td class="letrasNegritas">Traumáticos</td>
        <td>{{ $datos['traumaticos-personales'] ?? ''  }}</td>
    </tr>
    <tr class="no-border-bottom">
        <td class="letrasNegritas">Luéticos</td>
        <td>{{ $datos['lueticos-personales'] ?? ''  }}</td>
        <td class="letrasNegritas">Hipertensos</td>
        <td>{{ $datos['hipertensos-personales']  ?? '' }}</td>
        <td class="letrasNegritas">Oncológicos</td>
        <td>{{ $datos['oncologicos-personales'] ?? ''  }}</td>
    </tr>
    <tr class="no-border-bottom">
        <td class="letrasNegritas">Diabéticos</td>
        <td>{{ $datos['diabeticos-personales'] ?? ''  }}</td>
        <td class="letrasNegritas">Atópicos</td>
        <td>{{ $datos['atopicos-personales']  ?? '' }}</td>
        <td class="letrasNegritas">Epilépticos</td>
        <td>{{ $datos['epilepticos-personales'] ?? ''  }}</td>
    </tr>
    <tr>
        <td class="letrasNegritas">Renales</td>
        <td>{{ $datos['renales-personales'] ?? ''  }}</td>
        <td class="letrasNegritas">Lumbalgias</td>
        <td>{{ $datos['lumbalgias-personales']  ?? '' }}</td>
        <td class="letrasNegritas">Quirúrgicos</td>
        <td>{{ $datos['quirurgicos-personales'] ?? '' }}</td>
    </tr>
    <tr>
        <td class="letrasNegritas">otros</td>
        <td colspan="8">{{ $datos['otros-personales']  ?? '' }}</td>
    </tr>
</table>

<table class='table-container'>
    <tr>
        <th colspan="6" class="section-title">5) ANTECEDENTES PERSONALES NO PATOLÓGICOS</th>
    </tr>
    <tr class="no-border-bottom">
        <td class="letrasNegritas">Tabaquismo</td>
        <td>{{ $datos['tabaquismo'] ?? '' }}</td>
        <td class="letrasNegritas">Detalles extras:</td>
        <td> {{ $datos['especifica_tabaquismo'] ?? 'Sin Observaciones' }}</td>
        <td class="letrasNegritas">Menarquía</td>
        <td>{{ $datos['menarquia'] ?? '' }}</td>
    </tr>
    <tr class="no-border-bottom">
        <td class="letrasNegritas">Alcoholismo</td>
        <td>{{ $datos['alcoholismo'] ?? '' }}</td>
        <td class="letrasNegritas">Detalles extras: </td>
        <td> {{ $datos['especifica_alcoholismo'] ?? 'Sin Observaciones' }}</td>
        <td class="letrasNegritas">Ritmo</td>
        <td>{{ $datos['ritmo'] ?? '' }}</td>
    </tr>
    <tr class="no-border-bottom">
        <td class="letrasNegritas">Toxicomanias</td>
        <td>{{ $datos['toxicomanias'] ?? '' }}</td>
        <td class="letrasNegritas">Detalles extras:</td>
        <td> {{ $datos['especifica_toxicomanias'] ?? '' }}</td>
        <td class="letrasNegritas">F. U. M.</td>
        <td>{{ $datos['fum'] ?? '' }}</td>
    </tr>
    <tr class="no-border-bottom">
        <td class="letrasNegritas">IVSA</td>
        <td>{{ $datos['ivsa'] ?? '' }}</td>
        <td class="letrasNegritas">FUP</td>
        <td>{{ $datos['fup'] ?? '' }}</td>
        <td class="letrasNegritas">Dismenorrea</td>
        <td>{{ $datos['disminorrea'] ?? '' }}</td>
    </tr>
    <tr class="no-border-bottom">
        <td class="letrasNegritas">DOC</td>
        <td>{{ $datos['doc'] ?? '' }}</td>
        <td class="letrasNegritas">PF</td>
        <td>{{ $datos['pf'] ?? '' }}</td>
        <td class="letrasNegritas">G</td>
        <td>{{ $datos['g'] ?? '' }}</td>
    </tr>
    <tr>
        <td class="letrasNegritas">P</td>
        <td>{{ $datos['p'] ?? '' }}</td>
        <td class="letrasNegritas">C</td>
        <td>{{ $datos['c'] ?? '' }}</td>
        <td class="letrasNegritas">A</td>
        <td>{{ $datos['a'] ?? '' }}</td>
    </tr>
</table>

<table class='table-container'>
    <tr>
        <th colspan="3" class="section-title">6) ¿Ha Estado incapacitado por Riesgo de Trabajo?</th>
    </tr>
    <tr>
        <td>{{ $datos['riesgo-trabajo'] ?? '' }}</td>
        <td class="letrasNegritas">Riesgo de Trabajo:</td>
        <td> {{ $datos['especifica-riesgo-trabajo'] ?? 'Ninguno' }}</td>
    </tr>
</table>

<table class='table-container'>
    <tr>
        <th colspan="3" class="section-title">6) ¿Ha Estado incapacitado por Alguna Enfermedad?</th>
    </tr>
    <tr>
        <td>{{ $datos['riesgo-enfermedad'] ?? '' }}</td>
        <td class="letrasNegritas">Riesgo de Enfermedad: </td>
        <td>{{ $datos['especifica-riesgo-enfermedad'] ?? 'Ninguno' }}</td>
    </tr>
</table>


<table class='table-container'>
    <tr>
        <th colspan="6" class="section-title">8) ¿ACTUALMENTE PADECE ALGUNA ENFERMEDAD?</th>
    </tr>
    <tr>
        <td>{{ $datos['padece-enfermedad'] ?? ''}}</td>
        <td class="letrasNegritas">Especifique Enfermedad</td>
        <td>{{ $datos['especifica-padece-enfermedad'] ?? 'Ninguno' }}</td>
    </tr>
    <tr>
        <td class="letrasNegritas">Mano Dominante:</td>
        <td>{{ $datos['mano-dominante'] ?? ''}}</td>
    </tr>
    <tr>
        <td class="letrasNegritas">Firma del Candidato</td>
        <td>
            @if(isset($datos['firmaBase64']) && $datos['firmaBase64'] !== '')
                <img src="{{ $datos['firmaBase64'] }}" alt="Firma" style="max-width: 200px; max-height: 100px; border: 1px solid black;"/>
            @else
                <p>No hay firma registrada</p>
            @endif
        </td>
    </tr>
</table>


<table class='table-container'>
    <tr>
        <th colspan="6" class="section-title">9) EXPLORACION FISICA</th>
    </tr>
    <tr>
        <th>Peso</th>
        <th>Talla</th>
        <th>T/A</th>
        <th>FC</th>
        <th>FR</th>
        <th>IMC</th>
    </tr>
    <tr>
        <td>{{ $datos['exploracion-fisica-peso'] }}</td>
        <td>{{ $datos['exploracion-fisica-talla'] }}</td>
        <td>{{ $datos['exploracion-fisica-t/a'] }}</td>
        <td>{{ $datos['exploracion-fisica-fc'] }}</td>
        <td>{{ $datos['exploracion-fisica-fr'] }}</td>
        <td>{{ $datos['exploracion-fisica-imc'] }}</td>
    </tr>
</table>

<table class='table-container'>
    <tr>
        <th>Craneo</th>
        <th></th>
        <th>Cuello</th>
        <th></th>
        <th>Boca</th>
        <th></th>
    </tr>
    <tr>
        <td class="letrasNegritas">Forma</td>
        <td>{{ $datos['craneo-forma']  ?? ''  }}</td>
        <td class="letrasNegritas">Ganglios</td>
        <td>{{ $datos['cuello-ganglios']  ?? ''  }}</td>
        <td class="letrasNegritas">Mucosas</td>
        <td>{{ $datos['boca-mucosas'] ?? ''  }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Tamaño</td>
        <td>{{ $datos['craneo-tamano'] ?? ''  }}</td>
        <td class="letrasNegritas">Movilidad</td>
        <td>{{ $datos['cuello-movilidad']  ?? '' }}</td>
        <td class="letrasNegritas">Dentadura</td>
        <td>{{ $datos['boca-dentadura'] ?? ''  }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Pelo</td>
        <td>{{ $datos['craneo-pelo'] ?? '' }}</td>
        <td class="letrasNegritas">Tiroides</td>
        <td>{{ $datos['cuello-tiroides'] ?? ''  }}</td>
        <td class="letrasNegritas">Lengua</td>
        <td>{{ $datos['boca-Lengua'] ?? ''  }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Cara</td>
        <td>{{ $datos['craneo-Cara']  ?? '' }}</td>
        <td class="letrasNegritas">Pulsos</td>
        <td>{{ $datos['cuello-Pulsos'] ?? ''  }}</td>
        <td class="letrasNegritas">Encias</td>
        <td>{{ $datos['boca-Encias']  ?? '' }}</td>
    </tr>

    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="letrasNegritas">Faringe</td>
        <td>{{ $datos['boca-faringe']  ?? '' }}</td>
    </tr>

    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="letrasNegritas">Amigdalas</td>
        <td>{{ $datos['boca-amigdalas']  ?? '' }}</td>
    </tr>
    <tr>
        <th>Ojos</th>
        <th></th>
        <th>Nariz</th>
        <th></th>
        <th>Oido</th>
        <th></th>
    </tr>
    <tr>
        <td class="letrasNegritas">Conjuntivas</td>
        <td>{{ $datos['ojos-Conjuntivas'] ?? ''  }}</td>
        <td class="letrasNegritas">Tabique</td>
        <td>{{ $datos['nariz-Tabique'] ?? ''  }}</td>
        <td class="letrasNegritas">Pabellon</td>
        <td>{{ $datos['oido-Pabellon'] ?? ''  }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Pupilas</td>
        <td>{{ $datos['ojos-Pupilas'] ?? ''  }}</td>
        <td class="letrasNegritas">Mucosas</td>
        <td>{{ $datos['nariz-Mucosas'] ?? ''  }}</td>
        <td class="letrasNegritas">C.A.E.</td>
        <td>{{ $datos['oido-cae'] ?? ''  }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Parpados</td>
        <td>{{ $datos['ojos-Parpados'] ?? ''  }}</td>
        <td></td>
        <td></td>
        <td class="letrasNegritas">Timpanos</td>
        <td>{{ $datos['oido-timpanos'] ?? ''  }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Reflejos</td>
        <td>{{ $datos['ojos-Reflejos'] ?? ''  }}</td>  
    </tr>

    <tr>
        <th>Agudeza Visual</th>
        <th></th>
        <th>Abdomen</th>
        <th colspan='3'></th>
    </tr>
    <tr>
        <td class="letrasNegritas">S/L</td>
        <td>{{ $datos['agudeza-visual-sl']  ?? '' }}</td>
        <td class="letrasNegritas">Megalias</td>
        <td>{{ $datos['abdomen-Megalias'] ?? ''  }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">C/L</td>
        <td>{{ $datos['agudeza-visual-cl'] ?? ''  }}</td>
        <td class="letrasNegritas">Hernias</td>
        <td>{{ $datos['abdomen-Hernias'] ?? ''  }}</td>
    </tr>

    <tr>
        <th>Tórax</th>
        <th></th>
        <th>Piel y Anexos</th>
        <th></th>
        <th>Genitales</th>
        <th></th>
    </tr>
    <tr>
        <td class="letrasNegritas">Forma</td>
        <td>{{ $datos['torax-forma']  ?? '' }}</td>
        <td class="letrasNegritas">Nevos</td>
        <td>{{ $datos['piel-nevos'] ?? ''  }}</td>
        <td class="letrasNegritas">Fimosis</td>
        <td>{{ $datos['genitales-fimosis']  ?? '' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">R. Cardiacos</td>
        <td>{{ $datos['torax-rCardiacos'] ?? ''  }}</td>
        <td class="letrasNegritas">Cicatrices</td>
        <td>{{ $datos['piel-Cicatrices'] ?? ''  }}</td>
        <td class="letrasNegritas">Varicocele</td>
        <td>{{ $datos['genitales-Varicocele'] ?? ''  }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Campos Pulm.</td>
        <td>{{ $datos['torax-cPulm'] ?? ''  }}</td>
        <td class="letrasNegritas">Varices</td>
        <td>{{ $datos['piel-Varices']  ?? '' }}</td>
        <td class="letrasNegritas">Hernias</td>
        <td>{{ $datos['genitales-Hernias'] ?? ''  }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Mamas</td>
        <td>{{ $datos['torax-Mamas']  ?? '' }}</td>
        <td class="letrasNegritas">Edemas</td>
        <td>{{ $datos['piel-Edemas']  ?? '' }}</td>
        <td class="letrasNegritas">Criptorquidias</td>
        <td>{{ $datos['genitales-Criptorquidias'] ?? ''  }}</td>
    </tr>

    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td class="letrasNegritas">Micosis</td>
        <td>{{ $datos['piel-Micosis']  ?? '' }}</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <th></th>
        <th>Torácicos</th>
        <th></th>
        <th>Pélvicos</th>
        <th colspan='2'></th>
    </tr>
    <tr>
        <th>Miembros</th>
    </tr>

    <tr>
        <td class="letrasNegritas">Integridad</td>
        <td>{{ $datos['miembros-toraxicos-Integridad'] ?? ''  }}</td>
        <td></td>
        <td>{{ $datos['miembros-pelvicos-Integridad'] ?? ''  }}</td>
        <td>{{ $datos['especifica-miembro-integridad'] ?? 'Ninguna Observación' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Forma</td>
        <td>{{ $datos['miembros-toraxicos-forma']  ?? '' }}</td>
        <td></td>
        <td>{{ $datos['miembros-pelvicos-Forma'] ?? ''  }}</td>
        <td>{{ $datos['especifica-miembro-forma'] ?? 'Ninguna Observación' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Articulaciones</td>
        <td>{{ $datos['miembros-toraxicos-Articulaciones'] ?? ''  }}</td>
        <td></td>
        <td>{{ $datos['miembros-pelvicos-Articulaciones']  ?? '' }}</td>
        <td>{{ $datos['especifica-miembro-articulaciones'] ?? 'Ninguna Observación' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Tono Muscular</td>
        <td>{{ $datos['miembros-toraxicos-tonoMuscular'] ?? ''  }}</td>
        <td></td>
        <td>{{ $datos['miembros-pelvicos-tonoMuscular'] ?? ''  }}</td>
        <td>{{ $datos['especifica-miembro-tonoMuscular'] ?? 'Ninguna Observación' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Reflejos</td>
        <td>{{ $datos['miembros-toraxicos-Reflejos'] ?? ''  }}</td>
        <td></td>
        <td>{{ $datos['miembros-pelvicos-Reflejos']  ?? '' }}</td>
        <td>{{ $datos['especifica-miembro-Reflejos'] ?? 'Ninguna Observación' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Sensibilidad</td>
        <td>{{ $datos['miembros-toraxicos-Sensibilidad'] ?? ''  }}</td>
        <td></td>
        <td>{{ $datos['miembros-pelvicos-Sensibilidad'] ?? ''  }}</td>
        <td>{{ $datos['especifica-miembro-Sensibilidad'] ?? 'Ninguna Observación' }}</td>
    </tr>

    <tr>
        <th>Columna Vertebral</th>
    </tr>
    <tr>
        <th></th>
        <th>Cervical</th>
        <th>Dorsal</th>
        <th>Lumbar</th>
        <th colspan='2'></th>
    </tr>
    <tr>
        <td class="letrasNegritas">Integridad</td>
        <td>{{ $datos['columna-cervical-integridad']  ?? '' }}</td>
        <td>{{ $datos['columna-dorsal-integridad'] ?? ''  }}</td>
        <td>{{ $datos['columna-lumbar-integridad'] ?? ''  }}</td>
        <td>{{ $datos['Columna-vertebral-integridad'] ?? 'Ninguna Observación' }}</td>
    </tr>
    <tr>
        <td class="letrasNegritas">Forma</td>
        <td>{{ $datos['columna-cervical-Forma'] ?? ''  }}</td>
        <td>{{ $datos['columna-dorsal-Forma'] ?? '' }}</td>
        <td>{{ $datos['columna-lumbar-Forma'] ?? ''  }}</td>
        <td>{{ $datos['Columna-vertebral-Forma'] ?? 'Ninguna Observación' }}</td>
    </tr>
    <tr>
        <td class="letrasNegritas">Movimientos</td>
        <td>{{ $datos['columna-cervical-Movimientos']  ?? '' }}</td>
        <td>{{ $datos['columna-dorsal-Movimientos'] ?? ''  }}</td>
        <td>{{ $datos['columna-lumbar-Movimientos'] ?? ''  }}</td>
        <td>{{ $datos['Columna-vertebral-Movimientos'] ?? 'Ninguna Observación' }}</td>
    </tr>
    <tr>
        <td class="letrasNegritas">Fuerza</td>
        <td>{{ $datos['columna-cervical-Fuerza'] ?? ''  }}</td>
        <td>{{ $datos['columna-dorsal-Fuerza'] ?? ''  }}</td>
        <td>{{ $datos['columna-lumbar-Fuerza'] ?? ''  }}</td>
        <td>{{ $datos['Columna-vertebral-Fuerza'] ?? 'Ninguna Observación' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Escoleosis</td>
        <td>{{ $datos['columna-cervical-Escoleosis']  ?? '' }}</td>
        <td>{{ $datos['Columna-vertebral-Escoleosis'] ?? 'Ninguna Observación' }}</td>
    </tr>
    <tr>
        <td class="letrasNegritas">Cifosis</td>
        <td>{{ $datos['columna-cervical-Cifosis'] ?? ''  }}</td>
        <td>{{ $datos['Columna-vertebral-Cifosis'] ?? 'Ninguna Observación' }}</td>
    </tr>
    <tr>
        <td class="letrasNegritas">Lordosis</td>
        <td>{{ $datos['columna-cervical-Lordosis'] ?? ''  }}</td>
        <td>{{ $datos['Columna-vertebral-Lordosis'] ?? 'Ninguna Observación' }}</td>
    </tr>
</table>
<table class='table-container'>
                <tr>
                    <th colspan="3" class="section-title">10) AUXILIARES DIAGNÓSTICOS</th>
                </tr>
                @if(!empty($datos['auxiliares_diagnosticos']))
                    @foreach($datos['auxiliares_diagnosticos'] as $diagnosticoAuxiliar)
                        <tr>
                            <td>{{ $diagnosticoAuxiliar }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>Ninguno</td>
                    </tr>
                @endif
            </table>

            <table class='table-container'>
                <tr>
                    <th colspan="3" class="section-title">11) CONCLUSIONES</th>
                </tr>
                <tr>
                    <th>Diagnósticos</th>
                    <th></th>
                    <th>Recomendaciones</th>
                </tr>
                <tr>
                    <td>
                        @if(!empty($datos['conclusiones_diagnostico']))
                            <ul>
                                @foreach($datos['conclusiones_diagnostico'] as $diagnostico)
                                    <li>{{ $diagnostico }}</li>
                                @endforeach
                            </ul>
                        @else
                            Ninguno
                        @endif
                    </td>
                    <td></td>
                    <td>
                        @if(!empty($datos['recomendaciones']))
                            <ul>
                                @foreach($datos['recomendaciones'] as $recomendacion)
                                    <li>{{ $recomendacion }}</li>
                                @endforeach
                            </ul>
                        @else
                            Ninguna
                        @endif
                    </td>
                </tr>
            </table>

            <table class='table-container'>
                <tr>
                    <th colspan="2" class="section-title">12) SATISFACTORIO</th>
                </tr>
                <tr>
                    <td colspan="2">{{ $datos['satisfactorio'] ?? 'No Especificado' }}</td>
                </tr>
            </table>

            <table class='table-container'>
                <tr>
                    <th colspan="3" class="section-title">13) OBSERVACIONES</th>
                </tr>
                <tr>
                    <td>Fecha:</td>
                    <td>{{ $datos['observacion_fecha'] ?? 'No Especificada' }}</td>
                </tr>
                <tr>
                    <td>Firma del Médico:</td>
                    <td>


                    @if(isset($datos['firmaBase64Medico']) && $datos['firmaBase64Medico'] !== '')
                <img src="{{ $datos['firmaBase64Medico'] }}" alt="Firma" style="max-width: 200px; max-height: 100px; border: 1px solid black;"/>
            @else
                <p>No hay firma registrada</p>
            @endif
        
                    </td>
                </tr>
                <tr>
                    <td>Salud Ocupacional:</td>
                    <td>{{ $datos['salud_ocupacional'] ?? 'No Especificado' }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>