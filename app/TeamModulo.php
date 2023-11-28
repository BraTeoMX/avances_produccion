<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamModulo extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'team_modulo';
    // En el modelo TeamModulo
    public function catTeamLeader()
    {   
                                                // 'team_leader' es la columna de la tabla "team_modulo" donde el valor que tiene se vincula con
                                                // 'id' que es la columna de la tabla "cat_team_leader" si ambos valores existen, entonces se mostrara 
                                                // en este caso el nombre asignado al valor numerico
        return $this->belongsTo(Cat_team_leader::class, 'team_leader', 'id');
    }

    public function catModulo()
    {
        return $this->belongsTo(Cat_modulos::class, 'modulo', 'id');
    }

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
        'team_leader',
        'modulo',
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
