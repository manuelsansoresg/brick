<?php

namespace App\Http\Controllers;

use App\Familia;
use App\Http\Requests\FamiliaRequest;
use Illuminate\Http\Request;

class FamiliaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $familias = Familia::getAll();
        return view('familia.index', compact('familias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('familia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FamiliaRequest $request)
    {
        Familia::createUpdate($request);
        flash('Elemento guardado');
        return redirect('/admin/familia');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Familia  $familia
     * @return \Illuminate\Http\Response
     */
    public function show(Familia $familia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Familia  $family
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $familia = Familia::getById($id);
        return view('familia.edit', compact('familia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Familia  $familia
     * @return \Illuminate\Http\Response
     */
    public function update(FamiliaRequest $request, $id)
    {
        Familia::createUpdate($request, $id);
        flash('Elemento guardado');
        return redirect('/admin/unidad');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Familia  $familia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Familia::drop($id);
        flash('Elemento borrado');
        return redirect('/admin/familia');
    }
}
