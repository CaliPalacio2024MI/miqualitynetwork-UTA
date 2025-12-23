<?php

//namespace App\Models;
namespace App\Modules\Control_plan\Models;


use Illuminate\Database\Eloquent\Model;

class Planes extends Model
{
    protected $table = 'planes';

    protected $primaryKey = 'id_plan';

    public $timestamps = false; 
    protected $fillable = [
        'rfc',
        'no',
        'origen',
        'propiedad',
        'responsable'
    ];

    public function acciones()
    {
        return $this->hasMany(Acciones::class, 'id_plan');
    }
}
