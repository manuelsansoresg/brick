<?php

namespace App\Http\Controllers;

use App\Puesto;
use App\Departamento;
use App\Empleado;
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
        $empleados = Empleado::getAll();
        
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
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $puestos     = Puesto::getAll();
        $departamentos    = Departamento::getAll();
        
        $empleado = Empleado::getById($id);
        return view('empleado.edit', compact('empleado', 'puestos', 'departamentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(EmpleadoRequest $request, $id)
    {
        Empleado::createUpdate($request, $id);
        flash('Elemento guardado');
        return redirect('/admin/empleado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Empleado::drop($id);
        flash('Elemento borrado');
        return redirect('/admin/empleado');
    }
}
