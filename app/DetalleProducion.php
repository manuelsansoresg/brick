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
         return DetalleProducion::select('articulo.descripcion as descripcion', 'detalleproducion.IdProducto', 'detalleproducion.IdProducion', 'detalleproducion.Cantidad', 'articulo.id as articulo_id')
                        ->join('articulo', 'articulo.id', '=', 'detalleproducion.IdProducto')->where('IdProducion',$produccion_id)->get();

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



    public static function getByIds($IdProducion, $IdProducto)
    {
        return DetalleProducion::where(array('IdProducion' => $IdProducion, 'IdProducto' => $IdProducto))->first();
    }
}
