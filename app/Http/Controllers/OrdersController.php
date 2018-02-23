<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderLine;
use App\Supplier;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
            'pos.*.quantity' => 'required',
            'pos.*.description' => 'required',
            'pos.*.price' => 'required',
        ]);

        $order = Order::create([
            'user_id' => auth()->id(),
            'supplier_id' => request('supplier'),
            'description' => request('description'),
            'is_ordered' => false
        ]);

        foreach ($request['pos'] as $pos) {
            OrderLine::create([
                'order_id' => $order->id,
                'description' => $pos['description'],
                'quantity' => $pos['quantity'],
                'price' => $pos['price'],
            ]);
        }

        return redirect('orders/' . $order->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order['totalPrice'] = $order['orderLines']->sum(function ($product) {
            return $product['quantity'] * $product['price'];
        });

        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $suppliers = Supplier::get();
        return view('orders.edit', compact('order', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $this->validate($request, [
          'supplier' => 'required',
          'description' => 'required',
          'pos.*.quantity' => 'required',
          'pos.*.description' => 'required',
          'pos.*.price' => 'required',
        ]);

        $order->update([
            'supplier_id' => request('supplier'),
            'description' => request('description')
        ]);

        foreach ($request->pos as $id => $value) {
            OrderLine::find($id)->update([
                'quantity' => $value['quantity'],
                'description' => $value['description'],
                'price' => $value['price']
            ]);
        }

        return redirect('/orders/' . $order->id);
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
                $order['totalPrice'] = $order['orderLines']->sum(function ($product) {
                    return $product['quantity'] * $product['price'];
                });
                return $order;
            });
    }

}
