<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivilegiosCarpetas extends Model
{
    use HasFactory;

    protected $table = 'privilegios_carpetas';

    protected $fillable = ['user_id', 'carpeta_id'];

    public function user()
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}

public function carpeta()
{
    return $this->belongsTo(Carpetas::class, 'carpeta_id', 'id');
}
}
