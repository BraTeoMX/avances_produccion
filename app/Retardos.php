<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Retardos extends Model
{
    //
    use SoftDeletes;

    protected $table = 'faltas';

    protected $keyType = 'integer';

    protected $fillable = [
        'id',
        'no_empleado',
        'IdHorario',
        'NomHorario',
        'fecha_falta',
        'idIncidencia',
        'TpoIncidencia',
        'FechaActualizacion',
        'TpoJustificado',
        'TpoIniIncidencia',
        'IdEmpresa',
    ];
}
