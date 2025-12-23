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
                    <th class="section-title">PROPIEDAD / RAZÓN SOCIAL:</th>
                    <td colspan="4">{{ $empleado->razon_social ?? 'Sin Registrar'}}</td>
                </tr>
                <tr>
                    <th class="col-small">No. Zapato</th>
                    <th class="col-medium">Talla Playera</th>
                    <th class="col-medium">Talla Pantalón</th>
                    <th class="col-large">Tel. en caso de accidente</th>
                </tr>
                <tr>
                    <td>{{ $empleado->no_zapato ?? 'Sin Registrar'}}</td>
                    <td>{{ $empleado->talla_playera ?? 'Sin Registrar'}}</td>
                    <td>{{ $empleado->talla_pantalon ?? 'Sin Registrar'}}</td>
                    <td>{{ $empleado->tel_emergencia ?? 'Sin Registrar'}}</td>
                </tr>
            </table>

            <table class="table-container">
                <tr>
                    <th colspan="6" class="section-title">1) FICHA DE IDENTIFICACIÓN</th>
                </tr>
                <tr class="agents-list">
                    <td class="letrasNegritas">Nombre: </td>
                    <td>{{ $empleado->nombre ?? 'Sin Registrar'}}</td>
                    <td class="letrasNegritas">Edad:</td>
                    <td>{{ $empleado->edad ?? 'Sin Registrar'}}</td>
                    <td class="letrasNegritas">Género:</td>
                    <td>{{ $empleado->genero ?? 'Sin Registrar'}}</td>
                </tr>
                <tr class="agents-list">
                    <td class="letrasNegritas">Estado Civil:</td>
                    <td>{{ $empleado->estado_civil ?? 'Sin Registrar'}}</td>
                    <td class="letrasNegritas">Fecha de nacimiento:</td>
                    <td>{{ $empleado->fecha_nacimiento ?? 'Sin Registrar'}}</td>
                </tr>
                <tr class="agents-list">
                    <td class="letrasNegritas">Dirección:</td>
                     <td>{{ $empleado->direccion ?? 'Sin Registrar'}}</td>
                    <td class="letrasNegritas">Teléfono:</td>
                    <td>{{ $empleado->telefono ?? 'Sin Registrar'}}</td>
                </tr>
                <tr class="agents-list">
                    <td class="letrasNegritas">Escolaridad:</td>
                    <td>{{ $empleado->escolaridad ?? 'Sin Registrar'}}</td>
                    <td class="letrasNegritas">Departamento: </td>
                    <td>{{ $empleado->departamento ?? 'Sin Registrar'}}</td>
                    <td class="letrasNegritas">Puesto Aspirante: </td>
                    <td>{{ $empleado->puesto_aspirante ?? 'Sin Registrar'}}</td>
                </tr>
            </table>

            <table class="table-container">
                <tr>
                    <th colspan="5" class="section-title">2) ANTECEDENTES LABORALES</th>
                </tr>
                <tr>
                    <th>Edad de Inicio de Labores:</th>
                    <td>{{ $antecedentes->edad_inicio_labores ?? 'Sin Registrar' }}</td>
                </tr>
                <tr>
                    <th>Empresa</th>
                    <th>Puesto</th>
                    <th>Tiempo</th>
                    <th></th>
                    <th>Agentes</th>
                </tr>
                    <tr class="agents-list-antecedentes">
                        <td>{{ $antecedentes->empresas_laborado ?? 'Sin Registrar' }}</td>
                        <td>{{ $antecedentes->puestos_ocupados ?? 'Sin Registrar' }}</td>
                        <td>{{ $antecedentes->tiempo_laborado ?? 'Sin Registrar' }}</td>
                        <td></td>
                        <td>{{ $antecedentes->agentes ?? 'Sin Registrar' }}</td>
                    </tr>
            </table>

