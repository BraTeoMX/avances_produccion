<?php

namespace App\Http\Controllers;
use App\Cat_team_leader;
use App\Cat_modulos;
use App\TeamModulo;
use App\Planeacion;
use App\Planeacion_diaria;
use App\Datos_planeacion_diaria;

use Illuminate\Http\Request;
use App\Formato_P07;

class VPFController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $datosPlaneacion = Planeacion::with(['teamLeader', 'planeacionesDiarias'])->get();
        $datosPlaneacion_diaria = Planeacion_diaria::all();
        $Cat_team_leader = Cat_team_leader::all();
        date_default_timezone_set('America/Mexico_City');
        $inicio='';
        $fin ='';
        $dia =date('d/m');
        $hora = date("G").":00"; 
        $horaD = (int) date("G");
        $dia_semana = date("N");
        //dd($horaD);
        //$horaD = 12;

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
       
        return view('VPF.index', compact('meta','tiempo_desocupacion','horas_laboradas','horas_laboradas2', 'dia','hora','cantidad_dia','eficiencia_dia','inicio','fin',
            'datosPlaneacion','datosPlaneacion_diaria','horaD'));
 
    }

    public function actualizarTabla(Request $request)
{
    date_default_timezone_set('America/Mexico_City');
    $planeacionesData = $request->input('planeaciones');
    //dd($planeacionesData);
    $horaD = (int) date("G");
    
    //$horaD = (int)(12);
    //dd($request);
    
    foreach ($planeacionesData as $data) {
        $planeacionDiaria = Planeacion_diaria::where('id_planeacion', $data['id'])->first();
        if ($planeacionDiaria) {
            $planeacionDiaria->{'piezas_'.$horaD} = $data['piezas_'.$horaD];
            $planeacionDiaria->{'efic_'.$horaD} = $data['efic_'.$horaD];
            $planeacionDiaria->{'min_prod_'.$horaD} = $data['min_prod_'.$horaD];
            $planeacionDiaria->{'proy_min_'.$horaD} = $data['proy_min_'.$horaD];
            $planeacionDiaria->save();
        }
    }

    // Redirigir de vuelta a la página de origen o a donde consideres conveniente
    return back()->with('success', 'Todos los datos han sido actualizados correctamente.');
    }

    public function transferirDatosDiarios()
    {
        $datosDeHoy = Planeacion_diaria::all(); // o una consulta más específica si es necesario

        foreach ($datosDeHoy as $dato) {
            Datos_planeacion_diaria::create([
                'id_planeacion' => $dato->id_planeacion,
                'registro_fecha' => $dato->updated_at,
                'meta_8' => $dato->meta_8,
                'piezas_8' => $dato->piezas_8,
                'efic_8' => $dato->efic_8,
                'min_prod_8' => $dato->min_prod_8,
                'proy_min_8' => $dato->proy_min_8,
                'meta_9' => $dato->meta_9,
                'piezas_9' => $dato->piezas_9,
                'efic_9' => $dato->efic_9,
                'min_prod_9' => $dato->min_prod_9,
                'proy_min_9' => $dato->proy_min_9,
                'meta_10' => $dato->meta_10,
                'piezas_10' => $dato->piezas_10,
                'efic_10' => $dato->efic_10,
                'min_prod_10' => $dato->min_prod_10,
                'proy_min_10' => $dato->proy_min_10,
                'meta_11' => $dato->meta_11,
                'piezas_11' => $dato->piezas_11,
                'efic_11' => $dato->efic_11,
                'min_prod_11' => $dato->min_prod_11,
                'proy_min_11' => $dato->proy_min_11,
                'meta_12' => $dato->meta_12,
                'piezas_12' => $dato->piezas_12,
                'efic_12' => $dato->efic_12,
                'min_prod_12' => $dato->min_prod_12,
                'proy_min_12' => $dato->proy_min_12,
                'meta_13' => $dato->meta_13,
                'piezas_13' => $dato->piezas_13,
                'efic_13' => $dato->efic_13,
                'min_prod_13' => $dato->min_prod_13,
                'proy_min_13' => $dato->proy_min_13,
                'meta_14' => $dato->meta_14,
                'piezas_14' => $dato->piezas_14,
                'efic_14' => $dato->efic_14,
                'min_prod_14' => $dato->min_prod_14,
                'proy_min_14' => $dato->proy_min_14,
                'meta_15' => $dato->meta_15,
                'piezas_15' => $dato->piezas_15,
                'efic_15' => $dato->efic_15,
                'min_prod_15' => $dato->min_prod_15,
                'proy_min_15' => $dato->proy_min_15,
                'meta_16' => $dato->meta_16,
                'piezas_16' => $dato->piezas_16,
                'efic_16' => $dato->efic_16,
                'min_prod_16' => $dato->min_prod_16,
                'proy_min_16' => $dato->proy_min_16,
                'meta_17' => $dato->meta_17,
                'piezas_17' => $dato->piezas_17,
                'efic_17' => $dato->efic_17,
                'min_prod_17' => $dato->min_prod_17,
                'proy_min_17' => $dato->proy_min_17,
                'meta_18' => $dato->meta_18,
                'piezas_18' => $dato->piezas_18,
                'efic_18' => $dato->efic_18,
                'min_prod_18' => $dato->min_prod_18,
                'proy_min_18' => $dato->proy_min_18,
            ]);
        }

        // Opcional: Limpiar la tabla `planeacion_diaria` pero en este caso no es general y lo hace para los campos establecidos
        Planeacion_diaria::query()
        ->update([
            'meta_8' => null,
            'piezas_8' => null,
            'efic_8' => null,
            'min_prod_8' => null,
            'proy_min_8' => null,
            'meta_9' => null,
            'piezas_9' => null,
            'efic_9' => null,
            'min_prod_9' => null,
            'proy_min_9' => null,
            'meta_10' => null,
            'piezas_10' => null,
            'efic_10' => null,
            'min_prod_10' => null,
            'proy_min_10' => null,
            'meta_11' => null,
            'piezas_11' => null,
            'efic_11' => null,
            'min_prod_11' => null,
            'proy_min_11' => null,
            'meta_12' => null,
            'piezas_12' => null,
            'efic_12' => null,
            'min_prod_12' => null,
            'proy_min_12' => null,
            'meta_13' => null,
            'piezas_13' => null,
            'efic_13' => null,
            'min_prod_13' => null,
            'proy_min_13' => null,
            'meta_14' => null,
            'piezas_14' => null,
            'efic_14' => null,
            'min_prod_14' => null,
            'proy_min_14' => null,
            'meta_15' => null,
            'piezas_15' => null,
            'efic_15' => null,
            'min_prod_15' => null,
            'proy_min_15' => null,
            'meta_16' => null,
            'piezas_16' => null,
            'efic_16' => null,
            'min_prod_16' => null,
            'proy_min_16' => null,
            'meta_17' => null,
            'piezas_17' => null,
            'efic_17' => null,
            'min_prod_17' => null,
            'proy_min_17' => null,
            'meta_18' => null,
            'piezas_18' => null,
            'efic_18' => null,
            'min_prod_18' => null,
            'proy_min_18' => null,
        ]);
        return back()->with('success', 'Los datos han sido transferidos exitosamente.');
    }

    
    public function altasybajasTLyM(Request $request)
    {
         // Si es un POST request, entonces intentamos agregar un nuevo registro.
        if ($request->isMethod('post')) {
            // Validación básica
            $request->validate([
                'team_leader' => 'sometimes|required|max:255',
                'Modulo' => 'sometimes|required|max:255',
            ]);

            // Agregar un Team Leader
            if ($request->input('team_leader')) {
                // Buscar si ya existe un Team Leader con ese nombre
                $existingLeader = Cat_team_leader::where('team_leader', $request->input('team_leader'))->first();
                if ($existingLeader) {
                    // Si existe, regresa con un mensaje de error
                    return back()->with('error', 'El Team Leader ya existe.');
                } else {
                    // Si no existe, crea uno nuevo
                    $newLeader = new Cat_team_leader(['team_leader' => $request->input('team_leader'), 'estatus' => 'A']);
                    $newLeader->save();
                    return back()->with('success', 'Nuevo Team Leader agregado.');
                }
            }
            // Agregar un Módulo
            elseif ($request->input('Modulo')) {
                // Buscar si ya existe un Módulo con ese nombre
                $existingModulo = Cat_modulos::where('Modulo', $request->input('Modulo'))->first();
                if ($existingModulo) {
                    // Si existe, regresa con un mensaje de error
                    return back()->with('error', 'El Módulo ya existe.');
                } else {
                    // Si no existe, crea uno nuevo
                    $newModulo = new Cat_modulos(['Modulo' => $request->input('Modulo'), 'estatus' => 'A']);
                    $newModulo->save();
                    return back()->with('success', 'Nuevo Módulo agregado.');
                }
            }
        }
        $mensaje = "Hola mundo";
        $teamLeaders = Cat_team_leader::all();
        $modulos = Cat_modulos::all();
        /*
        $teamLeaders = Cat_team_leader::where('estatus', 'A')->get();
        $modulos = Cat_modulos::where('estatus', 'A')->get();
        */
        return view('VPF.altasybajasTLyM', compact('mensaje','teamLeaders', 'modulos'));

    }

    public function ActualizarEstatus(Request $request, $id) {
        $teamLeader = Cat_team_leader::findOrFail($id);
        $teamLeader->estatus = $request->input('estatus', 'A'); // Asumiendo 'A' como valor por defecto para "Dar de Alta"
        $teamLeader->save();
    
        $mensaje = $teamLeader->estatus == 'A' ? 'El Team Leader ha sido dado de alta.' : 'El Team Leader ha sido dado de baja.';
        
        return back()->with('status', $mensaje);
    }
    
    public function ActualizarEstatusM(Request $request, $id) {
        $modulo = Cat_modulos::findOrFail($id);

        // Cambia el estatus basado en el valor recibido del formulario
        $nuevoEstatus = $request->input('estatus');
        $modulo->estatus = $nuevoEstatus;
        $modulo->save();

        // Mensaje de éxito personalizado basado en la acción realizada
        $mensaje = $nuevoEstatus == 'A' ? 'El módulo ha sido dado de alta.' : 'El módulo ha sido dado de baja.';
    
        return back()->with('status', $mensaje);
}
    


    public function tablaTLyM(Request $request)
    {
       
        $mensaje = "Hola mundo";
        $teamLeaders = Cat_team_leader::all();
        $modulos = Cat_modulos::all();
        // Obtiene todos los registros de TeamModulo y sus relaciones
        //$teamModulos = TeamModulo::with('catTeamLeader', 'catModulo')->get();
        $teamModulos = TeamModulo::with(['catTeamLeader' => function ($query) {
            $query->where('estatus', 'A');
        }, 'catModulo' => function ($query) {
            $query->where('estatus', 'A');
        }])->whereHas('catTeamLeader', function ($query) {
            $query->where('estatus', 'A');
        })->whereHas('catModulo', function ($query) {
            $query->where('estatus', 'A');
        })->get();
        
        return view('VPF.tablaTLyM', compact('mensaje', 'teamModulos'));

    }
    

    
    public function modificacionTablaTLyM(Request $request)
    {
       
        $mensaje = "Hola mundo";
        // Validación básica, ajusta según sea necesario
            
        
        return view('VPF.modificacionTablaTLyM', compact('mensaje', 'teamModulos', 'modulos'));

    }

    public function showModificacionTablaTLyM(Request $request)
    {
        $teamLeaders = Cat_team_leader::all();
        $modulos = Cat_modulos::all();
        $request->validate([
            'team_leader' => 'required|exists:cat_team_leaders,id',
            'modulo' => 'required|exists:cat_modulos,id',
        ]);

        
        // Asumiendo que tienes un identificador para saber cuál TeamModulo actualizar
        $teamModuloId = $request->input('id'); // Asegúrate de tener este input en tu formulario
        $teamModulo = TeamModulo::findOrFail($teamModuloId);

        // Actualizar el team leader
        $teamModulo->team_leader_id = $request->input('team_leader');
        
        // Actualizar los módulos, si es una relación muchos a muchos
        $teamModulo->modulos()->sync($request->input('modulo'));

        $teamModulo->save();

        // Redirigir de vuelta a la vista con un mensaje de éxito
        return redirect()->back()->with('success', 'Actualización realizada con éxito.');
        

        $teamLeaders = Cat_team_leader::all();
        $modulos = Cat_modulos::all();
        
        return view('VPF.modificacionTablaTLyM', compact('teamLeaders', 'modulos'));
    }



}
