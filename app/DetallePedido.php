<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    protected $table      = 'detallepedido';
    protected $primaryKey = 'id';



    static function getById($IdPedido)
    {
        $detalle_pedido = DetallePedido::select('detallepedido.id', 'detallepedido.IdPedido', 'detallepedido.Idarticulo', 'articulo.ClaveInterna', 'articulo.descripcion', 'Abreviatura', 'cantidad', 'Precio1', 'Precio2', 'Precio3', 'descuento', 'importe',
                                                'detallepedido.estatus')
                                        ->join('articulo', 'articulo.id', '=' , 'detallepedido.Idarticulo')
                                        ->join('unidad', 'unidad.Id', '=', 'articulo.IdUnidadCompra')
                                        ->where('IdPedido', $IdPedido)->get();
        return $detalle_pedido;
    }

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

    static function drop($IdPedido)
    {
        $detalle_pedido = DetallePedido::where('IdPedido',$IdPedido);
        if($detalle_pedido){
            $detalle_pedido->delete();
        }
    }

}
