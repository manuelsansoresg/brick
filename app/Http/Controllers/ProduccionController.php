<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\DetallePedido;
use App\Http\Requests\PedidoRequest;
use App\Pedido;
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
        //$pedidos  = Produccion::getAll();

        //return view('pedido.index', compact('pedidos'));
        return view('produccion.index');
    }

    
    public function create()
    {
       
    }

    
    public function store(PedidoRequest $request)
    {
      
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
