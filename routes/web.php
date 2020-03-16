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
    Route::get('/produccion/{pedido_id}/form_autorizar', 'ProduccionController@form_autorizar');
    Route::get('/produccion/{pedido_id}/autorizar/{status}', 'ProduccionController@autorizar');
    Route::get('/produccion/{pedido_id}/{IdProducion}/getDetalle', 'ProduccionController@getDetalle');
    Route::get('/produccion/{pedido_id}/detalle', 'ProduccionController@show');
    Route::post('/produccion/{IdProducion}/{IdProducto}/saveProduction', 'ProduccionController@saveProduction');

    Route::get('/produccion/{detallepedido_id}/{IdProducion}/produccion_actual', 'ProduccionController@produccion_actual');
    Route::post('/produccion/{IdProducion}/{IdProducto}/saveSecado', 'ProduccionController@saveSecado');
    Route::get('/produccion/{detallepedido_id}/reset_secado', 'ProduccionController@reset_secado');
    Route::get('/produccion/{detallepedido_id}/{IdProducion}/get_secado', 'ProduccionController@get_secado');
    Route::get('/produccion/{IdEmpleadoSupervisor}/{IdProducion}/edit', 'ProduccionController@edit');

    Route::get('/produccion/{IdProducion}/{IdProducto}/detalle-produccion', 'ProduccionController@detalle_produccion');
    Route::post('/produccion/{IdProducion}/{IdProducto}/detalle-produccion', 'ProduccionController@detalle_produccion');

    Route::get('/produccion/{IdProducion}/{IdProducto}/avance-secado', 'ProduccionController@avace_secado');
    Route::post('/produccion/{IdProducion}/{IdProducto}/avance-secado', 'ProduccionController@avace_secado');




    Route::get('/produccion/{pedido_id}/setProduccion', 'ProduccionController@setProduccion');
    Route::get('/produccion/{IdProducion}/getTableDetail', 'ProduccionController@getTableDetail');
    Route::get('/produccion/{IdProducion}/getProduccionDetalle', 'ProduccionController@getProduccionDetalle');
    Route::get('/produccion/{IdProducion}/finish', 'ProduccionController@finish');

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

    Route::resource('/entrada', 'EntradaController');
    Route::resource('/salida', 'SalidaController');

    Route::get('/entrada/save/{IdProduccion}', 'EntradaSalidaController@entrada');
    Route::get('/salida/save/{IdProduccion}', 'EntradaSalidaController@salida');

});
