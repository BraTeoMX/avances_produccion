<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sorteo extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sorteo';

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
        'No_empleado',
        'nombre',
        'numero_sorteo'
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
