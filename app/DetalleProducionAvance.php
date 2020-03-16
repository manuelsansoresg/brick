<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DetalleProducionAvance extends Model
{
    protected $table= 'detalleproducionavance';
    protected $fillable = ['IdProducto', 'IdProducion', 'Fecha', 'IdEmpleado', 'Cantidad', 'observaciones', 'CantidadBueno', 'CantidadMalo', 'status'];


    public static function getByProduccion($IdProducto, $IdProducion)
    {
        $produccion = DetalleProducionAvance::where(array('IdProducto' => $IdProducto, 'IdProducion' => $IdProducion));
        return $produccion;
    }


    public static function getById($IdProducion, $IdProducto)
    {
        DB::enableQueryLog();
        $detalle = DetalleProducionAvance::where('IdProducion', $IdProducion)->where('IdProducto', $IdProducto)
                                            ->join('empleado', 'empleado.Id', '=' , 'IdEmpleado')
                                            ->get();

        return $detalle;
    }

    public static function getTotalSecado($IdProducion, $IdProducto, $detalle_produccion)
    {
        $detalleAvance = DetalleProducionAvance::where('IdProducion', $IdProducion)->where('IdProducto', $IdProducto)->get();
        $total2 = 0;

        foreach ($detalleAvance as $detalles){
            $cant   = (int)$detalles->CantidadBueno;
            $total2 = $total2 + $cant;
        }

        $cantidad            = $total2;
        $cantidad_produccion = $detalle_produccion->Cantidad;

        if ($cantidad_produccion > $cantidad)
        {
            return true;
        }else{
            return false;
        }
    }

    public static function getTotalDetalle($detalle_produccion_avance, $detalle_produccion)
    {
        $total = 0;
        $total1 = 0;
        $total2 = 0;
        $qletra = '';


        $maximo = (int)$detalle_produccion->Cantidad;

        foreach ($detalle_produccion_avance as $detalle_produccion_avance){
            $bueno = (int)$detalle_produccion_avance->CantidadBueno;
            $malo = (int)$detalle_produccion_avance->CantidadMalo;
            $cant = (int)$detalle_produccion_avance->Cantidad;

            $total = $total + $bueno;
            $total1 = $total1 + $malo;
            $total2 = $total2 + $cant;
        }

        //

        if ($total == 0){
            if ($total1 == 0){
                if ($maximo < $total2)
                {
                    return $maximo - $total2;
                }elseif($maximo == $total2)
                {
                    return $total2;
                }
            }else
            {
                return $maximo - $total1;
            }
        }else
        {
            $IdProducto =$detalle_produccion->IdProducto ;
            $IdProducion = $detalle_produccion->IdProducion;

            $detalleProduccion = DetalleProducion::where('IdProducion', $IdProducion)->where('IdProducto', $IdProducto)->first();

            $qletra = $detalleProduccion->clasificacion;

            if ($qletra =='d'){
                return $maximo - $total;
            }else{
                return $maximo;
            }
        }


    }

    static function createUpdate($request, $IdProducion, $IdProducto, $detalle_produccion, $id = null)
    {
        if ($id == null) {

            $detalle = new DetalleProducionAvance($request->except('_token'));
            $detalle->IdProducto = $IdProducto;
            $detalle->IdProducion = $IdProducion;
            $detalle->save();

            $detalleAvance = DetalleProducionAvance::where('IdProducion', $IdProducion)->where('IdProducto', $IdProducto)->get();
            $total2 = 0;

            foreach ($detalleAvance as $detalles){
                $cant = (int)$detalles->Cantidad;
                $total2 = $total2 + $cant;
            }

            $cantidad = $total2;
            $cantidad_produccion = $detalle_produccion->Cantidad;

            // ACTUALIZAR LOS ESTATUS DEPENDIENDO DE LA VALIDADCION.
            if ($cantidad >= $cantidad_produccion){
                $oExecutar = DetalleProducion::where('IdProducion', $IdProducion)->where('IdProducto', $IdProducto)->update(['clasificacion' => 'a']);
            }
        }

        return $detalle;
    }
    static function CreateUpdateAvance($request, $IdProducion, $IdProducto, $detalle_produccion,$id = null){

        $CantidadBueno = $request->CantidadBueno;
        $CantidadMalo  = $request->CantidadMalo;
        $IdEmpleado    = $request->IdEmpleado;
        $Id            = $request->Id;

        // obtengo los valores iniciales
        //$detalle       = new DetalleProducionAvance($request->except('_token'));

        $cont = -1;
        foreach ($CantidadBueno as $result) {
            $cont      = $cont + 1;
            $oExecutar = DetalleProducionAvance::where('id', $Id[$cont])->where('IdProducto', $IdProducto)->where('IdEmpleado', $IdEmpleado[$cont])->update(['CantidadBueno' => $CantidadBueno[$cont], 'CantidadMalo' => $CantidadMalo[$cont],'status'=>1]);
        }

        $detalleAvance = DetalleProducionAvance::where('IdProducion', $IdProducion)->where('IdProducto', $IdProducto)->get();
        $total2        = 0;

        foreach ($detalleAvance as $detalles){
            $cant = (int)$detalles->CantidadBueno;
            $total2 = $total2 + $cant;
        }

        $cantidad            = $total2;
        $cantidad_produccion = $detalle_produccion->Cantidad;

        if ($cantidad_produccion > $cantidad)
        {
            //actualizo el estatus de detalle produccion
            $objDetalleProduccion = DetalleProducion::where('IdProducion', $IdProducion)->where('IdProducto', $IdProducto)->update(['clasificacion' => 'd']);
            return true;
        }else{
            return false;
        }



    }

    public static function produccion_actual($IdProducion, $IdProducto)
    {
        return DetalleProducionAvance::where('IdProducion', $IdProducion)->where('IdProducto', $IdProducto)->sum('CantidadBueno');
    }

    public static function produccion_diferencia($IdProducion, $IdProducto)
    {
        $produccion = DetalleProducionAvance::where('IdProducion', $IdProducion)->where('IdProducto', $IdProducto)->get();
        $bueno = 0;

        foreach ($produccion as $row){
            $bueno = $bueno + $row->CantidadBueno;
        }

        $detalle = DetalleProducion::where('IdProducion', $IdProducion)->where('IdProducto', $IdProducto)->first();

        return (int)$detalle->Cantidad - $bueno;

    }
    public static function total_actual($IdProducion, $IdProducto)
    {
        $produccion = DetalleProducionAvance::where('IdProducion', $IdProducion)->where('IdProducto', $IdProducto)->get();
        $bueno = 0;
        $malo = 0;
        foreach ($produccion as $row){
            $bueno = $bueno + (int)$row->CantidadBueno;
            $malo = $malo + (int)$row->CantidadMalo;
        }

        return $bueno + $malo;
    }



}
