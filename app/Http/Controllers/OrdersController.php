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

        $order = Order::create([
            'user_id' => auth()->id(),
            'supplier_id' => request('supplier'),
            'description' => request('description'),
            'is_ordered' => false
        ]);

        $pos0 = [
          'order_id' => $order->id,
          'description' => request('description0'),
          'quantity' => request('quantity0'),
          'price' => request('price0'),
        ];
        $pos1 = [
          'order_id' => $order->id,
          'description' => request('description1'),
          'quantity' => request('quantity1'),
          'price' => request('price1'),
        ];
        $pos2 = [
          'order_id' => $order->id,
          'description' => request('description2'),
          'quantity' => request('quantity2'),
          'price' => request('price2'),
        ];

        $this->createLine($pos0);
        $this->createLine($pos1);
        $this->createLine($pos2);

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
        return view('orders.show', compact('order'));
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

    public function createLine($line)
    {
        OrderLine::create([
            'order_id' => $line['order_id'],
            'description' => $line['description'],
            'quantity' => $line['quantity'],
            'price' => $line['price'],
        ]);
    }
}
