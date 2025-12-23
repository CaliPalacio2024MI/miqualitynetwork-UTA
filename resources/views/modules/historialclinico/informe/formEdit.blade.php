@vite(['resources/css/modules/historialclinico/editEmpleado.css'])
<div class="form-wrapper">
  <div class="form-header">
    <h1>Editar Empleado</h1>
  </div>

  <form method="POST" action="{{ route('empleado.update', $empleado->id) }}" class="form-body">
    @csrf
    <input type="hidden" name="hotel" value="Princess">

    <fieldset>
      <legend>Propiedad / Razón Social</legend>
      <input type="text" name="razon-social" value="{{ $empleado->razon_social }}">
    </fieldset>
<fieldset>
    <div class="grid-4">
      <div>
        <label>No. Zapato</label>
        <input type="number" name="no-zapato" value="{{ $empleado->no_zapato }}">
      </div>
      <div>
        <label>Talla Playera</label>
        <input type="text" name="talla-playera" value="{{ $empleado->talla_playera }}">
      </div>
      <div>
        <label>Talla Pantalón</label>
        <input type="text" name="talla-pantalon" value="{{ $empleado->talla_pantalon }}">
      </div>
      <div>
        <label>Tel. en caso de accidente</label>
        <input type="tel" name="tel-emergencia" value="{{ $empleado->tel_emergencia }}">
      </div>
    </div>
</fieldset>
    <fieldset>
      <legend>1) FICHA DE IDENTIFICACIÓN</legend>
      <div class="grid-3">
        <div>
          <label>Nombre</label>
          <input type="text" name="nombre" value="{{ $empleado->nombre }}">
        </div>
        <div>
          <label>Edad</label>
          <input type="number" name="edad" value="{{ $empleado->edad }}">
        </div>
        <div>
          <label>Género</label>
          <select name="genero" class="form-control">
            <option value="Otro" {{ $empleado->genero == 'Sin seleccionar' ? 'selected' : '' }}>Sin seleccionar</option>
            <option value="Masculino" {{ $empleado->genero == 'Masculino' ? 'selected' : '' }}>Masculino</option>
            <option value="Femenino" {{ $empleado->genero == 'Femenino' ? 'selected' : '' }}>Femenino</option>
        </select>
        </div>
      </div>

      <div class="grid-2">
        <div>
          <label>Estado Civil</label>
          <input type="text" name="estado-civil" value="{{ $empleado->estado_civil }}">
        </div>
        <div>
          <label>Fecha de nacimiento</label>
          <input type="date" name="fecha-nacimiento" value="{{ $empleado->fecha_nacimiento }}">
        </div>
      </div>

      <div>
        <label>Dirección</label>
        <input type="text" name="direccion" value="{{ $empleado->direccion }}">
      </div>
      <div>
        <label>Teléfono</label>
        <input type="text" name="telefono" value="{{ $empleado->telefono }}">
      </div>

      <div class="grid-3">
        <div>
          <label>Escolaridad</label>
          <input type="text" name="escolaridad" value="{{ $empleado->escolaridad }}">
        </div>
        <div>
          <label for="departamento">Departamento</label>
          <input type="text" name="departamento" value="{{ $empleado->departamento }}">

        </div>
        <div>
          <label>Puesto</label>
          <input type="text" name="puesto-aspirante" value="{{ $empleado->puesto_aspirante }}">
        </div>
      </div>
    </fieldset>
<!-- ANTECEDENTES LABORALES -->
<fieldset>
  <legend>2) ANTECEDENTES LABORALES</legend>

  <div class="grid-2">
    <div>
      <label>Edad de inicio de labores</label>
      <input type="number" name="edad-inicio-labores" value="{{ $antecedentes->edad_inicio_labores ?? '' }}">
    </div>
    <div>
      <label>Tiempo laborado</label>
      <input type="text" name="tiempo" value="{{ $antecedentes->tiempo_laborado ?? '' }}">
    </div>
  </div>

  <div class="grid-2">
    <div>
      <label>Empresas en las que ha laborado</label>
      <input type="text" name="empresa" value="{{ $antecedentes->empresas_laborado ?? '' }}">
    </div>
    <div>
      <label>Puestos ocupados</label>
      <input type="text" name="puesto" value="{{ $antecedentes->puestos_ocupados ?? '' }}">
    </div>
  </div>

  <div>
    <label>Agentes que lo recomendaron</label>
    <input type="text" name="agentes" value="{{ $antecedentes->agentes ?? '' }}">
  </div>
