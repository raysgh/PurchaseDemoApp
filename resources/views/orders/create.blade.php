@extends('layouts.purchaseApp')
@section('title', 'New Order')
@section('content')



  @if (count($errors))
    <div class="notification">
      <button class="delete"></button>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </div>
  @endif

  <form action="/orders" method="post">

    {{ csrf_field() }}

    <div class="field">
      <label class="label">General order details</label>
      <div class="field is-grouped">
      <div class="control">
        <div class="select">
          <select id="supplier" name="supplier">
            <option value="">Select supplier</option>
            @foreach($suppliers as $supplier)
              <option value="{{ $supplier->id }}" {{ old('supplier') == $supplier->id ? 'selected' : '' }}>
                {{ $supplier->name }}
              </option>
            @endforeach
          </select>
        </div>
      </div>
        <div class="control is-expanded">
          <input class="input" type="text" id="description" name="description" placeholder="Description" value="{{ old('description') }}">
        </div>
      </div>
    </div>

    <div class="field">
      <label class="label">Order lines</label>
      <div class="field is-grouped">
        <div class="control">
          <input class="input" type="text" id="quantity0" name="pos[0][quantity]" placeholder="Quantity" value="{{ old('pos.0.quantity') }}">
        </div>
        <div class="control is-expanded">
          <input class="input" type="text" id="description0" name="pos[0][description]" placeholder="Description" value="{{ old('pos.0.description') }}">
        </div>
        <div class="control has-icons-left">
          <input class="input" type="text" id="price0" name="pos[0][price]" placeholder="0,00" value="{{ old('pos.0.price') }}">
          <span class="icon is-small is-left">
            <i class="fas fa-euro-sign"></i>
          </span>
        </div>
      </div>

      <div class="field is-grouped">
        <div class="control">
          <input class="input" type="text" id="quantity1" name="pos[1][quantity]" placeholder="Quantity" value="{{ old('pos.1.quantity') }}">
        </div>
        <div class="control is-expanded">
          <input class="input" type="text" id="description1" name="pos[1][description]" placeholder="Description" value="{{ old('pos.1.description') }}">
        </div>
        <div class="control has-icons-left">
          <input class="input" type="text" id="price1" name="pos[1][price]" placeholder="0,00" value="{{ old('pos.1.price') }}">
          <span class="icon is-small is-left">
            <i class="fas fa-euro-sign"></i>
          </span>
        </div>
      </div>

      <div class="field is-grouped">
        <div class="control">
          <input class="input" type="text" id="quantity2" name="pos[2][quantity]" placeholder="Quantity" value="{{ old('pos.2.quantity') }}">
        </div>
        <div class="control is-expanded">
          <input class="input" type="text" id="description2" name="pos[2][description]" placeholder="Description" value="{{ old('pos.2.description') }}">
        </div>
        <div class="control has-icons-left">
          <input class="input" type="text" id="price2" name="pos[2][price]" placeholder="0,00" value="{{ old('pos.2.price') }}">
          <span class="icon is-small is-left">
            <i class="fas fa-euro-sign"></i>
          </span>
        </div>
      </div>
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
        <button class="button is-text">Cancel</button>
      </div>
    </div>

  </form>



@endsection
