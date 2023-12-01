<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebaController extends Controller
{
    public function sorteo()
    {
        $mensaje = "Hola mundo ";
        return  view('prueba.sorteo', compact('mensaje')); 
    }

}
