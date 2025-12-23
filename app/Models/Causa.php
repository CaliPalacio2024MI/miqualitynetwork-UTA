<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Causa extends Model
{
    protected $fillable = ['nombre'];
    // Si tu tabla no se llama "causas", añade: protected $table = 'nombredetabla';
}