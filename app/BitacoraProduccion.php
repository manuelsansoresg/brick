<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitacoraProduccion extends Model
{
    protected $table = 'bitacora_produccion';

    public static function total_bitacora($produccion_id, $detalle_pedido_id) //saber si es detalle pedido o secado
    {
        $data            = array('produccion_id' => $produccion_id, 'detalle_pedido_id' => $detalle_pedido_id);
        $bitacora        = BitacoraProduccion::where($data);
        $total           = $bitacora->count();
        $result_bitacora = '';
        $detalle_pedido  = DetalleProducionAvance::where(array('IdProducion' => $produccion_id, 'detallepedido_id' => $detalle_pedido_id))->get();

        if($total > 0 ){
            $result_bitacora = $bitacora->first();
        }
        return array('detalle' => $result_bitacora, 'total' => $total, 'detalle_pedido' => $detalle_pedido);

    }
}
