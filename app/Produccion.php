<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Produccion extends Model
{
    protected $table = 'produccion';
    protected $primaryKey = 'Id';

    public static function getById($id)
    {
        return Produccion::find($id);
    }

    public static function setProduccion($IdPedido)
    {
        $production = Produccion::where('IdPedido', $IdPedido)->first();

        if(!is_object($production)){
            $production           = new Produccion();
            $production->IdPedido = $IdPedido;
            $production->Fecha    = date('Y-m-d');
            $production->save();

            $detalle_pedido = DetallePedido::where('IdPedido', $IdPedido)->get();

            foreach ($detalle_pedido as $detalle_pedido){
                $detalle_produccion = new DetalleProducion();
                $detalle_produccion->IdProducion = $production  ->Id;
                $detalle_produccion->IdProducto = $detalle_pedido->Idarticulo;
                $detalle_produccion->Cantidad = $detalle_pedido->cantidad;
                $detalle_produccion->Precio = $detalle_pedido->Precio;
                $detalle_produccion->Importe = $detalle_pedido->importe;
                $detalle_produccion->Observaciones = $detalle_pedido->Observaciones;
                $detalle_produccion->clasificacion = 'd';
                $detalle_produccion->save();
            }

        }

        return $production;

    }

    public static function edit($IdEmpleadoSupervisor, $IdProducion)
    {
        if($IdEmpleadoSupervisor > 0){
            $produccion = Produccion::find($IdProducion);
            $produccion->IdEmpleadoSupervisor = $IdEmpleadoSupervisor;
            $produccion->update();
        }

    }

    public static function finishSecado($id_produccion)
    {
        $produccion = Produccion::find($id_produccion);
        $IdPedido = $produccion->IdPedido;

        $pedido = Pedido::find($IdPedido);
        $pedido->statusPedido = 3;
        $pedido->update();

        $produccion->Estatus = 1;
        $produccion->update();
    }

}
