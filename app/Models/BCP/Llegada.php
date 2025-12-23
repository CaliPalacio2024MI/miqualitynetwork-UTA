<?php

namespace App\Models\BCP;

use Illuminate\Database\Eloquent\Model;

class Llegada extends Model
{
    protected $table = 'llegadas';
    protected $primaryKey = 'Cve_Reserv';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'Cve_Reserv', 'Nombre', 'C', 'Tpo', 'G', 'Seg', 'THab', 'Hb', 'P', 'NHab',
        'Plan', 'TP', 'In', 'Valor_A', 'Valor_N', 'Valor_J', 'Valor_MG', 'Valor_I',
        'FechaSal', 'Noc', 'Edo', 'FPgo', 'Tarifa', 'Agencia', 'Grupo', 'Compania',
        'MensajesRecepcion', 'Cod_Reserva', 'PreCheckInWeb', 'FechaLlegada', 'Mail',
        'Calle_Colonia', 'Municipio_Ciudad', 'Estado', 'CP', 'Telefono', 'Brasalete',
        'LateCheckOut', 'Pax', 'CreditoInicial', 'CreditoDisponible'
    ];
}
