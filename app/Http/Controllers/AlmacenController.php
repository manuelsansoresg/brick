<?php

namespace App\Http\Controllers;

use App\Almacen;
use App\Http\Requests\AlmacenRequest;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $almacenes = Almacen::getAll();
        return view('almacen.index', compact('almacenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('almacen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlmacenRequest $request)
    {
        Almacen::createUpdate($request);
        flash('Elemento guardado');
        return redirect('/admin/almacen');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function show(Almacen $almacen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $almacen = Almacen::getById($id);
        return view('almacen.edit', compact('almacen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function update(AlmacenRequest $request, $id)
    {
        Almacen::createUpdate($request, $id);
        flash('Elemento guardado');
        return redirect('/admin/almacen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Almacen::drop($id);
        flash('Elemento borrado');
        return redirect('/admin/almacen');
    }
}
