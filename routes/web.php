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


Route::get('/', function () {
    return redirect('login');
});


Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index');
    Route::get('/acerca', 'AcercaController@index');
    Route::get('estadistica', 'EstadisticaController@index');

    Route::get('reportes','PDFController@index');
    Route::get('reportes/reporte','PDFController@crearPDF');
    Route::get('reportes/show','PDFController@verPDF');

    Route::post('reportes/ventas','PDFController@reporteVentas');
    Route::get('reportes/ventas','PDFController@reporteVentas');


    Route::get('/listado_usuarios', 'UsuariosController@listado_usuarios');
    Route::post('crear_usuario', 'UsuariosController@crear_usuario')->middleware('roleshinobi:administrador');
    Route::post('editar_usuario', 'UsuariosController@editar_usuario')->middleware('roleshinobi:administrador');
    Route::post('buscar_usuario', 'UsuariosController@buscar_usuario')->middleware('roleshinobi:administrador');
    Route::post('borrar_usuario', 'UsuariosController@borrar_usuario')->middleware('roleshinobi:administrador');
    Route::post('editar_acceso', 'UsuariosController@editar_acceso')->middleware('roleshinobi:administrador');


    Route::post('crear_rol', 'UsuariosController@crear_rol')->middleware('roleshinobi:administrador');
    Route::post('crear_permiso', 'UsuariosController@crear_permiso')->middleware('roleshinobi:administrador');
    Route::post('asignar_permiso', 'UsuariosController@asignar_permiso')->middleware('roleshinobi:administrador');
    Route::get('quitar_permiso/{idrol}/{idper}', 'UsuariosController@quitar_permiso')->middleware('roleshinobi:administrador');


    Route::get('form_nuevo_usuario', 'UsuariosController@form_nuevo_usuario')->middleware('roleshinobi:administrador');
    Route::get('form_nuevo_rol', 'UsuariosController@form_nuevo_rol')->middleware('roleshinobi:administrador');
    Route::get('form_nuevo_permiso', 'UsuariosController@form_nuevo_permiso')->middleware('roleshinobi:administrador');
    Route::get('form_editar_usuario/{id}', 'UsuariosController@form_editar_usuario')->middleware('roleshinobi:administrador');
    Route::get('confirmacion_borrado_usuario/{idusuario}', 'UsuariosController@confirmacion_borrado_usuario')->middleware('roleshinobi:administrador');
    Route::get('asignar_rol/{idusu}/{idrol}', 'UsuariosController@asignar_rol')->middleware('roleshinobi:administrador');
    Route::get('quitar_rol/{idusu}/{idrol}', 'UsuariosController@quitar_rol')->middleware('roleshinobi:administrador');
    Route::get('form_borrado_usuario/{idusu}', 'UsuariosController@form_borrado_usuario')->middleware('roleshinobi:administrador');
    Route::get('borrar_rol/{idrol}', 'UsuariosController@borrar_rol')->middleware('roleshinobi:administrador');


    Route::get('profile','UsuariosController@profile');
    Route::post('profile','UsuariosController@update_avatar');
    Route::get('/{slug?}', 'HomeController@index');

    Route::resource('almacen/categoria','CategoriaController');
    Route::resource('almacen/articulo','ArticuloController');
    Route::resource('ventas/cliente','ClienteController');
    Route::resource('compras/proveedor','ProveedorController');
    Route::resource('compras/ingreso','IngresoController');
    Route::resource('ventas/venta','VentaController');





});


