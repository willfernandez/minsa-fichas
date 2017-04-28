<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('inicio', 'PacientesController@index')->name('pacientes.listado');
Route::get('pacientes', 'PacientesController@listar');
Route::post('pacientes', 'PacientesController@store');
Route::get('pacientes/find', 'PacientesController@findPaciente');
Route::get('pacientes/show/{id}', 'PacientesController@show');

Route::delete('pacientes/{id}', 'PacientesController@destroy');
Route::put('pacientes/{id}', 'PacientesController@update');

Route::get('categorias/findProblema/{id}', 'ProblemasController@findProblema');
Route::get('categorias', 'CategoriaAdversosController@index');

Route::get('tipoIncidentes', 'TipoIncidentesController@index');
Route::get('tipoEventos', 'TipoEventosController@index');

//FICHAS
Route::get('fichas/{idPaciente}', 'FichasController@create');
Route::post('fichas', 'FichasController@store');
Route::get('user/fichas/{paciente_id}', 'FichasController@verFichasPaciente');



Route::get('reportes', 'ReportesController@IncidenteReporte');

Route::get('reportes/mensualCategoria', 'ReportesController@mensualCategoria')->name('reportes.mensual_categoria');;
Route::post('reportes/mensualCategoriaProcesado', 'ReportesController@procesarCategoriaMensual');

Route::get('reportes/mensualServicio', 'ReportesController@mensualServicio')->name('reportes.mensual_servicio');;
Route::post('reportes/mensualServicioProcesado', 'ReportesController@procesarMensualServicio');

Route::get('reportes/mensualPersonal', 'ReportesController@mensualPersonal')->name('reportes.mensual_personal');
Route::post('reportes/mensualPersonalProcesado', 'ReportesController@procesarMensualPersonal');

Auth::routes();

Route::get('/home', 'HomeController@index');
