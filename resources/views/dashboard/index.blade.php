@extends('layouts.purchaseApp')
@section('title', 'Dashboard')
@section('content')

  <div class="content">
    <h1>Welcome {{ auth()->user()->name }},</h1>
  </div>

  <pu-dashboard></pu-dashboard>

@endsection
