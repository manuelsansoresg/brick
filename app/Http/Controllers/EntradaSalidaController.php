<?php

namespace App\Http\Controllers;

use App\Entrada;
use App\Produccion;
use Illuminate\Http\Request;

class EntradaSalidaController extends Controller
{
    public function entrada($IdProduccion)
    {


        Entrada::saveEdit($IdProduccion);
    }

    public function salida()
    {

    }
}
