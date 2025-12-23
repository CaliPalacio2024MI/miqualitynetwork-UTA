<?php

namespace App\Modules\Historial_clinico\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';  // Este es el nombre correcto de la tabla 'empleados'

    protected $fillable = [
        'razon_social',
        'no_zapato',
        'talla_playera',
        'talla_pantalon',
        'tel_emergencia',
        'nombre',
        'edad',
        'genero',
        'estado_civil',
        'fecha_nacimiento',
        'direccion',
        'telefono',
        'escolaridad',
        'departamento',
        'puesto_aspirante',
    ];
    public function historialLaboral()
{
    return $this->hasMany(HistorialLaboral::class, 'empleados_id');
}
public function heredoFamiliares()
{
    return $this->hasOne(HeredoFamiliares::class, 'empleados_id');
}
public function personalesPatologicos()
{
    return $this->hasOne(PersonalesPatologicos::class, 'empleados_id');
}
public function personalesNoPatologicos()
{
    return $this->hasOne(PersonalesNoPatologicos::class, 'empleados_id');
}
public function riesgoTrabajo()
{
    return $this->hasOne(RiesgoTrabajo::class, 'empleados_id');
}
public function riesgoEnfermedad()
{
    return $this->hasOne(RiesgoEnfermedad::class, 'empleados_id');
}
public function padece_Enfermedad()
{
    return $this->hasOne(Padece_Enfermedad::class, 'empleados_id');
}
public function exploracionDatosFisicos()
{
    return $this->hasOne(ExploracionDatosFisicos::class, 'empleados_id');
}
public function exploracionFisicaCraneo()
{
    return $this->hasOne(ExploracionFisicaCraneo::class, 'empleados_id');
}
public function exploracionFisicaCuello()
{
    return $this->hasOne(ExploracionFisicaCuello::class, 'empleados_id');
}
public function exploracionFisicaBoca()
{
    return $this->hasOne(ExploracionFisicaBoca::class, 'empleados_id');
}
public function exploracionFisicaOjos()
{
    return $this->hasOne(ExploracionFisicaOjos::class, 'empleados_id');
}
public function exploracionFisicaNariz()
{
    return $this->hasOne(ExploracionFisicaNariz::class, 'empleados_id');
}
public function exploracionFisicaOidos()
{
    return $this->hasOne(ExploracionFisicaOidos::class, 'empleados_id');
}
public function exploracionFisicaVisual()
{
    return $this->hasOne(ExploracionFisicaVisual::class, 'empleados_id');
}
public function exploracionFisicaAbdomen()
{
    return $this->hasOne(ExploracionFisicaAbdomen::class, 'empleados_id');
}
public function exploracionFisicaTorax()
{
    return $this->hasOne(ExploracionFisicaTorax::class, 'empleados_id');
}
public function exploracionFisicaPiel()
{
    return $this->hasOne(ExploracionFisicaPiel::class, 'empleados_id');
}
public function exploracionFisicaGenitales()
{
    return $this->hasOne(ExploracionFisicaGenitales::class, 'empleados_id');
}
public function exploracionFisicaMiembroToracico()
{
    return $this->hasOne(ExploracionFisicaMiembroToracico::class, 'empleados_id');
}
public function exploracionFisicaMiembroPelvico()
{
    return $this->hasOne(ExploracionFisicaMiembroPelvico::class, 'empleados_id');
}
public function exploracionFisicaColumnaCervical()
{
    return $this->hasOne(ExploracionFisicaColumnaCervical::class, 'empleados_id');
}
public function exploracionFisicaColumnaDorsal()
{
    return $this->hasOne(ExploracionFisicaColumnaDorsal::class, 'empleados_id');
}
public function exploracionFisicaColumnaLumbar()
{
    return $this->hasOne(ExploracionFisicaColumnaLumbar::class, 'empleados_id');
}
public function exploracionFisicaColumnaVertebral()
{
    return $this->hasOne(ExploracionFisicaColumnaVertebral::class, 'empleados_id');
}
public function auxiliarDiagnostico()
{
    return $this->hasOne(AuxiliarDiagnostico::class, 'empleados_id');
}
public function observacion()
{
    return $this->hasOne(Observacion::class, 'empleados_id');
}
}
