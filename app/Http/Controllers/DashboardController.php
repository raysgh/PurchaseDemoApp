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
        return view('dashboard.index');
    }

    public function level()
    {
        $level = [];
        $level['orders'] = Order::get()->count();
        $level['orderLines'] = OrderLine::get()->count();
        $level['suppliers'] = Supplier::get()->count();
        $spend = OrderLine::get()
            ->sum(function($product) {
                return $product['quantity'] * $product['price'] / 1000;
        });
        $level['spend'] = number_format($spend, '0', ',', '.');

        return $level;
    }
}
