@extends('layouts.purchaseApp')
@section('title', 'Orders')
@section('content')

  <table class="table is-hoverable is-fullwidth">
    <thead>
      <tr>
        <th>Order</th>
        <th>Description</th>
        <th>Supplier</th>
        <th><p class="has-text-right">Total</p></th>
        <th>Ordered</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
        <tr>
          <td>{{ $order->id }}</td>
          <td><a href="orders/{{ $order->id }}">{{ str_limit($order->description, 50) }}</a></td>
          <td>{{ str_limit($order->supplier->name, 30) }}</td>
          <td><p class="has-text-right">&euro; {{ number_format($order->totalPrice, 2, '.', ',') }}</p></td>
          <td>
            <span class="icon has-text-info">
              <i class="{{ $order->is_ordered ? 'fas fa-shopping-cart' : 'fab fa-opencart' }}"></i>
            </span>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  @if(isset($appliedFilters))
    {{ $orders->appends($appliedFilters)->links('components.paginate') }}
  @else
    {{ $orders->links('components.paginate') }}
  @endif

@endsection