</fieldset>
<fieldset>
  <legend>2) ANTECEDENTES HEREDOFAMILIARES</legend>
  <div class="grid-3">
    <div><label>Fimicos</label><input type="text" name="fimicos-heredofamiliares" value="{{ $heredoFamiliares->fimicos  ?? ''  }}"></div>
    <div><label>Luéticos</label><input type="text" name="lueticos-heredofamiliare" value="{{ $heredoFamiliares->luéticos ?? ''  }}"></div>
    <div><label>Diabéticos</label><input type="text" name="diabeticos-heredofamiliares" value="{{ $heredoFamiliares->diabéticos ?? ''  }}"></div>
    <div><label>Cardiópatas</label><input type="text" name="cardiopatas-heredofamiliares" value="{{ $heredoFamiliares->cardiópatas ?? ''  }}"></div>
    <div><label>Epilépticos</label><input type="text" name="epilepticos-heredofamiliares" value="{{ $heredoFamiliares->epilépticos ?? ''  }}"></div>
    <div><label>Oncológicos</label><input type="text" name="oncologicos-heredofamiliares" value="{{ $heredoFamiliares->oncologicos ?? ''  }}"></div>
    <div><label>Malformaciones Congénitas</label><input type="text" name="malformaciones-heredofamiliares" value="{{ $heredoFamiliares->malf_congen ?? ''  }}"></div>
    <div><label>Atópicos</label><input type="text" name="atopicos-heredofamiliares" value="{{ $heredoFamiliares->atópicos ?? ''  }}"></div>
    <div><label>Otro</label><input type="text" name="otro-heredofamiliares" value="{{ $heredoFamiliares->otro ?? ''  }}"></div>
  </div>
</fieldset>

<fieldset>
  <legend>3) ANTECEDENTES PERSONALES PATOLÓGICOS</legend>
  <div class="grid-3">
    <div><label>Fimicos</label><input type="text" name="fimicos-personales" value="{{ $personalesPatologicos->fimicos ?? ''  }}"></div>
    <div><label>Luéticos</label><input type="text" name="lueticos-personales" value="{{ $personalesPatologicos->lueticos ?? ''  }}"></div>
    <div><label>Diabéticos</label><input type="text" name="diabeticos-personales" value="{{ $personalesPatologicos->diabeticos ?? ''  }}"></div>
    <div><label>Renales</label><input type="text" name="renales-personales" value="{{ $personalesPatologicos->renales ?? ''  }}"></div>
    <div><label>Cardiacos</label><input type="text" name="cardiacos-personales" value="{{ $personalesPatologicos->cardiacos ?? ''  }}"></div>
    <div><label>Hipertensos</label><input type="text" name="hipertensos-personales" value="{{ $personalesPatologicos->hipertensos ?? ''  }}"></div>
    <div><label>Atópicos</label><input type="text" name="atopicos-personales" value="{{ $personalesPatologicos->atopicos ?? ''  }}"></div>
    <div><label>Lumbalgias</label><input type="text" name="lumbalgias-personales" value="{{ $personalesPatologicos->lumbalgias ?? ''  }}"></div>
    <div><label>Traumáticos</label><input type="text" name="traumaticos-personales" value="{{ $personalesPatologicos->traumaticos ?? ''  }}"></div>
    <div><label>Oncológicos</label><input type="text" name="oncologicos-personales" value="{{ $personalesPatologicos->oncologicos  ?? '' }}"></div>
    <div><label>Epilépticos</label><input type="text" name="epilepticos-personales" value="{{ $personalesPatologicos->epilepticos  ?? '' }}"></div>
    <div><label>Quirúrgicos</label><input type="text" name="quirurgicos-personales" value="{{ $personalesPatologicos->quirurgicos ?? ''  }}"></div>
    <div><label>Otros</label><input type="text" name="otros-personales" value="{{ $personalesPatologicos->otro ?? ''  }}"></div>
  </div>
</fieldset>

