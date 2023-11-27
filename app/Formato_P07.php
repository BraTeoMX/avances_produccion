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
class Formato_P07 extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'formato_p07';

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
        'fecha_inical',
        'fecha_final',
        'planta',
        'cliente',
        'modulo',
        'cantidad_d1',
        'eficiencia_d1',
        'minutos_prod_d1',
        'minutos_100_d1',
        'cantidad_d2',
        'eficiencia_d2',
        'minutos_prod_d2',
        'minutos_100_d2',
        'cantidad_d3',
        'eficiencia_d3',
        'minutos_prod_d3',
        'minutos_100_d3',
        'cantidad_d4',
        'eficiencia_d4',
        'minutos_prod_d4',
        'minutos_100_d4',
        'cantidad_d5',
        'eficiencia_d5',
        'minutos_prod_d5',
        'minutos_100_d5',
        
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
