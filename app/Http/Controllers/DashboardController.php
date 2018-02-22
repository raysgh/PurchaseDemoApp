<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderLine;
use App\Supplier;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::get()->count();
        $orderLines = OrderLine::get()->count();
        $suppliers = Supplier::get()->count();
        $spend = OrderLine::get()
            ->sum(function($product) {
                return $product['quantity'] * $product['price'] / 100000;
        });

        return view('dashboard.index', compact('orders', 'orderLines', 'suppliers', 'spend'));
    }
}
