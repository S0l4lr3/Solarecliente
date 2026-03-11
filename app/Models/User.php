<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'correo',
        'contrasena',
        'rol_id',
        'token_recuerdo',
        'correo_verificado_en'
    ];

    protected $hidden = [
        'contrasena',
        'token_recuerdo',
    ];

    protected function casts(): array
    {
        return [
            'correo_verificado_en' => 'datetime',
            'creado_en' => 'datetime',
            'actualizado_en' => 'datetime',
        ];
    }

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function getRememberToken()
    {
        return $this->token_recuerdo;
    }

    public function setRememberToken($value)
    {
        $this->token_recuerdo = $value;
    }

    public function getRememberTokenName()
    {
        return 'token_recuerdo';
    }
}