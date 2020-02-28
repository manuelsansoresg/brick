<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DetalleProducionAvance extends Model
{
    protected $table= 'detalleproducionavance';


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

    public static function getTotalDetalle($detalle_produccion_avance, $detalle_produccion)
    {
        $total = 0;
        $maximo = (int)$detalle_produccion->Cantidad;

        foreach ($detalle_produccion_avance as $detalle_produccion_avance){
            $bueno = (int)$detalle_produccion_avance->CantidadBueno;
            $total = $total + $bueno;
        }

        return $maximo - $total;
    }
}
