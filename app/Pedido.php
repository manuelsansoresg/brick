<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Pedido extends Model
{
    protected $table      = 'pedido';
    protected $primaryKey = 'IdPedido';
    protected $fillable = ['IdCliente', 'Fecha', 'FechaEntrega', 'Observaciones', 'Subtotal', 'Iva', 'descuento', 'Importe', 'Estatus', 'IdUsuario', 'TipoModelo'];

    static function getById($IdPedido)
    {
        $pedido = Pedido::select('IdPedido', 'FechaEntrega', 'clientes.Nombre as cliente', 'tipo_modelo.descripcion as modelo', 'Subtotal', 'Iva', 'descuento', 'Importe', 'pedido.Estatus', 'Observaciones', 'pedido.created_at as fecha', 'FechaEntrega', 'IdCliente')
            ->join('clientes', 'clientes.Id', '=', 'pedido.IdCliente')
            ->join('tipo_modelo', 'tipo_modelo.id', '=', 'pedido.TipoModelo')
            ->where('pedido.IdPedido', $IdPedido)
            ->first();
        return $pedido;
    }

    public static function getDetalleById($IdPedido, $IdProducion)
    {
        $pedido             = self::getById($IdPedido);
        $cliente            = Cliente::getById($pedido->IdCliente);
        $domicilio          = ($cliente!= "") ? 'Calle:' . $cliente->Calle . ' No° Ext:' . $cliente->NumeroExterior . ' No° Int' . $cliente->NumeroInterior . ' Colonia:' . $cliente->Colonia : '';
        $empleados          = Empleado::getAll();
        $detalle_pedidos    = DetallePedido::getById($IdPedido);
        $pedidos            = array();
        $total_produccion   = 0;
        foreach ($detalle_pedidos as $detalle_pedidos){
            //'detallepedido.id', 'detallepedido.IdPedido', 'detallepedido.Idarticulo', 'articulo.ClaveInterna', 'articulo.descripcion', 'Abreviatura', 'cantidad', 'Precio1', 'Precio2', 'Precio3', 'descuento', 'importe',
            //                                                'detallepedido.estatus'

            $produccion = DetalleProducionAvance::select('CantidadBueno', 'CantidadMalo', 'Cantidad')
                                        ->where('IdProducion', $IdProducion)->where('detallepedido_id', $detalle_pedidos->id)->get();

            $total_produccion = 0;
            foreach ($produccion as $produccion){
                $total_produccion+= $produccion->CantidadMalo + $produccion->CantidadBueno;
            }
            $pedidos[] = array('id' => $detalle_pedidos->id, 'descripcion' =>$detalle_pedidos->descripcion, 'cantidad' => $detalle_pedidos->cantidad,
                                'produccion_actual' =>$total_produccion, 'estatus' => $detalle_pedidos->estatus
                                );
        }


        $data = array('pedido' => $pedido, 'cliente' => $cliente, 'domicilio' => $domicilio, 'empleados' => $empleados, 'detalle_pedidos' => $pedidos);
        return $data;
    }

    static function getAll($statusPedido = '')
    {
        /*DB::enableQueryLog();*/
        $pedido = Pedido::select('IdPedido', 'FechaEntrega', 'pedido.created_at', 'clientes.Nombre as cliente', 'tipo_modelo.descripcion as modelo', 'Subtotal', 'Nombre', 'Iva', 'descuento', 'Importe', 'pedido.Estatus')
                            ->join('clientes', 'clientes.Id', '=', 'pedido.IdCliente', 'left')
                            ->join('tipo_modelo', 'tipo_modelo.id', '=', 'pedido.TipoModelo', 'left');

        if($statusPedido !== ''){
            $pedido = $pedido->where('statusPedido', $statusPedido);
        }
        $pedido = $pedido->get();
        /*dd(DB::getQueryLog());*/
        return $pedido;
    }

    public static function autorizar($pedido_id, $status)
    {
        DB::enableQueryLog();
        $pedido = Pedido::find($pedido_id);
        $pedido->statusPedido = $status;
        $pedido->update();

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

        }

        $pedido->IdUsuario = Auth::id();

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
        $pedido = Pedido::select('IdPedido','Nombre', 'Calle', 'NumeroExterior', 'NumeroExterior', 'Colonia', 'RFC','Fecha',
                                'FechaEntrega', 'Subtotal', 'Iva', 'descuento', 'Importe','Observaciones','Telefono'
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
