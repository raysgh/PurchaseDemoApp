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
        $filter = $request->filter;
        return view('orders.index', compact('orders', 'filter'));
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
            'pos.*.quantity' => 'required|integer|max:1000',
            'pos.*.description' => 'required',
            'pos.*.price' => 'required|numeric|max:10000000',
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

        return $order->id;
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
          'pos.*.quantity' => 'required|integer|max:1000',
          'pos.*.description' => 'required',
          'pos.*.price' => 'required|numeric|max:10000000',
          'posCurrent.*.quantity' => 'required|integer|max:1000',
          'posCurrent.*.description' => 'required',
          'posCurrent.*.price' => 'required|numeric|max:10000000',
        ]);

        $order->update([
            'supplier_id' => request('supplier'),
            'description' => request('description')
        ]);

        foreach ($request->posCurrent as $value) {
            OrderLine::find($value['id'])->update([
                'quantity' => $value['quantity'],
                'description' => $value['description'],
                'price' => $value['price']
              ]);
            }

        foreach ($request->pos as $value) {
            OrderLine::create([
                'order_id' => $order->id,
                'quantity' => $value['quantity'],
                'description' => $value['description'],
                'price' => $value['price'],
            ]);
        }

        return $order->id;
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
        if ($filter == 'ordered'){
            return Order::where('is_ordered', true)->paginate(10);
        } elseif ($filter == 'notOrdered') {
            return Order::where('is_ordered', false)->paginate(10);
        } else {
            return Order::paginate(10);
        }
    }
}
