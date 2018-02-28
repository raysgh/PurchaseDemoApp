@extends('layouts.purchaseApp')
@section('title', 'Supplier / ' . $supplier->name)
@section('content')

  <div class="columns">
    <div class="column is-two-thirds">
      <div class="card">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon has-text-primary">
              <i class="fas fa-industry"></i>
            </span>
            Supplier / {{ $supplier->name }}
          </p>
          <a href="#" class="card-header-icon" aria-label="more options">
            <span class="icon">
              <i class="fas fa-angle-down" aria-hidden="true"></i>
            </span>
          </a>
        </header>
        <div class="card-content">
          <div class="content">
            Name:
            <br>
            {{ $supplier->name }}
            <br><br>
            Address:
            <br>
            {{ $supplier->address }}
            <br>
            {{ $supplier->postcode }} {{ $supplier->city }}
            <br>
            {{ $supplier->country }}
          </div>
        </div>
        <footer class="card-footer">
          <p class="card-footer-item">
            todo
          </p>
          <p class="card-footer-item">
            todo
          </p>
        </footer>
      </div>
    </div>
    <div class="column">
      <div class="card">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon has-text-primary">
              <i class="fas fa-chart-bar"></i>
            </span>
            Statistics
          </p>
          <a href="#" class="card-header-icon" aria-label="more options">
            <span class="icon">
              <i class="fas fa-angle-down" aria-hidden="true"></i>
            </span>
          </a>
        </header>
        <div class="card-content">
          <div class="content">
            Total spend <strong>todo</strong>
            <br>
            Total orders: <strong>{{ $supplier->orders->count() }}</strong>
            <br>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <header class="card-header">
      <p class="card-header-title">
        <span class="icon has-text-primary">
          <i class="fas fa-clipboard"></i>
        </span>
        Orders by {{ $supplier->name }}
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
              <th>Order</th>
              <th>Description</th>
              <th>Lines</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach($supplier->orders as $order)
              <tr>
                <td>{{ $order->id }}</td>
                <td><a href="/orders/{{ $order->id }}">{{ str_limit($order->description, 50) }}</a></td>
                <td>{{ $order->orderLines->count() }}</td>
                <td>&euro; {{ number_format($order->totalPrice, 2, ',', '.') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <a class="button is-link">
    <span class="icon">
      <i class="fas fa-edit"></i>
    </span>
    <span>Edit</span>
  </a>
@endsection
