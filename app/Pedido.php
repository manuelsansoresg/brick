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
        $pedido = Pedido::select('pedido.IdPedido', 'FechaEntrega', 'clientes.Nombre as cliente', 'tipo_modelo.descripcion as modelo', 'Subtotal', 'Iva', 'descuento', 'Importe', 'pedido.Estatus', 'IdEmpleadoSupervisor', 'pedido.Observaciones', 'pedido.created_at as fecha', 'FechaEntrega', 'IdCliente')
            ->join('clientes', 'clientes.Id', '=', 'pedido.IdCliente', 'left')
            ->join('tipo_modelo', 'tipo_modelo.id', '=', 'pedido.TipoModelo', 'left')
            ->join('produccion', 'produccion.IdPedido', '=', 'pedido.IdPedido', 'left')
            ->where('pedido.IdPedido', $IdPedido)
            ->first();
        return $pedido;
    }

    public static function getDetalleById($IdPedido, $IdProducion)
    {
        $pedido              = self::getById($IdPedido);
        $cliente             = Cliente::getById($pedido->IdCliente);
        $domicilio           = ($cliente!= "") ? 'Calle:' . $cliente->Calle . ' No° Ext:' . $cliente->NumeroExterior . ' No° Int' . $cliente->NumeroInterior . ' Colonia:' . $cliente->Colonia : '';
        $empleados           = Empleado::getAll();
        $detalle_produccion  = DetalleProducion::select('Observaciones', 'Cantidad', 'clasificacion', 'IdProducion', 'IdProducto')
                                ->where('IdProducion', $IdProducion)->get();
        $pedidos             = array();
        $total_produccion    = 0;

        foreach ($detalle_produccion as $detalle_prod){
            $suma_cantidad       = 0;
            $diferencia          = 0;
            $get_avance = DetalleProducionAvance::where('IdProducion', $detalle_prod->IdProducion)->where('IdProducto', $detalle_prod->IdProducto)->get();
            foreach ($get_avance as $avance){

                $Cantidad      = $avance->Cantidad;
                $CantidadBueno = $avance->CantidadBueno;
                $CantidadMalo  = $avance->CantidadMalo;

                $suma_cantidad = $suma_cantidad +  $Cantidad;
                $diferencia    = $suma_cantidad - $detalle_prod->Cantidad;

            }

            $pedidos[] = array('Observaciones' =>$detalle_prod->Observaciones, 'IdProducion' => $detalle_prod->IdProducion , 'IdProducto' => $detalle_prod->IdProducto , 'Cantidad' => $detalle_prod->Cantidad, 'clasificacion' => $detalle_prod->clasificacion, 'produccion_actual' => $suma_cantidad, 'diferencia' => $diferencia);

        }


        $data = array('pedido' => $pedido,  'cliente' => $cliente, 'domicilio' => $domicilio, 'empleados' => $empleados, 'detalle_produccion' => $pedidos);
        return $data;
    }

    static function getAll($statusPedido = '')
    {
        /*DB::enableQueryLog();*/
        $pedido = Pedido::select('pedido.IdPedido', 'FechaEntrega', 'produccion.Id', 'pedido.created_at', 'clientes.Nombre as cliente', 'tipo_modelo.descripcion as modelo', 'Subtotal', 'Nombre', 'Iva', 'descuento', 'Importe', 'pedido.Estatus')
                            ->join('clientes', 'clientes.Id', '=', 'pedido.IdCliente', 'left')
                            ->join('produccion', 'produccion.IdPedido', '=', 'pedido.IdPedido', 'left')
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
