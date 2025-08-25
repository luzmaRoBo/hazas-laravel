<?php

namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table = 'usuarios';

    //datos sobre la clave primaria
    protected $primaryKey = 'idUsuario';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * como no usamos created_at ni updated_at desactivamos los timestamps
     */
    public $timestamps = false;

    //campos que se pueden asignar de la tabla
    protected $fillable = ['idUsuario','usuario','pass','rol'];

    //funcion para asignar un id por defecto
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($usuario) {
            if (empty($usuario->idUsuario)) {
                $usuario->idUsuario = Str::random(10);
            }
        });
    }

}
