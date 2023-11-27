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

class VPMController extends Controller
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
                      ->where('vp','VPM')
                      ->groupby('des_edo_neg')
                     ->get(['des_edo_neg']);

        $vacacionesEvenVPM= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->sum('eventualidades');   
                       
        $vacacionesPerVPM= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->sum('periodos');

        $vacacionesExcVPM= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->sum('excepcion');

        $vacacionesDDVPM= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->sum('dias_solicitud');

        $permisosDCSVPM= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->join('cat_permisos','cat_permisos.id_permiso','=','permisos.tipo_per')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->where('forma',1)->count ();

        $permisosDSSVPM= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->join('cat_permisos','cat_permisos.id_permiso','=','permisos.tipo_per')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->where('forma',2)->count ();

        $permisosHCSVPM= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->join('cat_permisos','cat_permisos.id_permiso','=','permisos.tipo_per')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->where('forma',3)->count ();

        $permisosHSSVPM= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->join('cat_permisos','cat_permisos.id_permiso','=','permisos.tipo_per')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->where('forma',4)->count ();

        $faltasM1VPM= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->where('motivo_falta',1)->count ();    
                       
        $faltasM2VPM= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->where('motivo_falta',2)->count ();         
        
        $faltasM3VPM= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->where('motivo_falta',3)->count ();         

        $faltasM4VPM= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->where('motivo_falta',4)->count ();         

        $faltasM5VPM= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->where('motivo_falta',5)->count ();         

        $faltasM6VPM= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->where('motivo_falta',6)->count ();         
  

        $incapacidadesDDVPM= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->sum('dias');

        $incapacidadesIVPM= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->where('tipo_incapacidad',1)->count ();   
                       
        $incapacidadesSVPM= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->where('tipo_incapacidad',2)->count ();      

                       

        $perVPM=Tbl_Empleado_SIA::join('cat_edo_neg','cat_edo_neg.edo_neg','=','Tbl_Empleados_SIA.cveci2')
                     ->whereNULL('Fecha_Eg')
                     ->where('vp','VPM')
                     ->distinct('id_empleado')
                     ->select(DB::raw('des_edo_neg, count(distinct tbl_empleados_sia.id_empleado) as perVPM'))      
                     ->groupby('des_edo_neg')
                     ->get(['des_edo_neg']);     
         

        $departamentoV= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->select(DB::raw('des_edo_neg, count(distinct vacaciones2.IdVacaciones) as vac, sum(vacaciones2.dias_solicitud) as vacdias'))      
                       ->groupby('des_edo_neg')
                       ->get(['des_edo_neg']);                  

        $departamentoP= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPM')
                      ->select(DB::raw('des_edo_neg, count(distinct permisos.IdPermiso) as per, sum(permisos.dias) as perdias'))   
                      ->groupby('des_edo_neg')
                      ->get(['des_edo_neg']);                 

        $departamentoFJ= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->select(DB::raw('des_edo_neg, count(distinct faltas_justificadas.id) as fal'))      
                     ->groupby('des_edo_neg')
                     ->get(['des_edo_neg']);                     

        $departamentoI= DB::table('incapacidades')
                    ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                        $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                    })
                    ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                    ->where('cat_edo_neg.vp','=','VPM')
                    ->select(DB::raw('des_edo_neg, count(distinct incapacidades.id) as inc, sum(incapacidades.dias) as incdias'))      
                    ->groupby('des_edo_neg')
                    ->get(['des_edo_neg']);       
                    
        $departamentoR= DB::table('faltas')
                    ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                    })
                    ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                    ->where('cat_edo_neg.vp','=','VPM')
                    ->where('IdJustificacion','Retardo')->where('fecha_falta','>=','2023-01-01')
                    ->select(DB::raw('des_edo_neg, count(distinct faltas.id) as ret'))      
                    ->groupby('des_edo_neg')
                    ->get(['des_edo_neg']);     

        $departamentoFI= DB::table('faltas')
                    ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                    })
                    ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                    ->where('cat_edo_neg.vp','=','VPM')
                    ->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->where('faltas.fecha_falta','>=','2023-01-01')->where('fecha_falta','<=',date('Y-m-d'))
                    ->select(DB::raw('des_edo_neg, count(distinct faltas.id) as fi'))      
                    ->groupby('des_edo_neg')
                    ->get(['des_edo_neg']);                 

                     
        $vacacionesVPM= DB::table('vacaciones2')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPM')
        ->groupby('vacaciones2.IdVacaciones')
        ->get(['vacaciones2.IdVacaciones']);

        $vacacionesVPM = $vacacionesVPM->unique('IdVacaciones');

        $vacacionesVPM=$vacacionesVPM->count();

        $permisosVPM= DB::table('permisos')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPM')
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);

        $permisosVPM = $permisosVPM->unique('IdPermiso');

        $permisosVPM=$permisosVPM->count();

        $faltasjustificadasVPM= DB::table('faltas_justificadas')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPM')
        ->groupby('faltas_justificadas.id')
        ->get(['faltas_justificadas.id']);

        $faltasjustificadasVPM = $faltasjustificadasVPM->unique('id');

        $faltasjustificadasVPM=$faltasjustificadasVPM->count();

        $incapacidadesVPM= DB::table('incapacidades')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPM')
        ->groupby('incapacidades.id')
        ->get(['incapacidades.id']);
    
        $incapacidadesVPM = $incapacidadesVPM->unique('id');
   
        $incapacidadesVPM=$incapacidadesVPM->count();

        $retardosVPM= DB::table('faltas')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPM')
        ->where('IdJustificacion','Retardo')->where('fecha_falta','>=','2023-01-01')
        ->groupby('faltas.id')
        ->get(['faltas.id']);

        $retardosVPM = $retardosVPM->unique('id');

        $retardosVPM=$retardosVPM->count();

        $faltasinjustificadasVPM= DB::table('faltas')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPM')
        ->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->where('faltas.fecha_falta','>=','2023-01-01')->where('fecha_falta','<=',date('Y-m-d'))
        ->groupby('faltas.id')
        ->get(['faltas.id']);

        $faltasinjustificadasVPM = $faltasinjustificadasVPM->unique('id');

        $faltasinjustificadasVPM=$faltasinjustificadasVPM->count();

        $vacacionesVPMA= DB::table('vacaciones2')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPM')
        ->groupby('vacaciones2.IdVacaciones')
        ->get(['vacaciones2.IdVacaciones']);

        $vacacionesVPMA = $vacacionesVPMA->unique('IdVacaciones');
        $vacacionesVPMA=$vacacionesVPMA->count();

        $vacacionesVPMD= DB::table('vacaciones2')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPM')
        ->where('vacaciones2.status','Denegado')
        ->groupby('vacaciones2.IdVacaciones')
        ->get(['vacaciones2.IdVacaciones']);

        $vacacionesVPMD = $vacacionesVPMD->unique('IdVacaciones');
        $vacacionesVPMD=$vacacionesVPMD->count();

        $vacacionesVPMP= DB::table('vacaciones2')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPM')
        ->where('vacaciones2.status','Pendiente')
        ->groupby('vacaciones2.IdVacaciones')
        ->get(['vacaciones2.IdVacaciones']);

        $vacacionesVPMP = $vacacionesVPMP->unique('IdVacaciones');
        $vacacionesVPMP=$vacacionesVPMP->count();

        $vacacionesVPMC= DB::table('vacaciones2')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPM')
        ->where('vacaciones2.status','Cancelado')
        ->groupby('vacaciones2.IdVacaciones')
        ->get(['vacaciones2.IdVacaciones']);

        $vacacionesVPMC = $vacacionesVPMC->unique('IdVacaciones');
        $vacacionesVPMC=$vacacionesVPMC->count();

        $permisosVPMA= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPM')
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);

        $permisosVPMA = $permisosVPMA->unique('IdPermiso');
        $permisosVPMA=$permisosVPMA->count();

        $permisosVPMD= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPM')
        ->where('permisos.status','Denegado')
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);

        $permisosVPMD = $permisosVPMD->unique('IdPermiso');
        $permisosVPMD=$permisosVPMD->count();
       
        $permisosVPMP= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPM')
        ->where('permisos.status','Pendiente')
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);

        $permisosVPMP = $permisosVPMP->unique('IdPermiso');
        $permisosVPMP=$permisosVPMP->count();
       
        $permisosVPMC= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPM')
        ->where('permisos.status','Cancelado')
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);

        $permisosVPMC = $permisosVPMC->unique('IdPermiso');
        $permisosVPMC=$permisosVPMC->count();

        

        
          /***********  VACACIONES X MES ************************* */
          $anio = date('Y');
    
          $departamentoV01= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_vac','=','1')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV02= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_vac','=','2')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV03= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_vac','=','3')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV04= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_vac','=','4')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV05= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_vac','=','5')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV06= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_vac','=','6')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV07= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_vac','=','7')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV08= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_vac','=','8')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV09= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_vac','=','9')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV10= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_vac','=','10')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV11= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_vac','=','11')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   
            $departamentoV12= DB::table('vacaciones2')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_vac','=','12')
                       ->whereYear('fech_ini_vac','=',$anio)->count();   

            $departamentoP01= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_per','=','1')
                       ->whereYear('fech_ini_per','=',$anio)->count();
            $departamentoP02= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_per','=','2')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP03= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_per','=','3')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP04= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_per','=','4')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP05= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_per','=','5')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP06= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_per','=','6')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP07= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_per','=','7')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP08= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_per','=','8')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP09= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_per','=','9')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP10= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_per','=','10')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP11= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_per','=','11')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP12= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fech_ini_per','=','12')
                       ->whereYear('fech_ini_per','=',$anio)->count();    
            $departamentoFJ01= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio_justificar','=','1')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
            $departamentoFJ02= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio_justificar','=','2')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
            $departamentoFJ03= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio_justificar','=','3')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
            $departamentoFJ04= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio_justificar','=','4')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
            $departamentoFJ05= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio_justificar','=','5')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
            $departamentoFJ06= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio_justificar','=','6')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
            $departamentoFJ07= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio_justificar','=','7')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
            $departamentoFJ08= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio_justificar','=','8')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
            $departamentoFJ09= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio_justificar','=','9')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
            $departamentoFJ10= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio_justificar','=','10')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
            $departamentoFJ11= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio_justificar','=','11')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count();
            $departamentoFJ12= DB::table('faltas_justificadas')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio_justificar','=','12')
                       ->whereYear('fecha_inicio_justificar','=',$anio)->count();              
            $departamentoI01= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio','=','01')
                       ->whereYear('fecha_inicio','=',$anio)->count();   
            $departamentoI02= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio','=','02')
                       ->whereYear('fecha_inicio','=',$anio)->count();  
            $departamentoI03= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio','=','03')
                       ->whereYear('fecha_inicio','=',$anio)->count();  
            $departamentoI04= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio','=','04')
                       ->whereYear('fecha_inicio','=',$anio)->count();  
            $departamentoI05= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio','=','05')
                       ->whereYear('fecha_inicio','=',$anio)->count();  
            $departamentoI06= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio','=','06')
                       ->whereYear('fecha_inicio','=',$anio)->count();  
            $departamentoI07= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio','=','07')
                       ->whereYear('fecha_inicio','=',$anio)->count();  
            $departamentoI08= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio','=','08')
                       ->whereYear('fecha_inicio','=',$anio)->count();  
            $departamentoI09= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio','=','09')
                       ->whereYear('fecha_inicio','=',$anio)->count();  
            $departamentoI10= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio','=','10')
                       ->whereYear('fecha_inicio','=',$anio)->count();  
            $departamentoI11= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio','=','11')
                       ->whereYear('fecha_inicio','=',$anio)->count();  
            $departamentoI12= DB::table('incapacidades')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPM')
                       ->whereMonth('fecha_inicio','=','12')
                       ->whereYear('fecha_inicio','=',$anio)->count();             
           

        return view('VPM.index', compact('departamento','departamentoV','departamentoP','departamentoFJ','departamentoI','vacacionesVPM','permisosVPM','faltasjustificadasVPM','incapacidadesVPM','vacacionesVPMA','vacacionesVPMD','vacacionesVPMP','vacacionesVPMC','permisosVPMA','permisosVPMD','permisosVPMP','permisosVPMC','inicio','fin','departamentoV01','departamentoV02','departamentoV03','departamentoV04','departamentoV05','departamentoV06','departamentoV07','departamentoV08','departamentoV09','departamentoV10','departamentoV11','departamentoV12','departamentoP01','departamentoP02','departamentoP03','departamentoP04','departamentoP05','departamentoP06','departamentoP07','departamentoP08','departamentoP09','departamentoP10','departamentoP11','departamentoP12','departamentoFJ01','departamentoFJ02','departamentoFJ03','departamentoFJ04','departamentoFJ05','departamentoFJ06','departamentoFJ07','departamentoFJ08','departamentoFJ09','departamentoFJ10','departamentoFJ11','departamentoFJ12','departamentoI01','departamentoI02','departamentoI03','departamentoI04','departamentoI05','departamentoI06','departamentoI07','departamentoI08','departamentoI09','departamentoI10','departamentoI11','departamentoI12','perVPM','vacacionesEvenVPM','vacacionesPerVPM','vacacionesExcVPM','vacacionesDDVPM','permisosDCSVPM','permisosDSSVPM','permisosHCSVPM','permisosHSSVPM','incapacidadesDDVPM','faltasM1VPM','faltasM2VPM','faltasM3VPM','faltasM4VPM','faltasM5VPM','faltasM6VPM','incapacidadesIVPM','incapacidadesSVPM','vacacionesEvenVPM','vacacionesPerVPM','vacacionesExcVPM','vacacionesDDVPM','permisosDCSVPM','permisosDSSVPM','permisosHCSVPM','permisosHSSVPM','incapacidadesDDVPM','faltasM1VPM','faltasM2VPM','faltasM3VPM','faltasM4VPM','faltasM5VPM','faltasM6VPM','incapacidadesIVPM','incapacidadesSVPM','retardosVPM','faltasinjustificadasVPM','departamentoR','departamentoFI'));
 
    }

    public function fechasVPM(Request $request)
    {
     //   dd($request->vacaciones);
      //dd($request->all());
        $inicio= ($request->filled('inicial')) ? $request->inicial : date('Y-m-d');
        $fin= ($request->filled('final')) ? $request->final : date('Y-m-d');

        $departamento = DB::table('cat_edo_neg')
        ->where('vp','VPM')
        ->groupby('des_edo_neg')
       ->get(['des_edo_neg']);

        $departamentoV= DB::table('vacaciones2')
                ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                    $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                })
                ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                ->where('cat_edo_neg.vp','=','VPM')
                ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
                ->select(DB::raw('des_edo_neg, count(distinct vacaciones2.IdVacaciones) as vac, sum(vacaciones2.dias_solicitud) as vacdias'))      
                ->groupby('des_edo_neg')
                ->get(['des_edo_neg']);      

        $departamentoP= DB::table('permisos')
                ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                    $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                })
                ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                ->where('cat_edo_neg.vp','=','VPM')
                ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
                ->select(DB::raw('des_edo_neg, count(distinct permisos.IdPermiso) as per, sum(distinct permisos.dias) as perdias'))      
                ->groupby('des_edo_neg')
                ->get(['des_edo_neg']);                 

        $departamentoFJ= DB::table('faltas_justificadas')
            ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
            })
            ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
            ->where('cat_edo_neg.vp','=','VPM')
            ->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)
            ->select(DB::raw('des_edo_neg, count(distinct faltas_justificadas.id) as fal'))      
            ->groupby('des_edo_neg')
            ->get(['des_edo_neg']);                     

        $departamentoI= DB::table('incapacidades')
            ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
            })
            ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
            ->where('cat_edo_neg.vp','=','VPM')
            ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)
            ->select(DB::raw('des_edo_neg, count(distinct incapacidades.id) as inc, sum(distinct incapacidades.dias) as incdias'))     
            ->groupby('des_edo_neg')
            ->get(['des_edo_neg']);    
            
        $departamentoR= DB::table('faltas')
            ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
            })
            ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
            ->where('cat_edo_neg.vp','=','VPM')
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
            ->where('cat_edo_neg.vp','=','VPM')
            ->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->where('faltas.fecha_falta','>=','2023-01-01')->where('fecha_falta','<=',date('Y-m-d'))
            ->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)
            ->select(DB::raw('des_edo_neg, count(distinct faltas.id) as fi'))      
            ->groupby('des_edo_neg')
            ->get(['des_edo_neg']);           

            $vacacionesEvenVPM= DB::table('vacaciones2')
            ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
            })
            ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
            ->where('cat_edo_neg.vp','=','VPM')
            ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
            ->sum('eventualidades');   

            $vacacionesPerVPM= DB::table('vacaciones2')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->where('cat_edo_neg.vp','=','VPM')
                        ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
                        ->sum('periodos');

            $vacacionesExcVPM= DB::table('vacaciones2')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->where('cat_edo_neg.vp','=','VPM')
                        ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
                        ->sum('excepcion');

            $vacacionesDDVPM= DB::table('vacaciones2')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->where('cat_edo_neg.vp','=','VPM')
                        ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
                        ->sum('dias_solicitud');

            $permisosDCSVPM= DB::table('permisos')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->join('cat_permisos','cat_permisos.id_permiso','=','permisos.tipo_per')
                        ->where('cat_edo_neg.vp','=','VPM')
                        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
                        ->where('forma',1)->count ();

            $permisosDSSVPM= DB::table('permisos')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->join('cat_permisos','cat_permisos.id_permiso','=','permisos.tipo_per')
                        ->where('cat_edo_neg.vp','=','VPM')
                        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
                        ->where('forma',2)->count ();

            $permisosHCSVPM= DB::table('permisos')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->join('cat_permisos','cat_permisos.id_permiso','=','permisos.tipo_per')
                        ->where('cat_edo_neg.vp','=','VPM')
                        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
                        ->where('forma',3)->count ();

            $permisosHSSVPM= DB::table('permisos')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->join('cat_permisos','cat_permisos.id_permiso','=','permisos.tipo_per')
                        ->where('cat_edo_neg.vp','=','VPM')
                        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
                        ->where('forma',4)->count ();

            $faltasM1VPM= DB::table('faltas_justificadas')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                        ->where('cat_edo_neg.vp','=','VPM')
                        ->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)
                        ->where('motivo_falta',1)->count ();    
                        
            $faltasM2VPM= DB::table('faltas_justificadas')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                        ->where('cat_edo_neg.vp','=','VPM')
                        ->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)
                        ->where('motivo_falta',2)->count ();         

            $faltasM3VPM= DB::table('faltas_justificadas')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                        ->where('cat_edo_neg.vp','=','VPM')
                        ->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)
                        ->where('motivo_falta',3)->count ();         

            $faltasM4VPM= DB::table('faltas_justificadas')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                        ->where('cat_edo_neg.vp','=','VPM')
                        ->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)
                        ->where('motivo_falta',4)->count ();         

            $faltasM5VPM= DB::table('faltas_justificadas')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                        ->where('cat_edo_neg.vp','=','VPM')
                        ->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)
                        ->where('motivo_falta',5)->count ();         

            $faltasM6VPM= DB::table('faltas_justificadas')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')
                        ->where('cat_edo_neg.vp','=','VPM')
                        ->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)
                        ->where('motivo_falta',6)->count ();         


            $incapacidadesDDVPM= DB::table('incapacidades')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->where('cat_edo_neg.vp','=','VPM')
                        ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)
                        ->sum('dias');

            $incapacidadesIVPM= DB::table('incapacidades')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->where('cat_edo_neg.vp','=','VPM')
                        ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)
                        ->where('tipo_incapacidad',1)->count ();   
                        
            $incapacidadesSVPM= DB::table('incapacidades')
                        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                            $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })
                        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                        ->where('cat_edo_neg.vp','=','VPM')
                        ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)
                        ->where('tipo_incapacidad',2)->count (); 

            
        $perVPM=Tbl_Empleado_SIA::join('cat_edo_neg','cat_edo_neg.edo_neg','=','Tbl_Empleados_SIA.cveci2')
            ->whereNULL('Fecha_Eg')
            ->where('vp','VPM')
            ->distinct('id_empleado')
            ->select(DB::raw('des_edo_neg, count(distinct tbl_empleados_sia.id_empleado) as perVPM'))      
            ->groupby('des_edo_neg')
            ->get(['des_edo_neg']);        
            
            
        $vacacionesVPM= DB::table('vacaciones2')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPM')
        ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
        ->groupby('vacaciones2.IdVacaciones')
        ->get(['vacaciones2.IdVacaciones']);

        $vacacionesVPM = $vacacionesVPM->unique('IdVacaciones');

        $vacacionesVPM=$vacacionesVPM->count();

        $permisosVPM= DB::table('permisos')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPM')
        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);

        $permisosVPM = $permisosVPM->unique('IdPermiso');

        $permisosVPM=$permisosVPM->count();

        $faltasjustificadasVPM= DB::table('faltas_justificadas')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPM')
        ->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)
        ->groupby('faltas_justificadas.id')
        ->get(['faltas_justificadas.id']);

        $faltasjustificadasVPM = $faltasjustificadasVPM->unique('id');

        $faltasjustificadasVPM=$faltasjustificadasVPM->count();

        $incapacidadesVPM= DB::table('incapacidades')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPM')
        ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)
        ->groupby('incapacidades.id')
        ->get(['incapacidades.id']);

        $incapacidadesVPM = $incapacidadesVPM->unique('id');

        $incapacidadesVPM=$incapacidadesVPM->count();

        $retardosVPM= DB::table('faltas')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPM')
        ->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)
        ->where('IdJustificacion','Retardo')->where('fecha_falta','>=','2023-01-01')
        ->groupby('faltas.id')
        ->get(['faltas.id']);

        $retardosVPM = $retardosVPM->unique('id');

        $retardosVPM=$retardosVPM->count();

        
        $faltasinjustificadasVPM= DB::table('faltas')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPM')
        ->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)
        ->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->where('faltas.fecha_falta','>=','2023-01-01')->where('fecha_falta','<=',date('Y-m-d'))
        ->groupby('faltas.id')
        ->get(['faltas.id']);

        $faltasinjustificadasVPM = $faltasinjustificadasVPM->unique('id');

        $faltasinjustificadasVPM=$faltasinjustificadasVPM->count();


        $vacacionesVPMA= DB::table('vacaciones2')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })

        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPM')
        ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
        ->groupby('vacaciones2.IdVacaciones')
        ->get(['vacaciones2.IdVacaciones']);

        $vacacionesVPMA = $vacacionesVPMA->unique('IdVacaciones');
        $vacacionesVPMA=$vacacionesVPMA->count();

        $vacacionesVPMD= DB::table('vacaciones2')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })

        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPM')
        ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
        ->where('vacaciones2.status','Denegado')
        ->groupby('vacaciones2.IdVacaciones')
        ->get(['vacaciones2.IdVacaciones']);

        $vacacionesVPMD = $vacacionesVPMD->unique('IdVacaciones');
        $vacacionesVPMD=$vacacionesVPMD->count();

        $vacacionesVPMP= DB::table('vacaciones2')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })

        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPM')
        ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
        ->where('vacaciones2.status','Pendiente')
        ->groupby('vacaciones2.IdVacaciones')
        ->get(['vacaciones2.IdVacaciones']);

        $vacacionesVPMP = $vacacionesVPMP->unique('IdVacaciones');
        $vacacionesVPMP=$vacacionesVPMP->count();

        $vacacionesVPMC= DB::table('vacaciones2')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })

        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPM')
        ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
        ->where('vacaciones2.status','Cancelado')
        ->groupby('vacaciones2.IdVacaciones')
        ->get(['vacaciones2.IdVacaciones']);
        
        $vacacionesVPMC = $vacacionesVPMC->unique('IdVacaciones');
        $vacacionesVPMC=$vacacionesVPMC->count();

        $permisosVPMA= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })

        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPM')
        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);

        $permisosVPMA = $permisosVPMA->unique('IdPermiso');
        $permisosVPMA=$permisosVPMA->count();

        $permisosVPMD= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })

        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPM')
        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
        ->where('permisos.status','Denegado')
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);
        
        $permisosVPMD = $permisosVPMD->unique('IdPermiso');
        $permisosVPMD=$permisosVPMD->count();

        $permisosVPMP= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })

        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPM')
        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
        ->where('permisos.status','Pendiente')
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);
       
        $permisosVPMP = $permisosVPMP->unique('IdPermiso');
        $permisosVPMP=$permisosVPMP->count();

        $permisosVPMC= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
        $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })

        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','VPM')
        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
        ->where('permisos.status','Cancelado')
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);
       
        $permisosVPMC = $permisosVPMC->unique('IdPermiso');
        $permisosVPMC=$permisosVPMC->count();

        /***********  VACACIONES X MES ************************* */
        $anio = date('Y');
    
        $departamentoV01= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_vac','=','1')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV02= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_vac','=','2')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV03= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_vac','=','3')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV04= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_vac','=','4')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV05= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_vac','=','5')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV06= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_vac','=','6')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV07= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_vac','=','7')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV08= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_vac','=','8')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV09= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_vac','=','9')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV10= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_vac','=','10')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV11= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_vac','=','11')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   
          $departamentoV12= DB::table('vacaciones2')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_vac','=','12')
                     ->whereYear('fech_ini_vac','=',$anio)->count();   

          $departamentoP01= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_per','=','1')
                     ->whereYear('fech_ini_per','=',$anio)->count();
          $departamentoP02= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_per','=','2')
                     ->whereYear('fech_ini_per','=',$anio)->count();  
          $departamentoP03= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_per','=','3')
                     ->whereYear('fech_ini_per','=',$anio)->count();  
          $departamentoP04= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_per','=','4')
                     ->whereYear('fech_ini_per','=',$anio)->count();  
          $departamentoP05= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_per','=','5')
                     ->whereYear('fech_ini_per','=',$anio)->count();  
          $departamentoP06= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_per','=','6')
                     ->whereYear('fech_ini_per','=',$anio)->count();  
          $departamentoP07= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_per','=','7')
                     ->whereYear('fech_ini_per','=',$anio)->count();  
          $departamentoP08= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_per','=','8')
                     ->whereYear('fech_ini_per','=',$anio)->count();  
          $departamentoP09= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_per','=','9')
                     ->whereYear('fech_ini_per','=',$anio)->count();  
          $departamentoP10= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_per','=','10')
                     ->whereYear('fech_ini_per','=',$anio)->count();  
          $departamentoP11= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_per','=','11')
                     ->whereYear('fech_ini_per','=',$anio)->count();  
          $departamentoP12= DB::table('permisos')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fech_ini_per','=','12')
                     ->whereYear('fech_ini_per','=',$anio)->count();    
          $departamentoFJ01= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio_justificar','=','1')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
          $departamentoFJ02= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio_justificar','=','2')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
          $departamentoFJ03= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio_justificar','=','3')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
          $departamentoFJ04= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio_justificar','=','4')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
          $departamentoFJ05= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio_justificar','=','5')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
          $departamentoFJ06= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio_justificar','=','6')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
          $departamentoFJ07= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio_justificar','=','7')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
          $departamentoFJ08= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio_justificar','=','8')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
          $departamentoFJ09= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio_justificar','=','9')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
          $departamentoFJ10= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio_justificar','=','10')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count(); 
          $departamentoFJ11= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio_justificar','=','11')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count();
          $departamentoFJ12= DB::table('faltas_justificadas')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio_justificar','=','12')
                     ->whereYear('fecha_inicio_justificar','=',$anio)->count();              
          $departamentoI01= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio','=','01')
                     ->whereYear('fecha_inicio','=',$anio)->count();   
          $departamentoI02= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio','=','02')
                     ->whereYear('fecha_inicio','=',$anio)->count();  
          $departamentoI03= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio','=','03')
                     ->whereYear('fecha_inicio','=',$anio)->count();  
          $departamentoI04= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio','=','04')
                     ->whereYear('fecha_inicio','=',$anio)->count();  
          $departamentoI05= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio','=','05')
                     ->whereYear('fecha_inicio','=',$anio)->count();  
          $departamentoI06= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio','=','06')
                     ->whereYear('fecha_inicio','=',$anio)->count();  
          $departamentoI07= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio','=','07')
                     ->whereYear('fecha_inicio','=',$anio)->count();  
          $departamentoI08= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio','=','08')
                     ->whereYear('fecha_inicio','=',$anio)->count();  
          $departamentoI09= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio','=','09')
                     ->whereYear('fecha_inicio','=',$anio)->count();  
          $departamentoI10= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio','=','10')
                     ->whereYear('fecha_inicio','=',$anio)->count();  
          $departamentoI11= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio','=','11')
                     ->whereYear('fecha_inicio','=',$anio)->count();  
          $departamentoI12= DB::table('incapacidades')
                     ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                         $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                     })
                     ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                     ->where('cat_edo_neg.vp','=','VPM')
                     ->whereMonth('fecha_inicio','=','12')
                     ->whereYear('fecha_inicio','=',$anio)->count();             

        return view('VPM.index', compact('departamento','departamentoV','departamentoP','departamentoFJ','departamentoI','departamentoR','departamentoFI','vacacionesVPM','permisosVPM','faltasjustificadasVPM','incapacidadesVPM','vacacionesVPMA','vacacionesVPMD','vacacionesVPMP','vacacionesVPMC','permisosVPMA','permisosVPMD','permisosVPMP','permisosVPMC','inicio','fin','departamentoV01','departamentoV02','departamentoV03','departamentoV04','departamentoV05','departamentoV06','departamentoV07','departamentoV08','departamentoV09','departamentoV10','departamentoV11','departamentoV12','departamentoP01','departamentoP02','departamentoP03','departamentoP04','departamentoP05','departamentoP06','departamentoP07','departamentoP08','departamentoP09','departamentoP10','departamentoP11','departamentoP12','departamentoFJ01','departamentoFJ02','departamentoFJ03','departamentoFJ04','departamentoFJ05','departamentoFJ06','departamentoFJ07','departamentoFJ08','departamentoFJ09','departamentoFJ10','departamentoFJ11','departamentoFJ12','departamentoI01','departamentoI02','departamentoI03','departamentoI04','departamentoI05','departamentoI06','departamentoI07','departamentoI08','departamentoI09','departamentoI10','departamentoI11','departamentoI12','perVPM','vacacionesEvenVPM','vacacionesPerVPM','vacacionesExcVPM','vacacionesDDVPM','permisosDCSVPM','permisosDSSVPM','permisosHCSVPM','permisosHSSVPM','incapacidadesDDVPM','faltasM1VPM','faltasM2VPM','faltasM3VPM','faltasM4VPM','faltasM5VPM','faltasM6VPM','incapacidadesIVPM','incapacidadesSVPM','vacacionesEvenVPM','vacacionesPerVPM','vacacionesExcVPM','vacacionesDDVPM','permisosDCSVPM','permisosDSSVPM','permisosHCSVPM','permisosHSSVPM','incapacidadesDDVPM','faltasM1VPM','faltasM2VPM','faltasM3VPM','faltasM4VPM','faltasM5VPM','faltasM6VPM','incapacidadesIVPM','incapacidadesSVPM','retardosVPM','faltasinjustificadasVPM'));

    }
    
    public function fechasVPM2(Request $request)
    {
        $inicio= ($request->filled('inicial')) ? $request->inicial : date('Y-m-d');
        $fin= ($request->filled('final')) ? $request->final : date('Y-m-d');

        $perVPM=Tbl_Empleado_SIA::join('cat_edo_neg','cat_edo_neg.edo_neg','=','Tbl_Empleados_SIA.cveci2')
                     ->whereNULL('Fecha_Eg')
                     ->where('vp','VPM')
                     ->distinct('id_empleado')
                     ->select(DB::raw('des_edo_neg, count(distinct tbl_empleados_sia.id_empleado) as perVPM'))      
                     ->groupby('des_edo_neg')
                     ->get(['des_edo_neg']);     

        $departamentoVPM = DB::table('permisos')
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
        ->where('cat_edo_neg.vp','=','VPM')
        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
        ->select(DB::raw('cat_puestos.Puesto, count(permisos.IdPermiso) as contper'))      
        ->groupby('cat_puestos.Puesto')
        ->get(['cat_puestos.Puesto']);  


       $permisosVPM= DB::table('permisos')->distinct()
       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->where('cat_edo_neg.vp','=','VPM')
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->groupby('permisos.IdPermiso')
       ->get(['permisos.IdPermiso']);

       $permisosVPM = $permisosVPM->unique('IdPermiso');

       $permisosVPM=$permisosVPM->count();

       $incapacidadesVPM= DB::table('incapacidades')->distinct()
       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
       $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->where('cat_edo_neg.vp','=','VPM')
       ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)
       ->groupby('incapacidades.id')
       ->get(['incapacidades.id']);

       $incapacidadesVPM = $incapacidadesVPM->unique('id');

       $incapacidadesVPM=$incapacidadesVPM->count();


       $vacacionesVPMA= DB::table('vacaciones2')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
       $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })

       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->where('cat_edo_neg.vp','VPM')
       ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
       ->groupby('vacaciones2.IdVacaciones')
       ->get(['vacaciones2.IdVacaciones']);

       $vacacionesVPMA = $vacacionesVPMA->unique('IdVacaciones');
       $vacacionesVPMA=$vacacionesVPMA->count();

       $vacacionesVPMD= DB::table('vacaciones2')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
       $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })

       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->where('cat_edo_neg.vp','VPM')
       ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
       ->where('vacaciones2.status','Denegado')
       ->groupby('vacaciones2.IdVacaciones')
       ->get(['vacaciones2.IdVacaciones']);

       $vacacionesVPMD = $vacacionesVPMD->unique('IdVacaciones');
       $vacacionesVPMD=$vacacionesVPMD->count();

       $vacacionesVPMP= DB::table('vacaciones2')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
       $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })

       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->where('cat_edo_neg.vp','VPM')
       ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
       ->where('vacaciones2.status','Pendiente')
       ->groupby('vacaciones2.IdVacaciones')
       ->get(['vacaciones2.IdVacaciones']);

       $vacacionesVPMP = $vacacionesVPMP->unique('IdVacaciones');
       $vacacionesVPMP=$vacacionesVPMP->count();

       $vacacionesVPMC= DB::table('vacaciones2')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
       $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })

       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->where('cat_edo_neg.vp','VPM')
       ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
       ->where('vacaciones2.status','Cancelado')
       ->groupby('vacaciones2.IdVacaciones')
       ->get(['vacaciones2.IdVacaciones']);
       
       $vacacionesVPMC = $vacacionesVPMC->unique('IdVacaciones');
       $vacacionesVPMC=$vacacionesVPMC->count();
