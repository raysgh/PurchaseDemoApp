@extends('layouts.purchaseApp')
@section('title', 'Order #' . $order->id)
@section('content')

  <div class="columns">
    <div class="column is-two-thirds">
      <div class="card">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon has-text-primary">
              <i class="fas fa-clipboard"></i>
            </span>
            Order #{{ $order->id }}
          </p>
          <a href="#" class="card-header-icon" aria-label="more options">
            <span class="icon">
              <i class="fas fa-angle-down" aria-hidden="true"></i>
            </span>
          </a>
        </header>
        <div class="card-content">
          <div class="content">
            {{ $order->description }}
          </div>
        </div>
        <footer class="card-footer">
          <p class="card-footer-item">
            <span class="icon has-text-info">
              <i class="{{ $order->is_ordered ? 'fas fa-shopping-cart' : 'fab fa-opencart' }}"></i>
            </span>
            &nbsp;{{ $order->is_ordered ? 'Ordered' : 'Not Ordered' }}
          </p>
          <p class="card-footer-item">
            Created by&nbsp;<strong>{{ $order->user->name }}</strong>
          </p>
        </footer>
      </div>
    </div>
    <div class="column">
      <div class="card">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon has-text-primary">
              <i class="fas fa-industry"></i>
            </span>
            {{ $order->supplier->name }}
          </p>
          <a href="#" class="card-header-icon" aria-label="more options">
            <span class="icon">
              <i class="fas fa-angle-down" aria-hidden="true"></i>
            </span>
          </a>
        </header>
        <div class="card-content">
          <div class="content">
            {{ $order->supplier->name }}
            <br>
            {{ $order->supplier->address }}
            <br>
            {{ $order->supplier->postcode . ' ' . $order->supplier->city }}
            <br>
            {{ $order->supplier->country }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <header class="card-header">
      <p class="card-header-title">
        <span class="icon has-text-primary">
          <i class="fas fa-list-alt"></i>
        </span>
        Order Lines
      </p>
      <a href="#" class="card-header-icon" aria-label="more options">
        <span class="icon">
          <i class="fas fa-angle-down" aria-hidden="true"></i>
        </span>
      </a>
    </header>
    <div class="card-content">
      <div class="content">
        <table class="table is-hoverable is-fullwidth">
          <thead>
            <tr>
              <th>Quantity</th>
              <th>Description</th>
              <th>Unit Price</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            @foreach($order->orderLines as $orderLine)
              <tr>
                <td>{{ $orderLine->quantity }}</td>
                <td>{{ str_limit($orderLine->description, 50) }}</td>
                <td>&euro; {{ number_format($orderLine->price / 100, 2, ',', '.') }}</td>
                <td>&euro; {{ number_format($orderLine->quantity * $orderLine->price / 100, 2, ',', '.') }}</td>
              </tr>
            @endforeach
            <tr>
              <td></td>
              <td></td>
              <td><strong>Total:</strong></td>
              <td><strong>&euro; {{ number_format($order->totalPrice / 100, 2, ',', '.') }}</strong></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <a class="button is-link" {{ $order->is_ordered ? 'disabled' : 'href=/orders/' . $order->id . '/edit' }}>
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
