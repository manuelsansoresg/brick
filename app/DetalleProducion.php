<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleProducion extends Model
{
    protected $table      = 'detalleproducion';
    protected $primaryKey = 'IdProducion';
    protected $fillable = ['IdProducion', 'IdProducto', 'Cantidad', 'Precio', 'Importe', 'Observaciones', 'Estatus', 'clasificacion','descripcion','total'];

    public static function getByProduccion($produccion_id)
    {
         return DetalleProducion::select('articulo.descripcion as descripcion', 'detalleproducion.clasificacion', 'detalleproducion.IdProducto', 'detalleproducion.IdProducion', 'detalleproducion.Cantidad', 'articulo.id as articulo_id')
                        ->join('articulo', 'articulo.id', '=', 'detalleproducion.IdProducto', 'left')
                        
                        ->where('IdProducion',$produccion_id)->get();

       /* $detalle = DetalleProducion::select('detalleproducion.IdProducion','articulo.descripcion','detalleproducion.IdProducto','detalleproducion.Cantidad',
                                'detalleproducion.clasificacion','detalleproducion.Estatus','detalleproducion.Observaciones','detalleproducion.Precio',
        'detalleproducion.Importe','(SELECT SUM(detalleproducionavance.Cantidad)
                FROM detalleproducionavance
                WHERE detalleproducionavance.IdProducion = detalleproducion.IdProducion
                AND detalleproducionavance.IdProducto= detalleproducion.IdProducto) AS total)')
            ->join('articulo', 'articulo.Id', '=', 'detalleproducion.IdProducto', 'INNER')
            ->where('detalleproducion.IdProducion', $produccion_id)
            ->get();*/

    }

    public static function statusDetalle($IdProducion)
    {
        $detalle = (int)DetalleProducion::where('IdProducion', $IdProducion)->sum('Cantidad');
        $get_avance = (int)DetalleProducionAvance::where('IdProducion', $IdProducion)->sum('CantidadBueno');

        if($detalle == $get_avance){
            return true;
        }else{
            return false;
        }
    }

    public static function getByIds($IdProducion, $IdProducto)
    {
        return DetalleProducion::where(array('IdProducion' => $IdProducion, 'IdProducto' => $IdProducto))->first();
    }
}
