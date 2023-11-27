<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planeacion extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'planeacion';

    public function teamLeader()
    {
        return $this->belongsTo(Cat_team_leader::class, 'team_leader', 'id');
    }

    public function planeacionesDiarias()
    {
        return $this->belongsTo(Planeacion_diaria::class, 'id','id_planeacion','piezas_10','efic_10','min_prod_10','proy_min_10');
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
        'modulo'
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
