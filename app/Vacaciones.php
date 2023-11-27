<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

/**
 * @property integer $id
 * @property string $categoria
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Vacaciones extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vacaciones2';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = [
        /*
        'IdVacaciones',
        'Folio',
        'Fecha_sol',
        'Area_emp',
        'Nombre_emp',
        'No_emp',
        'Tag_emp',
        'Turno_emp',
        'Frecuencia_emp',
        'Fecha_antig_emp',
        'Dias_disponibles',
        'Sol_dias_vac',
        'Fecha_ini_vac',
        'Fecha_fin_vac',
        'Dias_restantes'*/


        'IdVacaciones',
        'folio_vac',
        'fecha_solicitud',
        'fecha_aprobacion',
        'fk_no_empleado',
        'dias_solicitud',
        'fech_ini_vac',
        'fech_fin_vac',
        'jefe_directo',
        'periodos',
        'eventualidades',
        'excepcion',
        'status'

    ];

     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fecha_solicitado' => 'datetime',
    ];
    
}
