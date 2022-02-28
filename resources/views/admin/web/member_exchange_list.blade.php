@extends('admin.layout.main')
@section('title', 'Transaction List')
@section('content')
<div class="container">
    <div class="title d-flex justify-content-between my-3">
        <h1 class="">List Transaction</h1>
    </div>
    <table class="table">
        <thead class="align-middle">
            <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 10em">Name</th>
                <th scope="col">Product</th>
                <th scope="col">Qty</th>
                <th scope="col">Point Cost</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach ($exchanges as $exchange)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $exchange->user->name }}</td>
                <td>{{ $exchange->memberProduct->product_name }}</td>
                <td>{{ $exchange->qty}}</td>
                <td>{{ $exchange->point_total  }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
