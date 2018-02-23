@extends('layouts.purchaseApp')
@section('title', 'Edit Order #' . $order->id)
@section('content')

  @if (count($errors))
    <div class="notification">
      <button class="delete"></button>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </div>
  @endif

  <form action="/orders/{{ $order->id }}" method="post">

    {{ csrf_field() }}

    {{ method_field('PUT') }}

    <div class="field">
      <label class="label">General order details</label>
      <div class="field is-grouped">
      <div class="control">
        <div class="select">
          <select id="supplier" name="supplier">
            <option value="">Select supplier</option>
            @foreach($suppliers as $supplier)
              <option value="{{ $supplier->id }}" {{ $order->supplier->id == $supplier->id ? 'selected' : '' }}>
                {{ $supplier->name }}
              </option>
            @endforeach
          </select>
        </div>
      </div>
        <div class="control is-expanded">
          <input class="input" type="text" id="description" name="description" placeholder="Description" value="{{ $order->description }}">
        </div>
      </div>
    </div>

    <div class="field">
      <label class="label">Order lines</label>
      @foreach($order->orderLines as $orderLine)
      <div class="field is-grouped">
        <div class="control">
          <input class="input" type="text" id="quantity{{ $orderLine->id}}" name="pos[{{ $orderLine->id }}][quantity]" placeholder="Quantity" value="{{ $orderLine->quantity }}">
        </div>
        <div class="control is-expanded">
          <input class="input" type="text" id="description{{ $orderLine->id}}" name="pos[{{ $orderLine->id }}][description]" placeholder="Description" value="{{ $orderLine->description }}">
        </div>
        <div class="control has-icons-left">
          <input class="input" type="text" id="price{{ $orderLine->id}}" name="pos[{{ $orderLine->id }}][price]" placeholder="0,00" value="{{ $orderLine->price }}">
          <span class="icon is-small is-left">
            <i class="fas fa-euro-sign"></i>
          </span>
        </div>
      </div>
      @endforeach
    </div>

    <div class="field is-grouped">
      <div class="control">
        <button class="button is-link" type="submit">
          <span class="icon">
            <i class="fas fa-save"></i>
          </span>
          <span>Save</span>
        </button>
      </div>
      <div class="control">
        <a href="{{ url()->previous() }}" class="button is-text">Cancel</a>
      </div>
    </div>
  </form>

@endsection
