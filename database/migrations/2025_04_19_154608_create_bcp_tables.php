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
        Schema::create('catalogo', function (Blueprint $table) {
            $table->integer('N_Hab')->primary(); // clave primaria
            $table->string('Tp_Hab', 15);
            $table->string('Edificio', 15);
            $table->integer('Piso');
            $table->integer('Cred_Pasaje');
            $table->integer('Cred_Salida');
            $table->string('Secciones', 100)->nullable();
            $table->string('Status', 10)->nullable()->index();
        });
        Schema::create('asignadas', function (Blueprint $table) {
            $table->string('Sal_Pre', 5)->nullable();
            $table->integer('N_Hab')->nullable();
            $table->string('Tp_Hab', 25)->nullable();
            $table->integer('Piso')->nullable();
            $table->string('Status', 25)->nullable();
            $table->string('Tpo', 25)->nullable();
            $table->integer('AD')->nullable();
            $table->integer('MN')->nullable();
            $table->integer('Creds')->nullable();
            $table->string('Titular', 255)->nullable();
            $table->string('Camarista', 255)->nullable();
            $table->date('Fecha')->nullable();
            $table->time('Hora')->nullable();
        });
        Schema::create('creditos', function (Blueprint $table) {
            $table->string('id_creditos', 30)->primary();
            $table->integer('creditos');
        });
        Schema::create('llegadas', function (Blueprint $table) {
            $table->string('Cve_Reserv', 25)->primary();
            $table->string('Nombre', 255)->nullable();
            $table->string('C', 25)->nullable();
            $table->string('Tpo', 25)->nullable();
            $table->string('G', 25)->nullable();
            $table->string('Seg', 25)->nullable();
            $table->string('THab', 25)->nullable();
            $table->tinyInteger('Hb')->nullable();
            $table->string('P', 6)->nullable();
            $table->integer('NHab')->nullable();
            $table->string('Plan', 255)->nullable();
            $table->string('TP', 15)->nullable();
            $table->string('In', 25)->nullable();
            $table->tinyInteger('Valor_A')->nullable();
            $table->tinyInteger('Valor_N')->nullable();
            $table->tinyInteger('Valor_J')->nullable();
            $table->tinyInteger('Valor_MG')->nullable();
            $table->tinyInteger('Valor_I')->nullable();
            $table->date('FechaSal')->nullable();
            $table->tinyInteger('Noc')->nullable();
            $table->string('Edo', 25)->nullable();
            $table->string('FPgo', 6)->nullable();
            $table->decimal('Tarifa', 10, 2)->nullable();
            $table->string('Agencia', 50)->nullable();
            $table->string('Grupo', 255)->nullable();
            $table->string('Compania', 255)->nullable();
            $table->string('MensajesRecepcion', 255)->nullable();
            $table->string('Cod_Reserva', 10)->nullable();
            $table->string('PreCheckInWeb', 25)->nullable();
            $table->date('FechaLlegada')->nullable();
            $table->string('Mail', 255)->nullable();
            $table->string('Calle_Colonia', 255)->nullable();
            $table->string('Municipio_Ciudad', 25)->nullable();
            $table->string('Estado', 25)->nullable();
            $table->char('CP', 5)->nullable();
            $table->string('Telefono', 15)->nullable();
            $table->string('Brasalete', 25)->nullable();
            $table->string('LateCheckOut', 3)->nullable();
            $table->float('Pax')->nullable();
            $table->decimal('CreditoInicial', 10, 2)->nullable();
            $table->decimal('CreditoDisponible', 10, 2)->nullable();
        });
        Schema::create('tipo_status', function (Blueprint $table) {
            $table->string('Codigo', 10)->primary();
            $table->string('Nombre', 200);
            $table->string('Color', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogo');
        Schema::dropIfExists('asignadas');
        Schema::dropIfExists('creditos');
        Schema::dropIfExists('llegadas');
        Schema::dropIfExists('tipo_status');
    }
};
