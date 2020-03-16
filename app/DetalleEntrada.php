<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleEntrada extends Model
{
    protected $table = 'detalleentrada';
    protected $fillable = ['IdEntrada', 'IdProducto', 'Cantidad', 'Precio', 'Descuento', 'Importe', 'Observaciones', 'Estatus'];
}
