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
class FormatoPermisos extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permisos';

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

        'IdPermiso',
        'folio_per',
        'fecha_solicitud',
        'fecha_aprobacion',
        'fk_no_empleado',
        'tipo_per',
        'fech_ini_per',
        'fech_fin_per',
        'dias',
        'fech_ini_hor',
        'fech_fin_hor',
        'horas',
        'hora_comida',
        'jefe_directo',
        'status',
        'obs'

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
