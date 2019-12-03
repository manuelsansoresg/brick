<?php

namespace App\Http\Controllers;

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
        $pedidos = Pedido::getAll();
        return view('pedido.index', compact('pedidos'));
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

        return view('pedido.create', compact('proveedores', 'modelos'));
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
    public function edit(Pedido $pedido)
    {
        $proveedores = Proveedor::getAll();
        $modelos     = TipoModelo::getAll();
        return  view('pedido.edit', compact('pedido', 'proveedores', 'modelos'));
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
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        flash('Elemento borrado');
        return redirect('/admin/pedido');
    }
}
