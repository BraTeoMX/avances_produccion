<?php

namespace App\Http\Controllers;

use App\Vacaciones;
use App\FormatoPermisos;
use App\FaltasJustificadas;
use App\Incapacidades;
use App\Tbl_Empleado_SIA;
use App\Puestos;
use App\Departamentos;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;

use DB;

class VPRHController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $inicio='';
        $fin ='';

        $departamento = DB::table('cat_edo_neg')
                      ->where('vp','VPRH')
                      ->groupby('des_edo_neg')
                     ->get(['des_edo_neg']);

        $vacacionesEvenVPRH= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->sum('eventualidades');   
                       
        $vacacionesPerVPRH= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->sum('periodos');

        $vacacionesExcVPRH= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->sum('excepcion');

        $vacacionesDDVPRH= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->sum('dias_solicitud');

        $permisosDCSVPRH= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->join('cat_permisos','cat_permisos.id_permiso','=','permisos.tipo_per')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->where('forma',1)->count ();

        $permisosDSSVPRH= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->join('cat_permisos','cat_permisos.id_permiso','=','permisos.tipo_per')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->where('forma',2)->count ();

        $permisosHCSVPRH= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->join('cat_permisos','cat_permisos.id_permiso','=','permisos.tipo_per')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->where('forma',3)->count ();

        $permisosHSSVPRH= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->join('cat_permisos','cat_permisos.id_permiso','=','permisos.tipo_per')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->where('forma',4)->count ();

        $faltasM1VPRH= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->where('motivo_falta',1)->count ();    
                       
        $faltasM2VPRH= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->where('motivo_falta',2)->count ();         
        
        $faltasM3VPRH= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->where('motivo_falta',3)->count ();         

        $faltasM4VPRH= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->where('motivo_falta',4)->count ();         

        $faltasM5VPRH= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->where('motivo_falta',5)->count ();         

        $faltasM6VPRH= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->where('motivo_falta',6)->count ();         
  

        $incapacidadesDDVPRH= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->sum('dias');

        $incapacidadesIVPRH= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->where('tipo_incapacidad',1)->count ();   
                       
        $incapacidadesSVPRH= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->where('tipo_incapacidad',2)->count ();      

                       

        $perVPRH=Tbl_Empleado_SIA::join('cat_edo_neg','cat_edo_neg.edo_neg','=','Tbl_Empleados_SIA.cveci2')
                     ->whereNULL('Fecha_Eg')
                     ->where('vp','VPRH')
                     ->distinct('id_empleado')
                     ->select(DB::raw('des_edo_neg, count(distinct tbl_empleados_sia.id_empleado) as perVPRH'))      
                     ->groupby('des_edo_neg')
                     ->get(['des_edo_neg']);     
         

        $departamentoV= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->select(DB::raw('des_edo_neg, count(distinct vacaciones2.IdVacaciones) as vac, sum(vacaciones2.dias_solicitud) as vacdias'))      
                       ->groupby('des_edo_neg')
                       ->get(['des_edo_neg']);                  

        $departamentoP= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPRH')
                      ->select(DB::raw('des_edo_neg, count(distinct permisos.IdPermiso) as per, sum(permisos.dias) as perdias'))   
                      ->groupby('des_edo_neg')
                      ->get(['des_edo_neg']);                 

        $departamentoFJ= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->select(DB::raw('des_edo_neg, count(distinct faltas_justificadas.id) as fal'))      
                     ->groupby('des_edo_neg')
                     ->get(['des_edo_neg']);                     

        $departamentoI= DB::table('incapacidades')
                    ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                        $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                    })
                    ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                    ->where('cat_edo_neg.vp','=','VPRH')
                    ->select(DB::raw('des_edo_neg, count(distinct incapacidades.id) as inc, sum(incapacidades.dias) as incdias'))      
                    ->groupby('des_edo_neg')
                    ->get(['des_edo_neg']);       
                    
        $departamentoR= DB::table('faltas')
                    ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                    })
                    ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                    ->where('cat_edo_neg.vp','=','VPRH')
                    ->where('IdJustificacion','Retardo')->where('fecha_falta','>=','2023-01-01')
                    ->select(DB::raw('des_edo_neg, count(distinct faltas.id) as ret'))      
                    ->groupby('des_edo_neg')
                    ->get(['des_edo_neg']);     

        $departamentoFI= DB::table('faltas')
                    ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                    })
                    ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                    ->where('cat_edo_neg.vp','=','VPRH')
                    ->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->where('faltas.fecha_falta','>=','2023-01-01')->where('fecha_falta','<=',date('Y-m-d'))
                    ->select(DB::raw('des_edo_neg, count(distinct faltas.id) as fi'))      
                    ->groupby('des_edo_neg')
                    ->get(['des_edo_neg']);                 

                     
        $vacacionesVPRH= DB::table('vacaciones2')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPRH')
        ->groupby('vacaciones2.IdVacaciones')
        ->get(['vacaciones2.IdVacaciones']);

        $vacacionesVPRH = $vacacionesVPRH->unique('IdVacaciones');

        $vacacionesVPRH=$vacacionesVPRH->count();

        $permisosVPRH= DB::table('permisos')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPRH')
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);

        $permisosVPRH = $permisosVPRH->unique('IdPermiso');

        $permisosVPRH=$permisosVPRH->count();

        $faltasjustificadasVPRH= DB::table('faltas_justificadas')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPRH')
        ->groupby('faltas_justificadas.id')
        ->get(['faltas_justificadas.id']);

        $faltasjustificadasVPRH = $faltasjustificadasVPRH->unique('id');

        $faltasjustificadasVPRH=$faltasjustificadasVPRH->count();

        $incapacidadesVPRH= DB::table('incapacidades')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPRH')
        ->groupby('incapacidades.id')
        ->get(['incapacidades.id']);
    
        $incapacidadesVPRH = $incapacidadesVPRH->unique('id');
   
        $incapacidadesVPRH=$incapacidadesVPRH->count();

        $retardosVPRH= DB::table('faltas')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPRH')
        ->where('IdJustificacion','Retardo')->where('fecha_falta','>=','2023-01-01')
        ->groupby('faltas.id')
        ->get(['faltas.id']);

        $retardosVPRH = $retardosVPRH->unique('id');

        $retardosVPRH=$retardosVPRH->count();

        $faltasinjustificadasVPRH= DB::table('faltas')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPRH')
        ->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->where('faltas.fecha_falta','>=','2023-01-01')->where('fecha_falta','<=',date('Y-m-d'))
        ->groupby('faltas.id')
        ->get(['faltas.id']);

        $faltasinjustificadasVPRH = $faltasinjustificadasVPRH->unique('id');

        $faltasinjustificadasVPRH=$faltasinjustificadasVPRH->count();

        $vacacionesVPRHA= DB::table('vacaciones2')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPRH')
        ->groupby('vacaciones2.IdVacaciones')
        ->get(['vacaciones2.IdVacaciones']);

        $vacacionesVPRHA = $vacacionesVPRHA->unique('IdVacaciones');
        $vacacionesVPRHA=$vacacionesVPRHA->count();

        $vacacionesVPRHD= DB::table('vacaciones2')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPRH')
        ->where('vacaciones2.status','Denegado')
        ->groupby('vacaciones2.IdVacaciones')
        ->get(['vacaciones2.IdVacaciones']);

        $vacacionesVPRHD = $vacacionesVPRHD->unique('IdVacaciones');
        $vacacionesVPRHD=$vacacionesVPRHD->count();

        $vacacionesVPRHP= DB::table('vacaciones2')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPRH')
        ->where('vacaciones2.status','Pendiente')
        ->groupby('vacaciones2.IdVacaciones')
        ->get(['vacaciones2.IdVacaciones']);

        $vacacionesVPRHP = $vacacionesVPRHP->unique('IdVacaciones');
        $vacacionesVPRHP=$vacacionesVPRHP->count();

        $vacacionesVPRHC= DB::table('vacaciones2')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPRH')
        ->where('vacaciones2.status','Cancelado')
        ->groupby('vacaciones2.IdVacaciones')
        ->get(['vacaciones2.IdVacaciones']);

        $vacacionesVPRHC = $vacacionesVPRHC->unique('IdVacaciones');
        $vacacionesVPRHC=$vacacionesVPRHC->count();

        $permisosVPRHA= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPRH')
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);

        $permisosVPRHA = $permisosVPRHA->unique('IdPermiso');
        $permisosVPRHA=$permisosVPRHA->count();

        $permisosVPRHD= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPRH')
        ->where('permisos.status','Denegado')
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);

        $permisosVPRHD = $permisosVPRHD->unique('IdPermiso');
        $permisosVPRHD=$permisosVPRHD->count();
       
        $permisosVPRHP= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPRH')
        ->where('permisos.status','Pendiente')
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);

        $permisosVPRHP = $permisosVPRHP->unique('IdPermiso');
        $permisosVPRHP=$permisosVPRHP->count();
       
        $permisosVPRHC= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPRH')
        ->where('permisos.status','Cancelado')
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);

        $permisosVPRHC = $permisosVPRHC->unique('IdPermiso');
        $permisosVPRHC=$permisosVPRHC->count();

        

        
          /***********  VACACIONES X MES ************************* */
          $anio = date('Y');
    
          $departamentoV01= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_vac','=','1')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV02= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_vac','=','2')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV03= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_vac','=','3')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV04= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_vac','=','4')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV05= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_vac','=','5')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV06= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_vac','=','6')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV07= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_vac','=','7')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV08= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_vac','=','8')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV09= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_vac','=','9')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV10= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_vac','=','10')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV11= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_vac','=','11')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV12= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_vac','=','12')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   

            $departamentoP01= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_per','=','1')
                       ->whereYear('fech_ini_per','=',$anio)->count();
            $departamentoP02= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_per','=','2')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP03= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_per','=','3')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP04= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_per','=','4')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP05= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_per','=','5')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP06= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_per','=','6')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP07= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_per','=','7')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP08= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_per','=','8')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP09= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_per','=','9')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP10= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_per','=','10')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP11= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_per','=','11')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP12= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fech_ini_per','=','12')
                       ->whereYear('fech_ini_per','=',$anio)->count();    
            $departamentoFJ01= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio_justificar','=','1')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
            $departamentoFJ02= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio_justificar','=','2')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
            $departamentoFJ03= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio_justificar','=','3')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
            $departamentoFJ04= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio_justificar','=','4')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
            $departamentoFJ05= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio_justificar','=','5')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
            $departamentoFJ06= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio_justificar','=','6')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
            $departamentoFJ07= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio_justificar','=','7')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
            $departamentoFJ08= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio_justificar','=','8')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
            $departamentoFJ09= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio_justificar','=','9')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
            $departamentoFJ10= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio_justificar','=','10')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
            $departamentoFJ11= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio_justificar','=','11')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count();
            $departamentoFJ12= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio_justificar','=','12')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count();              
            $departamentoI01= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio','=','01')
                       ->whereYear('fecha_inicio','=',$anio)->count();   
            $departamentoI02= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio','=','02')
                       ->whereYear('fecha_inicio','=',$anio)->count();  
            $departamentoI03= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio','=','03')
                       ->whereYear('fecha_inicio','=',$anio)->count();  
            $departamentoI04= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio','=','04')
                       ->whereYear('fecha_inicio','=',$anio)->count();  
            $departamentoI05= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio','=','05')
                       ->whereYear('fecha_inicio','=',$anio)->count();  
            $departamentoI06= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio','=','06')
                       ->whereYear('fecha_inicio','=',$anio)->count();  
            $departamentoI07= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio','=','07')
                       ->whereYear('fecha_inicio','=',$anio)->count();  
            $departamentoI08= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio','=','08')
                       ->whereYear('fecha_inicio','=',$anio)->count();  
            $departamentoI09= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio','=','09')
                       ->whereYear('fecha_inicio','=',$anio)->count();  
            $departamentoI10= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio','=','10')
                       ->whereYear('fecha_inicio','=',$anio)->count();  
            $departamentoI11= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio','=','11')
                       ->whereYear('fecha_inicio','=',$anio)->count();  
            $departamentoI12= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPRH')
                       ->whereMonth('fecha_inicio','=','12')
                       ->whereYear('fecha_inicio','=',$anio)->count();             
           

        return view('VPRH.index', compact('departamento','departamentoV','departamentoP','departamentoFJ','departamentoI','vacacionesVPRH','permisosVPRH','faltasjustificadasVPRH','incapacidadesVPRH','vacacionesVPRHA','vacacionesVPRHD','vacacionesVPRHP','vacacionesVPRHC','permisosVPRHA','permisosVPRHD','permisosVPRHP','permisosVPRHC','inicio','fin','departamentoV01','departamentoV02','departamentoV03','departamentoV04','departamentoV05','departamentoV06','departamentoV07','departamentoV08','departamentoV09','departamentoV10','departamentoV11','departamentoV12','departamentoP01','departamentoP02','departamentoP03','departamentoP04','departamentoP05','departamentoP06','departamentoP07','departamentoP08','departamentoP09','departamentoP10','departamentoP11','departamentoP12','departamentoFJ01','departamentoFJ02','departamentoFJ03','departamentoFJ04','departamentoFJ05','departamentoFJ06','departamentoFJ07','departamentoFJ08','departamentoFJ09','departamentoFJ10','departamentoFJ11','departamentoFJ12','departamentoI01','departamentoI02','departamentoI03','departamentoI04','departamentoI05','departamentoI06','departamentoI07','departamentoI08','departamentoI09','departamentoI10','departamentoI11','departamentoI12','perVPRH','vacacionesEvenVPRH','vacacionesPerVPRH','vacacionesExcVPRH','vacacionesDDVPRH','permisosDCSVPRH','permisosDSSVPRH','permisosHCSVPRH','permisosHSSVPRH','incapacidadesDDVPRH','faltasM1VPRH','faltasM2VPRH','faltasM3VPRH','faltasM4VPRH','faltasM5VPRH','faltasM6VPRH','incapacidadesIVPRH','incapacidadesSVPRH','vacacionesEvenVPRH','vacacionesPerVPRH','vacacionesExcVPRH','vacacionesDDVPRH','permisosDCSVPRH','permisosDSSVPRH','permisosHCSVPRH','permisosHSSVPRH','incapacidadesDDVPRH','faltasM1VPRH','faltasM2VPRH','faltasM3VPRH','faltasM4VPRH','faltasM5VPRH','faltasM6VPRH','incapacidadesIVPRH','incapacidadesSVPRH','retardosVPRH','faltasinjustificadasVPRH','departamentoR','departamentoFI'));
 
    }

    public function fechasVPRH(Request $request)
    {
     //   dd($request->vacaciones);
      //dd($request->all());
        $inicio= ($request->filled('inicial')) ? $request->inicial : date('Y-m-d');
        $fin= ($request->filled('final')) ? $request->final : date('Y-m-d');

        $departamento = DB::table('cat_edo_neg')
        ->where('vp','VPRH')
        ->groupby('des_edo_neg')
       ->get(['des_edo_neg']);

        $departamentoV= DB::table('vacaciones2')
                ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                    $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                })
                ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                ->where('cat_edo_neg.vp','=','VPRH')
                ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
                ->select(DB::raw('des_edo_neg, count(distinct vacaciones2.IdVacaciones) as vac, sum(vacaciones2.dias_solicitud) as vacdias'))      
                ->groupby('des_edo_neg')
                ->get(['des_edo_neg']);      

        $departamentoP= DB::table('permisos')
                ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                    $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                })
                ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                ->where('cat_edo_neg.vp','=','VPRH')
                ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
                ->select(DB::raw('des_edo_neg, count(distinct permisos.IdPermiso) as per, sum(distinct permisos.dias) as perdias'))      
                ->groupby('des_edo_neg')
                ->get(['des_edo_neg']);                 

        $departamentoFJ= DB::table('faltas_justificadas')
            ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
            })
            ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
            ->where('cat_edo_neg.vp','=','VPRH')
            ->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)
            ->select(DB::raw('des_edo_neg, count(distinct faltas_justificadas.id) as fal'))      
            ->groupby('des_edo_neg')
            ->get(['des_edo_neg']);                     

        $departamentoI= DB::table('incapacidades')
            ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
            })
            ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
            ->where('cat_edo_neg.vp','=','VPRH')
            ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)
            ->select(DB::raw('des_edo_neg, count(distinct incapacidades.id) as inc, sum(distinct incapacidades.dias) as incdias'))     
            ->groupby('des_edo_neg')
            ->get(['des_edo_neg']);    
            
        $departamentoR= DB::table('faltas')
            ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
            })
            ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
            ->where('cat_edo_neg.vp','=','VPRH')
            ->where('IdJustificacion','Retardo')->where('fecha_falta','>=','2023-01-01')
            ->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)
            ->select(DB::raw('des_edo_neg, count(distinct faltas.id) as ret'))      
            ->groupby('des_edo_neg')
            ->get(['des_edo_neg']);     

        $departamentoFI= DB::table('faltas')
            ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
            })
            ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
            ->where('cat_edo_neg.vp','=','VPRH')
            ->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->where('faltas.fecha_falta','>=','2023-01-01')->where('fecha_falta','<=',date('Y-m-d'))
            ->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)
            ->select(DB::raw('des_edo_neg, count(distinct faltas.id) as fi'))      
            ->groupby('des_edo_neg')
            ->get(['des_edo_neg']);           

            $vacacionesEvenVPRH= DB::table('vacaciones2')
            ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
            })
            ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
            ->where('cat_edo_neg.vp','=','VPRH')
            ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
            ->sum('eventualidades');   

            $vacacionesPerVPRH= DB::table('vacaciones2')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->where('cat_edo_neg.vp','=','VPRH')
                        ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
                        ->sum('periodos');

            $vacacionesExcVPRH= DB::table('vacaciones2')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->where('cat_edo_neg.vp','=','VPRH')
                        ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
                        ->sum('excepcion');

            $vacacionesDDVPRH= DB::table('vacaciones2')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->where('cat_edo_neg.vp','=','VPRH')
                        ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
                        ->sum('dias_solicitud');

            $permisosDCSVPRH= DB::table('permisos')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->join('cat_permisos','cat_permisos.id_permiso','=','permisos.tipo_per')
                        ->where('cat_edo_neg.vp','=','VPRH')
                        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
                        ->where('forma',1)->count ();

            $permisosDSSVPRH= DB::table('permisos')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->join('cat_permisos','cat_permisos.id_permiso','=','permisos.tipo_per')
                        ->where('cat_edo_neg.vp','=','VPRH')
                        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
                        ->where('forma',2)->count ();

            $permisosHCSVPRH= DB::table('permisos')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->join('cat_permisos','cat_permisos.id_permiso','=','permisos.tipo_per')
                        ->where('cat_edo_neg.vp','=','VPRH')
                        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
                        ->where('forma',3)->count ();

            $permisosHSSVPRH= DB::table('permisos')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->join('cat_permisos','cat_permisos.id_permiso','=','permisos.tipo_per')
                        ->where('cat_edo_neg.vp','=','VPRH')
                        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
                        ->where('forma',4)->count ();

            $faltasM1VPRH= DB::table('faltas_justificadas')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                        ->where('cat_edo_neg.vp','=','VPRH')
                        ->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)
                        ->where('motivo_falta',1)->count ();    
                        
            $faltasM2VPRH= DB::table('faltas_justificadas')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                        ->where('cat_edo_neg.vp','=','VPRH')
                        ->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)
                        ->where('motivo_falta',2)->count ();         

            $faltasM3VPRH= DB::table('faltas_justificadas')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                        ->where('cat_edo_neg.vp','=','VPRH')
                        ->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)
                        ->where('motivo_falta',3)->count ();         

            $faltasM4VPRH= DB::table('faltas_justificadas')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                        ->where('cat_edo_neg.vp','=','VPRH')
                        ->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)
                        ->where('motivo_falta',4)->count ();         

            $faltasM5VPRH= DB::table('faltas_justificadas')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                        ->where('cat_edo_neg.vp','=','VPRH')
                        ->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)
                        ->where('motivo_falta',5)->count ();         

            $faltasM6VPRH= DB::table('faltas_justificadas')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                        ->where('cat_edo_neg.vp','=','VPRH')
                        ->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)
                        ->where('motivo_falta',6)->count ();         


            $incapacidadesDDVPRH= DB::table('incapacidades')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->where('cat_edo_neg.vp','=','VPRH')
                        ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)
                        ->sum('dias');

            $incapacidadesIVPRH= DB::table('incapacidades')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->where('cat_edo_neg.vp','=','VPRH')
                        ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)
                        ->where('tipo_incapacidad',1)->count ();   
                        
            $incapacidadesSVPRH= DB::table('incapacidades')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->where('cat_edo_neg.vp','=','VPRH')
                        ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)
                        ->where('tipo_incapacidad',2)->count (); 

            
        $perVPRH=Tbl_Empleado_SIA::join('cat_edo_neg','cat_edo_neg.edo_neg','=','Tbl_Empleados_SIA.cveci2')
            ->whereNULL('Fecha_Eg')
            ->where('vp','VPRH')
            ->distinct('id_empleado')
            ->select(DB::raw('des_edo_neg, count(distinct tbl_empleados_sia.id_empleado) as perVPRH'))      
            ->groupby('des_edo_neg')
            ->get(['des_edo_neg']);        
            
            
        $vacacionesVPRH= DB::table('vacaciones2')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPRH')
        ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
        ->groupby('vacaciones2.IdVacaciones')
        ->get(['vacaciones2.IdVacaciones']);

        $vacacionesVPRH = $vacacionesVPRH->unique('IdVacaciones');

        $vacacionesVPRH=$vacacionesVPRH->count();

        $permisosVPRH= DB::table('permisos')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPRH')
        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);

        $permisosVPRH = $permisosVPRH->unique('IdPermiso');

        $permisosVPRH=$permisosVPRH->count();

        $faltasjustificadasVPRH= DB::table('faltas_justificadas')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPRH')
        ->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)
        ->groupby('faltas_justificadas.id')
        ->get(['faltas_justificadas.id']);

        $faltasjustificadasVPRH = $faltasjustificadasVPRH->unique('id');

        $faltasjustificadasVPRH=$faltasjustificadasVPRH->count();

        $incapacidadesVPRH= DB::table('incapacidades')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPRH')
        ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)
        ->groupby('incapacidades.id')
        ->get(['incapacidades.id']);

        $incapacidadesVPRH = $incapacidadesVPRH->unique('id');

        $incapacidadesVPRH=$incapacidadesVPRH->count();

        $retardosVPRH= DB::table('faltas')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPRH')
        ->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)
        ->where('IdJustificacion','Retardo')->where('fecha_falta','>=','2023-01-01')
        ->groupby('faltas.id')
        ->get(['faltas.id']);

        $retardosVPRH = $retardosVPRH->unique('id');

        $retardosVPRH=$retardosVPRH->count();

        
        $faltasinjustificadasVPRH= DB::table('faltas')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPRH')
        ->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)
        ->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->where('faltas.fecha_falta','>=','2023-01-01')->where('fecha_falta','<=',date('Y-m-d'))
        ->groupby('faltas.id')
        ->get(['faltas.id']);

        $faltasinjustificadasVPRH = $faltasinjustificadasVPRH->unique('id');

        $faltasinjustificadasVPRH=$faltasinjustificadasVPRH->count();


        $vacacionesVPRHA= DB::table('vacaciones2')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })

        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPRH')
        ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
        ->groupby('vacaciones2.IdVacaciones')
        ->get(['vacaciones2.IdVacaciones']);

        $vacacionesVPRHA = $vacacionesVPRHA->unique('IdVacaciones');
        $vacacionesVPRHA=$vacacionesVPRHA->count();

        $vacacionesVPRHD= DB::table('vacaciones2')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })

        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPRH')
        ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
        ->where('vacaciones2.status','Denegado')
        ->groupby('vacaciones2.IdVacaciones')
        ->get(['vacaciones2.IdVacaciones']);

        $vacacionesVPRHD = $vacacionesVPRHD->unique('IdVacaciones');
        $vacacionesVPRHD=$vacacionesVPRHD->count();

        $vacacionesVPRHP= DB::table('vacaciones2')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })

        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPRH')
        ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
        ->where('vacaciones2.status','Pendiente')
        ->groupby('vacaciones2.IdVacaciones')
        ->get(['vacaciones2.IdVacaciones']);

        $vacacionesVPRHP = $vacacionesVPRHP->unique('IdVacaciones');
        $vacacionesVPRHP=$vacacionesVPRHP->count();

        $vacacionesVPRHC= DB::table('vacaciones2')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })

        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPRH')
        ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
        ->where('vacaciones2.status','Cancelado')
        ->groupby('vacaciones2.IdVacaciones')
        ->get(['vacaciones2.IdVacaciones']);
        
        $vacacionesVPRHC = $vacacionesVPRHC->unique('IdVacaciones');
        $vacacionesVPRHC=$vacacionesVPRHC->count();

        $permisosVPRHA= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })

        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPRH')
        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);

        $permisosVPRHA = $permisosVPRHA->unique('IdPermiso');
        $permisosVPRHA=$permisosVPRHA->count();

        $permisosVPRHD= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })

        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPRH')
        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
        ->where('permisos.status','Denegado')
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);
        
        $permisosVPRHD = $permisosVPRHD->unique('IdPermiso');
        $permisosVPRHD=$permisosVPRHD->count();

        $permisosVPRHP= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })

        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPRH')
        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
        ->where('permisos.status','Pendiente')
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);
       
        $permisosVPRHP = $permisosVPRHP->unique('IdPermiso');
        $permisosVPRHP=$permisosVPRHP->count();

        $permisosVPRHC= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })

        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPRH')
        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
        ->where('permisos.status','Cancelado')
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);
       
        $permisosVPRHC = $permisosVPRHC->unique('IdPermiso');
        $permisosVPRHC=$permisosVPRHC->count();

        /***********  VACACIONES X MES ************************* */
        $anio = date('Y');
    
        $departamentoV01= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_vac','=','1')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV02= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_vac','=','2')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV03= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_vac','=','3')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV04= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_vac','=','4')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV05= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_vac','=','5')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV06= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_vac','=','6')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV07= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_vac','=','7')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV08= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_vac','=','8')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV09= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_vac','=','9')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV10= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_vac','=','10')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV11= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_vac','=','11')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV12= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_vac','=','12')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   

          $departamentoP01= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_per','=','1')
                     ->whereYear('fech_ini_per','=',$anio)->count();
          $departamentoP02= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_per','=','2')
                     ->whereYear('fech_ini_per','=',$anio)->count();  
          $departamentoP03= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_per','=','3')
                     ->whereYear('fech_ini_per','=',$anio)->count();  
          $departamentoP04= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_per','=','4')
                     ->whereYear('fech_ini_per','=',$anio)->count();  
          $departamentoP05= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_per','=','5')
                     ->whereYear('fech_ini_per','=',$anio)->count();  
          $departamentoP06= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_per','=','6')
                     ->whereYear('fech_ini_per','=',$anio)->count();  
          $departamentoP07= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_per','=','7')
                     ->whereYear('fech_ini_per','=',$anio)->count();  
          $departamentoP08= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_per','=','8')
                     ->whereYear('fech_ini_per','=',$anio)->count();  
          $departamentoP09= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_per','=','9')
                     ->whereYear('fech_ini_per','=',$anio)->count();  
          $departamentoP10= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_per','=','10')
                     ->whereYear('fech_ini_per','=',$anio)->count();  
          $departamentoP11= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_per','=','11')
                     ->whereYear('fech_ini_per','=',$anio)->count();  
          $departamentoP12= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fech_ini_per','=','12')
                     ->whereYear('fech_ini_per','=',$anio)->count();    
          $departamentoFJ01= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio_justificar','=','1')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
          $departamentoFJ02= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio_justificar','=','2')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
          $departamentoFJ03= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio_justificar','=','3')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
          $departamentoFJ04= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio_justificar','=','4')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
          $departamentoFJ05= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio_justificar','=','5')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
          $departamentoFJ06= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio_justificar','=','6')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
          $departamentoFJ07= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio_justificar','=','7')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
          $departamentoFJ08= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio_justificar','=','8')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
          $departamentoFJ09= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio_justificar','=','9')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
          $departamentoFJ10= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio_justificar','=','10')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
          $departamentoFJ11= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio_justificar','=','11')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count();
          $departamentoFJ12= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio_justificar','=','12')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count();              
          $departamentoI01= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio','=','01')
                     ->whereYear('fecha_inicio','=',$anio)->count();   
          $departamentoI02= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio','=','02')
                     ->whereYear('fecha_inicio','=',$anio)->count();  
          $departamentoI03= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio','=','03')
                     ->whereYear('fecha_inicio','=',$anio)->count();  
          $departamentoI04= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio','=','04')
                     ->whereYear('fecha_inicio','=',$anio)->count();  
          $departamentoI05= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio','=','05')
                     ->whereYear('fecha_inicio','=',$anio)->count();  
          $departamentoI06= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio','=','06')
                     ->whereYear('fecha_inicio','=',$anio)->count();  
          $departamentoI07= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio','=','07')
                     ->whereYear('fecha_inicio','=',$anio)->count();  
          $departamentoI08= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio','=','08')
                     ->whereYear('fecha_inicio','=',$anio)->count();  
          $departamentoI09= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio','=','09')
                     ->whereYear('fecha_inicio','=',$anio)->count();  
          $departamentoI10= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio','=','10')
                     ->whereYear('fecha_inicio','=',$anio)->count();  
          $departamentoI11= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio','=','11')
                     ->whereYear('fecha_inicio','=',$anio)->count();  
          $departamentoI12= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPRH')
                     ->whereMonth('fecha_inicio','=','12')
                     ->whereYear('fecha_inicio','=',$anio)->count();             

        return view('VPRH.index', compact('departamento','departamentoV','departamentoP','departamentoFJ','departamentoI','departamentoR','departamentoFI','vacacionesVPRH','permisosVPRH','faltasjustificadasVPRH','incapacidadesVPRH','vacacionesVPRHA','vacacionesVPRHD','vacacionesVPRHP','vacacionesVPRHC','permisosVPRHA','permisosVPRHD','permisosVPRHP','permisosVPRHC','inicio','fin','departamentoV01','departamentoV02','departamentoV03','departamentoV04','departamentoV05','departamentoV06','departamentoV07','departamentoV08','departamentoV09','departamentoV10','departamentoV11','departamentoV12','departamentoP01','departamentoP02','departamentoP03','departamentoP04','departamentoP05','departamentoP06','departamentoP07','departamentoP08','departamentoP09','departamentoP10','departamentoP11','departamentoP12','departamentoFJ01','departamentoFJ02','departamentoFJ03','departamentoFJ04','departamentoFJ05','departamentoFJ06','departamentoFJ07','departamentoFJ08','departamentoFJ09','departamentoFJ10','departamentoFJ11','departamentoFJ12','departamentoI01','departamentoI02','departamentoI03','departamentoI04','departamentoI05','departamentoI06','departamentoI07','departamentoI08','departamentoI09','departamentoI10','departamentoI11','departamentoI12','perVPRH','vacacionesEvenVPRH','vacacionesPerVPRH','vacacionesExcVPRH','vacacionesDDVPRH','permisosDCSVPRH','permisosDSSVPRH','permisosHCSVPRH','permisosHSSVPRH','incapacidadesDDVPRH','faltasM1VPRH','faltasM2VPRH','faltasM3VPRH','faltasM4VPRH','faltasM5VPRH','faltasM6VPRH','incapacidadesIVPRH','incapacidadesSVPRH','vacacionesEvenVPRH','vacacionesPerVPRH','vacacionesExcVPRH','vacacionesDDVPRH','permisosDCSVPRH','permisosDSSVPRH','permisosHCSVPRH','permisosHSSVPRH','incapacidadesDDVPRH','faltasM1VPRH','faltasM2VPRH','faltasM3VPRH','faltasM4VPRH','faltasM5VPRH','faltasM6VPRH','incapacidadesIVPRH','incapacidadesSVPRH','retardosVPRH','faltasinjustificadasVPRH'));

    }
    
    public function fechasVPRH2(Request $request)
    {
        $inicio= ($request->filled('inicial')) ? $request->inicial : date('Y-m-d');
        $fin= ($request->filled('final')) ? $request->final : date('Y-m-d');

        $perVPRH=Tbl_Empleado_SIA::join('cat_edo_neg','cat_edo_neg.edo_neg','=','Tbl_Empleados_SIA.cveci2')
                     ->whereNULL('Fecha_Eg')
                     ->where('vp','VPRH')
                     ->distinct('id_empleado')
                     ->select(DB::raw('des_edo_neg, count(distinct tbl_empleados_sia.id_empleado) as perVPRH'))      
                     ->groupby('des_edo_neg')
                     ->get(['des_edo_neg']);     

        $departamentoVPRH = DB::table('permisos')
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
        ->where('cat_edo_neg.vp','=','VPRH')
        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
        ->select(DB::raw('cat_puestos.Puesto, count(permisos.IdPermiso) as contper'))      
        ->groupby('cat_puestos.Puesto')
        ->get(['cat_puestos.Puesto']);  


       $permisosVPRH= DB::table('permisos')->distinct()
       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->where('cat_edo_neg.vp','=','VPRH')
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->groupby('permisos.IdPermiso')
       ->get(['permisos.IdPermiso']);

       $permisosVPRH = $permisosVPRH->unique('IdPermiso');

       $permisosVPRH=$permisosVPRH->count();

       $incapacidadesVPRH= DB::table('incapacidades')->distinct()
       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
       $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->where('cat_edo_neg.vp','=','VPRH')
       ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)
       ->groupby('incapacidades.id')
       ->get(['incapacidades.id']);

       $incapacidadesVPRH = $incapacidadesVPRH->unique('id');

       $incapacidadesVPRH=$incapacidadesVPRH->count();


       $vacacionesVPRHA= DB::table('vacaciones2')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
       $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })

       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->where('cat_edo_neg.vp','VPRH')
       ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
       ->groupby('vacaciones2.IdVacaciones')
       ->get(['vacaciones2.IdVacaciones']);

       $vacacionesVPRHA = $vacacionesVPRHA->unique('IdVacaciones');
       $vacacionesVPRHA=$vacacionesVPRHA->count();

       $vacacionesVPRHD= DB::table('vacaciones2')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
       $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })

       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->where('cat_edo_neg.vp','VPRH')
       ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
       ->where('vacaciones2.status','Denegado')
       ->groupby('vacaciones2.IdVacaciones')
       ->get(['vacaciones2.IdVacaciones']);

       $vacacionesVPRHD = $vacacionesVPRHD->unique('IdVacaciones');
       $vacacionesVPRHD=$vacacionesVPRHD->count();

       $vacacionesVPRHP= DB::table('vacaciones2')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
       $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })

       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->where('cat_edo_neg.vp','VPRH')
       ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
       ->where('vacaciones2.status','Pendiente')
       ->groupby('vacaciones2.IdVacaciones')
       ->get(['vacaciones2.IdVacaciones']);

       $vacacionesVPRHP = $vacacionesVPRHP->unique('IdVacaciones');
       $vacacionesVPRHP=$vacacionesVPRHP->count();

       $vacacionesVPRHC= DB::table('vacaciones2')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
       $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })

       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->where('cat_edo_neg.vp','VPRH')
       ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
       ->where('vacaciones2.status','Cancelado')
       ->groupby('vacaciones2.IdVacaciones')
       ->get(['vacaciones2.IdVacaciones']);
       
       $vacacionesVPRHC = $vacacionesVPRHC->unique('IdVacaciones');
       $vacacionesVPRHC=$vacacionesVPRHC->count();
