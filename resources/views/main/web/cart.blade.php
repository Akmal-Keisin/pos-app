@extends('main.layout.main')
@section('title', 'Cart')
@section('content')
<div class="container">
    <h1 class="mt-5">Cart</h1>
    <div class="row mt-2">
        <div class="col-md-8">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Cost</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $cart)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $cart['product_name'] }}</td>
                        <td>{{ $cart['price'] }}</td>
                        <td>{{ $cart['qty'] }}</td>
                        <td>{{ $cart['cost'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
