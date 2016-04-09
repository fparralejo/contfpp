<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('login');
});


Route::post('login', 'adminController@login');
Route::get('logout', 'adminController@logout');
Route::get('main', 'adminController@main');

//configuracion
Route::get('datos', 'configController@main');
Route::post('datos', 'configController@editDatos');
Route::get('datos/logo', 'configController@buscar_fileLogo');



//clientes
Route::get('clientes', 'clientesController@main');
Route::post('clientes', 'clientesController@createEdit');
Route::get('cliente/show', 'clientesController@clienteShow');
Route::get('cliente/delete', 'clientesController@clienteDelete');

//proveedores
Route::get('proveedores', 'clientesController@mainProveedores');

//productos
Route::get('productos', 'productosController@main');
Route::post('productos', 'productosController@createEdit');
Route::get('producto/show', 'productosController@productoShow');
Route::get('producto/delete', 'productosController@productoDelete');



//presupuestos
Route::get('presupuestos/alta', 'presupuestosController@alta');
Route::get('presupuestos/editar/{idPresupuesto}', 'presupuestosController@editar');
Route::get('presupuestos/mdb', 'presupuestosController@listar');




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//Route::group(['middleware' => ['web']], function () {
//    //
//});
