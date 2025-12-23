<?php

namespace App\Modules\Bsc\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(CustomUser::class, 'property_id');
    }
    public function objetivos(): HasMany
    {
        return $this->hasMany(Objetivo::class);
    }
}
