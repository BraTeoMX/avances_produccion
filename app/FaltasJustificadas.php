<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class FaltasJustificadas extends Model
{
    //
    use SoftDeletes;

    protected $table = 'faltas_justificadas';

    protected $keyType = 'integer';

    protected $fillable = [
        'id',
        'folio_falta',
        'fecha_reg',
        'fk_no_empleado',
        'fecha_inicio_justificar',
        'fecha_fin_justificar',
        'motivo_falta',
        'comentario',
        'estatus_falta',
        'firma_empleado',
        'nombre_archivo',
        'ruta_archivo'
    ];

    protected $casts = [
        'fecha_solicitado' => 'datetime',
    ];
}
