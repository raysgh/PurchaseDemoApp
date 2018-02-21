<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Supplier;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = $this->getOrderList($request['filter']);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::get();

        return view('orders.create', [
          'suppliers' => $suppliers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'supplier' => 'required',
            'description' => 'required',
            'quantity0' => 'required',
            'description0' => 'required',
            'price0' => 'required',
            'quantity1' => 'required',
            'description1' => 'required',
            'price1' => 'required',
            'quantity2' => 'required',
            'description2' => 'required',
            'price2' => 'required'
        ]);
        
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getOrderList($filter)
    {
        $order = Order::with('orderlines');

        if ($filter == 'ordered'){
            $order->where('is_ordered', true);
        } elseif ($filter == 'notOrdered') {
            $order->where('is_ordered', false);
        }

        return $order->get()
            ->map(function ($order) {
                $order['totalPrice'] = $order['orderLines']->sum('price');
                return $order;
            });
    }
}