/***************permisos autorizados ********** */
       $permisosVPMA= DB::table('permisos')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
       })
       
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
       ->where('cat_edo_neg.vp','VPM')
       ->where('permisos.status','Aplicado')
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as vpma'))      
       ->groupby('cat_puestos.Puesto')
       ->get(['cat_puestos.Puesto']);

/***************permisos denegados ********** */

       $permisosVPMD= DB::table('permisos')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
       })
       
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
       ->where('cat_edo_neg.vp','VPM')
       ->where('permisos.status','Denegado')
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as vpmd'))      
       ->groupby('cat_puestos.Puesto')
       ->get(['cat_puestos.Puesto']);

  
      /***************permisos pendientes ********** */

       $permisosVPMP= DB::table('permisos')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
       })
       
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
       ->where('cat_edo_neg.vp','VPM')
       ->where('permisos.status','Pendiente')
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as vpmp'))      
       ->groupby('cat_puestos.Puesto')
       ->get(['cat_puestos.Puesto']);
      
/***************permisos cancelados ********** */

       $permisosVPMC= DB::table('permisos')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
       })
       
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
       ->where('cat_edo_neg.vp','VPM')
       ->where('permisos.status','Cancelado')
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as vpmc'))      
       ->groupby('cat_puestos.Puesto')
       ->get(['cat_puestos.Puesto']);

