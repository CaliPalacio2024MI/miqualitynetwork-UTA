<?php

namespace App\Modules\Bsc\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class CustomUser extends Authenticatable
{
    use HasFactory;

    protected $table = 'custom_users';// tabla personalizada de usuarios

    protected $fillable = [
        'name',
        'password',
        'property_id',
        'is_active',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed', // encriptar la contraseña debido a que laravel 8 ya no lo hace automaticamente utilizando bycrypt
    ];

    public function isUser()
    {
        return $this->role === 'user';
    }

    // Relación con la propiedad
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