<fieldset>
  <legend>4) ANTECEDENTES PERSONALES NO PATOLÓGICOS</legend>
  <div class="grid-2">
    <div><label>Tabaquismo</label><input type="text" name="tabaquismo" value="{{ $noPatologicos->no_patologicos_tabaquismo ?? ''  }}"></div>
    <div><label>Especifica Tabaquismo</label><input type="text" name="especifica_tabaquismo" value="{{ $noPatologicos->no_patologicos_tabaquismo_especifica ?? ''  }}"></div>
    <div><label>Alcoholismo</label><input type="text" name="alcoholismo" value="{{ $noPatologicos->no_patologicos_alcoholismo ?? ''  }}"></div>
    <div><label>Especifica Alcoholismo</label><input type="text" name="especifica_alcoholismo" value="{{ $noPatologicos->no_patologicos_alcoholismo_especifica ?? ''  }}"></div>
    <div><label>Toxicomanías</label><input type="text" name="toxicomanias" value="{{ $noPatologicos->no_patologicos_toxicomania ?? ''  }}"></div>
    <div><label>Especifica Toxicomanías</label><input type="text" name="especifica_toxicomanias" value="{{ $noPatologicos->no_patologicos_toxicomania_especifica ?? ''  }}"></div>
    <div><label>Menarquia</label><input type="text" name="menarquia" value="{{ $noPatologicos->no_patologicos_menarquia ?? ''  }}"></div>
    <div><label>Ritmo</label><input type="text" name="ritmo" value="{{ $noPatologicos->no_patologicos_ritmo ?? ''  }}"></div>
    <div><label>FUM</label><input type="text" name="fum" value="{{ $noPatologicos->no_patologicos_fum ?? ''  }}"></div>
    <div><label>Disminorrea</label><input type="text" name="disminorrea" value="{{ $noPatologicos->no_patologicos_disminorrea ?? ''  }}"></div>
    <div><label>IVSA</label><input type="text" name="ivsa" value="{{ $noPatologicos->no_patologicos_ivsa ?? ''  }}"></div>
    <div><label>FUP</label><input type="text" name="fup" value="{{ $noPatologicos->no_patologicos_fup ?? ''  }}"></div>
    <div><label>DOC</label><input type="text" name="doc" value="{{ $noPatologicos->no_patologicos_doc ?? ''  }}"></div>
    <div><label>PF</label><input type="text" name="pf" value="{{ $noPatologicos->no_patologicos_pf ?? ''  }}"></div>
    <div><label>G</label><input type="text" name="g" value="{{ $noPatologicos->no_patologicos_g ?? ''  }}"></div>
    <div><label>P</label><input type="text" name="p" value="{{ $noPatologicos->no_patologicos_p ?? ''  }}"></div>
    <div><label>C</label><input type="text" name="c" value="{{ $noPatologicos->no_patologicos_c ?? ''  }}"></div>
    <div><label>A</label><input type="text" name="a" value="{{ $noPatologicos->no_patologicos_a ?? ''  }}"></div>
  </div>
</fieldset>

<fieldset>
  <legend>5) RIESGOS</legend>
  <div class="grid-2">
    <div>
      <label>Riesgo en el Trabajo</label>
      <input type="text" name="riesgo-trabajo" value="{{ $riesgoTrabajo->riesgo ?? ''  }}">
    </div>
    <div>
      <label>Evaluación del Riesgo</label>
      <input type="text" name="especifica-riesgo-trabajo" value="{{ $riesgoTrabajo->riesgo_evaluacion ?? ''  }}">
    </div>
    <div>
      <label>Riesgo de Enfermedad</label>
      <input type="text" name="riesgo-enfermedad" value="{{ $riesgoEnfermedad->enfermedad ?? ''  }}">
    </div>
    <div>
      <label>Evaluación del Riesgo de Enfermedad</label>
      <input type="text" name="especifica-riesgo-enfermedad" value="{{ $riesgoEnfermedad->enfermedad_evaluacion ?? ''  }}">
    </div>
    <div>
      <label>Padece Alguna Enfermedad:</label>
      <input type="text" name="padece-enfermedad" value="{{ $padece->padece_enfermedad ?? ''  }}">
    </div>
    <div>
      <label>Enfermedad:</label>
      <input type="text" name="especifica-padece-enfermedad" value="{{ $padece->especifique_enfermedad ?? ''  }}">
    </div>
    <div>
      <label>Mano Dominante:</label>
      <input type="text" name="mano-dominante" value="{{ $padece->mano_dominante ?? ''  }}">
    <div>