/***************permisos autorizados ********** */
       $permisosVPRHA= DB::table('permisos')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
       })
       
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
       ->where('cat_edo_neg.vp','VPRH')
       ->where('permisos.status','Aplicado')
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as vprha'))      
       ->groupby('cat_puestos.Puesto')
       ->get(['cat_puestos.Puesto']);

/***************permisos denegados ********** */

       $permisosVPRHD= DB::table('permisos')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
       })
       
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
       ->where('cat_edo_neg.vp','VPRH')
       ->where('permisos.status','Denegado')
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as vprhd'))      
       ->groupby('cat_puestos.Puesto')
       ->get(['cat_puestos.Puesto']);

  
      /***************permisos pendientes ********** */

       $permisosVPRHP= DB::table('permisos')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
       })
       
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
       ->where('cat_edo_neg.vp','VPRH')
       ->where('permisos.status','Pendiente')
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as vprhp'))      
       ->groupby('cat_puestos.Puesto')
       ->get(['cat_puestos.Puesto']);
      
/***************permisos cancelados ********** */

       $permisosVPRHC= DB::table('permisos')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
       })
       
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
       ->where('cat_edo_neg.vp','VPRH')
       ->where('permisos.status','Cancelado')
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as vprhc'))      
       ->groupby('cat_puestos.Puesto')
       ->get(['cat_puestos.Puesto']);

