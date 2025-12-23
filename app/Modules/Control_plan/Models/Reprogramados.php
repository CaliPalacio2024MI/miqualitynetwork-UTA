<?php

//namespace App\Models;
namespace App\Modules\Control_plan\Models;

use Illuminate\Database\Eloquent\Model;

class Reprogramados extends Model
{
    protected $table = 'reprogramados';

    protected $primaryKey = 'id_rep';

    public $timestamps = false; 
    protected $fillable = [
        'fecha_anterior',
        'fecha_reprog',
        'motivo'
    ];
}
