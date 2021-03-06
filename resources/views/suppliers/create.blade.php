@extends('layouts.purchaseApp')
@section('title', 'New Supplier')
@section('content')

<div class="card">
  <header class="card-header">
    <p class="card-header-title">
      <span class="icon has-text-primary">
        <i class="fas fa-industry"></i>
      </span>
      Create new supplier
    </p>
  </header>
  <div class="card-content">
    <div class="content">

      @if (count($errors))
        <div class="notification">
          <button class="delete"></button>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </div>
      @endif

      <form action="/suppliers" method="post">
        {{ csrf_field() }}

        <div class="field">
          <label class="label">Name</label>
          <div class="control">
            <input class="input" type="text" id="name" name="name" value="{{ old('name') }}">
          </div>
        </div>

        <div class="field">
          <label class="label">Address</label>
          <div class="control">
            <input class="input" type="text" id="address" name="address" value="{{ old('address') }}">
          </div>
        </div>

        <div class="field">
          <label class="label">Postcode</label>
          <div class="control">
            <input class="input" type="text" id="postcode" name="postcode" value="{{ old('postcode') }}">
          </div>
        </div>

        <div class="field">
          <label class="label">City</label>
          <div class="control">
            <input class="input" type="text" id="city" name="city" value="{{ old('city') }}">
          </div>
        </div>

        <div class="field">
          <label class="label">Country</label>
          <div class="control">
            <input class="input" type="text" id="country" name="country" value="{{ old('country') }}">
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
            <a href="{{ url()->previous() }}" class="button is-text">Cancel</a>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>



@endsection
