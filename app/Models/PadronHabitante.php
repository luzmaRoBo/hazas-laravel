<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PadronHabitante extends Model
{
    protected $table = 'padronhabitantes';

    protected $primaryKey = 'idHabitante';

    public $incrementing = false;

    protected $keyType = 'string';

    /**
     * como no usamos created_at ni updated_at desactivamos los timestamps
     */
    public $timestamps = false;

    protected $fillable = [
        'idHabitante',
        'apellido1',
        'apellido2',
        'nombre',
        'domicilioOriginal',
        'tipoDireccion',
        'nombreDireccion',
        'numeroDireccion',
        'bloqueDireccion',
        'escaleraDireccion',
        'piso',
        'puerta',
        'codigoPostal',
        'excluido',
        'fechaExclusion',
        'observaciones',
    ];
}
