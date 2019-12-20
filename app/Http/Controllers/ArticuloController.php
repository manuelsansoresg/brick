<?php

namespace App\Http\Controllers;

use App\Articulo;
use App\Proveedor;
use App\Color;
use App\Familia;
use App\Http\Requests\ArticuloRequest;
use App\Unidad;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    protected $path_image;
    
    public function __construct()
    {
       $this->path_image = './img/articulo';
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articulos = Articulo::getAll();
        
        return view('articulo.index', compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores = Proveedor::getAll();
        $colores     = Color::getAll();
        $familias    = Familia::getAll();
        $unidades    = Unidad::getAll();

        return view('articulo.create', compact('proveedores', 'colores', 'familias', 'unidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticuloRequest $request)
    {
        Articulo::createUpdate($request, $this->path_image);
        flash('Elemento guardado');
        return redirect('/admin/articulo');
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

    public function getAll()
    {
        $articulos = Articulo::getAllDatatable();
        return response()->json($articulos);
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
        $unidades    = Unidad::getAll();
        
        $articulo = Articulo::getById($id);
        return view('articulo.edit', compact('articulo', 'colores', 'proveedores', 'familias', 'unidades'));
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
        Articulo::createUpdate($request, $this->path_image, $id);
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
       
        
        Articulo::drop($id, $this->path_image);
        flash('Elemento borrado');
        return redirect('/admin/articulo');
    }
}