/***************tipos de permisos ********** */

       $permisodcs = DB::table('permisos')
       ->join('Tbl_empleados_SIA', function (JoinClause $join) { 
          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_permisos','cat_permisos.id_permiso','permisos.tipo_per')
       ->where('cat_edo_neg.vp','VPM')
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
       ->where('cat_edo_neg.vp','VPM')
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
       ->where('cat_edo_neg.vp','VPM')
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
       ->where('cat_edo_neg.vp','VPM')
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
       ->where('cat_edo_neg.vp','VPM')
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
       ->where('cat_edo_neg.vp','VPM')
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
       ->where('cat_edo_neg.vp','VPM')
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
       ->where('cat_edo_neg.vp','VPM')
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
                      ->where('cat_edo_neg.vp','=','VPM')
                      ->whereMonth('fech_ini_per','=','1')
                      ->whereYear('fech_ini_per','=',$anio)->count();
           $departamentoP02= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPM')
                      ->whereMonth('fech_ini_per','=','2')
                      ->whereYear('fech_ini_per','=',$anio)->count();  
           $departamentoP03= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPM')
                      ->whereMonth('fech_ini_per','=','3')
                      ->whereYear('fech_ini_per','=',$anio)->count();  
           $departamentoP04= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPM')
                      ->whereMonth('fech_ini_per','=','4')
                      ->whereYear('fech_ini_per','=',$anio)->count();  
           $departamentoP05= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPM')
                      ->whereMonth('fech_ini_per','=','5')
                      ->whereYear('fech_ini_per','=',$anio)->count();  
           $departamentoP06= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPM')
                      ->whereMonth('fech_ini_per','=','6')
                      ->whereYear('fech_ini_per','=',$anio)->count();  
           $departamentoP07= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPM')
                      ->whereMonth('fech_ini_per','=','7')
                      ->whereYear('fech_ini_per','=',$anio)->count();  
           $departamentoP08= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPM')
                      ->whereMonth('fech_ini_per','=','8')
                      ->whereYear('fech_ini_per','=',$anio)->count();  
           $departamentoP09= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPM')
                      ->whereMonth('fech_ini_per','=','9')
                      ->whereYear('fech_ini_per','=',$anio)->count();  
           $departamentoP10= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPM')
                      ->whereMonth('fech_ini_per','=','10')
                      ->whereYear('fech_ini_per','=',$anio)->count();  
           $departamentoP11= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPM')
                      ->whereMonth('fech_ini_per','=','11')
                      ->whereYear('fech_ini_per','=',$anio)->count();  
           $departamentoP12= DB::table('permisos')
                      ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                          $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                      })
                      ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                      ->where('cat_edo_neg.vp','=','VPM')
                      ->whereMonth('fech_ini_per','=','12')
                      ->whereYear('fech_ini_per','=',$anio)->count();      

       return view('VPM.detalle', compact('permisosVPM','permisosVPMA','permisosVPMD','permisosVPMP','permisosVPMC','inicio','fin','departamentoP01','departamentoP02','departamentoP03','departamentoP04','departamentoP05','departamentoP06','departamentoP07','departamentoP08','departamentoP09','departamentoP10','departamentoP11','departamentoP12','departamentoVPM','permisosdcs','permisosdss','permisoshcs','permisoshss','permisodcs','permisodss','permisohcs','permisohss','sumdcs','sumdss','sumhcs','sumhss','perVPM','vacacionesVPMD'));


    }

    public function excepcionesVPM(request $request)
    {

        $inicio='';
        $fin ='';

        $departamento = DB::table('cat_edo_neg')
        ->where('vp','VPM')
        ->groupby('des_edo_neg')
       ->get(['des_edo_neg']);

       $depVPMVE = DB::table('vacaciones2')
       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','vacaciones2.jefe_directo')
       ->where('cat_edo_neg.vp','=','VPM')
       ->where('vacaciones2.excepcion',1)
       ->select(DB::raw('cat_edo_neg.des_edo_neg, count(distinct vacaciones2.IdVacaciones) as excevac, cat_puestos.Puesto'))      
       ->groupby('cat_edo_neg.des_edo_neg','cat_puestos.Puesto')
       ->get(['cat_edo_neg.des_edo_neg']); 

       $depVPMPE = DB::table('permisos')
       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
       ->where('cat_edo_neg.vp','=','VPM')
       ->where('permisos.excepcion',1)
       ->select(DB::raw('cat_edo_neg.des_edo_neg, count(distinct permisos.IdPermiso) as exceper, cat_puestos.Puesto'))      
       ->groupby('cat_edo_neg.des_edo_neg','cat_puestos.Puesto')
       ->get(['cat_edo_neg.des_edo_neg']); 

       $detallevacVPM = DB::table('vacaciones2')
       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','vacaciones2.jefe_directo')
       ->where('cat_edo_neg.vp','=','VPM')
       ->where('vacaciones2.excepcion',1)
       ->orderby('cat_edo_neg.des_edo_neg')
       ->get(); 

       $detalleperVPM = DB::table('permisos')
       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
       ->where('cat_edo_neg.vp','=','VPM')
       ->where('permisos.excepcion',1)
       ->orderby('cat_edo_neg.des_edo_neg')
       ->get(); 
/******************************************************************************* */
        $excepcionVPMV= DB::table('vacaciones2')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPM')
        ->where('vacaciones2.excepcion',1)
        ->count();

        $excepcionVPMP= DB::table('permisos')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPM')
        ->where('permisos.excepcion',1)
        ->count();
     
        return view('VPM.excepcionesVPM', compact('inicio','fin','excepcionVPMV','excepcionVPMP','departamento','depVPMVE','depVPMPE','detallevacVPM','detalleperVPM'));
 
    }


    public function fechas_excepVPM(request $request)
    {

        $inicio= ($request->filled('inicial')) ? $request->inicial : date('Y-m-d');
        $fin= ($request->filled('final')) ? $request->final : date('Y-m-d');

        $departamento = DB::table('cat_edo_neg')
        ->where('vp','VPM')
        ->groupby('des_edo_neg')
       ->get(['des_edo_neg']);

       $depVPMVE = DB::table('vacaciones2')
       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','vacaciones2.jefe_directo')
       ->where('cat_edo_neg.vp','=','VPM')
       ->where('vacaciones2.excepcion',1)
       ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
       ->select(DB::raw('cat_edo_neg.des_edo_neg, count(distinct vacaciones2.IdVacaciones) as excevac, cat_puestos.Puesto'))      
       ->groupby('cat_edo_neg.des_edo_neg','cat_puestos.Puesto')
       ->get(['cat_edo_neg.des_edo_neg']); 

       $depVPMPE = DB::table('permisos')
       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
       ->where('cat_edo_neg.vp','=','VPM')
       ->where('permisos.excepcion',1)
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->select(DB::raw('cat_edo_neg.des_edo_neg, count(distinct permisos.IdPermiso) as exceper, cat_puestos.Puesto'))      
       ->groupby('cat_edo_neg.des_edo_neg','cat_puestos.Puesto')
       ->get(['cat_edo_neg.des_edo_neg']); 

       $detallevacVPM = DB::table('vacaciones2')
       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','vacaciones2.jefe_directo')
       ->where('cat_edo_neg.vp','=','VPM')
       ->where('vacaciones2.excepcion',1)
       ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)

       ->orderby('cat_edo_neg.des_edo_neg')
       ->get(); 

       $detalleperVPM = DB::table('permisos')
       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
       ->where('cat_edo_neg.vp','=','VPM')
       ->where('permisos.excepcion',1)
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)

       ->orderby('cat_edo_neg.des_edo_neg')
       ->get(); 
               
/******************************************************************************* */
        $excepcionVPMV= DB::table('vacaciones2')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPM')
        ->where('vacaciones2.excepcion',1)
        ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)

        ->count();

        $excepcionVPMP= DB::table('permisos')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPM')
        ->where('permisos.excepcion',1)
        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
        ->count();
     
        return view('VPM.excepcionesVPM', compact('inicio','fin','excepcionVPMV','excepcionVPMP','departamento','depVPMVE','depVPMPE','detallevacVPM','detalleperVPM'));
   
    }
}
