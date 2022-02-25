@extends('admin.layout.main')
@section('title', 'Edit Product')
@section('content')
<div class="container">
    <div class="row justify-content-center mt-5 ">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <h1 class="text-center">Edit Product</h1>

        {{-- Form --}}
        <form action="/member_admin/{{ $product->id }}" method="POST" class="col-md-5 mb-5" enctype="multipart/form-data">
            @csrf
            @method('put')
            {{-- Product Name --}}
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name :</label>
                <input type="text" class="form-control" id="product_name" name="product_name"
                    placeholder="Product Name Here" value="{{ old('product_name', $product->product_name) }}">
            </div>
            {{-- Image --}}
            <div class="mb-3">
                <label for="image" class="form-label">Image :</label>
                <input type="file" class="form-control" id="image" name="image" placeholder="Product Name Here"
                    value="{{ old('image', $product->image) }}">
            </div>
            {{-- Description --}}
            <div class="mb-3">
                <label for="product_description" class="form-label">Product Description :</label>
                <textarea class="form-control" id="product_description" name="product_description"
                    placeholder="Product Description Here" rows="4">{{ old('product_description', $product->product_description) }}</textarea>
            </div>
            {{-- Stock --}}
            <div class="mb-3">
                <label for="stock" class="form-label">Stock :</label>
                <input type="number" id="stock" class="form-control" name="stock" min="1" placeholder="Stock"
                    value="{{ old('stock', $product->stock) }}">
            </div>
            {{-- Point --}}
            <div class="mb-3">
                <label for="point" class="form-label">Point :</label>
                <input type="number" id="point" class="form-control" name="point" min="1" placeholder="point"
                    value="{{ old('point', $product->point) }}">
            </div>
            <button type="submit" class="btn btn-warning">Edit</button>
        </form>
    </div>
</div>
@endsection
