<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleProducion extends Model
{
    protected $table      = 'detalleproducion';
    protected $primaryKey = 'IdProducion';

    public static function getByProduccion($produccion_id)
    {
        return  DetalleProducion::find($produccion_id)->get();
    }

    public static function getByIds($IdProducion, $IdProducto)
    {
        return  DetalleProducion::where(array('IdProducion' => $IdProducion, 'IdProducto' => $IdProducto))->first();
    }
}
