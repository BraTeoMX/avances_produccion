<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_Empleado_SIA extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Tbl_Empleados_SIA';

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
        
        'ID_Empleado',
        'Id_Planta',
        'No_Empleado',
        'No_TAG',
        'Modulo',
        'Ap_Pat',
        'Ap_Mat',
        'Nom_Emp',
        'Rfc_Emp',
        'Curp_Emp',
        'Ine_emp',
        'Email_Emp',
        'Status_Emp',
        'Fecha_In',
        'Fecha_Eg',
        'Puesto',
        'Departamento',
        'Frec_Pago',
        'Dias_pago',
        'deleted_at'
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