</fieldset>
<fieldset>

  <legend>6) EXPLORACIÓN FÍSICA</legend>
  <div class="grid-3">
    <div>
      <label>Peso (kg)</label>
      <input type="text" name="exploracion-fisica-peso" value="{{ $datosFisicos->fisico_peso ?? ''}}">
    </div>
    <div>
      <label>Talla (m)</label>
      <input type="text" name="exploracion-fisica-talla" value="{{ $datosFisicos->fisico_talla ?? ''}}">
    </div>
    <div>
      <label>Tensión Arterial (TA)</label>
      <input type="text" name="exploracion-fisica-t/a" value="{{ $datosFisicos->fisico_ta ?? ''}}">
    </div>
  </div>

  <div class="grid-3">
    <div>
      <label>Frecuencia Cardiaca (FC)</label>
      <input type="text" name="exploracion-fisica-fc" value="{{ $datosFisicos->fisico_fc ?? ''}}">
    </div>
    <div>
      <label>Frecuencia Respiratoria (FR)</label>
      <input type="text" name="exploracion-fisica-fre" value="{{ $datosFisicos->fisico_fr ?? ''}}">
    </div>
    <div>
      <label>IMC</label>
      <input type="text" name="exploracion-fisica-imc" value="{{ $datosFisicos->fisico_imc ?? ''}}">
    </div>
  </div>
</fieldset>

<fieldset>
  <legend> EXPLORACIÓN FÍSICA: CRÁNEO</legend>
  <div class="grid-2">
    <div>
      <label>Forma</label>
      <input type="text" name="craneo-forma" value="{{ $craneo->forma ?? ''}}">
    </div>
    <div>
      <label>Tamaño</label>
      <input type="text" name="craneo-tamano" value="{{ $craneo->tamaño ?? ''}}">
    </div>
  </div>
  <div class="grid-2">
    <div>
      <label>Pelo</label>
      <input type="text" name="craneo-pelo" value="{{ $craneo->pelo ?? ''}}">
    </div>
    <div>
      <label>Cara</label>
      <input type="text" name="craneo-Cara" value="{{ $craneo->cara ?? ''}}">
    </div>
  </div>
</fieldset>

<fieldset>
  <legend> EXPLORACIÓN FÍSICA: CUELLO</legend>
  <div class="grid-2">
    <div>
      <label>Ganglios</label>
      <input type="text" name="cuello-ganglios" value="{{ $cuello->ganglios ?? ''}}">
    </div>
    <div>
      <label>Movilidad</label>
      <input type="text" name="cuello-movilidad" value="{{ $cuello->movilidad ?? ''}}">
    </div>
  </div>
  <div class="grid-2">
    <div>
      <label>Tiroides</label>
      <input type="text" name="cuello-tiroides" value="{{ $cuello->tiroides ?? ''}}">
    </div>
    <div>
      <label>Pulsos</label>
      <input type="text" name="cuello-Pulsos" value="{{ $cuello->pulsos ?? ''}}">
    </div>
  </div>
</fieldset>
<fieldset>
  <legend> EXPLORACIÓN FÍSICA: BOCA</legend>
  <div class="grid-3">
    <div>
      <label>Mucosas</label>
      <input type="text" name="boca-mucosas" value="{{ $boca->mucosas ?? ''}}">
    </div>
    <div>
      <label>Dentadura</label>
      <input type="text" name="boca-dentadura" value="{{ $boca->dentadura ?? ''}}">
    </div>
    <div>
      <label>Lengua</label>
      <input type="text" name="boca-Lengua" value="{{ $boca->lengua ?? ''}}">
    </div>
  </div>
  <div class="grid-2">
    <div>
      <label>Encías</label>
      <input type="text" name="boca-Encias" value="{{ $boca->encias ?? ''}}">
    </div>
    <div>
      <label>Faringe</label>
      <input type="text" name="boca-faringe" value="{{ $boca->faringe ?? ''}}">
    </div>
  </div>
  <div>
    <label>Amígdalas</label>
    <input type="text" name="boca-amigdalas" value="{{ $boca->amigdalas ?? '' }}">
  </div>
</fieldset>
<fieldset>
  <legend> EXPLORACIÓN FÍSICA: OJOS</legend>
  <div class="grid-2">
    <div>
      <label>Conjuntivas</label>
      <input type="text" name="ojos-Conjuntivas" value="{{ $ojos->conjuntivas ?? '' }}">
    </div>
    <div>
      <label>Pupilas</label>
      <input type="text" name="ojos-Pupilas" value="{{ $ojos->pupilas ?? '' }}">
    </div>
  </div>
  <div class="grid-2">
    <div>
      <label>Párpados</label>
      <input type="text" name="ojos-Parpados" value="{{ $ojos->parpados ?? '' }}">
    </div>
    <div>
      <label>Reflejos</label>
      <input type="text" name="ojos-Reflejos" value="{{ $ojos->reflejos ?? '' }}">
    </div>
  </div>
