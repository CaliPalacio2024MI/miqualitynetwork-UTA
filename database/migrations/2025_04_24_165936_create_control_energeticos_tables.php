<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones (operación de avance)
     */
    public function up()
    {
        // Primero verificamos si la tabla existe
        if (!Schema::hasTable('control_energeticos_tables')) {
            // Si no existe, la creamos con todos los campos necesarios
            Schema::create('control_energeticos_tables', function (Blueprint $table) {
                $table->id();
                $table->string('nombre');
                $table->string('unidad');
                $table->string('modulo');
                $table->string('color', 7)->default('#3490dc');
                $table->timestamps();
            });

            // Insertamos datos iniciales solo si creamos la tabla
            DB::table('control_energeticos_tables')->insert([
                [
                    'nombre' => 'Electricidad',
                    'unidad' => 'kWh',
                    'modulo' => 'energia',
                    'color' => '#FFD700',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nombre' => 'Gasolina',
                    'unidad' => 'Litros',
                    'modulo' => 'aire',
                    'color' => '#FF6347',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nombre' => 'Agua',
                    'unidad' => 'm³',
                    'modulo' => 'agua',
                    'color' => '#1E90FF',
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
        } else {
            // Si la tabla ya existe, solo agregamos las columnas que faltan
            
            // Verificamos y agregamos columna 'color' si no existe
            if (!Schema::hasColumn('control_energeticos_tables', 'color')) {
                Schema::table('control_energeticos_tables', function (Blueprint $table) {
                    $table->string('color', 7)->default('#3490dc')->after('modulo');
                });
            }

            // Verificamos y agregamos columna 'unidad' si no existe
            if (!Schema::hasColumn('control_energeticos_tables', 'unidad')) {
                Schema::table('control_energeticos_tables', function (Blueprint $table) {
                    $table->string('unidad')->after('nombre');
                });
            }
        }
    }

    /**
     * Revierte las migraciones (operación de rollback)
     * 
     * NOTA: En producción es recomendable no tener operaciones destructivas
     *       en el método down(). Esto es solo para desarrollo.
     */
    public function down()
    {
        // Solo ejecutamos en entorno de desarrollo
        if (app()->environment('local')) {
            // Eliminamos las columnas agregadas (si existen)
            Schema::table('control_energeticos_tables', function (Blueprint $table) {
                if (Schema::hasColumn('control_energeticos_tables', 'color')) {
                    $table->dropColumn('color');
                }
                
                if (Schema::hasColumn('control_energeticos_tables', 'unidad')) {
                    $table->dropColumn('unidad');
                }
            });

            // OPCIONAL: Si quieres eliminar completamente la tabla en desarrollo
            // Schema::dropIfExists('control_energeticos_tables');
        }
    }
};