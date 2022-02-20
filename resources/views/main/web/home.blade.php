@extends('main.layout.main')
@section('title', 'Home')
@section('content')
<div class="container">
    <div class="row mt-5">
        @if ($products->isEmpty())
        <h1 class="text-center">Product Not Found</h1>
        @endif
        @foreach ($products as $product)
        <div class="col-md-3">
            <div class="card">
                <div class="card-head">
                    <img class="img-fluid" src="{{ $product->image }}" alt="{{ $product->product_name }}">
                </div>
                <div class="card-body">
                    <p class="text-secondary">{{ $product->category->category_name }}</p>
                    <h4>{{ $product->product_name }}</h4>
                    <p class="description">{{ $product->product_description }}</p>
                    <div class="d-flex justify-content-between align-items-center ">
                        <p><a class="btn btn-primary" href="/home/{{ $product->id }}">More</a></p>
                        <p class="text-primary">@convert($product->price)</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