/***************tipos de permisos ********** */

       $permisodcs = DB::table('permisos')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) { 
          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_permisos','cat_permisos.id_permiso','permisos.tipo_per')
       ->where('cat_edo_neg.vp','VPRH')
       ->where('cat_permisos.forma','=',1)
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->select(DB::raw('cat_permisos.id_permiso, cat_permisos.permiso'))      
       ->groupby('cat_permisos.id_permiso','cat_permisos.permiso')
       ->get('cat_permisos.id_permiso');


       $permisodss = DB::table('permisos')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) { 
          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_permisos','cat_permisos.id_permiso','permisos.tipo_per')
       ->where('cat_edo_neg.vp','VPRH')
       ->where('cat_permisos.forma','=',2)
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->select(DB::raw('cat_permisos.id_permiso, cat_permisos.permiso'))      
       ->groupby('cat_permisos.id_permiso','cat_permisos.permiso')
       ->get('cat_permisos.id_permiso');

       $permisohcs = DB::table('permisos')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) { 
          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_permisos','cat_permisos.id_permiso','permisos.tipo_per')
       ->where('cat_edo_neg.vp','VPRH')
       ->where('cat_permisos.forma','=',3)
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->select(DB::raw('cat_permisos.id_permiso, cat_permisos.permiso'))      
       ->groupby('cat_permisos.id_permiso','cat_permisos.permiso')
       ->get('cat_permisos.id_permiso');

       $permisohss = DB::table('permisos')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) { 
          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_permisos','cat_permisos.id_permiso','permisos.tipo_per')
       ->where('cat_edo_neg.vp','VPRH')
       ->where('cat_permisos.forma','=',4)
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
      ->select(DB::raw('cat_permisos.id_permiso, cat_permisos.permiso'))      
       ->groupby('cat_permisos.id_permiso','cat_permisos.permiso')
       ->get('cat_permisos.id_permiso');

/***************total permisos x dia con goce de sueldo ********** */

       $permisosdcs = DB::table('permisos')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) { 
          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_permisos','cat_permisos.id_permiso','permisos.tipo_per')
       ->where('cat_edo_neg.vp','VPRH')
       ->where('cat_permisos.forma','=',1)
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->select(DB::raw('permisos.tipo_per, count(distinct permisos.IdPermiso) as perdcs'))      
       ->groupby('permisos.tipo_per')
       ->get(['permisos.tipo_per']);
       
       $sumdcs= $permisosdcs->pluck('perdcs')->sum();
       
/***************total permisos x dia sin goce de sueldo ********** */

       $permisosdss = DB::table('permisos')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_permisos','cat_permisos.id_permiso','permisos.tipo_per')
       ->where('cat_edo_neg.vp','VPRH')
       ->where('cat_permisos.forma','=',2)
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->select(DB::raw('permisos.tipo_per, count(distinct permisos.IdPermiso) as perdss'))      
       ->groupby('permisos.tipo_per')
       ->get(['permisos.tipo_per']);
       
       $sumdss= $permisosdss->pluck('perdss')->sum();
/***************total permisos x horas con goce de sueldo ********** */

       $permisoshcs = DB::table('permisos')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_permisos','cat_permisos.id_permiso','permisos.tipo_per')
       ->where('cat_edo_neg.vp','VPRH')
       ->where('cat_permisos.forma','=',3)
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->select(DB::raw('permisos.tipo_per, count(distinct permisos.IdPermiso) as perhcs'))      
       ->groupby('permisos.tipo_per')
       ->get(['permisos.tipo_per']);
       
       $sumhcs= $permisoshcs->pluck('perhcs')->sum();
/***************total permisos x horas sin goce de sueldo ********** */

       $permisoshss = DB::table('permisos')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_permisos','cat_permisos.id_permiso','permisos.tipo_per')
       ->where('cat_edo_neg.vp','VPRH')
       ->where('cat_permisos.forma','=',4)
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->select(DB::raw('permisos.tipo_per, count(distinct permisos.IdPermiso) as perhss'))      
       ->groupby('permisos.tipo_per')
       ->get(['permisos.tipo_per']);
       
       $sumhss= $permisoshss->pluck('perhss')->sum();
       
         /***********   X MES ************************* */
         $anio = date('Y');
   
           $departamentoP01= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPRH')
                      ->whereMonth('fech_ini_per','=','1')
                      ->whereYear('fech_ini_per','=',$anio)->count();
           $departamentoP02= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPRH')
                      ->whereMonth('fech_ini_per','=','2')
                      ->whereYear('fech_ini_per','=',$anio)->count();  
           $departamentoP03= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPRH')
                      ->whereMonth('fech_ini_per','=','3')
                      ->whereYear('fech_ini_per','=',$anio)->count();  
           $departamentoP04= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPRH')
                      ->whereMonth('fech_ini_per','=','4')
                      ->whereYear('fech_ini_per','=',$anio)->count();  
           $departamentoP05= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPRH')
                      ->whereMonth('fech_ini_per','=','5')
                      ->whereYear('fech_ini_per','=',$anio)->count();  
           $departamentoP06= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPRH')
                      ->whereMonth('fech_ini_per','=','6')
                      ->whereYear('fech_ini_per','=',$anio)->count();  
           $departamentoP07= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPRH')
                      ->whereMonth('fech_ini_per','=','7')
                      ->whereYear('fech_ini_per','=',$anio)->count();  
           $departamentoP08= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPRH')
                      ->whereMonth('fech_ini_per','=','8')
                      ->whereYear('fech_ini_per','=',$anio)->count();  
           $departamentoP09= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPRH')
                      ->whereMonth('fech_ini_per','=','9')
                      ->whereYear('fech_ini_per','=',$anio)->count();  
           $departamentoP10= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPRH')
                      ->whereMonth('fech_ini_per','=','10')
                      ->whereYear('fech_ini_per','=',$anio)->count();  
           $departamentoP11= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPRH')
                      ->whereMonth('fech_ini_per','=','11')
                      ->whereYear('fech_ini_per','=',$anio)->count();  
           $departamentoP12= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPRH')
                      ->whereMonth('fech_ini_per','=','12')
                      ->whereYear('fech_ini_per','=',$anio)->count();      

       return view('VPRH.detalle', compact('permisosVPRH','permisosVPRHA','permisosVPRHD','permisosVPRHP','permisosVPRHC','inicio','fin','departamentoP01','departamentoP02','departamentoP03','departamentoP04','departamentoP05','departamentoP06','departamentoP07','departamentoP08','departamentoP09','departamentoP10','departamentoP11','departamentoP12','departamentoVPRH','permisosdcs','permisosdss','permisoshcs','permisoshss','permisodcs','permisodss','permisohcs','permisohss','sumdcs','sumdss','sumhcs','sumhss','perVPRH','vacacionesVPRHD'));


    }

    public function excepcionesVPRH(request $request)
    {

        $inicio='';
        $fin ='';

        $departamento = DB::table('cat_edo_neg')
        ->where('vp','VPRH')
        ->groupby('des_edo_neg')
       ->get(['des_edo_neg']);

       $depVPRHVE = DB::table('vacaciones2')
       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','vacaciones2.jefe_directo')
       ->where('cat_edo_neg.vp','=','VPRH')
       ->where('vacaciones2.excepcion',1)
       ->select(DB::raw('cat_edo_neg.des_edo_neg, count(distinct vacaciones2.IdVacaciones) as excevac, cat_puestos.Puesto'))      
       ->groupby('cat_edo_neg.des_edo_neg','cat_puestos.Puesto')
       ->get(['cat_edo_neg.des_edo_neg']); 

       $depVPRHPE = DB::table('permisos')
       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
       ->where('cat_edo_neg.vp','=','VPRH')
       ->where('permisos.excepcion',1)
       ->select(DB::raw('cat_edo_neg.des_edo_neg, count(distinct permisos.IdPermiso) as exceper, cat_puestos.Puesto'))      
       ->groupby('cat_edo_neg.des_edo_neg','cat_puestos.Puesto')
       ->get(['cat_edo_neg.des_edo_neg']); 

       $detallevacVPRH = DB::table('vacaciones2')
       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','vacaciones2.jefe_directo')
       ->where('cat_edo_neg.vp','=','VPRH')
       ->where('vacaciones2.excepcion',1)
       ->orderby('cat_edo_neg.des_edo_neg')
       ->get(); 

       $detalleperVPRH = DB::table('permisos')
       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
       ->where('cat_edo_neg.vp','=','VPRH')
       ->where('permisos.excepcion',1)
       ->orderby('cat_edo_neg.des_edo_neg')
       ->get(); 
/******************************************************************************* */
        $excepcionVPRHV= DB::table('vacaciones2')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPRH')
        ->where('vacaciones2.excepcion',1)
        ->count();

        $excepcionVPRHP= DB::table('permisos')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPRH')
        ->where('permisos.excepcion',1)
        ->count();
     
        return view('VPRH.excepcionesVPRH', compact('inicio','fin','excepcionVPRHV','excepcionVPRHP','departamento','depVPRHVE','depVPRHPE','detallevacVPRH','detalleperVPRH'));
 
    }


    public function fechas_excepVPRH(request $request)
    {

        $inicio= ($request->filled('inicial')) ? $request->inicial : date('Y-m-d');
        $fin= ($request->filled('final')) ? $request->final : date('Y-m-d');

        $departamento = DB::table('cat_edo_neg')
        ->where('vp','VPRH')
        ->groupby('des_edo_neg')
       ->get(['des_edo_neg']);

       $depVPRHVE = DB::table('vacaciones2')
       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','vacaciones2.jefe_directo')
       ->where('cat_edo_neg.vp','=','VPRH')
       ->where('vacaciones2.excepcion',1)
       ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
       ->select(DB::raw('cat_edo_neg.des_edo_neg, count(distinct vacaciones2.IdVacaciones) as excevac, cat_puestos.Puesto'))      
       ->groupby('cat_edo_neg.des_edo_neg','cat_puestos.Puesto')
       ->get(['cat_edo_neg.des_edo_neg']); 

       $depVPRHPE = DB::table('permisos')
       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
       ->where('cat_edo_neg.vp','=','VPRH')
       ->where('permisos.excepcion',1)
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->select(DB::raw('cat_edo_neg.des_edo_neg, count(distinct permisos.IdPermiso) as exceper, cat_puestos.Puesto'))      
       ->groupby('cat_edo_neg.des_edo_neg','cat_puestos.Puesto')
       ->get(['cat_edo_neg.des_edo_neg']); 

       $detallevacVPRH = DB::table('vacaciones2')
       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','vacaciones2.jefe_directo')
       ->where('cat_edo_neg.vp','=','VPRH')
       ->where('vacaciones2.excepcion',1)
       ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)

       ->orderby('cat_edo_neg.des_edo_neg')
       ->get(); 

       $detalleperVPRH = DB::table('permisos')
       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
       ->where('cat_edo_neg.vp','=','VPRH')
       ->where('permisos.excepcion',1)
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)

       ->orderby('cat_edo_neg.des_edo_neg')
       ->get(); 
               
/******************************************************************************* */
        $excepcionVPRHV= DB::table('vacaciones2')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPRH')
        ->where('vacaciones2.excepcion',1)
        ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)

        ->count();

        $excepcionVPRHP= DB::table('permisos')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPRH')
        ->where('permisos.excepcion',1)
        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
        ->count();
     
        return view('VPRH.excepcionesVPRH', compact('inicio','fin','excepcionVPRHV','excepcionVPRHP','departamento','depVPRHVE','depVPRHPE','detallevacVPRH','detalleperVPRH'));
   
    }
}
