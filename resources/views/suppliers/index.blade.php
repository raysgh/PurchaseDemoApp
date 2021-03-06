@extends('layouts.purchaseApp')
@section('title', 'Suppliers')
@section('content')

  <table class="table is-hoverable is-fullwidth">
    <thead>
      <tr>
        <th>Supplier</th>
        <th>Name</th>
        <th>City</th>
        <th>Country</th>
      </tr>
    </thead>
    <tbody>
      @foreach($suppliers as $supplier)
        <tr>
          <td>{{ $supplier->id }}</td>
          <td><a href="/suppliers/{{ $supplier->id }}">{{ $supplier->name }}</a></td>
          <td>{{ $supplier->city }}</td>
          <td>{{ $supplier->country }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {{ $suppliers->links('components.paginate') }}

@endsection
