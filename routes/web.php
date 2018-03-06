<?php

use App\Order;

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
Route::get('/', function() {
    return redirect('/home');
});
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/dashboard', 'DashboardController@index');
Route::resource('orders', 'OrdersController');
Route::resource('order-lines', 'OrderlinesController');
Route::resource('suppliers', 'SuppliersController');
Route::get('send-order/{order}', 'SendOrderController@send');
Route::get('cancel-order/{order}', 'SendOrderController@cancel');
