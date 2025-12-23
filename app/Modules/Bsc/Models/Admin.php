<?php

namespace App\Modules\Bsc\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins'; // Nombre de la tabla

    protected $fillable = ['usuario', 'password', 'role']; // Campos que se pueden modificar    

    protected $hidden = ['password']; // Oculta la contraseña

    protected $casts = [
        'password' => 'hashed', // encriptar la contraseña debido a que laravel 8 ya no lo hace automaticamente utilizando bycrypt
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}


