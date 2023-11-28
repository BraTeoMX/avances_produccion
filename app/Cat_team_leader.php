<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat_team_leader extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cat_team_leader';
    // En el modelo Cat_team_leader
    public function teamModulos()
    {
        return $this->hasMany(TeamModulo::class, 'team_leader', 'id');
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
        'estatus',
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
