<?php

namespace App\Modules\Residuos\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaProcedencia extends Model
{
    use HasFactory;

    protected $table = 'areas_procedencia'; 

    protected $fillable = ['nombre'];
}
