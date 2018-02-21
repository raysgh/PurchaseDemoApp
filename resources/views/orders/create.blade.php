@extends('layouts.purchaseApp')
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
          <input class="input" type="text" id="quantity0" name="quantity0" placeholder="Quantity" value="{{ old('quantity0') }}">
        </div>
        <div class="control is-expanded">
          <input class="input" type="text" id="description0" name="description0" placeholder="Description" value="{{ old('description0') }}">
        </div>
        <div class="control">
          <input class="input" type="text" id="price0" name="price0" placeholder="Price" value="{{ old('price0') }}">
        </div>
      </div>

      <div class="field is-grouped">
        <div class="control">
          <input class="input" type="text" id="quantity1" name="quantity1" placeholder="Quantity" value="{{ old('quantity1') }}">
        </div>
        <div class="control is-expanded">
          <input class="input" type="text" id="description1" name="description1" placeholder="Description" value="{{ old('description1') }}">
        </div>
        <div class="control">
          <input class="input" type="text" id="price1" name="price1" placeholder="Price" value="{{ old('price1') }}">
        </div>
      </div>

      <div class="field is-grouped">
        <div class="control">
          <input class="input" type="text" id="quantity2" name="quantity2" placeholder="Quantity" value="{{ old('quantity2') }}">
        </div>
        <div class="control is-expanded">
          <input class="input" type="text" id="description2" name="description2" placeholder="Description" value="{{ old('description2') }}">
        </div>
        <div class="control">
          <input class="input" type="text" id="price2" name="price2" placeholder="Price" value="{{ old('price2') }}">
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
