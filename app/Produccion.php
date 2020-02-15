<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Produccion extends Model
{
    protected $table = 'produccion';



    public static function setProduccion($IdPedido)
    {
        $production = Produccion::where('IdPedido', $IdPedido)->first();

        if(!is_object($production)){
            $production           = new Produccion();
            $production->IdPedido = $IdPedido;
            $production->Fecha    = date('Y-m-d');
            $production->save();
        }

        return $production;

    }



}
