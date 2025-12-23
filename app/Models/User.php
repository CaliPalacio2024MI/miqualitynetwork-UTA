<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\PrivilegiosCarpetas;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'name',
        'apellido_paterno',
        'rfc',
        'password',
        'departamento',
        'propiedad_id',
    ];
    public function propiedad()
    {
        return $this->belongsTo(Propiedades::class, 'propiedad_id', 'id_propiedad');
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Get the column used to authenticate the user.
     *
     * @return string
     */
    public function username(): string
    {
        return 'rfc'; // aqui se indica que el campo RFC será utilizado como identificador
    }
    public function privilegios()
    {
        return $this->hasOne('App\Models\Privilegios', 'user_id', 'id');
    }

    public function carpetasAccesibles()
    {
        return $this->belongsToMany(
            Carpetas::class, // Modelo relacionado
            'privilegios_carpetas', // Nombre de la tabla pivote
            'user_id', // Llave foránea en la tabla pivote que referencia al usuario
            'carpeta_id' // Llave foránea en la tabla pivote que referencia a la carpeta
        );
    }
}
