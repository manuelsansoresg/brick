<?php

namespace App\Http\Controllers;

use App\Departamento;
use App\Http\Requests\DepartamentoRequest;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = Departamento::getAll();
        return view('departamento.index', compact('departamento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departamento.create');
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartamentoRequest $request)
    {
        Departamento::createUpdate($request);
        flash('Elemento guardado');
        return redirect('/admin/departamento');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Departamento $departamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Departamento $departamento)
    {
        return view('departamento.edit', compact('departamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(DepartamentoRequest $request, Departamento $departamento)
    {
        Departamento::createUpdate($request, $departamento->id);
        flash('Elemento guardado');
        return redirect('/admin/departamento');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departamento $departamento)
    {
        $departamento->delete();
        flash('Elemento borrado');
        return redirect('/admin/departamento');
    }
}
