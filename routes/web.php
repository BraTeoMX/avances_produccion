<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VPFController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	Route::get('vpf', ['as' => 'vpf.index', 'uses' => 'App\Http\Controllers\VpfController@index']);
	Route::get('vprh', ['as' => 'vprh.index', 'uses' => 'App\Http\Controllers\VprhController@index']);
	Route::get('vpm', ['as' => 'vpm.index', 'uses' => 'App\Http\Controllers\VpmController@index']);
	Route::get('vpv', ['as' => 'vpv.index', 'uses' => 'App\Http\Controllers\VpvController@index']);

	Route::get('fechas', ['as' => 'fechas', 'uses' => 'App\Http\Controllers\HomeController@fechas']);//verificar fechas
	Route::get('fechasVPF', ['as' => 'fechasVPF', 'uses' => 'App\Http\Controllers\VpfController@fechasVPF']);
	Route::get('fechasVPM', ['as' => 'fechasVPM', 'uses' => 'App\Http\Controllers\VpmController@fechasVPM']);
	Route::get('fechasVPRH', ['as' => 'fechasVPRH', 'uses' => 'App\Http\Controllers\VprhController@fechasVPRH']);
	Route::get('fechasVPV', ['as' => 'fechasVPV', 'uses' => 'App\Http\Controllers\VpvController@fechasVPV']);

	Route::get('detalleVPF', ['as' => 'detalleVPF', 'uses' => 'App\Http\Controllers\HomeController@detalleVPF']);
	Route::get('detalleVPM', ['as' => 'detalleVPM', 'uses' => 'App\Http\Controllers\HomeController@detalleVPM']);
	Route::get('detalleVPRH', ['as' => 'detalleVPRH', 'uses' => 'App\Http\Controllers\HomeController@detalleVPRH']);
	Route::get('detalleVPV', ['as' => 'detalleVPV', 'uses' => 'App\Http\Controllers\HomeController@detalleVPV']);

	Route::get('fechasVPF2', ['as' => 'fechasVPF2', 'uses' => 'App\Http\Controllers\VpfController@fechasVPF2']);
	Route::get('fechasVPM2', ['as' => 'fechasVPM2', 'uses' => 'App\Http\Controllers\VpmController@fechasVPM2']);
	Route::get('fechasVPRH2', ['as' => 'fechasVPRH2', 'uses' => 'App\Http\Controllers\VprhController@fechasVPRH2']);
	Route::get('fechasVPV2', ['as' => 'fechasVPV2', 'uses' => 'App\Http\Controllers\VpvController@fechasVPV2']);

	Route::get('excepciones', ['as' => 'excepciones', 'uses' => 'App\Http\Controllers\HomeController@excepciones']);
	Route::get('fechas_excep', ['as' => 'fechas_excep', 'uses' => 'App\Http\Controllers\HomeController@fechas_excep']);
	Route::get('excepcionesVPF', ['as' => 'excepcionesVPF', 'uses' => 'App\Http\Controllers\VpfController@excepcionesVPF']);
	Route::get('fechas_excepVPF', ['as' => 'fechas_excepVPF', 'uses' => 'App\Http\Controllers\VpfController@fechas_excepVPF']);
	Route::get('excepcionesVPM', ['as' => 'excepcionesVPM', 'uses' => 'App\Http\Controllers\VpmController@excepcionesVPM']);
	Route::get('fechas_excepVPM', ['as' => 'fechas_excepVPM', 'uses' => 'App\Http\Controllers\VpmController@fechas_excepVPM']);
	Route::get('excepcionesVPRH', ['as' => 'excepcionesVPRH', 'uses' => 'App\Http\Controllers\VprhController@excepcionesVPRH']);
	Route::get('fechas_excepVPRH', ['as' => 'fechas_excepVPRH', 'uses' => 'App\Http\Controllers\VprhController@fechas_excepVPRH']);
	Route::get('excepcionesVPV', ['as' => 'excepcionesVPV', 'uses' => 'App\Http\Controllers\VpvController@excepcionesVPV']);
	Route::get('fechas_excepVPV', ['as' => 'fechas_excepVPV', 'uses' => 'App\Http\Controllers\VpvController@fechas_excepVPV']);

	Route::get('hojadevida', ['as' => 'hojadevida.index', 'uses' => 'App\Http\Controllers\HojadevidaController@index']);
	Route::get('detalleHojadevida/{id}', ['as' => 'detalleHojadevida', 'uses' => 'App\Http\Controllers\HojadevidaController@detalleHojadevida']);
	Route::get('fechashojadevida', ['as' => 'fechashojadevida', 'uses' => 'App\Http\Controllers\HojadevidaController@fechashojadevida']);

	// apartado para actualizar tabla de VPF
	Route::post('actualizarTabla', 'App\Http\Controllers\VPFController@actualizarTabla')->name('vpf.actualizarTabla');
	Route::post('/transferir-datos', 'App\Http\Controllers\VPFController@transferirDatosDiarios')->name('transferir.datos');

	Route::get('/altasybajasTLyM', 'App\Http\Controllers\VPFController@altasybajasTLyM')->name('vpf.altasybajasTLyM');
	Route::get('/tablaTLyM', 'App\Http\Controllers\VPFController@tablaTLyM')->name('vpf.tablaTLyM');
	Route::get('/modificacionTablaTLyM', 'App\Http\Controllers\VPFController@showModificacionTablaTLyM')->name('vpf.modificacionTablaTLyM');
	// Ruta para mostrar los datos de las tablas TeamLeader y Modulos
	Route::post('/team-leader/store', 'App\Http\Controllers\VPFController@altasybajasTLyM')->name('team-leader.store');
	Route::post('/Modulo/store', 'App\Http\Controllers\VPFController@altasybajasTLyM')->name('Modulo.store');
	// Ruta para actualizar el estado de un Team Leader
	Route::patch('/team-leader/{id}/update-status', 'App\Http\Controllers\VPFController@ActualizarEstatus')->name('team-leader.ActualizarEstatus');
	// Ruta para actualizar el estado de un Módulo
	Route::patch('/Modulo/{id}/update-status', 'App\Http\Controllers\VPFController@ActualizarEstatusM')->name('Modulo.ActualizarEstatusM');
	Route::post('/asignar-modulos', 'App\Http\Controllers\VPFController@asignarModulos')->name('asignar.modulos');
	// Ruta para modificar datos de team leader y modulos en la tabla "team_modulo"
	Route::post('/team_modulo/modificar', 'App\Http\Controllers\VPFController@modificacionTablaTLyM')->name('team_modulo.modificar');


	//seccion para pruebas, asi se llamara la carpeta 
	Route::get('/sorteo', 'App\Http\Controllers\pruebaController@sorteo')->name('prueba.sorteo');
	Route::get('/resultadoSorteo', 'App\Http\Controllers\pruebaController@resultadoSorteo')->name('prueba.resultadoSorteo');
	Route::post('/registroSorteo', 'App\Http\Controllers\PruebaController@registroSorteo')->name('registroSorteo');

});

