<?php

namespace App\Modules\Bsc\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Propiedades;
class process extends Model
{
    protected $table = 'processes';
    
    protected $fillable = [
        'name',
        'parent_id',
        'id_propiedad'
    ];
    
    /**
     * Relación con la propiedad
     */
    public function propiedad(): BelongsTo
    {
        return $this->belongsTo(Propiedades::class, 'id_propiedad', 'id_propiedad');
    }
    
    /**
     * Relación con subprocesos
     */
    public function subprocesses(): HasMany
    {
        return $this->hasMany(Subprocess::class);
    }
}
