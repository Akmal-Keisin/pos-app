@extends('main.layout.main')
@section('title', $product->product_name )
@section('content')
<div class="container">
    <div class="row mt-5 justify-content-evenly">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif ($message = Session::get('failed'))
        <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="col-md-4">
            <img class="img-fluid" src="{{ asset($product->image) }}" alt="">
            <h3 class="mt-4">Your Point : {{ $member->point }}Pt</h3>
        </div>
        <div class="col-md-6">
            <form action="/exchange" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <h1>{{ $product->product_name }}</h1>
                <div class="mb-3">
                    <h6 class="fw-bold">Description :</h6>
                    <p>{{ $product->product_description }}</p>
                </div>
                <div class="mb-3">
                    <h6 class="fw-bold">Stock :</h6>
                    <p>{{ $product->stock }}</p>
                </div>
                <div class="mb-3">
                    <h6 class="fw-bold">Price :</h6>
                    <p>{{ $product->point }}Pt</p>
                </div>
                <div class="mb-3" style="width: 20%">
                    <label for="">
                        <h6 class="fw-bold">Quantity :</h6>
                    </label>
                    <input type="number" class="form-control" name="qty">
                </div>
                <button class="btn btn-primary" type="submit">Exchange</button>
            </form>
        </div>
    </div>
</div>
@endsection
