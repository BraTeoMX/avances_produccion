<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Incapacidades extends Model
{
    //
    use SoftDeletes;

    protected $table = 'incapacidades';

    protected $keyType = 'integer';

    protected $fillable = [
        'id',
        'folio_incapacidad',
        'fecha_registro',
        'fk_empleado',
        'fecha_inicio',
        'fecha_fin',
        'dias',
        'tipo_incapacidad',
        'ramo_seguro',
        'riesgo',
        'comentario',
        'formato_incapacidad',
        'ruta_incapacidad',
        'formato_st9',
        'ruta_st9',
        'formato_st7',
        'ruta_st7',
        'formato_st3',
        'ruta_st3',
        'oficioentregado',
        'formato_alta',
        'ruta_alta',
    ];
}