</fieldset>
<fieldset>
  <legend> EXPLORACIÓN FÍSICA: NARIZ Y OÍDOS</legend>

  <div class="grid-2">
    <div>
      <label>Tabique</label>
      <input type="text" name="nariz-Tabique" value="{{ $nariz->tabique ?? '' }}">
    </div>
    <div>
      <label>Mucosas (Nariz)</label>
      <input type="text" name="nariz-Mucosas" value="{{ $nariz->mucosas ?? '' }}">
    </div>
  </div>

  <div class="grid-3">
    <div>
      <label>Pabellón</label>
      <input type="text" name="oido-Pabellon" value="{{ $oidos->pabellon ?? '' }}">
    </div>
    <div>
      <label>CAE</label>
      <input type="text" name="oido-cae" value="{{ $oidos->cae ?? '' }}">
    </div>
    <div>
      <label>Tímpanos</label>
      <input type="text" name="oido-timpanos" value="{{ $oidos->timpanos ?? '' }}">
    </div>
  </div>
</fieldset>
<fieldset>
  <legend>EXPLORACIÓN FÍSICA: AGUDEZA VISUAL</legend>

  <div class="grid-2">
    <div>
      <label>Sin lentes (SL)</label>
      <input type="text" name="agudeza-visual-sl" value="{{ $visual->SL ?? '' }}">
    </div>
    <div>
      <label>Con lentes (CL)</label>
      <input type="text" name="agudeza-visual-cl" value="{{ $visual->CL ?? '' }}">
    </div>
  </div>
</fieldset>
<fieldset>
  <legend>EXPLORACIÓN FÍSICA: ABDOMEN</legend>

  <div class="grid-2">
    <div>
      <label>Megalias</label>
      <input type="text" name="abdomen-Megalias" value="{{ $abdomen->megalias ?? '' }}">
    </div>
    <div>
      <label>Hernias</label>
      <input type="text" name="abdomen-Hernias" value="{{ $abdomen->hernias ?? '' }}">
    </div>
  </div>
</fieldset>
<fieldset>
  <legend>EXPLORACIÓN FÍSICA: TÓRAX</legend>

  <div class="grid-2">
    <div>
      <label>Forma</label>
      <input type="text" name="torax-forma" value="{{ $torax->forma ?? '' }}">
    </div>
    <div>
      <label>Ritmos Cardíacos</label>
      <input type="text" name="torax-rCardiacos" value="{{ $torax->ritmos_Cardiacos ?? '' }}">
    </div>
    <div>
      <label>Campos Pulmonares</label>
      <input type="text" name="torax-cPulm" value="{{ $torax->campos_pulm ?? '' }}">
    </div>
    <div>
      <label>Mamas</label>
      <input type="text" name="torax-Mamas" value="{{ $torax->mamas ?? '' }}">
    </div>
  </div>
</fieldset>
<fieldset>
  <legend>EXPLORACIÓN FÍSICA: PIEL</legend>

  <div class="grid-3">
    <div>
      <label>Nevos</label>
      <input type="text" name="piel-nevos" value="{{ $piel->nevos ?? '' }}">
    </div>
    <div>
      <label>Cicatrices</label>
      <input type="text" name="piel-Cicatrices" value="{{ $piel->cicatrices ?? '' }}">
    </div>
    <div>
      <label>Várices</label>
      <input type="text" name="piel-Varices" value="{{ $piel->varices ?? '' }}">
    </div>
    <div>
      <label>Edemas</label>
      <input type="text" name="piel-Edemas" value="{{ $piel->edemas ?? '' }}">
    </div>
    <div>
      <label>Micosis</label>
      <input type="text" name="piel-Micosis" value="{{ $piel->micosis ?? '' }}">
    </div>
  </div>
</fieldset>
<fieldset>
  <legend>EXPLORACIÓN FÍSICA: GENITALES</legend>

  <div class="grid-2">
    <div>
      <label>Fimosis</label>
      <input type="text" name="genitales-fimosis" value="{{ $genitales->fimosis ?? '' }}">
    </div>
    <div>
      <label>Varicocele</label>
      <input type="text" name="genitales-Varicocele" value="{{ $genitales->varicocele ?? '' }}">
    </div>
    <div>
      <label>Hernias</label>
      <input type="text" name="genitales-Hernias" value="{{ $genitales->hernias ?? '' }}">
    </div>
    <div>
      <label>Criptorquidias</label>
      <input type="text" name="genitales-Criptorquidias" value="{{ $genitales->criptorquidias ?? '' }}">
    </div>
  </div>
