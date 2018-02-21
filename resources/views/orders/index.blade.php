@extends('layouts.purchaseApp')
@section('content')

  <table class="table">
    <thead>
      <tr>
        <th>Order</th>
        <th>Description</th>
        <th>Supplier</th>
        <th>Total</th>
        <th>Ordered</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
        <tr>
          <td>{{ $order->id }}</td>
          <td><a href="orders/{{ $order->id }}">{{ str_limit($order->description, 50) }}</a></td>
          <td>{{ str_limit($order->supplier->name, 30) }}</td>
          <td>&euro; {{ number_format($order->totalPrice / 100, 2, ',', '.') }}</td>
          <td>

            <span class="icon has-text-info">
              <i class="{{ $order->is_ordered ? 'fas fa-shopping-cart' : 'fab fa-opencart' }}"></i>
            </span>

          </td>
        </tr>
      @endforeach
    </tbody>
  </table>


@endsection
