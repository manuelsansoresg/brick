<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\DetallePedido;
use App\Http\Requests\PedidoRequest;
use App\Pedido;
use App\Proveedor;
use App\TipoModelo;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos  = Pedido::getAll();

        return view('pedido.index', compact('pedidos'));
    }

    public function createPdf($IdPedido)
    {
        $data_pedido = Pedido::pdfPedido($IdPedido);
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('reportes.pedido', $data_pedido);


        return $pdf->stream('mi-archivo.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores = Proveedor::getAll();
        $modelos     = TipoModelo::getAll();
        $folio       = Pedido::getFolio();
        $clientes    = Cliente::getAll();

        return view('pedido.create', compact('proveedores', 'modelos', 'folio', 'clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PedidoRequest $request)
    {
        Pedido::createUpdate($request);
        flash('Elemento guardado');
        return redirect('/admin/pedido');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pedido             = Pedido::getById($id);
        $modelos            = TipoModelo::getAll();
        $folio              = Pedido::getFolio();
        $clientes           = Cliente::getAll();
        $cliente            = Cliente::getById($pedido->IdCliente);
        $domicilio          = ($cliente!= "") ? 'Calle:' . $cliente->Calle . ' No° Ext:' . $cliente->NumeroExterior . ' No° Int' . $cliente->NumeroInterior . ' Colonia:' . $cliente->Colonia : '';
        $detalle_pedidos    = DetallePedido::getById($id);
        $total_detalle      = count($detalle_pedidos);
        $is_autorizar       = false;

        return  view('pedido.edit', compact('clientes', 'is_autorizar', 'modelos', 'folio', 'pedido', 'domicilio', 'detalle_pedidos', 'total_detalle'));
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

        Pedido::createUpdate($request, $pedido->IdPedido);
        flash('Elemento guardado');
        return redirect('/admin/pedido');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy($IdPedido, $Estatus)
    {
        Pedido::drop($IdPedido, $Estatus);
        flash('Elemento borrado');
        return redirect('/admin/pedido');
    }
}
