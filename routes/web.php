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
    Route::resource('/produccion', 'ProduccionController');
    Route::get('/pedido/destroy/{IdPedido}/{Estatus}', 'PedidoController@destroy');
    Route::get('/pedido/pdf/create/{IdPedido}', 'PedidoController@createPdf');
    Route::resource('/unidad', 'UnidadController');
    Route::resource('/marca', 'MarcaController');
    Route::resource('/color', 'ColorController');
    Route::resource('/familia', 'FamiliaController');
    Route::resource('/modelo', 'TipoModeloController');
    Route::resource('/almacen', 'AlmacenController');
    Route::resource('/articulo', 'ArticuloController');
    Route::get('/tabla-articulo/list', 'ArticuloController@getAll');
    Route::get('/cliente/direccion/{client_id}', 'ClienteController@getAddress');
    Route::resource('/cliente', 'ClienteController');
    Route::resource('/proveedor', 'ProveedorController');
    Route::resource('/puesto', 'PuestoController');
    Route::resource('/departamento', 'DepartamentoController');
    Route::resource('/empleado', 'EmpleadoController');
});
