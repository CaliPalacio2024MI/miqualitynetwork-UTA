<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('departamentos', function (Blueprint $table) {
            $table->id();
            $table->string('departamento');
            $table->string('propiedad'); // Usamos 'hotel' para relacionar con tus tablas (princess, palacio, pierre)
            $table->timestamps();
        });
        Schema::create('puestos', function (Blueprint $table) {
            $table->id();
            $table->string('puesto');

            // Coinciden con los tipos de las otras tablas
            $table->unsignedBigInteger('departamento_id'); // porque departamentos.id es BIGINT UNSIGNED
            $table->integer('propiedad_id');               // porque propiedades.id_propiedad es INT (firmado)

            // Claves foráneas
            $table->foreign('departamento_id')
                ->references('id')->on('departamentos')
                ->onDelete('cascade');

            $table->foreign('propiedad_id')
                ->references('id_propiedad')->on('propiedades')
                ->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('agentes', function (Blueprint $table) {
            $table->id();
            $table->string('agente');
            $table->timestamps();
        });
        //tabla empleados
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('edad');
            $table->string('genero');
            $table->string('estado_civil');
            $table->date('fecha_nacimiento');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('escolaridad');
            $table->string('razon_social')->nullable();
            $table->string('no_zapato')->nullable();
            $table->string('talla_playera')->nullable();
            $table->string('talla_pantalon')->nullable();
            $table->string('tel_emergencia')->nullable();
            $table->string('departamento');
            $table->string('puesto_aspirante');
            $table->timestamps();
        });
        ////////////////////Partes del cuerpto
        Schema::create('partes_afectadas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');
            $table->string('parte_cuerpo');
            $table->timestamps();
        });



        //tabla historial laboral
        Schema::create('historial_laboral', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');
            $table->integer('edad_inicio_labores')->nullable();
            $table->text('empresas_laborado')->nullable();
            $table->text('puestos_ocupados')->nullable();
            $table->text('tiempo_laborado')->nullable();
            $table->text('agentes')->nullable();
            $table->timestamps();
        });    
        // tabla Antecedentes Heredofamiliares
        Schema::create('antecedentes_heredofamiliares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');
            $table->string('fimicos');
            $table->string('luéticos');
            $table->string('diabéticos');
            $table->string('cardiópatas');
            $table->string('epilépticos');
            $table->string('oncologicos');
            $table->string('malf_congen');
            $table->string('atópicos');
            $table->string('otro')->nullable();           
            $table->timestamps();
        });
        // Patológicos
        Schema::create('antecedentes_patologicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');
            $table->string('fimicos');
            $table->string('lueticos');
            $table->string('diabeticos');
            $table->string('renales');
            $table->string('cardiacos');
            $table->string('hipertensos');
            $table->string('atopicos');
            $table->string('lumbalgias');
            $table->string('traumaticos');
            $table->string('oncologicos');
            $table->string('epilepticos');
            $table->string('quirurgicos');
            $table->string('otro')->nullable();
            $table->timestamps();
        });
         // No Patológicos
         Schema::create('antecedentes_no_patologicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');
            $table->string('no_patologicos_tabaquismo');
            $table->string('no_patologicos_tabaquismo_especifica')->nullable();
            $table->string('no_patologicos_alcoholismo');
            $table->string('no_patologicos_alcoholismo_especifica')->nullable();
            $table->string('no_patologicos_toxicomania');
            $table->string('no_patologicos_toxicomania_especifica')->nullable();
            $table->string('no_patologicos_menarquia')->nullable();
            $table->string('no_patologicos_ritmo')->nullable();
            $table->string('no_patologicos_fum')->nullable();
            $table->string('no_patologicos_disminorrea')->nullable();
            $table->string('no_patologicos_ivsa')->nullable();
            $table->string('no_patologicos_fup')->nullable();
            $table->string('no_patologicos_doc')->nullable();
            $table->string('no_patologicos_pf')->nullable();
            $table->string('no_patologicos_g')->nullable();
            $table->string('no_patologicos_p')->nullable();
            $table->string('no_patologicos_c')->nullable();
            $table->string('no_patologicos_a')->nullable();
            $table->timestamps();
        });
            //Incapacidad por Riesgo de Trabajo
        Schema::create('incapacidad_por_trabajo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');            
            $table->string('riesgo');
            $table->text('riesgo_evaluacion')->nullable();
            $table->timestamps();
        });
            //Incapacidad por Enfermedad
        Schema::create('incapacidad_por_enfermedad', function (Blueprint $table) {
            $table->id();          
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');   
            $table->string('enfermedad');
            $table->text('enfermedad_evaluacion')->nullable();
            $table->timestamps();
        });
        //Padece alguna Enfermedad
        Schema::create('padece_alguna_enfermedad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');
            $table->string('padece_enfermedad');
            $table->string('especifique_enfermedad')->nullable();
            $table->string('mano_dominante'); // Este es el campo que agregaste
            $table->string('firma')->nullable();
            $table->timestamps();
        });           
            // Exploración Física
        Schema::create('datos_fisicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade'); 
            $table->float('fisico_peso')->nullable();
            $table->float('fisico_talla')->nullable();
            $table->string('fisico_ta')->nullable();
            $table->integer('fisico_fc')->nullable();
            $table->integer('fisico_fr')->nullable();
            $table->float('fisico_imc')->nullable();
            $table->timestamps();
        });     
            //exploracion craneo
        Schema::create('exploracion_craneo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade'); 
            $table->string('forma');
            $table->string('tamaño');
            $table->string('pelo');
            $table->string('cara');
            $table->timestamps();
        });   
            //exploracion cuello
        Schema::create('exploracion_cuello', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade'); 
            $table->string('ganglios');
            $table->string('movilidad');
            $table->string('tiroides');
            $table->string('pulsos');
            $table->timestamps();
        });      
            //exploracion boca
        Schema::create('exploracion_boca', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');            
            $table->string('mucosas');
            $table->string('dentadura');
            $table->string('lengua');
            $table->string('encias');
            $table->string('faringe');
            $table->string('amigdalas');
            $table->timestamps();
        });                
            //exploracion ojos
        Schema::create('exploracion_ojos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');   
            $table->string('conjuntivas');
            $table->string('pupilas');
            $table->string('parpados');
            $table->string('reflejos');
            $table->timestamps();
        });                         
            //exploracion nariz
        Schema::create('exploracion_nariz', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');   
            $table->string('tabique');
            $table->string('mucosas');
            $table->timestamps();
        });  
            //exploracion oido
        Schema::create('exploracion_oido', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');             
            $table->string('pabellon');
            $table->string('cae');
            $table->string('timpanos');
            $table->timestamps();
        });             
            //exploracion agudeza visual
        Schema::create('exploracion_agudeza_visual', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');               
            $table->string('SL');
            $table->string('CL');
            $table->timestamps();
        });                         
            //exploracion abdomen
        Schema::create('exploracion_abdomen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');     
            $table->string('megalias');
            $table->string('hernias');
            $table->timestamps();
        });        
            //exploracion torax
        Schema::create('exploracion_torax', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');   
            $table->string('forma');
            $table->string('ritmos_Cardiacos');
            $table->string('campos_pulm');
            $table->string('mamas');            
            $table->timestamps();
        });        
            //exploracion piel y anexos
        Schema::create('exploracion_piel_anexos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');
            $table->string('nevos');
            $table->string('cicatrices');
            $table->string('varices');
            $table->string('edemas');
            $table->string('micosis');
            $table->timestamps();
        });
            //exploracion genitales
        Schema::create('exploracion_genitales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');
            $table->string('fimosis');
            $table->string('varicocele');
            $table->string('hernias');
            $table->string('criptorquidias'); 
            $table->timestamps();
        });  
            //exploracion miembros toracicos
        Schema::create('exploracion_miembros_toracicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');
            $table->string('integridad');
            $table->string('integridad_observacion')->nullable();
            $table->string('forma');
            $table->string('forma_observacion')->nullable();
            $table->string('articulaciones');
            $table->string('articulaciones_observacion')->nullable();
            $table->string('tono_muscular');
            $table->string('tono_muscular_observacion')->nullable();             
            $table->string('reflejos');
            $table->string('reflejos_observacion')->nullable();
            $table->string('sensibilidad');
            $table->string('sensibilidad_observacion')->nullable();
            $table->timestamps();
        });  
            
            //exploracion miembros pelvicos
        Schema::create('exploracion_miembros_pelvicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');
            $table->string('integridad');
            $table->string('integridad_observacion')->nullable();
            $table->string('forma');
            $table->string('forma_observacion')->nullable();
            $table->string('articulaciones');
            $table->string('articulaciones_observacion')->nullable();
            $table->string('tono_muscular'); 
            $table->string('tono_muscular_observacion')->nullable();             
            $table->string('reflejos');
            $table->string('reflejos_observacion')->nullable();
            $table->string('sensibilidad');
            $table->string('sensibilidad_observacion')->nullable();
            $table->timestamps();
        });
            //columna cervical
        Schema::create('exploracion_columna_cervical', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');
            $table->string('integridad');
            $table->string('integridad_observacion')->nullable();
            $table->string('forma');
            $table->string('forma_observacion')->nullable();
            $table->string('movimientos');
            $table->string('movimientos_observacion')->nullable();
            $table->string('fuerza');
            $table->string('fuerza_observacion')->nullable();
            $table->timestamps();
        });  
            //columna dorsal
        Schema::create('exploracion_columna_dorsal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');
            $table->string('integridad');
            $table->string('integridad_observacion')->nullable();
            $table->string('forma');
            $table->string('forma_observacion')->nullable();
            $table->string('movimientos');
            $table->string('movimientos_observacion')->nullable();
            $table->string('fuerza');
            $table->string('fuerza_observacion')->nullable();
            $table->timestamps();
        });   
            //columna lumbar
        Schema::create('exploracion_columna_lumbar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');
            $table->string('integridad');
            $table->string('integridad_observacion')->nullable();
            $table->string('forma');
            $table->string('forma_observacion')->nullable();
            $table->string('movimientos');
            $table->string('movimientos_observacion')->nullable();
            $table->string('fuerza');
            $table->string('fuerza_observacion')->nullable();
            $table->timestamps();
        });                               
            //exploracion columna vertebral
        Schema::create('exploracion_columna_vertebral', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');
            $table->string('escoleosis');
            $table->string('evaluacion_escoleosis')->nullable();
            $table->string('cifosis');
            $table->string('evaluacion_cifosis')->nullable();
            $table->string('lordosis');
            $table->string('evaluacion_lordosis')->nullable();
            $table->timestamps();
        });                    
            //exploracion auxiliares diagnosticos
        Schema::create('auxiliares_diagnosticos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');
            $table->string('radiografias')->nullable();
            $table->string('torax')->nullable();
            $table->string('col_lumbar')->nullable();                   
            $table->string('laboratorio')->nullable();
            $table->string('audiometria')->nullable();
            $table->string('otros');  
            $table->timestamps();
        });             
            // Diagnóstico y Evaluaciones
        Schema::create('observaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->constrained('empleados')->onDelete('cascade');
            $table->text('diagnosticos')->nullable();
            $table->text('recomendaciones')->nullable();
            $table->string('evaluacion_satisfactoria');
            $table->date('fecha_formulario');
            $table->string('firma_formulario')->nullable();
            $table->string('salud_ocupacional')->nullable();
            $table->timestamps();
        });    

    
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departamentos');
        Schema::dropIfExists('puestos');
        Schema::dropIfExists('agentes');
        Schema::dropIfExists('empleados');
        Schema::dropIfExists('historial_laboral');
        Schema::dropIfExists('antecedentes_heredofamiliares');
        Schema::dropIfExists('antecedentes_patologicos');
        Schema::dropIfExists('antecedentes_no_patologicos');
        Schema::dropIfExists('incapacidad_por_trabajo');
        Schema::dropIfExists('incapacidad_por_enfermedad');
        Schema::dropIfExists('padece_alguna_enfermedad');
        Schema::dropIfExists('datos_fisicos');
        Schema::dropIfExists('exploracion_craneo');
        Schema::dropIfExists('exploracion_cuello');
        Schema::dropIfExists('exploracion_boca');
        Schema::dropIfExists('exploracion_ojos');
        Schema::dropIfExists('exploracion_nariz');
        Schema::dropIfExists('exploracion_oido');
        Schema::dropIfExists('exploracion_agudeza_visual');
        Schema::dropIfExists('exploracion_abdomen');
        Schema::dropIfExists('exploracion_torax');
        Schema::dropIfExists('exploracion_piel_anexos');
        Schema::dropIfExists('exploracion_genitales');
        Schema::dropIfExists('exploracion_miembros_toracicos');
        Schema::dropIfExists('exploracion_miembros_pelvicos');
        Schema::dropIfExists('exploracion_columna_cervical');
        Schema::dropIfExists('exploracion_columna_dorsal');
        Schema::dropIfExists('exploracion_columna_lumbar');
        Schema::dropIfExists('exploracion_columna_vertebral');
        Schema::dropIfExists('auxiliares_diagnosticos');
        Schema::dropIfExists('observaciones');
    }
};
