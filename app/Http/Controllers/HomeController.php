<?php

namespace App\Http\Controllers;

use App\Formato_P07;

use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        date_default_timezone_set('America/Mexico_City');
        $inicio='';
        $fin ='';
        $dia =date('d/m');
        $hora = date("G").":00"; 
        $dia_semana = date("N");

        /***************montos generales ******************/
      
        $meta = Formato_P07::select('cantidad_total','eficiencia_total')->first();

        $cantidad_dia = Formato_P07::sum('cantidad_d'.$dia_semana); 
        $eficiencia_dia = Formato_P07::sum('eficiencia_d'.$dia_semana);

        $cantidad_acum=0;
        for($i=1;$i<=$dia_semana;$i++){
            $dia = Formato_P07::sum('cantidad_d'.$i); 
            $cantidad_acum = $cantidad_acum +  $dia;
        }

        
        $tiempo_desocupacion = 630*0.98;
        $horas_laboradas = 10.5;
        $horas_laboradas2 = 5.5;
             
    return view('avanceproduccion', compact('meta','tiempo_desocupacion','horas_laboradas','horas_laboradas2', 'dia','hora','cantidad_dia','eficiencia_dia','inicio','fin'));
    }

    public function fechas(Request $request)
    {
    
      //dd($request->all());
        $inicio= ($request->filled('inicial')) ? $request->inicial : date('Y-m-d');
        $fin= ($request->filled('final')) ? $request->final : date('Y-m-d');

              /***************monto global ******************/
              $vacaciones = Vacaciones::where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)->count();
              $permisos = FormatoPermisos::where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->count();
              $faltasjustificadas = FaltasJustificadas::where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)->count();
              $incapacidades = Incapacidades::where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)->count();
              $retardos = Retardos::where('IdJustificacion','Retardo')->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
              $faltasinjustificadas = DB::table('Tbl_Empleados_SIA')
              ->leftjoin('faltas', function (JoinClause $join) {
                      $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado') ->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                  })->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->where('faltas.fecha_falta','>','2023-01-01')->where('faltas.fecha_falta','<',date('Y-m-d'))->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();

               /***************monto global x dias ******************/

                $vacacionesDD = Vacaciones::where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)->sum('dias_solicitud');

                $vacacionesEven = Vacaciones::where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)->sum('eventualidades');
                $vacacionesPer = Vacaciones::where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)->sum('periodos');
                $vacacionesExc = Vacaciones::where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)->sum('excepcion');

                $permisosDD = FormatoPermisos::where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->sum('dias');
        
                $permisosDCS = FormatoPermisos::join('cat_permisos','cat_permisos.id_permiso','=','permisos.tipo_per')
                ->where('forma',1)->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->count ();
                $permisosDSS = FormatoPermisos::join('cat_permisos','cat_permisos.id_permiso','=','permisos.tipo_per')
                ->where('forma',2)->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->count ();
                $permisosHCS = FormatoPermisos::join('cat_permisos','cat_permisos.id_permiso','=','permisos.tipo_per')
                ->where('forma',3)->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->count ();
                $permisosHSS = FormatoPermisos::join('cat_permisos','cat_permisos.id_permiso','=','permisos.tipo_per')
                ->where('forma',4)->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->count ();
        

                $faltasjustificadasDD = FaltasJustificadas::where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)->count();

                $faltasM1 = FaltasJustificadas::join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')->where('motivo_falta',1)->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)->count ();
                $faltasM2 = FaltasJustificadas::join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')->where('motivo_falta',2)->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)->count ();
                $faltasM3 = FaltasJustificadas::join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')->where('motivo_falta',3)->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)->count ();
                $faltasM4 = FaltasJustificadas::join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')->where('motivo_falta',4)->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)->count ();
                $faltasM5 = FaltasJustificadas::join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')->where('motivo_falta',5)->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)->count ();
                $faltasM6 = FaltasJustificadas::join('cat_motivos_faltasjusti','cat_motivos_faltasjusti.id','=','faltas_justificadas.motivo_falta')->where('motivo_falta',6)->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)->count ();
              
                $incapacidadesDD = Incapacidades::where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)->sum('dias');
                $incapacidadesI = Incapacidades::where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)->where('tipo_incapacidad',1)->count();
                $incapacidadesS = Incapacidades::where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)->where('tipo_incapacidad',2)->count();

                /**********************conteo x planta ****************************/
                $planta = DB::table('Tbl_empleados_SIA')
                ->groupby('Id_Planta')
                ->get(['Id_Planta']);

                $plantaV= DB::table('Tbl_Empleados_SIA')
                            ->leftjoin('vacaciones2', function (JoinClause $join) {
                                $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado') ;
                            })
                            ->select(DB::raw('Tbl_Empleados_SIA.Id_Planta, count(distinct vacaciones2.IdVacaciones) as vacplanta'))    
                            ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)    
                            ->groupby('Tbl_Empleados_SIA.Id_Planta')
                            ->get(['Tbl_Empleados_SIA.Id_Planta']);      

                $plantaP= DB::table('Tbl_Empleados_SIA')
                            ->leftjoin('permisos', function (JoinClause $join) {
                                $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado') ;
                            })
                            ->select(DB::raw('Tbl_Empleados_SIA.Id_Planta, count(distinct permisos.IdPermiso) as perplanta'))   
                            ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)     
                            ->groupby('Tbl_Empleados_SIA.Id_Planta')
                            ->get(['Tbl_Empleados_SIA.Id_Planta']);      

                $plantaFJ= DB::table('Tbl_Empleados_SIA')
                            ->leftjoin('faltas_justificadas', function (JoinClause $join) {
                                $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado') ;
                            })
                            ->select(DB::raw('Tbl_Empleados_SIA.Id_Planta, count(distinct faltas_justificadas.id) as falplanta')) 
                            ->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)       
                            ->groupby('Tbl_Empleados_SIA.Id_Planta')
                            ->get(['Tbl_Empleados_SIA.Id_Planta']);   

                $plantaI= DB::table('Tbl_Empleados_SIA')
                            ->leftjoin('incapacidades', function (JoinClause $join) {
                                $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado') ;
                            })
                            ->select(DB::raw('Tbl_Empleados_SIA.Id_Planta, count(distinct incapacidades.id) as incplanta')) 
                            ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)       
                            ->groupby('Tbl_Empleados_SIA.Id_Planta')
                            ->get(['Tbl_Empleados_SIA.Id_Planta']);        
                            
                $plantaR= DB::table('Tbl_Empleados_SIA')
                            ->leftjoin('faltas', function (JoinClause $join) {
                                $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado') ;
                            })
                            ->where('fecha_falta','>=','2023-01-01')
                            ->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)       
                            ->where('IdJustificacion','Retardo')
                            ->select(DB::raw('Tbl_Empleados_SIA.Id_Planta, count(distinct faltas.id) as retplanta'))      
                            ->groupby('Tbl_Empleados_SIA.Id_Planta')
                            ->get(['Tbl_Empleados_SIA.Id_Planta']);   

                           // dd($plantaR);
     
                $plantaFI= DB::table('Tbl_Empleados_SIA')
                            ->leftjoin('faltas', function (JoinClause $join) {
                                $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado') ;
                            })
                            ->where('fecha_falta','>=','2023-01-01')
                            ->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)       
                            ->whereNull('IdJustificacion')
                            ->where('idIncidencia','INASISTENC')
                            ->where('fecha_falta','<',date('Y-m-d'))
                            ->select(DB::raw('Tbl_Empleados_SIA.Id_Planta, count(distinct faltas.id) as fiplanta'))      
                            ->groupby('Tbl_Empleados_SIA.Id_Planta')
                            ->get(['Tbl_Empleados_SIA.Id_Planta']);   
      
              /***************conteo aplicada, denegada, pendiente, cancelada ********** */
              $vacacionesA = Vacaciones::where('status','Aplicado')->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)->count();
              $vacacionesD = Vacaciones::where('status','Denegado')->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)->count();
              $vacacionesP = Vacaciones::where('status','Pendiente')->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)->count();
              $vacacionesC = Vacaciones::where('status','Cancelado')->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)->count();
             
              $permisosA = FormatoPermisos::where('status','Aplicado')->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->count();
              $permisosD = FormatoPermisos::where('status','Denegado')->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->count();
              $permisosP = FormatoPermisos::where('status','Pendiente')->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->count();
              $permisosC = FormatoPermisos::where('status','Cancelado')->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->count();
      
              /*********************************VACACIONES VP *********************************/
      
              $vacacionesVPF= DB::table('vacaciones2')->distinct()
              ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                  $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
              })
              ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
              ->where('cat_edo_neg.vp','=','VPF')
              ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
              ->groupby('vacaciones2.IdVacaciones')
              ->get(['vacaciones2.IdVacaciones']);
      
              $vacacionesVPF = $vacacionesVPF->unique('IdVacaciones');
      
              $vacacionesVPF=$vacacionesVPF->count();
      
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
      
              $vacacionesVPV= DB::table('vacaciones2')->distinct()
              ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                  $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
              })
              ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
              ->where('cat_edo_neg.vp','=','VPV')
              ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
              ->groupby('vacaciones2.IdVacaciones')
              ->get(['vacaciones2.IdVacaciones']);
      
              $vacacionesVPV = $vacacionesVPV->unique('IdVacaciones');
      
              $vacacionesVPV=$vacacionesVPV->count();
      /*********************************PERMISOS VP*********************************/
              $permisosVPF= DB::table('permisos')->distinct()
              ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                  $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
              })
              ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
              ->where('cat_edo_neg.vp','=','VPF')
              ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
              ->groupby('permisos.IdPermiso')
              ->get(['permisos.IdPermiso']);
      
              $permisosVPF = $permisosVPF->unique('IdPermiso');
      
              $permisosVPF=$permisosVPF->count();
      
              $permisosVPV= DB::table('permisos')->distinct()
              ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                  $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
              })
              ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
              ->where('cat_edo_neg.vp','=','VPV')
              ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
              ->groupby('permisos.IdPermiso')
              ->get(['permisos.IdPermiso']);
      
              $permisosVPV = $permisosVPV->unique('IdPermiso');
      
              $permisosVPV=$permisosVPV->count();
      
      
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
      
              /*********************************FALTAS JUSTIFICADAS VP*********************************/
              $faltasjustificadasVPF= DB::table('faltas_justificadas')->distinct()
              ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                  $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
              })
              ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
              ->where('cat_edo_neg.vp','=','VPF')
              ->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)
              ->groupby('faltas_justificadas.id')
              ->get(['faltas_justificadas.id']);
      
              $faltasjustificadasVPF = $faltasjustificadasVPF->unique('id');
      
              $faltasjustificadasVPF=$faltasjustificadasVPF->count();
      
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
      
              $faltasjustificadasVPV= DB::table('faltas_justificadas')->distinct()
              ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                  $join->on('faltas_justificadas.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
              })
              ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
              ->where('cat_edo_neg.vp','=','VPV')
              ->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)
              ->groupby('faltas_justificadas.id')
              ->get(['faltas_justificadas.id']);
      
              $faltasjustificadasVPV = $faltasjustificadasVPV->unique('id');
      
              $faltasjustificadasVPV=$faltasjustificadasVPV->count();
      
              /*********************************INCAPACIDADES VP*********************************/
              $incapacidadesVPF= DB::table('incapacidades')->distinct()
              ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                  $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
              })
              ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
              ->where('cat_edo_neg.vp','=','VPF')
              ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)
              ->groupby('incapacidades.id')
              ->get(['incapacidades.id']);
          
              $incapacidadesVPF = $incapacidadesVPF->unique('id');
         
              $incapacidadesVPF=$incapacidadesVPF->count();
      
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
      
              $incapacidadesVPV= DB::table('incapacidades')->distinct()
              ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                  $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
              })
              ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
              ->where('cat_edo_neg.vp','=','VPV')
              ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)
              ->groupby('incapacidades.id')
              ->get(['incapacidades.id']);
          
              $incapacidadesVPV = $incapacidadesVPV->unique('id');
         
              $incapacidadesVPV=$incapacidadesVPV->count();

                /*********************************RETARDOS VP*********************************/
                    $retardosVPF= DB::table('faltas')->distinct()
                    ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                    })
                    ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                    ->where('cat_edo_neg.vp','=','VPF')
                    ->where('faltas.IdJustificacion','Retardo')
                    ->where('faltas.fecha_falta','>=',$inicio)->where('faltas.fecha_falta','<=',$fin)
                    ->groupby('faltas.id')
                    ->get(['faltas.id']);

                    $retardosVPF = $retardosVPF->unique('id');

                    $retardosVPF=$retardosVPF->count();

                    $retardosVPM= DB::table('faltas')->distinct()
                    ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                    })
                    ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                    ->where('cat_edo_neg.vp','=','VPM')
                    ->where('faltas.IdJustificacion','Retardo')
                    ->where('faltas.fecha_falta','>=',$inicio)->where('faltas.fecha_falta','<=',$fin)
                    ->groupby('faltas.id')
                    ->get(['faltas.id']);

                    $retardosVPM = $retardosVPM->unique('id');

                    $retardosVPM=$retardosVPM->count();

                    $retardosVPRH= DB::table('faltas')->distinct()
                    ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                    })
                    ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                    ->where('cat_edo_neg.vp','=','VPRH')
                    ->where('faltas.IdJustificacion','Retardo')
                    ->where('faltas.fecha_falta','>=',$inicio)->where('faltas.fecha_falta','<=',$fin)
                    ->groupby('faltas.id')
                    ->get(['faltas.id']);

                    $retardosVPRH = $retardosVPRH->unique('id');

                    $retardosVPRH=$retardosVPRH->count();

                    $retardosVPV= DB::table('faltas')->distinct()
                    ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                    })
                    ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                    ->where('cat_edo_neg.vp','=','VPV')
                    ->where('faltas.IdJustificacion','Retardo')
                    ->where('faltas.fecha_falta','>=',$inicio)->where('faltas.fecha_falta','<=',$fin)
                    ->groupby('faltas.id')
                    ->get(['faltas.id']);

                    $retardosVPV = $retardosVPV->unique('id');

                    $retardosVPV=$retardosVPV->count();
                    
                        /*********************************FALTAS INJUSTIFICADAS VP*********************************/
                    $faltasinjustificadasVPF= DB::table('faltas')->distinct()
                    ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                    })
                    ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                    ->where('cat_edo_neg.vp','=','VPF')
                    ->whereNull('IdJustificacion')
                    ->where('idIncidencia','INASISTENC')
                    ->where('faltas.fecha_falta','>=',$inicio)->where('faltas.fecha_falta','<=',$fin)
                    ->where('fecha_falta','<',date('Y-m-d'))
                    ->groupby('faltas.id')
                    ->get(['faltas.id']);

                    $faltasinjustificadasVPF = $faltasinjustificadasVPF->unique('id');

                    $faltasinjustificadasVPF=$faltasinjustificadasVPF->count();

                    $faltasinjustificadasVPM= DB::table('faltas')->distinct()
                    ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                    })
                    ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                    ->where('cat_edo_neg.vp','=','VPM')
                    ->whereNull('IdJustificacion')
                    ->where('idIncidencia','INASISTENC')
                    ->where('faltas.fecha_falta','>=',$inicio)->where('faltas.fecha_falta','<=',$fin)
                    ->where('fecha_falta','<',date('Y-m-d'))
                    ->groupby('faltas.id')
                    ->get(['faltas.id']);

                    $faltasinjustificadasVPM = $faltasinjustificadasVPM->unique('id');

                    $faltasinjustificadasVPM=$faltasinjustificadasVPM->count();

                    $faltasinjustificadasVPRH= DB::table('faltas')->distinct()
                    ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                    })
                    ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                    ->where('cat_edo_neg.vp','=','VPRH')
                    ->whereNull('IdJustificacion')
                    ->where('idIncidencia','INASISTENC')  
                    ->where('faltas.fecha_falta','>=',$inicio)->where('faltas.fecha_falta','<=',$fin)
                    ->where('fecha_falta','<',date('Y-m-d'))
                    ->groupby('faltas.id')
                    ->get(['faltas.id']);

                    $faltasinjustificadasVPRH = $faltasinjustificadasVPRH->unique('id');

                    $faltasinjustificadasVPRH=$faltasinjustificadasVPRH->count();

                    $faltasinjustificadasVPV= DB::table('faltas')->distinct()
                    ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                    })
                    ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                    ->where('cat_edo_neg.vp','=','VPV')
                    ->whereNull('IdJustificacion')
                    ->where('idIncidencia','INASISTENC')   
                    ->where('faltas.fecha_falta','>=',$inicio)->where('faltas.fecha_falta','<=',$fin)
                    ->where('fecha_falta','<',date('Y-m-d'))
                    ->groupby('faltas.id')
                    ->get(['faltas.id']);

                    $faltasinjustificadasVPV = $faltasinjustificadasVPV->unique('id');

                    $faltasinjustificadasVPV=$faltasinjustificadasVPV->count();


                    /*********************************VACACIONES VP X DIAS x planta*********************************/
                $vacacionesPID= DB::table('vacaciones2')->distinct()
                ->join('Tbl_empleados_SIA', function (JoinClause $join) {
                    $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                })
                ->where('Id_Planta','Intimark1')
                ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
                ->get();

                $vacacionesPID = $vacacionesPID->unique('IdVacaciones');
                $vacacionesPID=$vacacionesPID->sum('dias_solicitud');

                $vacacionesPIID= DB::table('vacaciones2')->distinct()
                ->join('Tbl_empleados_SIA', function (JoinClause $join) {
                    $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                })
                ->where('Id_Planta','Intimark2')
                ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
                ->get();

                $vacacionesPIID = $vacacionesPIID->unique('IdVacaciones');
                $vacacionesPIID=$vacacionesPIID->sum('dias_solicitud');
                /*********************************VACACIONES VP X DIAS*********************************/
         $vacacionesVPFD= DB::table('vacaciones2')->distinct()
         ->join('Tbl_empleados_SIA', function (JoinClause $join) {
             $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
         ->where('cat_edo_neg.vp','=','VPF')
         ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
         ->get();

         $vacacionesVPFD = $vacacionesVPFD->unique('IdVacaciones');
         $vacacionesVPFD=$vacacionesVPFD->sum('dias_solicitud');

 
         $vacacionesVPMD= DB::table('vacaciones2')->distinct()
         ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
             $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')    
         ->where('cat_edo_neg.vp','=','VPM')
         ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
         ->get();
         $vacacionesVPMD = $vacacionesVPMD->unique('IdVacaciones');
         $vacacionesVPMD=$vacacionesVPMD->sum('dias_solicitud');
        
         $vacacionesVPRHD= DB::table('vacaciones2')->distinct()
         ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
             $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
         ->where('cat_edo_neg.vp','=','VPRH')
         ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
         ->get();
         $vacacionesVPRHD = $vacacionesVPRHD->unique('IdVacaciones');
         $vacacionesVPRHD=$vacacionesVPRHD->sum('dias_solicitud');

         $vacacionesVPVD= DB::table('vacaciones2')->distinct()
         ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
             $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
         ->where('cat_edo_neg.vp','=','VPV')
         ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
         ->get();
         $vacacionesVPVD = $vacacionesVPVD->unique('IdVacaciones');
         $vacacionesVPVD=$vacacionesVPVD->sum('dias_solicitud');

        /*********************************PERMISOS VP X DIAS x planta*********************************/
                
        $permisosPIDia= DB::table('permisos')->distinct()
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->where('Id_Planta','Intimark1')
        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
        ->get();

        $permisosPIDia = $permisosPIDia->unique('IdPermiso');
        $permisosPIDia=$permisosPIDia->sum('dias');

        $permisosPIIDia= DB::table('permisos')->distinct()
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->where('Id_Planta','Intimark2')
        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
        ->get();

        $permisosPIIDia = $permisosPIIDia->unique('IdPermiso');
        $permisosPIIDia=$permisosPIIDia->sum('dias');

       /*********************************PERMISOS VP X DIAS*********************************/
        
       $permisosVPFDia= DB::table('permisos')->distinct()
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->where('cat_edo_neg.vp','=','VPF')
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->get();

       $permisosVPFDia = $permisosVPFDia->unique('IdPermiso');
       $permisosVPFDia=$permisosVPFDia->sum('dias');


       $permisosVPMDia= DB::table('permisos')->distinct()
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->where('cat_edo_neg.vp','=','VPM')
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->get();

       $permisosVPMDia = $permisosVPMDia->unique('IdPermiso');
       $permisosVPMDia=$permisosVPMDia->sum('dias');

      
       $permisosVPRHDia= DB::table('permisos')->distinct()
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->where('cat_edo_neg.vp','=','VPRH')
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->get();

       $permisosVPRHDia = $permisosVPRHDia->unique('IdPermiso');
       $permisosVPRHDia=$permisosVPRHDia->sum('dias');


       $permisosVPVDia= DB::table('permisos')->distinct()
       ->join('Tbl_empleados_SIA', function (JoinClause $join) {
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
       })
       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
       ->where('cat_edo_neg.vp','=','VPV')
       ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
       ->get();

       $permisosVPVDia = $permisosVPVDia->unique('IdPermiso');
       $permisosVPVDia=$permisosVPVDia->sum('dias');

        /*********************************INCAPACIDADES VP X DIAS x planta*********************************/
        $incapacidadesPID= DB::table('incapacidades')
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->where('Id_Planta','Intimark1')
        ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)
        ->get();
        
        $incapacidadesPID=$incapacidadesPID->sum('dias');

        $incapacidadesPIID= DB::table('incapacidades')
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->where('Id_Planta','Intimark2')
        ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)
        ->get();

        $incapacidadesPIID=$incapacidadesPIID->sum('dias');


 /*********************************INCAPACIDADES VP X DIAS*********************************/
            $incapacidadesVPFD= DB::table('incapacidades')
            ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
            })
            ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
            ->where('cat_edo_neg.vp','=','VPF')
            ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)
            ->get();

            $incapacidadesVPFD=$incapacidadesVPFD->sum('dias');

            $incapacidadesVPMD= DB::table('incapacidades')
            ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
            })
            ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
            ->where('cat_edo_neg.vp','=','VPM')
            ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)

            ->get();

            $incapacidadesVPMD=$incapacidadesVPMD->sum('dias');


            $incapacidadesVPRHD= DB::table('incapacidades')
            ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
            })
            ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
            ->where('cat_edo_neg.vp','=','VPRH')
            ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)

            ->get();

            $incapacidadesVPRHD=$incapacidadesVPRHD->sum('dias');


            $incapacidadesVPVD= DB::table('incapacidades')
            ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('incapacidades.fk_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
            })
            ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
            ->where('cat_edo_neg.vp','=','VPV')
            ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)

            ->get();

            $incapacidadesVPVD=$incapacidadesVPVD->sum('dias');


              /***********  VACACIONES X MES ************************* */
        $anio = date('Y');
        
        $vacaciones01 = Vacaciones::whereMonth('fech_ini_vac','=','1')->whereYear('fech_ini_vac','=',$anio)->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)->count();
        $vacaciones02 = Vacaciones::whereMonth('fech_ini_vac','=','2')->whereYear('fech_ini_vac','=',$anio)->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)->count();
        $vacaciones03 = Vacaciones::whereMonth('fech_ini_vac','=','3')->whereYear('fech_ini_vac','=',$anio)->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)->count();
        $vacaciones04 = Vacaciones::whereMonth('fech_ini_vac','=','4')->whereYear('fech_ini_vac','=',$anio)->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)->count();
        $vacaciones05 = Vacaciones::whereMonth('fech_ini_vac','=','5')->whereYear('fech_ini_vac','=',$anio)->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)->count();
        $vacaciones06 = Vacaciones::whereMonth('fech_ini_vac','=','6')->whereYear('fech_ini_vac','=',$anio)->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)->count();
        $vacaciones07 = Vacaciones::whereMonth('fech_ini_vac','=','7')->whereYear('fech_ini_vac','=',$anio)->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)->count();
        $vacaciones08 = Vacaciones::whereMonth('fech_ini_vac','=','8')->whereYear('fech_ini_vac','=',$anio)->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)->count();
        $vacaciones09 = Vacaciones::whereMonth('fech_ini_vac','=','9')->whereYear('fech_ini_vac','=',$anio)->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)->count();
        $vacaciones10 = Vacaciones::whereMonth('fech_ini_vac','=','10')->whereYear('fech_ini_vac','=',$anio)->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)->count();
        $vacaciones11 = Vacaciones::whereMonth('fech_ini_vac','=','11')->whereYear('fech_ini_vac','=',$anio)->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)->count();
        $vacaciones12 = Vacaciones::whereMonth('fech_ini_vac','=','12')->whereYear('fech_ini_vac','=',$anio)->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)->count();

        $permisos01 = FormatoPermisos::whereMonth('fech_ini_per','=','1')->whereYear('fech_ini_per','=',$anio)->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->count();
        $permisos02 = FormatoPermisos::whereMonth('fech_ini_per','=','2')->whereYear('fech_ini_per','=',$anio)->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->count();
        $permisos03 = FormatoPermisos::whereMonth('fech_ini_per','=','3')->whereYear('fech_ini_per','=',$anio)->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->count();
        $permisos04 = FormatoPermisos::whereMonth('fech_ini_per','=','4')->whereYear('fech_ini_per','=',$anio)->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->count();
        $permisos05 = FormatoPermisos::whereMonth('fech_ini_per','=','5')->whereYear('fech_ini_per','=',$anio)->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->count();
        $permisos06 = FormatoPermisos::whereMonth('fech_ini_per','=','6')->whereYear('fech_ini_per','=',$anio)->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->count();
        $permisos07 = FormatoPermisos::whereMonth('fech_ini_per','=','7')->whereYear('fech_ini_per','=',$anio)->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->count();
        $permisos08 = FormatoPermisos::whereMonth('fech_ini_per','=','8')->whereYear('fech_ini_per','=',$anio)->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->count();
        $permisos09 = FormatoPermisos::whereMonth('fech_ini_per','=','9')->whereYear('fech_ini_per','=',$anio)->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->count();
        $permisos10 = FormatoPermisos::whereMonth('fech_ini_per','=','10')->whereYear('fech_ini_per','=',$anio)->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->count();
        $permisos11 = FormatoPermisos::whereMonth('fech_ini_per','=','11')->whereYear('fech_ini_per','=',$anio)->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->count();
        $permisos12 = FormatoPermisos::whereMonth('fech_ini_per','=','12')->whereYear('fech_ini_per','=',$anio)->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)->count();

        $faltasj01 = FaltasJustificadas::whereMonth('fecha_inicio_justificar','=','1')->whereYear('fecha_inicio_justificar','=',$anio)->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)->count();
        $faltasj02 = FaltasJustificadas::whereMonth('fecha_inicio_justificar','=','2')->whereYear('fecha_inicio_justificar','=',$anio)->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)->count();
        $faltasj03 = FaltasJustificadas::whereMonth('fecha_inicio_justificar','=','3')->whereYear('fecha_inicio_justificar','=',$anio)->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)->count();
        $faltasj04 = FaltasJustificadas::whereMonth('fecha_inicio_justificar','=','4')->whereYear('fecha_inicio_justificar','=',$anio)->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)->count();
        $faltasj05 = FaltasJustificadas::whereMonth('fecha_inicio_justificar','=','5')->whereYear('fecha_inicio_justificar','=',$anio)->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)->count();
        $faltasj06 = FaltasJustificadas::whereMonth('fecha_inicio_justificar','=','6')->whereYear('fecha_inicio_justificar','=',$anio)->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)->count();
        $faltasj07 = FaltasJustificadas::whereMonth('fecha_inicio_justificar','=','7')->whereYear('fecha_inicio_justificar','=',$anio)->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)->count();
        $faltasj08 = FaltasJustificadas::whereMonth('fecha_inicio_justificar','=','8')->whereYear('fecha_inicio_justificar','=',$anio)->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)->count();
        $faltasj09 = FaltasJustificadas::whereMonth('fecha_inicio_justificar','=','9')->whereYear('fecha_inicio_justificar','=',$anio)->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)->count();
        $faltasj10 = FaltasJustificadas::whereMonth('fecha_inicio_justificar','=','10')->whereYear('fecha_inicio_justificar','=',$anio)->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)->count();
        $faltasj11 = FaltasJustificadas::whereMonth('fecha_inicio_justificar','=','11')->whereYear('fecha_inicio_justificar','=',$anio)->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)->count();
        $faltasj12 = FaltasJustificadas::whereMonth('fecha_inicio_justificar','=','12')->whereYear('fecha_inicio_justificar','=',$anio)->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)->count();

        $incapacidades01 = Incapacidades::whereMonth('fecha_inicio','=','1')->whereYear('fecha_inicio','=',$anio)->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)->count();
        $incapacidades02 = Incapacidades::whereMonth('fecha_inicio','=','2')->whereYear('fecha_inicio','=',$anio)->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)->count();
        $incapacidades03 = Incapacidades::whereMonth('fecha_inicio','=','3')->whereYear('fecha_inicio','=',$anio)->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)->count();
        $incapacidades04 = Incapacidades::whereMonth('fecha_inicio','=','4')->whereYear('fecha_inicio','=',$anio)->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)->count();
        $incapacidades05 = Incapacidades::whereMonth('fecha_inicio','=','5')->whereYear('fecha_inicio','=',$anio)->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)->count();
        $incapacidades06 = Incapacidades::whereMonth('fecha_inicio','=','6')->whereYear('fecha_inicio','=',$anio)->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)->count();
        $incapacidades07 = Incapacidades::whereMonth('fecha_inicio','=','7')->whereYear('fecha_inicio','=',$anio)->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)->count();
        $incapacidades08 = Incapacidades::whereMonth('fecha_inicio','=','8')->whereYear('fecha_inicio','=',$anio)->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)->count();
        $incapacidades09 = Incapacidades::whereMonth('fecha_inicio','=','9')->whereYear('fecha_inicio','=',$anio)->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)->count();
        $incapacidades10 = Incapacidades::whereMonth('fecha_inicio','=','10')->whereYear('fecha_inicio','=',$anio)->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)->count();
        $incapacidades11 = Incapacidades::whereMonth('fecha_inicio','=','11')->whereYear('fecha_inicio','=',$anio)->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)->count();
        $incapacidades12 = Incapacidades::whereMonth('fecha_inicio','=','12')->whereYear('fecha_inicio','=',$anio)->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)->count();

        $retardos01 = Retardos::whereMonth('fecha_falta','=','1')->where('faltas.IdJustificacion','Retardo')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $retardos02 = Retardos::whereMonth('fecha_falta','=','2')->where('faltas.IdJustificacion','Retardo')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $retardos03 = Retardos::whereMonth('fecha_falta','=','3')->where('faltas.IdJustificacion','Retardo')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $retardos04 = Retardos::whereMonth('fecha_falta','=','4')->where('faltas.IdJustificacion','Retardo')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $retardos05 = Retardos::whereMonth('fecha_falta','=','5')->where('faltas.IdJustificacion','Retardo')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $retardos06 = Retardos::whereMonth('fecha_falta','=','6')->where('faltas.IdJustificacion','Retardo')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $retardos07 = Retardos::whereMonth('fecha_falta','=','7')->where('faltas.IdJustificacion','Retardo')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $retardos08 = Retardos::whereMonth('fecha_falta','=','8')->where('faltas.IdJustificacion','Retardo')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $retardos09 = Retardos::whereMonth('fecha_falta','=','9')->where('faltas.IdJustificacion','Retardo')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $retardos10 = Retardos::whereMonth('fecha_falta','=','10')->where('faltas.IdJustificacion','Retardo')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $retardos11 = Retardos::whereMonth('fecha_falta','=','11')->where('faltas.IdJustificacion','Retardo')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $retardos12 = Retardos::whereMonth('fecha_falta','=','12')->where('faltas.IdJustificacion','Retardo')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();

        $faltasi01 = DB::table('Tbl_Empleados_SIA')
                        ->leftjoin('faltas', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado') ->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })->whereMonth('fecha_falta','=','1')->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','<',date('Y-m-d'))->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $faltasi02 = DB::table('Tbl_Empleados_SIA')
                        ->leftjoin('faltas', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado') ->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })->whereMonth('fecha_falta','=','2')->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','<',date('Y-m-d'))->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $faltasi03 = DB::table('Tbl_Empleados_SIA')
                        ->leftjoin('faltas', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado') ->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })->whereMonth('fecha_falta','=','3')->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','<',date('Y-m-d'))->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $faltasi04 = DB::table('Tbl_Empleados_SIA')
                        ->leftjoin('faltas', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado') ->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })->whereMonth('fecha_falta','=','4')->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','<',date('Y-m-d'))->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $faltasi05 = DB::table('Tbl_Empleados_SIA')
                        ->leftjoin('faltas', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado') ->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })->whereMonth('fecha_falta','=','5')->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','<',date('Y-m-d'))->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $faltasi06 = DB::table('Tbl_Empleados_SIA')
                        ->leftjoin('faltas', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado') ->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })->whereMonth('fecha_falta','=','6')->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','<',date('Y-m-d'))->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $faltasi07 = DB::table('Tbl_Empleados_SIA')
                        ->leftjoin('faltas', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado') ->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })->whereMonth('fecha_falta','=','7')->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','<',date('Y-m-d'))->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $faltasi08 = DB::table('Tbl_Empleados_SIA')
                        ->leftjoin('faltas', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado') ->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })->whereMonth('fecha_falta','=','8')->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','<',date('Y-m-d'))->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $faltasi09 = DB::table('Tbl_Empleados_SIA')
                        ->leftjoin('faltas', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado') ->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })->whereMonth('fecha_falta','=','9')->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','<',date('Y-m-d'))->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $faltasi10 = DB::table('Tbl_Empleados_SIA')
                        ->leftjoin('faltas', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado') ->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })->whereMonth('fecha_falta','=','10')->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','<',date('Y-m-d'))->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $faltasi11 = DB::table('Tbl_Empleados_SIA')
                        ->leftjoin('faltas', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado') ->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })->whereMonth('fecha_falta','=','11')->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','<',date('Y-m-d'))->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
        $faltasi12 = DB::table('Tbl_Empleados_SIA')
                        ->leftjoin('faltas', function (JoinClause $join) {
                        $join->on('faltas.no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado') ->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                        })->whereMonth('fecha_falta','=','12')->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->whereYear('fecha_falta','=',$anio)->where('fecha_falta','<',date('Y-m-d'))->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)->count();
                
         /************************Empleados por VP ************************************** */

         $perVPF=Tbl_Empleado_SIA::join('cat_edo_neg','cat_edo_neg.edo_neg','=','Tbl_Empleados_SIA.cveci2')
         ->whereNULL('Fecha_Eg')
         ->where('vp','VPF')
         ->distinct('id_empleado')
         ->count ();
        $perVPRH=Tbl_Empleado_SIA::join('cat_edo_neg','cat_edo_neg.edo_neg','=','Tbl_Empleados_SIA.cveci2')
         ->whereNULL('Fecha_Eg')
         ->where('vp','VPRH')
         ->distinct('id_empleado')
         ->count ();
        $perVPM=Tbl_Empleado_SIA::join('cat_edo_neg','cat_edo_neg.edo_neg','=','Tbl_Empleados_SIA.cveci2')
         ->whereNULL('Fecha_Eg')
         ->where('vp','VPM')
         ->distinct('id_empleado')
         ->count ();
        $perVPV=Tbl_Empleado_SIA::join('cat_edo_neg','cat_edo_neg.edo_neg','=','Tbl_Empleados_SIA.cveci2')
         ->whereNULL('Fecha_Eg')
         ->where('vp','VPV')
         ->distinct('id_empleado')
         ->count ();

                      
            /************************Empleados por planta ************************************** */

            $perPI=Tbl_Empleado_SIA::where('Id_Planta','Intimark1')->where('Status_Emp','A')->count();
            $perPII=Tbl_Empleado_SIA::where('Id_Planta','Intimark2')->where('Status_Emp','A')->count();
            
              
        return view('avanceproduccion', compact('vacaciones','permisos','faltasjustificadas','incapacidades','vacacionesA','vacacionesD','vacacionesP','vacacionesC','permisosA','permisosD','permisosP','permisosC','vacacionesVPF','vacacionesVPM','vacacionesVPRH','vacacionesVPV','permisosVPF','permisosVPV','permisosVPM','permisosVPRH','faltasjustificadasVPF','faltasjustificadasVPM','faltasjustificadasVPRH','faltasjustificadasVPV','incapacidadesVPF','incapacidadesVPM','incapacidadesVPRH','incapacidadesVPV','inicio','fin','vacaciones01','vacaciones02','vacaciones03','vacaciones04','vacaciones05','vacaciones06','vacaciones07','vacaciones08','vacaciones09','vacaciones10','vacaciones11','vacaciones12','permisos01','permisos02','permisos03','permisos04','permisos05','permisos06','permisos07','permisos08','permisos09','permisos10','permisos11','permisos12','faltasj01','faltasj02','faltasj03','faltasj04','faltasj05','faltasj06','faltasj07','faltasj08','faltasj09','faltasj10','faltasj11','faltasj12','incapacidades01','incapacidades02','incapacidades03','incapacidades04','incapacidades05','incapacidades06','incapacidades07','incapacidades08','incapacidades09','incapacidades10','incapacidades11','incapacidades12','planta','plantaV','plantaP','plantaFJ','plantaI','plantaR','plantaFI','perVPF','perVPM','perVPRH','perVPV','vacacionesVPFD','vacacionesVPMD','vacacionesVPRHD','vacacionesVPVD','vacacionesDD','permisosDD','faltasjustificadasDD','incapacidadesDD','permisosVPFDia','permisosVPMDia','permisosVPRHDia','permisosVPVDia','incapacidadesVPFD','incapacidadesVPMD','incapacidadesVPRHD','incapacidadesVPVD','vacacionesEven','vacacionesPer','vacacionesExc','permisosDCS','permisosDSS','permisosHCS','permisosHSS','faltasM1','faltasM2','faltasM3','faltasM4','faltasM5','faltasM6','incapacidadesI','incapacidadesS','perPI','perPII','vacacionesPID','vacacionesPIID','permisosPIDia','permisosPIIDia','incapacidadesPID','incapacidadesPIID','retardos','faltasinjustificadas','faltasinjustificadasVPF','faltasinjustificadasVPRH','faltasinjustificadasVPM','faltasinjustificadasVPV','retardosVPF','retardosVPRH','retardosVPM','retardosVPV','retardos01','retardos02','retardos03','retardos04','retardos05','retardos06','retardos07','retardos08','retardos09','retardos10','retardos11','retardos12','faltasi01','faltasi02','faltasi03','faltasi04','faltasi05','faltasi06','faltasi07','faltasi08','faltasi09','faltasi10','faltasi11','faltasi12'));
      
    }

    public function detalleVPF(request $request)
    {

        $inicio='';
        $fin ='';

         $departamentoVPF = DB::table('permisos')
         ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
             $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
         ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
         ->where('cat_edo_neg.vp','=','VPF')
         ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as contper'))      
         ->groupby('cat_puestos.Puesto')
         ->get(['cat_puestos.Puesto']);  


        $permisosVPF= DB::table('permisos')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPF')
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);

        $permisosVPF = $permisosVPF->unique('IdPermiso');

        $permisosVPF=$permisosVPF->count();

