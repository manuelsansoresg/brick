<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    protected $table      = 'detallepedido';
    protected $primaryKey = 'IdPedido';


    static function createUpdate ($IdPedido, $Idarticulo, $cantidad, $descuento, $Precio, $importe, $id = null)
    {
        if ($id == null) {
            $detalle_pedido             = new DetallePedido();
            $detalle_pedido->IdPedido   = $IdPedido;
            $detalle_pedido->Idarticulo = $Idarticulo;
            $detalle_pedido->cantidad   = $cantidad;
            $detalle_pedido->descuento  = $descuento;
            $detalle_pedido->Precio     = $Precio;
            $detalle_pedido->importe    = $importe;
            $detalle_pedido->save();
        }else{

        }
    }

}
