<?php

namespace App\Modules\Control_energeticos\Models;

use Illuminate\Database\Eloquent\Model;
use App\Core\Models\Energetico; // Asegúrate de que este namespace sea correcto

class Controlenergeticos extends Model
{
    protected $table = 'control_energeticos_tables';
    
    protected $fillable = [
        'nombre', 
        'unidad',
        'modulo',
        'color',
        'energetico_id'
    ];
    
    public function energetico()
    {
        return $this->belongsTo(Energetico::class, 'energetico_id');
    }
    
    public static function getByModulo($modulo)
    {
        return self::where('modulo', $modulo)->get();
    }
}