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

Route::get('/', function () {

    $orders = Order::with('orderlines')
        ->get()
        ->map(function ($order) {
            $order['totalPrice'] = $order['orderLines']->sum('price');
            return $order;
        });

    return view('orders.index', compact('orders'));

});
