@extends('admin.layout.main')
@section('title', 'Transaction List')
@section('content')
<div class="container">
    <div class="title d-flex justify-content-between my-3">
        <h1 class="">Transaction Detail</h1>
    </div>
    <div class="row">
        <div class="col-md-7">
            <table class="table">
                <thead class="align-middle">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" style="width: 10em">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total Cost</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($transactions as $transaction)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $transaction->product->product_name }}</td>
                        <td>{{ $transaction->qty }}</td>
                        <td>{{ $transaction->cost}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