</fieldset>
<fieldset>
  <legend>EXPLORACIÓN FÍSICA: MIEMBROS TORÁCICOS</legend>
  <div class="grid-2">
    <div>
      <label>Integridad</label>
      <input type="text" name="miembros-toraxicos-Integridad" value="{{ $miembro->integridad ?? '' }}">
    </div>
    <div>
      <label>Observaciones</label>
      <input type="text" name="especifica-miembro-integridad" value="{{ $miembro->integridad_observacion ?? '' }}">
    </div>
    <div>
      <label>Forma</label>
      <input type="text" name="miembros-toraxicos-forma" value="{{ $miembro->forma ?? '' }}">
    </div>
    <div>
      <label>Observaciones</label>
      <input type="text" name="especifica-miembro-forma" value="{{ $miembro->forma_observacion ?? '' }}">
    </div>
    <div>
      <label>Articulaciones</label>
      <input type="text" name="miembros-toraxicos-Articulaciones" value="{{ $miembro->articulaciones ?? '' }}">
    </div>
    <div>
      <label>Observaciones</label>
      <input type="text" name="especifica-miembro-articulaciones" value="{{ $miembro->articulaciones_observacion ?? '' }}">
    </div>
    <div>
      <label>Tono Muscular</label>
      <input type="text" name="miembros-toraxicos-tonoMusculars" value="{{ $miembro->tono_muscular ?? '' }}">
    </div>
    <div>
      <label>Observaciones</label>
      <input type="text" name="especifica-miembro-tonoMuscular" value="{{ $miembro->tono_muscular_observacion ?? '' }}">
    </div>
    <div>
      <label>Reflejos</label>
      <input type="text" name="miembros-toraxicos-Reflejos" value="{{ $miembro->reflejos ?? '' }}">
    </div>
    <div>
      <label>Observaciones</label>
      <input type="text" name="especifica-miembro-Reflejos" value="{{ $miembro->reflejos_observacion ?? '' }}">
    </div>
    <div>
      <label>Sensibilidad</label>
      <input type="text" name="miembros-toraxicos-Sensibilidad" value="{{ $miembro->sensibilidad ?? '' }}">
    </div>
    <div>
      <label>Observaciones</label>
      <input type="text" name="especifica-miembro-Sensibilidad" value="{{ $miembro->sensibilidad_observacion ?? '' }}">
    </div>
  </div>
</fieldset>
<fieldset>
  <legend>EXPLORACIÓN FÍSICA: MIEMBROS PÉLVICOS</legend>
  <div class="grid-2">
    <div>
      <label>Integridad</label>
      <input type="text" name="miembros-pelvicos-Integridad" value="{{ $pelvicos->integridad ?? '' }}">
    </div>
    <div>
      <label>Observaciones</label>
      <input type="text" name="especifica-miembro-integridad" value="{{ $pelvicos->integridad_observacion ?? '' }}">
    </div>
    <div>
      <label>Forma</label>
      <input type="text" name="miembros-pelvicos-Forma" value="{{ $pelvicos->forma ?? '' }}">
    </div>
    <div>
      <label>Observaciones</label>
      <input type="text" name="especifica-miembro-forma" value="{{ $pelvicos->forma_observacion ?? '' }}">
    </div>
    <div>
      <label>Articulaciones</label>
      <input type="text" name="miembros-pelvicos-Articulaciones" value="{{ $pelvicos->articulaciones ?? '' }}">
    </div>
    <div>
      <label>Observaciones</label>
      <input type="text" name="especifica-miembro-articulaciones" value="{{ $pelvicos->articulaciones_observacion ?? '' }}">
    </div>
    <div>
      <label>Tono Muscular</label>
      <input type="text" name="miembros-toraxicos-tonoMuscular" value="{{ $pelvicos->tono_muscular ?? '' }}">
    </div>
    <div>
      <label>Observaciones</label>
      <input type="text" name="especifica-miembro-tonoMuscular" value="{{ $pelvicos->tono_muscular_observacion ?? '' }}">
    </div>
    <div>
      <label>Reflejos</label>
      <input type="text" name="miembros-pelvicos-Reflejos" value="{{ $pelvicos->reflejos ?? '' }}">
    </div>
    <div>
      <label>Observaciones</label>
      <input type="text" name="especifica-miembro-Reflejos" value="{{ $pelvicos->reflejos_observacion ?? '' }}">
    </div>
    <div>
      <label>Sensibilidad</label>
      <input type="text" name="miembros-pelvicos-Sensibilidad" value="{{ $pelvicos->sensibilidad ?? '' }}">
    </div>
    <div>
      <label>Observaciones</label>
      <input type="text" name="especifica-miembro-Sensibilidad" value="{{ $pelvicos->sensibilidad_observacion ?? '' }}">
    </div>
  </div>