<table class="table-container">
    <tr>
        <th colspan="9" class="section-title">3) ANTECEDENTES HEREDO FAMILIARES</th>
    </tr>

    <tr class="no-border-bottom">
        <td class="letrasNegritas">Fímicos</td>
        <td>{{ $heredoFamiliares->fimicos ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Cardiópatas</td>
        <td>{{ $heredoFamiliares->cardiópatas ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Malformaciones</td>
        <td>{{ $heredoFamiliares->malf_congen ?? 'Sin Registrar' }}</td>
    </tr>
    <tr class="no-border-bottom">
        <td class="letrasNegritas">Lueticos</td>
        <td>{{ $heredoFamiliares->luéticos ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Epilepticos</td>
        <td>{{ $heredoFamiliares->epilépticos ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Atopicos</td>
        <td>{{ $heredoFamiliares->atópicos ?? 'Sin Registrar' }}</td>
    </tr>
    <tr>
        <td class="letrasNegritas">Diabeticos</td>    
        <td>{{ $heredoFamiliares->diabéticos ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Oncológicos</td>    
        <td>{{ $heredoFamiliares->oncologicos ?? 'Sin Registrar' }}</td>
    </tr>
    <tr>
        <td class="letrasNegritas">Otros</td>
        <td colspan="8">{{ $heredoFamiliares->otro ?? 'Sin Registrar' }}</td>
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
        <td>{{ $personalesPatologicos->fimicos ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Cardiacos</td>
        <td>{{ $personalesPatologicos->cardiacos ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Traumáticos</td>
        <td>{{ $personalesPatologicos->traumaticos ?? 'Sin Registrar' }}</td>
    </tr>
    <tr class="no-border-bottom">
        <td class="letrasNegritas">Luéticos</td>
        <td>{{ $personalesPatologicos->lueticos ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Hipertensos</td>
        <td>{{ $personalesPatologicos->hipertensos ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Oncológicos</td>
        <td>{{ $personalesPatologicos->oncologicos ?? 'Sin Registrar' }}</td>
    </tr>
    <tr class="no-border-bottom">
        <td class="letrasNegritas">Diabéticos</td>
        <td>{{ $personalesPatologicos->diabeticos ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Atópicos</td>
        <td>{{ $personalesPatologicos->atopicos ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Epilépticos</td>
        <td>{{ $personalesPatologicos->epilepticos ?? 'Sin Registrar' }}</td>
    </tr>
    <tr>
        <td class="letrasNegritas">Renales</td>
        <td>{{ $personalesPatologicos->renales ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Lumbalgias</td>
        <td>{{ $personalesPatologicos->lumbalgias ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Quirúrgicos</td>
        <td>{{ $personalesPatologicos->quirurgicos ?? 'Sin Registrar' }}</td>
    </tr>
    <tr>
        <td class="letrasNegritas">otros</td>
        <td colspan="8">{{ $personalesPatologicos->otro ?? 'Sin Registrar' }}</td>
    </tr>
</table>

<table class='table-container'>
    <tr>
        <th colspan="6" class="section-title">5) ANTECEDENTES PERSONALES NO PATOLÓGICOS</th>
    </tr>
    <tr class="no-border-bottom">
        <td class="letrasNegritas">Tabaquismo</td>
        <td>{{ $noPatologicos->no_patologicos_tabaquismo ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Detalles extras:</td>
        <td>{{ $noPatologicos->no_patologicos_tabaquismo_especifica ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Menarquía</td>
        <td>{{ $noPatologicos->no_patologicos_menarquia ?? 'Sin Registrar' }}</td>
    </tr>
    <tr class="no-border-bottom">
        <td class="letrasNegritas">Alcoholismo</td>
        <td>{{ $noPatologicos->no_patologicos_alcoholismo ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Detalles extras: </td>
        <td>{{ $noPatologicos->no_patologicos_alcoholismo_especifica ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Ritmo</td>
        <td>{{ $noPatologicos->no_patologicos_ritmo ?? 'Sin Registrar' }}</td>
    </tr>
    <tr class="no-border-bottom">
        <td class="letrasNegritas">Toxicomanias</td>
        <td>{{ $noPatologicos->no_patologicos_toxicomania ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Detalles extras:</td>
        <td>{{ $noPatologicos->no_patologicos_toxicomania_especifica ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">F. U. M.</td>
        <td>{{ $noPatologicos->no_patologicos_fum ?? 'Sin Registrar' }}</td>
    </tr>
    <tr class="no-border-bottom">
        <td class="letrasNegritas">IVSA</td>
        <td>{{ $noPatologicos->no_patologicos_ivsa ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">FUP</td>
        <td>{{ $noPatologicos->no_patologicos_fup ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Dismenorrea</td>
        <td>{{ $noPatologicos->no_patologicos_disminorrea ?? 'Sin Registrar' }}</td>
    </tr>
    <tr class="no-border-bottom">
        <td class="letrasNegritas">DOC</td>
        <td>{{ $noPatologicos->no_patologicos_doc ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">PF</td>
        <td>{{ $noPatologicos->no_patologicos_pf ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">G</td>
        <td>{{ $noPatologicos->no_patologicos_g ?? 'Sin Registrar' }}</td>
    </tr>
    <tr>
        <td class="letrasNegritas">P</td>
        <td>{{ $noPatologicos->no_patologicos_p ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">C</td>
        <td>{{ $noPatologicos->no_patologicos_c ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">A</td>
        <td>{{ $noPatologicos->no_patologicos_a ?? 'Sin Registrar' }}</td>
    </tr>
</table>

<table class='table-container'>
    <tr>
        <th colspan="6" class="section-title">6) ¿HA ESTADO INCAPACITADO POR RIESGO DE TRABAJO?</th>
    </tr>
    <tr>
        <td class="letrasNegritas">Incapacitado por Riesgo de Trabajo:</td>
        <td>{{ $riesgoTrabajo->riesgo ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Riesgo:</td>
        <td>{{ $riesgoTrabajo->riesgo_evaluacion ?? 'Sin Registrar' }}</td>
    </tr>
</table>

<table class='table-container'>
    <tr>
        <th colspan="6" class="section-title">6) ¿HA ESTADO INCAPACITADO POR ALGUNA ENFERMEDAD?</th>
    </tr>
    <tr>
        <td class="letrasNegritas">Incapacitado por Riesgo de Enfermedad: </td>
        <td>{{ $riesgoEnfermedad->riesgo ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Enfermedad: </td>
        <td>{{ $riesgoEnfermedad->riesgo_evaluacion ?? 'Sin Registrar' }}</td>
    </tr>
</table>

<table class='table-container'>
    <tr>
        <th colspan="6" class="section-title">8) ¿ACTUALMENTE PADECE ALGUNA ENFERMEDAD?</th>
    </tr>
    <tr>
        <td class="letrasNegritas">Padece Alguna Enfermedad:</td>
        <td>{{ $padeceEnfermedad->padece ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Especifique:</td>
        <td>{{ $padeceEnfermedad->padece_evaluacion ?? 'Sin Registrar' }}</td>
    </tr>
    <tr>
        <td class="letrasNegritas">Mano Dominante:</td>
        <td>{{ $padeceEnfermedad->mano_dominante ?? 'Sin Registrar' }}</td>
    </tr>
    <tr>
        <td class="letrasNegritas">Firma del Candidato</td>
        <td>
            @if(isset($padece) && $padece->firma)
                <img src="{{ public_path('storage/firma/' . $padece->firma) }}"/>
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
        <td>{{ $datosFisicos->fisico_peso ?? 'Sin Registrar' }}</td>
        <td>{{ $datosFisicos->fisico_talla ?? 'Sin Registrar' }}</td>
        <td>{{ $datosFisicos->fisico_ta ?? 'Sin Registrar' }}</td>
        <td>{{ $datosFisicos->fisico_fc ?? 'Sin Registrar' }}</td>
        <td>{{ $datosFisicos->fisico_fr ?? 'Sin Registrar' }}</td>
        <td>{{ $datosFisicos->fisico_imc ?? 'Sin Registrar' }}</td>
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
        <td>{{ $craneo->forma ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Ganglios</td>
        <td>{{ $cuello->ganglios ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Mucosas</td>
        <td>{{ $boca->mucosas ?? 'Sin Registrar' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Tamaño</td>
        <td>{{ $craneo->tamaño ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Movilidad</td>
        <td>{{ $cuello->movilidad ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Dentadura</td>
        <td>{{ $boca->dentadura ?? 'Sin Registrar' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Pelo</td>
        <td>{{ $craneo->pelo ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Tiroides</td>
        <td>{{ $cuello->tiroides ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Lengua</td>
        <td>{{ $boca->lengua ?? 'Sin Registrar' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Cara</td>
        <td>{{ $craneo->cara ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Pulsos</td>
        <td>{{ $cuello->pulsos ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Encias</td>
        <td>{{ $boca->encias ?? 'Sin Registrar' }}</td>
    </tr>

    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="letrasNegritas">Faringe</td>
        <td>{{ $boca->faringe ?? 'Sin Registrar' }}</td>
    </tr>

    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="letrasNegritas">Amigdalas</td>
        <td>{{ $boca->amigdalas ?? 'Sin Registrar' }}</td>
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
        <td>{{ $ojos->conjuntivas ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Tabique</td>
        <td>{{ $nariz->tabique ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Pabellon</td>
        <td>{{ $oido->pabellon ?? 'Sin Registrar' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Pupilas</td>
        <td>{{ $ojos->pupilas ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Mucosas</td>
        <td>{{ $nariz->mucosas ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">C.A.E.</td>
        <td>{{ $oido->cae ?? 'Sin Registrar' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Parpados</td>
        <td>{{ $ojos->parpados ?? 'Sin Registrar' }}</td>
        <td></td>
        <td></td>
        <td class="letrasNegritas">Timpanos</td>
        <td>{{ $oido->timpanos ?? 'Sin Registrar' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Reflejos</td>
        <td>{{ $ojos->reflejos ?? 'Sin Registrar' }}</td>  
    </tr>

    <tr>
        <th>Agudeza Visual</th>
        <th></th>
        <th>Abdomen</th>
        <th colspan='3'></th>
    </tr>
    <tr>
        <td class="letrasNegritas">S/L</td>
        <td>{{ $visual->SL ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">megalias</td>
        <td>{{ $abdomen->megalias ?? 'Sin Registrar' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">C/L</td>
        <td>{{ $visual->CL ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Hernias</td>
        <td>{{ $abdomen->hernias ?? 'Sin Registrar' }}</td>
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
        <td>{{ $torax->forma ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Nevos</td>
        <td>{{ $piel->nevos ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Fimosis</td>
        <td>{{ $genitales->fimosis ?? 'Sin Registrar' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">R. Cardiacos</td>
        <td>{{ $torax->ritmos_Cardiacos ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Cicatrices</td>
        <td>{{ $piel->cicatrices ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Varicocele</td>
        <td>{{ $genitales->varicocele ?? 'Sin Registrar' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Campos Pulm.</td>
        <td>{{ $torax->campos_pulm ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Varices</td>
        <td>{{ $piel->varices ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Hernias</td>
        <td>{{ $genitales->hernias ?? 'Sin Registrar' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Mamas</td>
        <td>{{ $torax->mamas ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Edemas</td>
        <td>{{ $piel->edemas ?? 'Sin Registrar' }}</td>
        <td class="letrasNegritas">Criptorquidias</td>
        <td>{{ $genitales->criptorquidias ?? 'Sin Registrar' }}</td>
    </tr>

    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td class="letrasNegritas">Micosis</td>
        <td>{{ $piel->micosis ?? 'Sin Registrar' }}</td>
    </tr>

    <tr><td></td></tr>
    <tr><td></td></tr>

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
        <td>{{ $miembro->integridad ?? 'Sin Registrar' }}</td>
        <td></td>
        <td>{{ $miembro->integridad_observacion ?? 'Sin Registrar' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Forma</td>
        <td>{{ $miembro->forma ?? 'Sin Registrar' }}</td>
        <td></td>
        <td>{{ $miembro->forma_observacion ?? 'Sin Registrar' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Articulaciones</td>
        <td>{{ $miembro->articulaciones ?? 'Sin Registrar' }}</td>
        <td></td>
        <td>{{ $miembro->articulaciones_observacion ?? 'Sin Registrar' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Tono Muscular</td>
        <td>{{ $miembro->tono_muscular ?? 'Sin Registrar' }}</td>
        <td></td>
        <td>{{ $miembro->tono_muscular_observacion ?? 'Sin Registrar' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Reflejos</td>
        <td>{{ $miembro->reflejos ?? 'Sin Registrar' }}</td>
        <td></td>
        <td>{{ $miembro->reflejos_observacion ?? 'Sin Registrar' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Sensibilidad</td>
        <td>{{ $miembro->sensibilidad ?? 'Sin Registrar' }}</td>
        <td></td>
        <td>{{ $miembro->sensibilidad_observacion ?? 'Sin Registrar' }}</td>
    </tr>

        <tr>
        <th>Columna Vertebral</th>
    </tr>
    <tr>
        <th></th>
        <th>Cervical</th>
        <th>Dorsal</th>
        <th>Lumbar</th>
        <th colspan='3'></th>
    </tr>
    <tr>
        <td class="letrasNegritas">Integridad</td>
        <td>{{ $cervical->integridad ?? 'Sin Registrar' }}</td>
        <td>{{ $cervical->integridad_observacion ?? 'Sin Registrar' }}</td>
        <td>{{ $dorsal->integridad ?? 'Sin Registrar' }}</td>
        <td>{{ $dorsal->integridad_observacion ?? 'Sin Registrar' }}</td>
        <td>{{ $lumbar->integridad ?? 'Sin Registrar' }}</td>
        <td>{{ $lumbar->integridad_observacion ?? 'Sin Registrar' }}</td>
    
    </tr>
    <tr>
        <td class="letrasNegritas">Forma</td>
        <td>{{ $cervical->forma ?? 'Sin Registrar' }}</td>
        <td>{{ $cervical->forma_observacion ?? 'Sin Registrar' }}</td>
        <td>{{ $dorsal->forma ?? 'Sin Registrar' }}</td>
        <td>{{ $dorsal->forma_observacion ?? 'Sin Registrar' }}</td>
        <td>{{ $lumbar->forma ?? 'Sin Registrar' }}</td>
        <td>{{ $lumbar->forma_observacion ?? 'Sin Registrar' }}</td>

    </tr>
    <tr>
        <td class="letrasNegritas">Movimientos</td>
        <td>{{ $cervical->movimientos ?? 'Sin Registrar' }}</td>
        <td>{{ $cervical->movimientos_observacion ?? 'Sin Registrar' }}</td>
        <td>{{ $dorsal->movimientos ?? 'Sin Registrar' }}</td>
        <td>{{ $dorsal->movimientos_observacion ?? 'Sin Registrar' }}</td>
        <td>{{ $lumbar->movimientos ?? 'Sin Registrar' }}</td>
        <td>{{ $lumbar->movimientos_observacion ?? 'Sin Registrar' }}</td>

    </tr>
    <tr>
        <td class="letrasNegritas">Fuerza</td>
        <td>{{ $cervical->fuerza ?? 'Sin Registrar' }}</td>
        <td>{{ $cervical->fuerza_observacion ?? 'Sin Registrar' }}</td>   
        <td>{{ $dorsal->fuerza ?? 'Sin Registrar' }}</td>
        <td>{{ $dorsal->fuerza_observacion ?? 'Sin Registrar' }}</td>
        <td>{{ $lumbar->fuerza ?? 'Sin Registrar' }}</td>
        <td>{{ $lumbar->fuerza_observacion ?? 'Sin Registrar' }}</td>
    </tr>

    <tr>
        <td class="letrasNegritas">Escoleosis</td>
        <td>{{ $cervical->escoleosis ?? 'Sin Registrar' }}</td>
        <td>{{ $vertebral->escoleosis ?? 'Ninguna Observación' }}</td>
        <td>{{ $vertebral->evaluacion_escoleosis ?? 'Ninguna Observación' }}</td>
    </tr>
    <tr>
        <td class="letrasNegritas">Cifosis</td>
        <td>{{ $cervical->cifosis ?? 'Sin Registrar' }}</td>
        <td>{{ $vertebral->cifosis ?? 'Ninguna Observación' }}</td>
        <td>{{ $vertebral->evaluacion_cifosis ?? 'Ninguna Observación' }}</td>
    </tr>
    <tr>
        <td class="letrasNegritas">Lordosis</td>
        <td>{{ $cervical->lordosis ?? 'Sin Registrar' }}</td>
        <td>{{ $vertebral->lordosis ?? 'Ninguna Observación' }}</td>
        <td>{{ $vertebral->evaluacion_lordosis ?? 'Ninguna Observación' }}</td>
    </tr>
</table>
<table class='table-container'>
                <tr>
                    <th colspan="3" class="section-title">10) AUXILIARES DE DIAGNÓSTICOS</th>
                </tr>
                <tr>
                    <td>{{ $auxiliar->radiografias ?? 'Sin Registrar' }}</td>
                </tr>
                    <td>{{ $auxiliar->torax ?? 'Sin Registrar' }}</td>
                <tr>
                    <td>{{ $auxiliar->colLumbar ?? 'Sin Registrar' }}</td>                       
                </tr>
                <tr>
                    <td>{{ $auxiliar->laboratorio ?? 'Sin Registrar' }}</td>
                </tr>
                    <td>{{ $auxiliar->audiometria ?? 'Sin Registrar' }}</td>
                <tr>
                    <td>{{ $auxiliar->otros ?? 'Sin Registrar' }}</td>                       
                </tr>                
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
                    <td>Evaluacion Satisfactoria:</td>
                    <td>{{ $observacion->evaluacion_satisfactoria ?? '' }}</td>
                </tr>
                <tr>
                    <td>Recomendaciones:</td>
                    <td>{{ $observacion->recomendaciones ?? 'Sin Registrar' }}</td>
                </tr>                
                <tr>
                    <td>Salud Ocupacional:</td>
                    <td>{{ $observacion->salud_ocupacional ?? 'Sin Registrar' }}</td>
                </tr>
                                <tr>
                    <td>Fecha:</td>
                    <td>{{ $observacion->fecha_formulario ?? 'Sin Registrar' }}</td>
                </tr>
                <tr>
                    <td>Firma del Médico:</td>
                    <td>
                    @if(isset($observacion) && $observacion->firma_formulario)
                        <img src="{{ public_path('storage/firma/' . $observacion->firma_formulario) }}" alt="Firma"/>
                     @else
                        <p>No hay firma registrada</p>
                      @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>