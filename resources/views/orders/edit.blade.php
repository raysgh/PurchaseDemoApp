@extends('layouts.purchaseApp')
@section('title', 'Edit Order #' . $order->id)
@section('content')
  <div class="card">
    <header class="card-header">
      <p class="card-header-title">
        <span class="icon has-text-primary">
          <i class="fas fa-edit"></i>
        </span>
        Edit Order #{{ $order->id }}
      </p>
    </header>
    <div class="card-content">
      <div class="content">
        <pu-edit-order
          suppliers="{{ $suppliers }}"
          order="{{ $order }}"
          order-lines="{{ $order->orderLines }}"
          previous="{{ url()->previous() }}">
        </pu-edit-order>
      </div>
    </div>
  </div>
@endsection
