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
            @endif
            <div class="col-md-4">
                <img class="img-fluid" src="{{ asset($product->image) }}" alt="">
            </div>
            <div class="col-md-6">
                <form action="/cart/{{ $product->id }}" method="POST">
                    @csrf
                    <h1>{{ $product->product_name }}</h1>
                    <p><a class="text-decoration-none" href="/category/{{ $product->category->id }}">{{ $product->category->category_name }}</a></p>
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
                        <p>{{ $product->price }}</p>
                    </div>
                    <div class="mb-3" style="width: 20%">
                        <label for=""><h6 class="fw-bold">Quantity :</h6></label>
                        <input type="number" class="form-control" name="qty">
                    </div>
                    <button class="btn btn-primary" type="submit">Add To Cart</button>
                </form>
            </div>
        </div>
    </div>
@endsection
