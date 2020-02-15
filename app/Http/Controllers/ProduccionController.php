<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\DetallePedido;
use App\DetalleProducionAvance;
use App\Empleado;
use App\Http\Requests\PedidoRequest;
use App\Pedido;
use App\Produccion;
use App\Proveedor;
use App\TipoModelo;
use Illuminate\Http\Request;

class ProduccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos            = Pedido::getAll(0);
        $pedido_procesados  = Pedido::getAll(1);

        //return view('pedido.index', compact('pedidos'));
        return view('produccion.index', compact('pedidos', 'pedido_procesados'));
    }

    public function getTableDetail($detallepedido_id , $IdProducion)
    {
        $detalleProduccion = DetalleProducionAvance::getById($IdProducion, $detallepedido_id);
        return response()->json($detalleProduccion);
    }

    public function getDetalle($pedido_id , $IdProducion)
    {
        $pedido = Pedido::getDetalleById($pedido_id, $IdProducion);
        return response()->json($pedido);
    }

    public function produccion_actual($detallepedido_id, $IdProducion)
    {
        $detalle = DetalleProducionAvance::produccion_actual_diferencia($detallepedido_id, $IdProducion);
        return response()->json($detalle);
    }

    public function setProduccion($pedido_id)
    {
        $produccion = Produccion::setProduccion($pedido_id);
        return response()->json($produccion);
    }

    public function form_autorizar($pedido_id)
    {
        $pedido             = Pedido::getById($pedido_id);
        $modelos            = TipoModelo::getAll();
        $folio              = Pedido::getFolio();
        $clientes           = Cliente::getAll();
        $cliente            = Cliente::getById($pedido->IdCliente);
        $domicilio          = ($cliente!= "") ? 'Calle:' . $cliente->Calle . ' No° Ext:' . $cliente->NumeroExterior . ' No° Int' . $cliente->NumeroInterior . ' Colonia:' . $cliente->Colonia : '';
        $detalle_pedidos    = DetallePedido::getById($pedido_id);
        $total_detalle      = count($detalle_pedidos);
        $is_autorizar       = true;

        return  view('pedido.edit', compact('clientes', 'is_autorizar', 'modelos', 'folio', 'pedido', 'domicilio', 'detalle_pedidos', 'total_detalle'));
    }

    public function saveProduction(Request $request, $detallepedido_id, $IdProducion)
    {
        $detalle = DetalleProducionAvance::saveProduction($detallepedido_id, $IdProducion, $request);
        return response()->json($detalle);
    }

    public function saveSecado(Request $request, $detallepedido_id, $IdProducion)
    {
        $detalle = DetalleProducionAvance::saveSecado($detallepedido_id, $IdProducion, $request);
        return response()->json($detalle);
    }

    public function autorizar($pedido_id, $status)
    {

        Pedido::autorizar($pedido_id, $status);
        $msg = ($status == 2)? 'Producto borrado': 'Producto autorizado';

        flash($msg);
        return redirect('/admin/produccion');
    }

    public function create()
    {

    }


    public function store(Request $request)
    {
        $id_empleado = $request->id_empleado;
        return response()->json($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show($pedido_id)
    {
        $pedido     = Pedido::getById($pedido_id);
        $clientes   = Cliente::getAll();
        $empleados  = Empleado::getAll();
        $cliente            = Cliente::getById($pedido->IdCliente);
        $domicilio          = ($cliente!= "") ? 'Calle:' . $cliente->Calle . ' No° Ext:' . $cliente->NumeroExterior . ' No° Int' . $cliente->NumeroInterior . ' Colonia:' . $cliente->Colonia : '';
        $detalle_pedidos    = DetallePedido::getById($pedido_id);

        return view('produccion.detalle', compact('pedido', 'clientes', 'empleados', 'domicilio', 'detalle_pedidos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(PedidoRequest $request, Pedido $pedido)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy($IdPedido, $Estatus)
    {

    }
}
