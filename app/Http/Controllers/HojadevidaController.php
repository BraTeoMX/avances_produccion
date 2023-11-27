<?php

namespace App\Http\Controllers;

use App\Vacaciones;
use App\FormatoPermisos;
use App\FaltasJustificadas;
use App\Incapacidades;
use App\Retardos;
use App\Tbl_Empleado_SIA;
use App\Puestos;
use App\Departamentos;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;

use DB;

class HojadevidaController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
      
      $inicio= ($request->filled('inicial')) ? $request->inicial : '';
       $fin= ($request->filled('final')) ? $request->final : '';

       $empleado= ($request->filled('empleado'))? $request->empleado : '-';
     
       $hoy = date('Y-m-d');
       $tag = substr($request->empleado, -9);
       $tag = str_pad($tag, 7, "0", STR_PAD_LEFT);

       if(isset($empleado)){
        
            $no_empleado = Tbl_Empleado_SIA::join('cat_departamentos','cat_departamentos.id_Departamento','tbl_empleados_sia.Departamento')
            ->join('cat_puestos','cat_puestos.Id_Puesto','tbl_empleados_sia.Puesto')
            ->join('cat_edo_neg','cat_edo_neg.edo_neg','tbl_empleados_sia.cveci2')
            ->where('No_Empleado', $tag)->where('Status_Emp', 'A')
            ->get();
            $contador=1;

           
           if ($no_empleado->count()==0){
            $contador=0;
        
                $no_empleado = Tbl_Empleado_SIA::join('cat_departamentos','cat_departamentos.id_Departamento','tbl_empleados_sia.Departamento')
                ->join('cat_puestos','cat_puestos.Id_Puesto','tbl_empleados_sia.Puesto')
                ->join('cat_edo_neg','cat_edo_neg.edo_neg','tbl_empleados_sia.cveci2')
                ->where('Nom_Emp', 'LIKE', '%' . $empleado . '%')
                ->orwhere('Ap_Pat', 'LIKE', '%' . $empleado . '%')
                ->orwhere('Ap_Mat', 'LIKE', '%' . $empleado . '%')
                ->orderby('No_Empleado')
                ->get();

                if ($no_empleado->count()== true and $empleado!=''){
                    $contador=1;
                }
    
            }    
           
        }else{
           $no_empleado='';
        }
        
        return view('hojadevida.index',compact('no_empleado','inicio','fin','contador'));
        
 
    }

    public function detalleHojadevida($id)
    {

        $inicio= "";
        $fin= "";

        $no_empleado = Tbl_Empleado_SIA::join('cat_edo_neg','cat_edo_neg.edo_neg','tbl_empleados_sia.cveci2')
        ->join('cat_puestos','cat_puestos.id_puesto','tbl_empleados_sia.Puesto')
        ->where('No_Empleado', $id)->where('Status_Emp', 'A')
        ->get();

        $vacaciones = Vacaciones::join('cat_puestos','cat_puestos.id_puesto','vacaciones2.jefe_directo')
        ->where('fk_no_empleado', $id)
        ->orderby('fech_ini_vac','desc')
        ->get();

        $permisos = FormatoPermisos::join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
        ->join('cat_permisos','cat_permisos.id_permiso','permisos.tipo_per')
        ->where('fk_no_empleado', $id)
        ->orderby('fech_ini_per','desc')
        ->get();

        $faltas_justificadas = FaltasJustificadas::where('fk_no_empleado', $id)
        ->orderby('fecha_inicio_justificar','desc')
        ->get();

        $incapacidades = Incapacidades::where('fk_empleado', $id)
        ->orderby('fecha_inicio','desc')
        ->get();
        
        $retardos = Retardos::where('no_empleado', $id)->where('IdJustificacion','Retardo')->where('fecha_falta','>=','2023-01-01')
        ->orderby('fecha_falta','desc')
        ->get();
        
        $faltasinjustificadas = Retardos::where('no_empleado', $id)->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->where('faltas.fecha_falta','>=','2023-01-01')->where('fecha_falta','<',date('Y-m-d'))
        ->orderby('fecha_falta','desc')
        ->get();

        $vacaciones2 = Retardos::where('no_empleado', $id)->where('IdJustificacion','vac')->where('fecha_falta','>=','2023-01-01')
        ->orderby('fecha_falta','desc')
        ->get();

        $permisos2 = Retardos::where('no_empleado', $id)->where('IdJustificacion','<>','Retardo')->where('IdJustificacion','<>','vac')->where('IdJustificacion','<>','Retardo')->where('IdJustificacion','<>','Suspension')->where('IdJustificacion','<>',NULL)
        ->where('fecha_falta','>=','2023-01-01')
        ->orderby('fecha_falta','desc')
        ->get();

        $faltasjustificadas2 = Retardos::where('no_empleado', $id)->where('IdJustificacion','InasJusti')
        ->where('fecha_falta','>=','2023-01-01')
        ->orderby('fecha_falta','desc')
        ->get();

        $incapacidades2 = Retardos::where('no_empleado', $id)->where('IdJustificacion','IncMater')->where('IdJustificacion','IncMater')->where('IdJustificacion','IncInterna')
        ->where('fecha_falta','>=','2023-01-01')
        ->orderby('fecha_falta','desc')
        ->get();


        return view('hojadevida.detallehojadevida',compact('no_empleado','inicio','fin','vacaciones','permisos','faltas_justificadas','incapacidades','retardos','faltasinjustificadas','vacaciones2','permisos2','faltasjustificadas2','incapacidades2'));
        
    }

    public function fechashojadevida(Request $request)
    {
        $inicio= ($request->filled('inicial')) ? $request->inicial : '';
        $fin= ($request->filled('final')) ? $request->final : '';
 
        $empleado= ($request->filled('empleado'))? $request->empleado : '-';
 

        $no_empleado = Tbl_Empleado_SIA::join('cat_edo_neg','cat_edo_neg.edo_neg','tbl_empleados_sia.cveci2')
        ->join('cat_puestos','cat_puestos.id_puesto','tbl_empleados_sia.Puesto')
        ->where('No_Empleado', $empleado)->where('Status_Emp', 'A')
        ->get();

        $vacaciones = Vacaciones::join('cat_puestos','cat_puestos.id_puesto','vacaciones2.jefe_directo')
        ->where('fk_no_empleado', $empleado)
        ->where('fech_ini_vac','>=',$inicio)->where('fech_ini_vac','<=',$fin)
        ->get();

        $permisos = FormatoPermisos::join('cat_puestos','cat_puestos.id_puesto','permisos.jefe_directo')
        ->where('fk_no_empleado', $empleado)
        ->where('fech_ini_per','>=',$inicio)->where('fech_ini_per','<=',$fin)
        ->get();

        $faltas_justificadas = FaltasJustificadas::where('fk_no_empleado', $empleado)
        ->where('fecha_inicio_justificar','>=',$inicio)->where('fecha_inicio_justificar','<=',$fin)
        ->get();

        $incapacidades = Incapacidades::where('fk_empleado', $empleado)
        ->where('fecha_inicio','>=',$inicio)->where('fecha_inicio','<=',$fin)
        ->get();

        $retardos = Retardos::where('no_empleado', $empleado)->where('IdJustificacion','Retardo')->where('fecha_falta','>=','2023-01-01')
        ->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)
        ->get();
        
        $faltasinjustificadas = Retardos::where('no_empleado', $empleado)->whereNull('IdJustificacion')->where('idIncidencia','INASISTENC')->where('faltas.fecha_falta','>=','2023-01-01')->where('fecha_falta','<',date('Y-m-d'))
        ->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)
        ->get();

        $vacaciones2 = Retardos::where('no_empleado', $empleado)->where('IdJustificacion','vac')->where('fecha_falta','>=','2023-01-01')
        ->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)
        ->orderby('fecha_falta','desc')
        ->get();

        $permisos2 = Retardos::where('no_empleado', $empleado)->where('IdJustificacion','<>','Retardo')->where('IdJustificacion','<>','vac')->where('IdJustificacion','<>','Retardo')->where('IdJustificacion','<>','Suspension')->where('IdJustificacion','<>',NULL)
        ->where('fecha_falta','>=','2023-01-01')
        ->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)
        ->orderby('fecha_falta','desc')
        ->get();

        $faltasjustificadas2 = Retardos::where('no_empleado', $empleado)->where('IdJustificacion','InasJusti')
        ->where('fecha_falta','>=','2023-01-01')
        ->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)
        ->orderby('fecha_falta','desc')
        ->get();

        $incapacidades2 = Retardos::where('no_empleado', $empleado)->where('IdJustificacion','IncMater')->where('IdJustificacion','IncMater')->where('IdJustificacion','IncInterna')
        ->where('fecha_falta','>=','2023-01-01')
        ->where('fecha_falta','>=',$inicio)->where('fecha_falta','<=',$fin)
        ->orderby('fecha_falta','desc')
        ->get();      

        return view('hojadevida.detallehojadevida',compact('no_empleado','inicio','fin','vacaciones','permisos','faltas_justificadas','incapacidades','retardos','faltasinjustificadas','vacaciones2','permisos2','faltasjustificadas2','incapacidades2'));
        
    }

}