</fieldset>
<fieldset>
  <legend>EXPLORACIÓN FÍSICA: COLUMNA CERVICAL</legend>
  <div class="grid-2">
    <div>
      <label>Integridad</label>
      <input type="text" name="columna-cervical-integridad" value="{{ $cervical->integridad ?? '' }}">
    </div>
    <div>
      <label>Observaciones</label>
      <input type="text" name="Columna-vertebral-integridad" value="{{ $cervical->integridad_observacion ?? '' }}">
    </div>
    <div>
      <label>Forma</label>
      <input type="text" name="columna-cervical-Forma" value="{{ $cervical->forma ?? '' }}">
    </div>
    <div>
      <label>Observaciones</label>
      <input type="text" name="Columna-vertebral-Forma" value="{{ $cervical->forma_observacion ?? '' }}">
    </div>
    <div>
      <label>Movimientos</label>
      <input type="text" name="columna-cervical-Movimientos" value="{{ $cervical->movimientos ?? '' }}">
    </div>
    <div>
      <label>Observaciones</label>
      <input type="text" name="Columna-vertebral-Movimientos" value="{{ $cervical->movimientos_observacion ?? '' }}">
    </div>
    <div>
      <label>Fuerza</label>
      <input type="text" name="columna-cervical-Fuerza" value="{{ $cervical->fuerza ?? '' }}">
    </div>
    <div>
      <label>Observaciones</label>
      <input type="text" name="Columna-vertebral-Fuerza" value="{{ $cervical->fuerza_observacion ?? '' }}">
    </div>
  </div>
</fieldset>
<fieldset>
  <legend>EXPLORACIÓN FÍSICA: COLUMNA DORSAL</legend>
  <div class="grid-2">
    <div>
      <label>Integridad</label>
      <input type="text" name="columna-dorsal-integridad" value="{{ $dorsal->integridad ?? '' }}">
    </div>
    <div>
      <label>Observaciones</label>
      <input type="text" name="Columna-vertebral-integridad" value="{{ $dorsal->integridad_observacion ?? '' }}">
    </div>
    <div>
      <label>Forma</label>
      <input type="text" name="columna-dorsal-Forma" value="{{ $dorsal->forma ?? '' }}">
    </div>
    <div>
      <label>Observaciones</label>
      <input type="text" name="Columna-vertebral-Forma" value="{{ $dorsal->forma_observacion ?? '' }}">
    </div>
    <div>
      <label>Movimientos</label>
      <input type="text" name="columna-dorsal-Movimientos" value="{{ $dorsal->movimientos ?? '' }}">
    </div>
    <div>
      <label>Observaciones</label>
      <input type="text" name="Columna-vertebral-Movimientos" value="{{ $dorsal->movimientos_observacion ?? '' }}">
    </div>
    <div>
      <label>Fuerza</label>
      <input type="text" name="columna-dorsal-Fuerza" value="{{ $dorsal->fuerza ?? '' }}">
    </div>
    <div>
      <label>Observaciones</label>
      <input type="text" name="Columna-vertebral-Fuerza" value="{{ $dorsal->fuerza_observacion ?? '' }}">
    </div>
  </div>
