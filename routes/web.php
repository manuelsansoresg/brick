<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/login', 301);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function () {
    Route::resource('/pedido', 'PedidoController');
    Route::resource('/unidad', 'UnidadController');
    Route::resource('/marca', 'MarcaController');
    Route::resource('/color', 'ColorController');
    Route::resource('/familia', 'FamiliaController');
    Route::resource('/modelo', 'TipoModeloController');
    Route::resource('/almacen', 'AlmacenController');
    Route::resource('/articulo', 'ArticuloController');
    Route::resource('/cliente', 'ClienteController');
    Route::resource('/proveedor', 'ProveedorController');
    Route::resource('/puesto', 'PuestoController');
    Route::resource('/departamento', 'DepartamentoController');
    Route::resource('/empleado', 'EmpleadoController');
});
