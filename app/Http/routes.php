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

//articulos
Route::get('articulos', 'articulosController@main');
Route::post('articulos', 'articulosController@createEdit');
Route::get('articulo/show', 'articulosController@articuloShow');
Route::get('articulo/delete', 'articulosController@articuloDelete');


//bbdd
Route::get('bbdd/exportar', function () {
    return view('construccion');
});
Route::get('bbdd/importar', function () {
    return view('construccion');
});
Route::get('bbdd/corregir', function () {
    return view('construccion');
});



//presupuestos
Route::get('presupuestos/alta', 'presupuestosController@alta');
Route::get('presupuestos/editar/{idPresupuesto}', 'presupuestosController@editar');
Route::get('presupuestos/mdb', 'presupuestosController@listar');
Route::post('presupuestos/createEdit', 'presupuestosController@createEdit');
Route::get('presupuestos/verPDF/{idPresupuesto}/{accion}', 'presupuestosController@verPDF');
Route::get('presupuestos/duplicar/{idPresupuesto}', 'presupuestosController@duplicar');
Route::get('presupuestos/borrar/{idPresupuesto}', 'presupuestosController@borrar');
Route::get('presupuestos/buscar_articulos', 'presupuestosController@buscar_articulos');
Route::get('presupuestos/datos_articulo', 'presupuestosController@datos_articulo');
Route::get('presupuestos/actualizarEstado', 'presupuestosController@actualizarEstado');
Route::get('ped_prep', 'presupuestosController@listarParaPedido');
Route::get('presupuestos/prepararPedido/{idPresupuesto}', 'presupuestosController@prepararPedido');
Route::post('presupuestos/prepararPedido', 'presupuestosController@generarPedido');


//pedidos
Route::get('pedidos/alta', 'pedidosController@alta');
Route::get('pedidos/mdb', 'pedidosController@listar');
Route::get('pedidos/editar/{idPedido}', 'pedidosController@editar');
Route::post('pedidos/createEdit', 'pedidosController@createEdit');
Route::get('pedidos/verPDF/{idPedido}/{accion}', 'pedidosController@verPDF');
Route::get('pedidos/duplicar/{idPedido}', 'pedidosController@duplicar');
Route::get('pedidos/borrar/{idPedido}', 'pedidosController@borrar');
Route::get('pedidos/buscar_articulos', 'presupuestosController@buscar_articulos');//busco en presupuestosController
Route::get('pedidos/datos_articulo', 'presupuestosController@datos_articulo');//busco en presupuestosController
Route::get('pedidos/actualizarEstado', 'pedidosController@actualizarEstado');



//pedidos
//Route::get('pedidos/alta', function () {
//    return view('construccion');
//});
//Route::get('pedidos/mdb', function () {
//    return view('construccion');
//});
Route::get('fact_ped', function () {
    return view('construccion');
});





Route::get('fact_prep', function () {
    return view('construccion');
});
//Route::get('ped_prep', function () {
//    return view('construccion');
//});







//facturas
Route::get('facturas/alta', function () {
    return view('construccion');
});
Route::get('facturas/mdb', function () {
    return view('construccion');
});
Route::get('facturas/cobrar_facturas', function () {
    return view('construccion');
});





//albaranes
Route::get('albaranes/alta', function () {
    return view('construccion');
});
Route::get('albaranes/mdb', function () {
    return view('construccion');
});
Route::get('fact_alb', function () {
    return view('construccion');
});




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
