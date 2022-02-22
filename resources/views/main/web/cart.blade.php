@extends('main.layout.main')
@section('title', 'Cart')
@section('content')
<div class="container">
    <h1 class="mt-5">Cart</h1>
    <div class="row mt-2">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="col-md-8">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col" class="price">Cost</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @if (!$carts)
                    <tr>
                        <td colspan="6" class="text-center fw-light text-secondary"> Cart Is Empty</td>
                    </tr>
                    @else
                    @foreach ($carts as $cart)
                    <tr>
                        <form action="/"></form>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $cart['product_name'] }}</td>
                        <td>{{ $cart['price'] }}</td>
                        <td>
                            <form action="/cart/{{ $cart['row_id'] }}" class="d-flex" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="input-group">
                                    <input class="form-control" type="number" value="{{ $cart['qty'] }}" name="qty">
                                    <button class="btn btn-outline-warning">Edit</button>
                                </div>
                            </form>
                        </td>
                        <td>{{ $cart['cost'] }}</td>
                        <td>
                            <form action="/cart/{{ $cart['row_id'] }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <div class="ms-4">
                <h2 class="">Cost Total :</h2>
                <h2 class="fw-light">Rp. @convert($cost_total)</h2>
            </div>
            <div class="ms-4 mt-3">
                <h2>Address</h2>
                <h5 class="fw-light">{{ Auth::user()->address }}</h5>
            </div>
            <div class="ms-4 mt-3">
                <form action="/checkout" method="POST">
                    @csrf
                    <button class="btn btn-primary">Checkout</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
