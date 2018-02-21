@extends('layouts.purchaseApp')
@section('title', 'Dashboard')
@section('content')

  <div class="content">
    <h1>Welcome {{ auth()->user()->name }},</h1>
  </div>

  <nav class="level">
  <div class="level-item has-text-centered">
    <div>
      <p class="heading">Orders</p>
      <p class="title">3,456</p>
    </div>
  </div>
  <div class="level-item has-text-centered">
    <div>
      <p class="heading">Order lines</p>
      <p class="title">123</p>
    </div>
  </div>
  <div class="level-item has-text-centered">
    <div>
      <p class="heading">Spend</p>
      <p class="title">456K</p>
    </div>
  </div>
  <div class="level-item has-text-centered">
    <div>
      <p class="heading">Suppliers</p>
      <p class="title">789</p>
    </div>
  </div>
  </nav>


@endsection
