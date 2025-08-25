<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Haza extends Model
{
    //el nombre de la tabla
    protected $table = 'hazas';
    //datos sobre la clave primaria
    protected $primaryKey = 'idHaza';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * como no usamos created_at ni updated_at desactivamos los timestamps
     */
    public $timestamps = false;

    //campos que se pueden asignar de la tabla
    protected $fillable = [
        'idHaza',
        'nHaza',
        'partido',
        'hectareas',
        'rentaAnual',
        'uso',
        'localizacion',
        'caballerizas',
        'fechaInicio',
        'fechaFin',
    ];


}
