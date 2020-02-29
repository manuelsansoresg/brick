<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $table = 'entradas';
    protected $primaryKey = 'Id';

    public static function getAll()
    {
        $entradas = Entrada::select('entradas.Id', 'movimiento.Descripcion as movimiento', 'proveedores.Nombre as proveedor', 'entradas.Fecha','Subtotal', 'Iva', 'Descuento', 'Importe', 'Observaciones')
                            ->join('movimiento', 'movimiento.Id', '=', 'entradas.Id')
                            ->join('proveedores', 'proveedores.Id', '=', 'entradas.IdProveedor')
                            ->join('users', 'users.id', '=', 'entradas.IdUsuario')
                            ->get();
        return $entradas;
    }

}
