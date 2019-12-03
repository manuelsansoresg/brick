<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table      = 'pedido';
    protected $primaryKey = 'IdPedido';
    protected $fillable = ['IdProveedor', 'Fecha', 'FechaEntrega', 'Observaciones', 'Subtotal', 'Iva', 'descuento', 'Importe', 'Estatus', 'IdUsuario', 'TipoModelo'];

    static function getAll()
    {
        $pedido = Pedido::select('IdPedido', 'FechaEntrega', 'proveedores.Nombre as proveedor', 'tipo_modelo.descripcion as modelo', 'Subtotal', 'Iva', 'descuento', 'Importe', 'pedido.Estatus')
                            ->join('proveedores', 'proveedores.Id', '=', 'pedido.IdProveedor')
                            ->join('tipo_modelo', 'tipo_modelo.id', '=', 'pedido.TipoModelo')
                            ->get();
        return $pedido;
    }

    static function createUpdate($request , $id=null)
    {
        $Estatus = isset($request->Estatus)? 1 : 0;

        if($id == null){
            $pedido = new Pedido($request->except('_token'));
            $pedido->Estatus = $Estatus;
            $pedido->save();
        }else{
            $pedido = Pedido::find($id);
            $pedido->fill($request->except('_token'));
            $pedido->Estatus = $Estatus;
            $pedido->update();
        }
    }

}
