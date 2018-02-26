@extends('layouts.purchaseApp')
@section('title', 'Orders')
@section('content')

  <table class="table is-hoverable is-fullwidth">
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

  @if(isset($filter))
    {{ $orders->appends(['filter' => $filter])->links('components.paginate') }}
  @else
    {{ $orders->links('components.paginate') }}
  @endif

@endsection
