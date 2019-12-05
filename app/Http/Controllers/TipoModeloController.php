<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModeloRequest;
use App\TipoModelo;
use Illuminate\Http\Request;

class TipoModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelos = TipoModelo::getAll();
        return view('modelo.index', compact('modelos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modelo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModeloRequest $request)
    {
        TipoModelo::createUpdate($request);
        flash('Elemento guardado');
        return redirect('/admin/modelo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoModelo  $tipoModelo
     * @return \Illuminate\Http\Response
     */
    public function show(TipoModelo $tipoModelo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoModelo  $tipoModelo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modelo = TipoModelo::getById($id);
        return view('modelo.edit', compact('modelo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoModelo  $tipoModelo
     * @return \Illuminate\Http\Response
     */
    public function update(ModeloRequest $request, $id)
    {
        TipoModelo::createUpdate($request, $id);
        flash('Elemento guardado');
        return redirect('/admin/modelo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoModelo  $tipoModelo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TipoModelo::drop($id);
        flash('Elemento borrado');
        return redirect('/admin/modelo');
    }
}
