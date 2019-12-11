<?php

namespace App\Http\Controllers;

use App\Puesto;
use App\Departamento;
use App\Http\Requests\EmpleadoRequest;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articulos = Articulo::getAll();
        
        return view('empleado.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $puestos = Puesto::getAll();
        $departamentos = Departamento::getAll();        

        return view('empleado.create', compact('puestos', 'departamentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpleadoRequest $request)
    {
        Empleado::createUpdate($request);
        flash('Elemento guardado');
        return redirect('/admin/empleado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show(Articulo $articulo)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedores = Proveedor::getAll();
        $colores     = Color::getAll();
        $familias    = Familia::getAll();
        
        $articulo = Articulo::getById($id);
        return view('articulo.edit', compact('articulo', 'colores', 'proveedores', 'familias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(ArticuloRequest $request, $id)
    {
        Articulo::createUpdate($request, $id);
        flash('Elemento guardado');
        return redirect('/admin/articulo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Articulo::drop($id);
        flash('Elemento borrado');
        return redirect('/admin/articulo');
    }
}