</fieldset>
<fieldset>
  <legend>EXPLORACIÓN FÍSICA: COLUMNA LUMBAR</legend>
  <div class="grid-2">
    <div>
      <label>Integridad</label>
      <input type="text" name="columna-lumbar-integridad" value="{{ $lumbar->integridad ?? '' }}">
    </div>
    <div>
      <label>Observación Integridad</label>
      <input type="text" name="Columna-vertebral-integridad" value="{{ $lumbar->integridad_observacion ?? '' }}">
    </div>
    <div>
      <label>Forma</label>
      <input type="text" name="columna-lumbar-Forma" value="{{ $lumbar->forma ?? '' }}">
    </div>
    <div>
      <label>Observación Forma</label>
      <input type="text" name="Columna-vertebral-Forma" value="{{ $lumbar->forma_observacion ?? '' }}">
    </div>
    <div>
      <label>Movimientos</label>
      <input type="text" name="columna-lumbar-Movimientos" value="{{ $lumbar->movimientos ?? '' }}">
    </div>
    <div>
      <label>Observación Movimientos</label>
      <input type="text" name="Columna-vertebral-Movimientos" value="{{ $lumbar->movimientos_observacion ?? '' }}">
    </div>
    <div>
      <label>Fuerza</label>
      <input type="text" name="columna-lumbar-Fuerza" value="{{ $lumbar->fuerza ?? '' }}">
    </div>
    <div>
      <label>Observación Fuerza</label>
      <input type="text" name="Columna-vertebral-Fuerza" value="{{ $lumbar->fuerza_observacion ?? '' }}">
    </div>
  </div>
</fieldset>
<fieldset>
  <legend>EXPLORACIÓN FÍSICA: COLUMNA VERTEBRAL</legend>
  <div class="grid-2">
    <div>
      <label>Escoliosis</label>
      <input type="text" name="columna-cervical-Escoleosis" value="{{ $vertebral->escoleosis ?? '' }}">
    </div>
    <div>
      <label>Evaluación Escoliosis</label>
      <input type="text" name="Columna-vertebral-Escoleosis" value="{{ $vertebral->evaluacion_escoleosis ?? '' }}">
    </div>
    <div>
      <label>Cifosis</label>
      <input type="text" name="columna-cervical-Cifosis" value="{{ $vertebral->cifosis ?? '' }}">
    </div>
    <div>
      <label>Evaluación Cifosis</label>
      <input type="text" name="Columna-vertebral-Cifosis" value="{{ $vertebral->evaluacion_cifosis ?? '' }}">
    </div>
    <div>
      <label>Lordosis</label>
      <input type="text" name="columna-cervical-Lordosis" value="{{ $vertebral->lordosis ?? '' }}">
    </div>
    <div>
      <label>Evaluación Lordosis</label>
      <input type="text" name="Columna-vertebral-Lordosis" value="{{ $vertebral->evaluacion_lordosis ?? '' }}">
    </div>
  </div>
</fieldset>
<fieldset>
  <legend>7) AUXILIARES DE DIAGNÓSTICO</legend>
  <div class="grid-2">
    <div>
      <label>Radiografías</label>
      <input type="text" name="radiografias-aux" value="{{ $auxiliar->radiografias ?? '' }}">
    </div>
    <div>
      <label>Tórax</label>
      <input type="text" name="torax-aux" value="{{ $auxiliar->torax ?? '' }}">
    </div>
    <div>
      <label>Columna Lumbar</label>
      <input type="text" name="col-lumbar-aux" value="{{ $auxiliar->col_lumbar ?? '' }}">
    </div>
    <div>
      <label>Laboratorio</label>
      <input type="text" name="laboratorio-aux" value="{{ $auxiliar->laboratorio ?? '' }}">
    </div>
    <div>
      <label>Audiometría</label>
      <input type="text" name="audiometria-aux" value="{{ $auxiliar->audiometria ?? '' }}">
    </div>
    <div>
      <label>Otros</label>
      <input type="text" name="otros-aux" value="{{ $auxiliar->otros ?? '' }}">
    </div>
  </div>
</fieldset>
<fieldset>
  <legend>8) OBSERVACIONES Y CONCLUSIONES</legend>
  <div class="grid-1">
    <div>
      <label>Diagnóstico(s)</label>
      <input type="text" name="conclusiones_diagnostico" value="{{ $observacion->diagnosticos ?? '' }}">
    </div>
    <div>
      <label>Recomendaciones</label>
      <input type="text" name="conclusiones_recomendaciones" value="{{ $observacion->recomendaciones ?? '' }}">
    </div>
    <div>
      <label>Evaluación satisfactoria</label>
      <input type="text" name="conclusiones_satisfactorias" value="{{ $observacion->evaluacion_satisfactoria ?? '' }}">
    </div>
    <div>
      <label>Salud Ocupacional</label>
      <input type="text" name="salud-ocupacional" value="{{ $observacion->salud_ocupacional ?? '' }}">
    </div>
    <div>
      <label>Fecha de realizacion</label>
      <input type="date" name="fecha-formulario" value="{{ $observacion->fecha_formulario ?? '' }}">
    </div>
  </div>
</fieldset>

    <button type="submit" class="btn-submit">Actualizar</button>
  </form>
</div>
