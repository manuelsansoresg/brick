<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DetalleProducionAvance extends Model
{
    protected $table= 'detalleproducionavance';
    protected $primaryKey = 'id';

    public static function getById($IdProducion, $detallepedido_id)
    {
        DB::enableQueryLog();
        $detalle = DetalleProducionAvance::select('detalleproducionavance.id','IdProducion', 'detallepedido_id', 'detallepedido.estatus', 'detalleproducionavance.Fecha', 'detalleproducionavance.IdEmpleado',
                                            'empleado.Nombre','detalleproducionavance.Cantidad', 'detalleproducionavance.observaciones', 'CantidadBueno', 'CantidadMalo', 'detallepedido.estatus'
                                            )
                                            ->join('detallepedido', 'detallepedido.id', '=', 'detalleproducionavance.detallepedido_id')
                                            ->join('empleado', 'empleado.Id', '=', 'detalleproducionavance.IdEmpleado', 'left')
                                            ->where('IdProducion', $IdProducion)->where('detallepedido_id', $detallepedido_id)->get();
        /*dd(DB::getQueryLog());*/

        return array('detalle' => $detalle, 'total' => count($detalle));
    }

    public static function produccion_actual_diferencia($detallepedido_id, $IdProducion, $type=1)
    {
        $produccion = DetalleProducionAvance::select('CantidadBueno', 'CantidadMalo', 'Cantidad')->where('IdProducion', $IdProducion)->where('detallepedido_id', $detallepedido_id)->get();

        $total_produccion = 0;
        foreach ($produccion as $produccion){
            if($type == 1){
                $total_produccion+= $produccion->CantidadMalo + $produccion->CantidadBueno;
            }
        }
        return $total_produccion;
    }

    public static function saveProduction($detallepedido_id, $IdProducion, $request)
    {
        $prod            = DetalleProducionAvance::where('IdProducion',$IdProducion)->where('detallepedido_id', $detallepedido_id);
        $detalle_pedido  = DetallePedido::find($detallepedido_id);


        if(is_object($prod)){
            $prod->delete();
        }

        $total = 0;

        foreach ($request->empleado as $key=>$row){

            if($request->Cantidad[$key] != 0){

                $total   = $total + $request->Cantidad[$key];
                $detalle = new DetalleProducionAvance();

                $detalle->IdProducion       = $IdProducion;
                $detalle->detallepedido_id  = $detallepedido_id;
                $detalle->Fecha             = date('Y-m-d');
                $detalle->IdEmpleado        = $request->empleado[$key];
                $detalle->observaciones     = $request->observaciones[$key];
                $detalle->Cantidad          = $request->Cantidad[$key];
                $detalle->save();

            }
        }

        if($detalle_pedido->cantidad == $total){
            $detalle_pedido->estatus = 1;
            $detalle_pedido = $detalle_pedido->update();
        }else{
            $detalle_pedido->estatus = 0;
            $detalle_pedido = $detalle_pedido->update();
        }

        $data = array('status' => 200, 'total' => $total);

        return $data;

    }

    public static function saveSecado($detallepedido_id, $IdProducion, $request)
    {


        foreach ($request->producionavanceid as $key=>$row){

            $detalle = DetalleProducionAvance::find($row);
            $detalle->CantidadBueno =  $request->CantidadBueno[$key];
            $detalle->CantidadMalo =  $request->CantidadMalo[$key];
            $detalle->update();

        }

    }
}
