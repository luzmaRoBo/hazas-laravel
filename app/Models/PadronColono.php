<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PadronColono extends Model
{
    // Nombre de la tabla
    protected $table = 'padronColonos';

    // Datos sobre la clave primaria
    protected $primaryKey = 'idColono';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Desactivamos los timestamps (created_at, updated_at)
     */
    public $timestamps = false;

    // Campos que se pueden asignar de la tabla
    protected $fillable = [
        'idColono',
        'apellido1',
        'apellido2',
        'nombre',
        'apodo',
        'dni',
        'telefono',
        'email',
        'idJuntaHazas',
        'idHabitante',
        'tipoDireccion',
        'nombreDireccion',
        'numeroDireccion',
        'bloqueDireccion',
        'escaleraDireccion',
        'piso',
        'puerta',
        'codigoPostal',
    ];
}
