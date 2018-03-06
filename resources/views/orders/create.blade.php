@extends('layouts.purchaseApp')
@section('title', 'New Order')
@section('content')
  <div class="card">
    <header class="card-header">
      <p class="card-header-title">
        <span class="icon has-text-primary">
          <i class="fas fa-clipboard"></i>
        </span>
        Create new order
      </p>
    </header>
    <div class="card-content">
      <div class="content">
        <pu-create-order
          suppliers="{{ $suppliers }}"
          previous="{{ url()->previous() }}">
        </pu-create-order>
      </div>
    </div>
  </div>
@endsection
