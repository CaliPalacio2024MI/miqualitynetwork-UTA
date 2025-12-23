<?php

namespace App\Models\BCP;

use Illuminate\Database\Eloquent\Model;

class Creditos extends Model
{
    protected $table = 'creditos';

    protected $primaryKey = 'id_creditos';

    public $timestamps = false;

    protected $fillable = [
        'creditos'
    ];
}
