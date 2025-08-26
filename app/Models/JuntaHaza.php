<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JuntaHaza extends Model
{
    // Nombre de la tabla
    protected $table = 'juntaHazas';

    // Clave primaria
    protected $primaryKey = 'idJuntaHazas';
    public $incrementing = false;
    protected $keyType = 'string';

    // Desactivamos timestamps
    public $timestamps = false;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'idJuntaHazas',
        'nombre',
        'apellido1',
        'apellido2',
        'tipoParticipante',
    ];
}
