<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Produccion extends Model
{
    protected $table      = 'produccion';
    protected $primaryKey = 'Id';
    protected $fillable = ['Id', 'Fecha', 'IdPedido', 'Observaciones', 'Estatus'];

    static function getById($IdPedido)
    {
        $pedido = Pedido::select('IdPedido', 'FechaEntrega', 'clientes.Nombre as cliente', 'tipo_modelo.descripcion as modelo', 'Subtotal', 'Iva', 'descuento', 'Importe', 'pedido.Estatus', 'Observaciones', 'pedido.created_at as fecha', 'FechaEntrega', 'IdCliente')
            ->join('clientes', 'clientes.Id', '=', 'pedido.IdCliente')
            ->join('tipo_modelo', 'tipo_modelo.id', '=', 'pedido.TipoModelo')
            ->where('pedido.IdPedido', $IdPedido)
            ->first();
        return $pedido;
    }

    static function getAll()
    {
        $pedido = Pedido::select('IdPedido', 'FechaEntrega', 'clientes.Nombre as cliente', 'tipo_modelo.descripcion as modelo', 'Subtotal', 'Iva', 'descuento', 'Importe', 'pedido.Estatus')
                            ->join('clientes', 'clientes.Id', '=', 'pedido.IdCliente')
                            ->join('tipo_modelo', 'tipo_modelo.id', '=', 'pedido.TipoModelo')
                            ->get();
        return $pedido;
    }

    static function createUpdate($request , $id=null)
    {

        //dd($request->all());

        $Estatus          = isset($request->Estatus)? 1: 0;
        $total_articulos  = count($request->articulo_importe);

        if($id == null){
            $pedido = new Pedido($request->except('_token', 'articulo_cantidad', 'articulo_precio', 'articulo_desc', 'articulo_importe'));
            $pedido->Estatus = $Estatus;
          
        }else{
            $pedido = Pedido::find($id);
            $pedido->fill($request->except('_token'));
            $pedido->Estatus = $Estatus;
            
        }

       
        if ($id != null) {
            $pedido->IdUsuario = Auth::id();
        }
        

        if ($id == null){
            $pedido->save();
        }else{
            $pedido->update();
            DetallePedido::drop($pedido->IdPedido);

        }

        for ($i = 0; $i < $total_articulos; $i++) {
            $Idarticulo = $request->articulo_id[$i];
            $cantidad   = $request->articulo_cantidad[$i];
            $descuento  = $request->articulo_desc[$i];
            $Precio     = $request->articulo_precio[$i];
            $importe    = $request->articulo_importe[$i];

            DetallePedido::createUpdate($pedido->IdPedido, $Idarticulo, $cantidad, $descuento, $Precio, $importe);
        }

    }
    
    static function getFolio()
    {
        $producto = Pedido::select(DB::raw('max(IdPedido) as total'))->first()->total+1;
        return $producto;
    }

    static function pdfPedido($IdPedido)
    {
        $pedido = Pedido::select('Nombre', 'Calle', 'NumeroExterior', 'NumeroExterior', 'Colonia', 'RFC',
                                'FechaEntrega', 'Subtotal', 'Iva', 'descuento', 'Importe'
                                )
                        ->join('clientes', 'clientes.Id', '=', 'pedido.IdCliente')
                        ->where('IdPedido', $IdPedido)
                        ->first();

        $articulos = DetallePedido::select('Idarticulo', 'articulo.ClaveInterna', 'descripcion','cantidad', 'descuento', 'Precio', 'importe')
                        ->join('articulo', 'articulo.id', '=', 'detallepedido.Idarticulo')
                        ->where('IdPedido', $IdPedido)
                        ->get();

        return array('pedido' => $pedido, 'articulos' => $articulos);
    }

    static function drop($IdPedido, $status)
    {
        $pedido = Pedido::find($IdPedido);
        $pedido->Estatus = $status;
        $pedido->update();
    }

}