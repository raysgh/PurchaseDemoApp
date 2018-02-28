@extends('layouts.purchaseApp')
@section('title', 'Order #' . $order->id)
@section('content')

  <div class="columns">
    <div class="column is-two-thirds">
      <pu-order
      orderid="{{ $order->id }}"
      description="{{ $order->description }}"
      ordered="{{ $order->is_ordered }}"
      username="{{ $order->user->name }}">
      </pu-order>
    </div>
    <div class="column">
      <pu-supplier
        orderid="{{ $order->supplier->id }}"
        name="{{ $order->supplier->name }}"
        address="{{ $order->supplier->address }}"
        postcode="{{ $order->supplier->postcode }}"
        city="{{ $order->supplier->city }}"
        country="{{ $order->supplier->country }}">
      </pu-supplier>
    </div>
  </div>

  <pu-order-line
    orderlines="{{ $order->orderLines }}"
    total="{{ number_format($order->totalPrice, 2, ',', '.') }}">
  </pu-order-line>

  <a class="button is-link" {{ $order->is_ordered ? 'disabled' : 'href=/orders/' . $order->id . '/edit' }}>
    <span class="icon">
      <i class="fas fa-edit"></i>
    </span>
    <span>Edit</span>
  </a>

@if(!$order->is_ordered)
  <a class="button is-primary" href="/send-order/{{ $order->id }}">
    <span class="icon">
      <i class="fas fa-envelope"></i>
    </span>
    <span>Send</span>
  </a>
@endif

@if($order->is_ordered)
  <a class="button is-warning" href="/cancel-order/{{ $order->id }}">
    <span class="icon">
      <i class="fas fa-envelope"></i>
    </span>
    <span>Cancel Order</span>
  </a>
@endif

@endsection
