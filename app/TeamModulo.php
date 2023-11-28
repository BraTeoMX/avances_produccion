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
        return $this->belongsTo(Cat_team_leader::class, 'id', 'id');
    }

    public function catModulo()
    {
        return $this->belongsTo(Cat_modulos::class, 'id', 'id');
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
