<?php

namespace App\Http\Controllers;
use App\Tbl_Empleado_SIA;
use App\Sorteo;
use Illuminate\Http\Request;

class PruebaController extends Controller
{
    public function sorteo(Request $request)
    {
   
        $mensaje = "Hola mundo ";
        return  view('prueba.sorteo', compact('mensaje')); 
    }
    public function resultadoSorteo(Request $request)
    {
   
        $mensaje = "Hola mundo ";
        return  view('prueba.sorteo', compact('mensaje')); 
    }

    public function registroSorteo(Request $request)
    {
        $numeroEmpleado = $request->input('numeroEmpleado');
    
        // Obteniendo datos del empleado
        $empleado = Tbl_Empleado_SIA::where('No_Empleado', str_pad($numeroEmpleado, 7, '0', STR_PAD_LEFT))
                                ->where('Status_Emp', 'A')
                                ->first();
        $registroExistente = Sorteo::where('No_Empleado', str_pad($numeroEmpleado, 7, '0', STR_PAD_LEFT))
            ->first();
        if($registroExistente){
            return redirect()->back()->with('status', 'El empleado ya está registrado en el sorteo.');
        }
        $numeroAleatorio = rand(100, 999);
        // Filtrar por planta Ixtlahuaca
        $empleadoIxtlahuaca = Tbl_Empleado_SIA::where('No_Empleado', str_pad($numeroEmpleado, 7, '0', STR_PAD_LEFT))
                                            ->where('Status_Emp', 'A')
                                            ->where('Id_Planta', 'Intimark1')
                                            ->first();

        // Filtrar por planta San Bartolo
        $empleadoSanBartolo = Tbl_Empleado_SIA::where('No_Empleado', str_pad($numeroEmpleado, 7, '0', STR_PAD_LEFT))
                                            ->where('Status_Emp', 'A')
                                            ->where('Id_Planta', 'Intimark2')
                                            ->first();
    
        if ($empleado) {
            $nombreCompleto = $empleado->Nom_Emp . ' ' . $empleado->Ap_Pat . ' ' . $empleado->Ap_Mat;
        } else {
            $nombreCompleto = 'No encontrado';
            return back()->with('error', 'Dato no encontrado');
        }
        //dd($empleado);
    
        // Guardando registro en la tabla Sorteo
        if ($empleado) {
            $sorteo = new Sorteo();
            $sorteo->No_empleado = $numeroEmpleado;
            $sorteo->nombre = $nombreCompleto;
            $sorteo->numero_sorteo = $numeroAleatorio;
            // Puedes agregar más campos aquí si lo necesitas
            $sorteo->save();
            return back()->with('success', 'Todos los datos han sido actualizados correctamente.')
                        ->with('sorteo', 'Numero de sorteo: ' . $numeroAleatorio);
        }
        return back()->with('status', '');
        // Puedes retornar una respuesta, como un JSON con el nombre
        //return response()->json(['nombre' => $empleado]);
    }

}
