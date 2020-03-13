<?php

namespace App\Http\Controllers;

use App\BitacoraProduccion;
use App\Cliente;
use App\DetallePedido;
use App\DetalleProducion;
use App\DetalleProducionAvance;
use App\Empleado;
use App\Http\Requests\PedidoRequest;
use App\Pedido;
use App\Produccion;
use App\Proveedor;
use App\TipoModelo;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

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
        $pedido_terminados  = Pedido::getAll(3);

        //return view('pedido.index', compact('pedidos'));
        return view('produccion.index', compact('pedidos', 'pedido_procesados', 'pedido_terminados'));
    }

    public function edit($IdEmpleadoSupervisor, $IdProducion)
    {
        Produccion::edit($IdEmpleadoSupervisor, $IdProducion);
    }

    public function finish($IdProducion)
    {
        Produccion::finishSecado($IdProducion);
        flash('Producto terminado');
        return response()->json('200');
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
    public function show($pedido_id) // vista de /admin/produccion/{pedido_id}/detalle
    {
        $produccion = Produccion::setProduccion($pedido_id);  //si no existe produccion guarda en la tabla produccion

        $pedido            = Pedido::getById($pedido_id); 
        $clientes           = Cliente::getAll();
        $empleados          = Empleado::getAll();
        $cliente            = Cliente::getById($pedido->IdCliente);
        $domicilio          = ($cliente!= "") ? 'Calle:' . $cliente->Calle . ' No° Ext:' . $cliente->NumeroExterior . ' No° Int' . $cliente->NumeroInterior . ' Colonia:' . $cliente->Colonia : '';
        $detalle_produccion = DetalleProducion::getByProduccion($produccion->Id);

        return view('produccion.detalle', compact('pedido', 'clientes', 'empleados', 'domicilio', 'detalle_produccion', 'produccion'));
    }

    public function detalle_produccion(Request $request, $IdProducion, $IdProducto)
    {
        $detalle_produccion        = DetalleProducion::getByIds($IdProducion, $IdProducto);
        $produccion                = Produccion::getById($IdProducion);
        $detalle_produccion_avance = DetalleProducionAvance::getById($IdProducion,$IdProducto);
        $total_detalle             = DetalleProducionAvance::getTotalDetalle($detalle_produccion_avance, $detalle_produccion);
        $empleados                 = Empleado::all();

        if($_POST){
            $datelle = DetalleProducionAvance::createUpdate($request, $IdProducion, $IdProducto, $detalle_produccion);
            return redirect('/admin/produccion/' .$IdProducion. '/'. $IdProducto. '/detalle-produccion');                          
            //dd($datelle);
        }
        return view('produccion.detalle_produccion', compact('detalle_produccion', 'produccion', 'detalle_produccion_avance', 'total_detalle', 'empleados'));
    }

    public function avace_secado(Request $request, $IdProducion, $IdProducto)
    {
        $detalle_produccion        = DetalleProducion::getByIds($IdProducion, $IdProducto);
        $produccion                = Produccion::getById($IdProducion);
        $detalle_produccion_avance = DetalleProducionAvance::getById($IdProducion,$IdProducto);
        $total_detalle             = DetalleProducionAvance::getTotalDetalle($detalle_produccion_avance, $detalle_produccion);
        $empleados                 = Empleado::all();

        if($_POST){
            $detalle = DetalleProducionAvance::CreateUpdateAvance($request, $IdProducion, $IdProducto, $detalle_produccion);
            return redirect('/admin/produccion/' .$IdProducion. '/'. $IdProducto. '/avance-secado');
            //dd($detalle);         
        }
        
        return view('produccion.detalle_secado', compact('detalle_produccion', 'produccion', 'detalle_produccion_avance', 'total_detalle', 'empleados'));
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
