<?php

namespace App\Modules\Bsc\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class subprocess extends Model
{
    use HasFactory;
    protected $table = 'subprocesses';

    protected $fillable = ['process_id', 'name'];

    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function indicators()
    {
        return $this->hasMany(Indicator::class);
    }
}
