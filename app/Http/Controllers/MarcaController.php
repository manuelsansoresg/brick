<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarcaRequest;
use App\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = Marca::getAll();
        return view('marca.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marca.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarcaRequest $request)
    {
        Marca::createUpdate($request);
        flash('Elemento guardado');
        return redirect('/admin/marca');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(Marca $marca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        return view('marca.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(MarcaRequest $request, Marca $marca)
    {
        Marca::createUpdate($request, $marca->id);
        flash('Elemento guardado');
        return redirect('/admin/marca');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca $marca)
    {
        $marca->delete();
        flash('Elemento borrado');
        return redirect('/admin/marca');
    }
}