/***************permisos autorizados ********** */
        $permisosVPFA= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
        ->where('cat_edo_neg.vp','VPF')
        ->where('permisos.status','Aplicado')
        ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as vpfa'))      
        ->groupby('cat_puestos.Puesto')
        ->get(['cat_puestos.Puesto']);

 /***************permisos denegados ********** */

        $permisosVPFD= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
        ->where('cat_edo_neg.vp','VPF')
        ->where('permisos.status','Denegado')
        ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as vpfd'))      
        ->groupby('cat_puestos.Puesto')
        ->get(['cat_puestos.Puesto']);

   
       /***************permisos pendientes ********** */
 
        $permisosVPFP= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
        ->where('cat_edo_neg.vp','VPF')
        ->where('permisos.status','Pendiente')
        ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as vpfp'))      
        ->groupby('cat_puestos.Puesto')
        ->get(['cat_puestos.Puesto']);
       
/***************permisos cancelados ********** */

        $permisosVPFC= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
        ->where('cat_edo_neg.vp','VPF')
        ->where('permisos.status','Cancelado')
        ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as vpfc'))      
        ->groupby('cat_puestos.Puesto')
        ->get(['cat_puestos.Puesto']);

 /***************tipos de permisos ********** */

        $permisodcs = DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) { 
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->join('cat_permisos','cat_permisos.id_permiso','permisos.tipo_per')
        ->where('cat_edo_neg.vp','VPF')
        ->where('cat_permisos.forma','=',1)
        ->select(DB::raw('cat_permisos.id_permiso, cat_permisos.permiso'))      
        ->groupby('cat_permisos.id_permiso','cat_permisos.permiso')
        ->get('cat_permisos.id_permiso');


        $permisodss = DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) { 
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->join('cat_permisos','cat_permisos.id_permiso','permisos.tipo_per')
        ->where('cat_edo_neg.vp','VPF')
        ->where('cat_permisos.forma','=',2)
        ->select(DB::raw('cat_permisos.id_permiso, cat_permisos.permiso'))      
        ->groupby('cat_permisos.id_permiso','cat_permisos.permiso')
        ->get('cat_permisos.id_permiso');

        $permisohcs = DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) { 
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->join('cat_permisos','cat_permisos.id_permiso','permisos.tipo_per')
        ->where('cat_edo_neg.vp','VPF')
        ->where('cat_permisos.forma','=',3)
        ->select(DB::raw('cat_permisos.id_permiso, cat_permisos.permiso'))      
        ->groupby('cat_permisos.id_permiso','cat_permisos.permiso')
        ->get('cat_permisos.id_permiso');

        $permisohss = DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) { 
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->join('cat_permisos','cat_permisos.id_permiso','permisos.tipo_per')
        ->where('cat_edo_neg.vp','VPF')
        ->where('cat_permisos.forma','=',4)
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
        ->where('cat_edo_neg.vp','VPF')
        ->where('cat_permisos.forma','=',1)
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
        ->where('cat_edo_neg.vp','VPF')
        ->where('cat_permisos.forma','=',2)
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
        ->where('cat_edo_neg.vp','VPF')
        ->where('cat_permisos.forma','=',3)
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
        ->where('cat_edo_neg.vp','VPF')
        ->where('cat_permisos.forma','=',4)
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
                       ->where('cat_edo_neg.vp','=','VPF')
                       ->whereMonth('fech_ini_per','=','1')
                       ->whereYear('fech_ini_per','=',$anio)->count();
            $departamentoP02= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPF')
                       ->whereMonth('fech_ini_per','=','2')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP03= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPF')
                       ->whereMonth('fech_ini_per','=','3')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP04= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPF')
                       ->whereMonth('fech_ini_per','=','4')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP05= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPF')
                       ->whereMonth('fech_ini_per','=','5')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP06= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPF')
                       ->whereMonth('fech_ini_per','=','6')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP07= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPF')
                       ->whereMonth('fech_ini_per','=','7')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP08= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPF')
                       ->whereMonth('fech_ini_per','=','8')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP09= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPF')
                       ->whereMonth('fech_ini_per','=','9')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP10= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPF')
                       ->whereMonth('fech_ini_per','=','10')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP11= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPF')
                       ->whereMonth('fech_ini_per','=','11')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP12= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPF')
                       ->whereMonth('fech_ini_per','=','12')
                       ->whereYear('fech_ini_per','=',$anio)->count();      

        return view('VPF.detalle', compact('permisosVPF','permisosVPFA','permisosVPFD','permisosVPFP','permisosVPFC','inicio','fin','departamentoP01','departamentoP02','departamentoP03','departamentoP04','departamentoP05','departamentoP06','departamentoP07','departamentoP08','departamentoP09','departamentoP10','departamentoP11','departamentoP12','departamentoVPF','permisosdcs','permisosdss','permisoshcs','permisoshss','permisodcs','permisodss','permisohcs','permisohss','sumdcs','sumdss','sumhcs','sumhss'));
 
    }
    
    public function detalleVPM(request $request)
    {

        $inicio='';
        $fin ='';

         $departamentoVPM = DB::table('permisos')
         ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
             $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
         ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
         ->where('cat_edo_neg.vp','=','VPM')
         ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as contper'))      
         ->groupby('cat_puestos.Puesto')
         ->get(['cat_puestos.Puesto']);  


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

/***************permisos autorizados ********** */
        $permisosVPMA= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
        ->where('cat_edo_neg.vp','VPM')
        ->where('permisos.status','Aplicado')
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

        return view('VPM.detalle', compact('permisosVPM','permisosVPMA','permisosVPMD','permisosVPMP','permisosVPMC','inicio','fin','departamentoP01','departamentoP02','departamentoP03','departamentoP04','departamentoP05','departamentoP06','departamentoP07','departamentoP08','departamentoP09','departamentoP10','departamentoP11','departamentoP12','departamentoVPM','permisosdcs','permisosdss','permisoshcs','permisoshss','permisodcs','permisodss','permisohcs','permisohss','sumdcs','sumdss','sumhcs','sumhss'));
 
    }

    public function detalleVPRH(request $request)
    {

        $inicio='';
        $fin ='';

         $departamentoVPRH = DB::table('permisos')
         ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
             $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
         ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
         ->where('cat_edo_neg.vp','=','VPRH')
         ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as contper'))      
         ->groupby('cat_puestos.Puesto')
         ->get(['cat_puestos.Puesto']);  


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

/***************permisos autorizados ********** */
        $permisosVPRHA= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
        ->where('cat_edo_neg.vp','VPRH')
        ->where('permisos.status','Aplicado')
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

        return view('VPRH.detalle', compact('permisosVPRH','permisosVPRHA','permisosVPRHD','permisosVPRHP','permisosVPRHC','inicio','fin','departamentoP01','departamentoP02','departamentoP03','departamentoP04','departamentoP05','departamentoP06','departamentoP07','departamentoP08','departamentoP09','departamentoP10','departamentoP11','departamentoP12','departamentoVPRH','permisosdcs','permisosdss','permisoshcs','permisoshss','permisodcs','permisodss','permisohcs','permisohss','sumdcs','sumdss','sumhcs','sumhss'));
 
    }

    public function detalleVPV(request $request)
    {

        $inicio='';
        $fin ='';

         $departamentoVPV = DB::table('permisos')
         ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
             $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
         ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
         ->where('cat_edo_neg.vp','=','VPV')
         ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as contper'))      
         ->groupby('cat_puestos.Puesto')
         ->get(['cat_puestos.Puesto']);  


        $permisosVPV= DB::table('permisos')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPV')
        ->groupby('permisos.IdPermiso')
        ->get(['permisos.IdPermiso']);

        $permisosVPV = $permisosVPV->unique('IdPermiso');

        $permisosVPV=$permisosVPV->count();

/***************permisos autorizados ********** */
        $permisosVPVA= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
        ->where('cat_edo_neg.vp','VPV')
        ->where('permisos.status','Aplicado')
        ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as vpva'))      
        ->groupby('cat_puestos.Puesto')
        ->get(['cat_puestos.Puesto']);

 /***************permisos denegados ********** */

        $permisosVPVD= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
        ->where('cat_edo_neg.vp','VPV')
        ->where('permisos.status','Denegado')
        ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as vpvd'))      
        ->groupby('cat_puestos.Puesto')
        ->get(['cat_puestos.Puesto']);

   
       /***************permisos pendientes ********** */
 
        $permisosVPVP= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
        ->where('cat_edo_neg.vp','VPV')
        ->where('permisos.status','Pendiente')
        ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as vpvp'))      
        ->groupby('cat_puestos.Puesto')
        ->get(['cat_puestos.Puesto']);
       
/***************permisos cancelados ********** */

        $permisosVPVC= DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
        ->where('cat_edo_neg.vp','VPV')
        ->where('permisos.status','Cancelado')
        ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as vpvc'))      
        ->groupby('cat_puestos.Puesto')
        ->get(['cat_puestos.Puesto']);

 /***************tipos de permisos ********** */

        $permisodcs = DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) { 
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->join('cat_permisos','cat_permisos.id_permiso','permisos.tipo_per')
        ->where('cat_edo_neg.vp','VPV')
        ->where('cat_permisos.forma','=',1)
        ->select(DB::raw('cat_permisos.id_permiso, cat_permisos.permiso'))      
        ->groupby('cat_permisos.id_permiso','cat_permisos.permiso')
        ->get('cat_permisos.id_permiso');


        $permisodss = DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) { 
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->join('cat_permisos','cat_permisos.id_permiso','permisos.tipo_per')
        ->where('cat_edo_neg.vp','VPV')
        ->where('cat_permisos.forma','=',2)
        ->select(DB::raw('cat_permisos.id_permiso, cat_permisos.permiso'))      
        ->groupby('cat_permisos.id_permiso','cat_permisos.permiso')
        ->get('cat_permisos.id_permiso');

        $permisohcs = DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) { 
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->join('cat_permisos','cat_permisos.id_permiso','permisos.tipo_per')
        ->where('cat_edo_neg.vp','VPV')
        ->where('cat_permisos.forma','=',3)
        ->select(DB::raw('cat_permisos.id_permiso, cat_permisos.permiso'))      
        ->groupby('cat_permisos.id_permiso','cat_permisos.permiso')
        ->get('cat_permisos.id_permiso');

        $permisohss = DB::table('permisos')
        ->join('Tbl_empleados_SIA', function (JoinClause $join) { 
           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003');
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->join('cat_permisos','cat_permisos.id_permiso','permisos.tipo_per')
        ->where('cat_edo_neg.vp','VPV')
        ->where('cat_permisos.forma','=',4)
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
        ->where('cat_edo_neg.vp','VPV')
        ->where('cat_permisos.forma','=',1)
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
        ->where('cat_edo_neg.vp','VPV')
        ->where('cat_permisos.forma','=',2)
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
        ->where('cat_edo_neg.vp','VPV')
        ->where('cat_permisos.forma','=',3)
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
        ->where('cat_edo_neg.vp','VPV')
        ->where('cat_permisos.forma','=',4)
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
                       ->where('cat_edo_neg.vp','=','VPV')
                       ->whereMonth('fech_ini_per','=','1')
                       ->whereYear('fech_ini_per','=',$anio)->count();
            $departamentoP02= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPV')
                       ->whereMonth('fech_ini_per','=','2')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP03= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPV')
                       ->whereMonth('fech_ini_per','=','3')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP04= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPV')
                       ->whereMonth('fech_ini_per','=','4')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP05= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPV')
                       ->whereMonth('fech_ini_per','=','5')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP06= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPV')
                       ->whereMonth('fech_ini_per','=','6')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP07= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPV')
                       ->whereMonth('fech_ini_per','=','7')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP08= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPV')
                       ->whereMonth('fech_ini_per','=','8')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP09= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPV')
                       ->whereMonth('fech_ini_per','=','9')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP10= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPV')
                       ->whereMonth('fech_ini_per','=','10')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP11= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPV')
                       ->whereMonth('fech_ini_per','=','11')
                       ->whereYear('fech_ini_per','=',$anio)->count();  
            $departamentoP12= DB::table('permisos')
                       ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
                           $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
                       })
                       ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
                       ->where('cat_edo_neg.vp','=','VPV')
                       ->whereMonth('fech_ini_per','=','12')
                       ->whereYear('fech_ini_per','=',$anio)->count();      

        return view('VPV.detalle', compact('permisosVPV','permisosVPVA','permisosVPVD','permisosVPVP','permisosVPVC','inicio','fin','departamentoP01','departamentoP02','departamentoP03','departamentoP04','departamentoP05','departamentoP06','departamentoP07','departamentoP08','departamentoP09','departamentoP10','departamentoP11','departamentoP12','departamentoVPV','permisosdcs','permisosdss','permisoshcs','permisoshss','permisodcs','permisodss','permisohcs','permisohss','sumdcs','sumdss','sumhcs','sumhss'));
 
    }

    public function excepciones(request $request)
    {

        $inicio='';
        $fin ='';

        $departamentoVPV = DB::table('permisos')
         ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
             $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
         ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
         ->where('cat_edo_neg.vp','=','VPV')
         ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as contper'))      
         ->groupby('cat_puestos.Puesto')
         ->get(['cat_puestos.Puesto']);  
/*****************************departamentos por VP *******************/

        $departamentosVPV = DB::table('Tbl_empleados_SIA')
         ->leftjoin('cat_edo_neg', function (JoinClause $join) {
             $join->on('tbl_empleados_sia.cveci2', '=', 'cat_edo_neg.edo_neg')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->where('cat_edo_neg.vp','=','VPV')
         ->where('tbl_empleados_sia.Status_Emp', 'A')
         ->groupby('cat_edo_neg.des_edo_neg')
         ->get(['cat_edo_neg.des_edo_neg']);

         $departamentosVPRH = DB::table('Tbl_empleados_SIA')
         ->leftjoin('cat_edo_neg', function (JoinClause $join) {
             $join->on('tbl_empleados_sia.cveci2', '=', 'cat_edo_neg.edo_neg')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->where('cat_edo_neg.vp','=','VPRH')
         ->where('tbl_empleados_sia.Status_Emp', 'A')
         ->groupby('cat_edo_neg.des_edo_neg')
         ->get(['cat_edo_neg.des_edo_neg']);

         $departamentosVPM = DB::table('Tbl_empleados_SIA')
         ->leftjoin('cat_edo_neg', function (JoinClause $join) {
             $join->on('tbl_empleados_sia.cveci2', '=', 'cat_edo_neg.edo_neg')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->where('cat_edo_neg.vp','=','VPM')
         ->where('tbl_empleados_sia.Status_Emp', 'A')
         ->groupby('cat_edo_neg.des_edo_neg')
         ->get(['cat_edo_neg.des_edo_neg']);

         $departamentosVPF = DB::table('Tbl_empleados_SIA')
         ->leftjoin('cat_edo_neg', function (JoinClause $join) {
             $join->on('tbl_empleados_sia.cveci2', '=', 'cat_edo_neg.edo_neg')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->where('cat_edo_neg.vp','=','VPF')
         ->where('tbl_empleados_sia.Status_Emp', 'A')
         ->groupby('cat_edo_neg.des_edo_neg')
         ->get(['cat_edo_neg.des_edo_neg']);


/********************************************************************** */
         

         $depVPVVE = DB::table('vacaciones2')
         ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
             $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
         ->join('cat_puestos','cat_puestos.id_puesto','vacaciones2.jefe_directo')
         ->where('cat_edo_neg.vp','=','VPV')
         ->where('vacaciones2.excepcion',1)
         ->select(DB::raw('cat_edo_neg.des_edo_neg, count(distinct vacaciones2.IdVacaciones) as excevac, cat_puestos.Puesto'))      
         ->groupby('cat_edo_neg.des_edo_neg','cat_puestos.Puesto')
         ->get(['cat_edo_neg.des_edo_neg']);  


        $depVPVPE = DB::table('permisos')
         ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
             $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
         ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
         ->where('cat_edo_neg.vp','=','VPV')
         ->where('permisos.excepcion',1)
         ->select(DB::raw('cat_edo_neg.des_edo_neg, count(distinct permisos.IdPermiso) as exceper, cat_puestos.Puesto'))      
         ->groupby('cat_edo_neg.des_edo_neg','cat_puestos.Puesto')
         ->get(['cat_edo_neg.des_edo_neg']);  

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

         $depVPFVE = DB::table('vacaciones2')
         ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
             $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
         ->join('cat_puestos','cat_puestos.id_puesto','vacaciones2.jefe_directo')
         ->where('cat_edo_neg.vp','=','VPF')
         ->where('vacaciones2.excepcion',1)
         ->select(DB::raw('cat_edo_neg.des_edo_neg, count(distinct vacaciones2.IdVacaciones) as excevac, cat_puestos.Puesto'))      
         ->groupby('cat_edo_neg.des_edo_neg','cat_puestos.Puesto')
         ->get(['cat_edo_neg.des_edo_neg']);  


        $depVPFPE = DB::table('permisos')
         ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
             $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
         ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
         ->where('cat_edo_neg.vp','=','VPF')
         ->where('permisos.excepcion',1)
         ->select(DB::raw('cat_edo_neg.des_edo_neg, count(distinct permisos.IdPermiso) as exceper, cat_puestos.Puesto'))      
         ->groupby('cat_edo_neg.des_edo_neg','cat_puestos.Puesto')
         ->get(['cat_edo_neg.des_edo_neg']);  
        
/******************************************************************************* */
        $excepcionVPFV= DB::table('vacaciones2')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPF')
        ->where('vacaciones2.excepcion',1)
        ->count();

        $excepcionVPFP= DB::table('permisos')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPF')
        ->where('permisos.excepcion',1)
        ->count();

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

        $excepcionVPVV= DB::table('vacaciones2')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPV')
        ->where('vacaciones2.excepcion',1)
        ->count();

        $excepcionVPVP= DB::table('permisos')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPV')
        ->where('permisos.excepcion',1)
        ->count();

    
        

        return view('excepciones', compact('inicio','fin','departamentoVPV','excepcionVPFV','excepcionVPFP','excepcionVPMV','excepcionVPMP','excepcionVPRHV','excepcionVPRHP','excepcionVPVV','excepcionVPVP','depVPVVE','depVPVPE','departamentosVPV','depVPMVE','depVPMPE','departamentosVPM','depVPRHVE','depVPRHPE','departamentosVPRH','depVPFVE','depVPFPE','departamentosVPF'));
 
    }


    public function fechas_excep(request $request)
    {

        $inicio= ($request->filled('inicial')) ? $request->inicial : date('Y-m-d');
        $fin= ($request->filled('final')) ? $request->final : date('Y-m-d');

        $departamentoVPV = DB::table('permisos')
         ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
             $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
         ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
         ->where('cat_edo_neg.vp','=','VPV')
         ->select(DB::raw('cat_puestos.Puesto, count(distinct permisos.IdPermiso) as contper'))      
         ->groupby('cat_puestos.Puesto')
         ->get(['cat_puestos.Puesto']);  
/*****************************departamentos por VP *******************/

        $departamentosVPV = DB::table('Tbl_empleados_SIA')
         ->leftjoin('cat_edo_neg', function (JoinClause $join) {
             $join->on('tbl_empleados_sia.cveci2', '=', 'cat_edo_neg.edo_neg')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->where('cat_edo_neg.vp','=','VPV')
         ->where('tbl_empleados_sia.Status_Emp', 'A')
         ->groupby('cat_edo_neg.des_edo_neg')
         ->get(['cat_edo_neg.des_edo_neg']);

         $departamentosVPRH = DB::table('Tbl_empleados_SIA')
         ->leftjoin('cat_edo_neg', function (JoinClause $join) {
             $join->on('tbl_empleados_sia.cveci2', '=', 'cat_edo_neg.edo_neg')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->where('cat_edo_neg.vp','=','VPRH')
         ->where('tbl_empleados_sia.Status_Emp', 'A')
         ->groupby('cat_edo_neg.des_edo_neg')
         ->get(['cat_edo_neg.des_edo_neg']);

         $departamentosVPM = DB::table('Tbl_empleados_SIA')
         ->leftjoin('cat_edo_neg', function (JoinClause $join) {
             $join->on('tbl_empleados_sia.cveci2', '=', 'cat_edo_neg.edo_neg')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->where('cat_edo_neg.vp','=','VPM')
         ->where('tbl_empleados_sia.Status_Emp', 'A')
         ->groupby('cat_edo_neg.des_edo_neg')
         ->get(['cat_edo_neg.des_edo_neg']);

         $departamentosVPF = DB::table('Tbl_empleados_SIA')
         ->leftjoin('cat_edo_neg', function (JoinClause $join) {
             $join->on('tbl_empleados_sia.cveci2', '=', 'cat_edo_neg.edo_neg')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->where('cat_edo_neg.vp','=','VPF')
         ->where('tbl_empleados_sia.Status_Emp', 'A')
         ->groupby('cat_edo_neg.des_edo_neg')
         ->get(['cat_edo_neg.des_edo_neg']);


/********************************************************************** */
         

         $depVPVVE = DB::table('vacaciones2')
         ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
             $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
         ->join('cat_puestos','cat_puestos.id_puesto','vacaciones2.jefe_directo')
         ->where('cat_edo_neg.vp','=','VPV')
         ->where('vacaciones2.excepcion',1)
         ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
         ->select(DB::raw('cat_edo_neg.des_edo_neg, count(distinct vacaciones2.IdVacaciones) as excevac, cat_puestos.Puesto'))      
         ->groupby('cat_edo_neg.des_edo_neg','cat_puestos.Puesto')
         ->get(['cat_edo_neg.des_edo_neg']);  


        $depVPVPE = DB::table('permisos')
         ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
             $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
         ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
         ->where('cat_edo_neg.vp','=','VPV')
         ->where('permisos.excepcion',1)
         ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
         ->select(DB::raw('cat_edo_neg.des_edo_neg, count(distinct permisos.IdPermiso) as exceper, cat_puestos.Puesto'))      
         ->groupby('cat_edo_neg.des_edo_neg','cat_puestos.Puesto')
         ->get(['cat_edo_neg.des_edo_neg']);  

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

         $depVPFVE = DB::table('vacaciones2')
         ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
             $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
         ->join('cat_puestos','cat_puestos.id_puesto','vacaciones2.jefe_directo')
         ->where('cat_edo_neg.vp','=','VPF')
         ->where('vacaciones2.excepcion',1)
         ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
         ->select(DB::raw('cat_edo_neg.des_edo_neg, count(distinct vacaciones2.IdVacaciones) as excevac, cat_puestos.Puesto'))      
         ->groupby('cat_edo_neg.des_edo_neg','cat_puestos.Puesto')
         ->get(['cat_edo_neg.des_edo_neg']);  


        $depVPFPE = DB::table('permisos')
         ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
             $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
         })
         ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
         ->join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
         ->where('cat_edo_neg.vp','=','VPF')
         ->where('permisos.excepcion',1)
         ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
         ->select(DB::raw('cat_edo_neg.des_edo_neg, count(distinct permisos.IdPermiso) as exceper, cat_puestos.Puesto'))      
         ->groupby('cat_edo_neg.des_edo_neg','cat_puestos.Puesto')
         ->get(['cat_edo_neg.des_edo_neg']);  
        
/******************************************************************************* */
        $excepcionVPFV= DB::table('vacaciones2')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPF')
        ->where('vacaciones2.excepcion',1)
        ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
        ->count();

        $excepcionVPFP= DB::table('permisos')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPF')
        ->where('permisos.excepcion',1)
        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
        ->count();

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

        $excepcionVPVV= DB::table('vacaciones2')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('vacaciones2.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPV')
        ->where('vacaciones2.excepcion',1)
        ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
        ->count();

        $excepcionVPVP= DB::table('permisos')->distinct()
        ->leftjoin('Tbl_empleados_SIA', function (JoinClause $join) {
            $join->on('permisos.fk_no_empleado', '=', 'Tbl_Empleados_SIA.No_Empleado')->where('Tbl_Empleados_SIA.cvecia','=','003') ;
        })
        ->join('cat_edo_neg','cat_edo_neg.edo_neg','Tbl_Empleados_SIA.cveci2')
        ->where('cat_edo_neg.vp','=','VPV')
        ->where('permisos.excepcion',1)
        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
        ->count();       

        return view('excepciones', compact('inicio','fin','departamentoVPV','excepcionVPFV','excepcionVPFP','excepcionVPMV','excepcionVPMP','excepcionVPRHV','excepcionVPRHP','excepcionVPVV','excepcionVPVP','depVPVVE','depVPVPE','departamentosVPV','depVPMVE','depVPMPE','departamentosVPM','depVPRHVE','depVPRHPE','departamentosVPRH','depVPFVE','depVPFPE','departamentosVPF'));
 
    }

}
