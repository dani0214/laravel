<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pedidos;

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

Route::post('/cart-add', 'App\Http\Controllers\CartController@add')->name('cart.add');
Route::get('/cart-checkout', 'App\Http\Controllers\CartController@cart')->name('cart.checkout');
Route::post('/cart-update', 'App\Http\Controllers\CartController@updateQuantity')->name('cart.update');
Route::post('/cart-clear', 'App\Http\Controllers\CartController@clear')->name('cart.clear');
Route::post('/cart-removeitem', 'App\Http\Controllers\CartController@removeitem')->name('cart.removeitem');

Auth::routes();
Route::get('/datos_usuario', 'App\Http\Controllers\UserController@show')->name('user');
Route::get('/datos_usuario/modificar', 'App\Http\Controllers\UserController@edit')->name('user.edit');
Route::patch('datos_usuario/update',  ['as' => 'users.update', 'uses' => 'App\Http\Controllers\UserController@update']);
Route::get('datos_usuario/eliminar', ['as' => 'users.confirmdelete', 'uses' => 'App\Http\Controllers\UserController@confirmDelete']);
Route::get('datos_usuario/confirmar-eliminar/', ['as' => 'users.delete', 'uses' => 'App\Http\Controllers\UserController@delete']);
Route::get('admin/crear_destacados/{id}',  ['as' => 'users.crear_destacados', 'uses' => 'App\Http\Controllers\mostrar_productos@crearDestacado']);
Route::patch('admin/destacar',  ['as' => 'users.destacar', 'uses' => 'App\Http\Controllers\mostrar_productos@destacar']);
Route::get('admin/modificar_informacion/{id}',  ['as' => 'users.modificar_informacion', 'uses' => 'App\Http\Controllers\mostrar_productos@modificarInformacion']);
Route::patch('admin/modificar',  ['as' => 'users.modificar', 'uses' => 'App\Http\Controllers\mostrar_productos@modificar']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('auth/google', 'App\Http\Controllers\Auth\LoginController@redirectToGoogle');
Route::get('callback/google', 'App\Http\Controllers\Auth\LoginController@handleCallback');

Route::get('handle-payment', 'App\Http\Controllers\Pagos@handlePayment')->name('make.payment');
Route::get('cancel-payment', 'App\Http\Controllers\Pagos@paymentCancel')->name('cancel.payment');
Route::get('payment-success', 'App\Http\Controllers\Pagos@paymentSuccess')->name('success.payment');

Route::get('pedido', 'App\Http\Controllers\Pedidos@fillAddress')->name('pedido');
Route::post('direccion', 'App\Http\Controllers\Pedidos@validateAddress')->name('direccion');
Route::get('pago', 'App\Http\Controllers\Pedidos@payment')->name('pago');

Route::get('pedidos/{user}', ['as' => 'pedidos', 'uses' => 'App\Http\Controllers\Pedidos@mostrarPedidos']);
Route::get('mi_pedido/{id}', ['as' => 'mi_pedido', 'uses' => 'App\Http\Controllers\Pedidos@datosPedido']);
Route::get('confirmar/{id}', 'App\Http\Controllers\Pedidos@cancelarPedido')->name('confirmar');
Route::get('cancelar/{id}', 'App\Http\Controllers\Pedidos@cancelar')->name('cancelar');
Route::get('factura/{id}', 'App\Http\Controllers\Pedidos@PDF')->name('factura');