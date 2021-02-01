<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\inicio@index');
Route::get('/categoria={categoria}', 'App\Http\Controllers\mostrar_productos@categoria');
Route::get('/producto={id}', 'App\Http\Controllers\mostrar_productos@informacion');
Route::get('/menu', 'App\Http\Controllers\mostrar_categoria@index');

Route::get('/hola', function () {
    return view('hola');
});

Route::get('/adios', function () {
    return view('adios');
});