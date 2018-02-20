@extends('layouts.app')
@section('content')

<div class="container">

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
          <td>{{ $order->description}}</td>
          <td>{{ $order->supplier->name }}</td>
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



</div>

@endsection
