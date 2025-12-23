<?php

namespace App\Modules\Bsc\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Indicator extends Model
{
    use HasFactory;

    protected $table = 'indicators';
    protected $fillable = ['subprocess_id', 'name', 'data'];

    protected $casts = [
        'data' => 'array'
    ];

    public function subprocess()
    {
        return $this->belongsTo(Subprocess::class);
    }

    public function setDataAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['data'] = json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        } else {
            $this->attributes['data'] = $value;
        }
    }
}
