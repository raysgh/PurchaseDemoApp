@extends('layouts.purchaseApp')
@section('title', 'Order #' . $order->id)
@section('content')

  <table class="table">
    <thead>
      <tr>
        <th>Order</th>
        <th>Description</th>
        <th>Supplier</th>
        <th>Created By</th>
        <th>Ordered</th>
      </tr>
    </thead>
    <tbody>
        <tr>
          <td>{{ $order->id }}</td>
          <td>{{ str_limit($order->description, 50) }}</td>
          <td>{{ str_limit($order->supplier->name, 30) }}</td>
          <td>{{ str_limit($order->user->name, 30) }}</td>
          <td>
            <span class="icon has-text-info">
              <i class="{{ $order->is_ordered ? 'fas fa-shopping-cart' : 'fab fa-opencart' }}"></i>
            </span>
          </td>
        </tr>
    </tbody>
  </table>

  <table class="table">
    <thead>
      <tr>
        <th>Supplier</th>
        <th>Address</th>
        <th>Postcode</th>
        <th>City</th>
        <th>Country</th>
      </tr>
    </thead>
    <tbody>
        <tr>
          <td>{{ $order->supplier->name }}</td>
          <td>{{ $order->supplier->address }}</td>
          <td>{{ $order->supplier->postcode }}</td>
          <td>{{ $order->supplier->city }}</td>
          <td>{{ $order->supplier->country }}</td>
        </tr>
    </tbody>
  </table>

  <table class="table">
    <thead>
      <tr>
        <th>Quantity</th>
        <th>Description</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
      @foreach($order->orderLines as $orderLine)
        <tr>
          <td>{{ $orderLine->quantity }}</td>
          <td>{{ str_limit($orderLine->description, 50) }}</td>
          <td>&euro; {{ number_format($orderLine->price / 100, 2, ',', '.') }}</td>
        </tr>
      @endforeach
      <tr>
        <td></td>
        <td><strong>Total:</strong></td>
        <td><strong>&euro; {{ number_format($order->totalPrice / 100, 2, ',', '.') }}</strong></td>
      </tr>
    </tbody>
  </table>

  <a class="button is-link">
    <span class="icon">
      <i class="fas fa-edit"></i>
    </span>
    <span>Edit</span>
  </a>

  <a class="button is-primary">
    <span class="icon">
      <i class="fas fa-envelope"></i>
    </span>
    <span>Send</span>
  </a>


@endsection
