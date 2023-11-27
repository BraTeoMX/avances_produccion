<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datos_planeacion_diaria extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'datos_planeacion_diaria';

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
        
        'id',
        'id_planeacion',
        'piezas_10',
        'efic_10',
        'min_prod_10',
        'proy_min_10'
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
