@extends('admin.layout.main')
@section('title', 'Add Product')
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
            <h1 class="text-center">Add Product</h1>

            {{-- Form --}}
            <form action="/admin" method="POST" class="col-md-5 mb-5" enctype="multipart/form-data">
                @csrf
                {{-- Product Name --}}
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name :</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name Here" value="{{ old('product_name') }}">
                </div>
                {{-- Image --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Image :</label>
                    <input type="file" class="form-control" id="image" name="image" placeholder="Product Name Here" value="{{ old('image') }}">
                </div>
                {{-- Category --}}
                <div class="mb-3">
                    <label class="form-label">Product Category :</label>
                    <div class="input-group">
                        <select class="form-select" name="category">
                            @if (old('category_id'))
                                <option value="{{ old('category_id') }}" selected>{{ old('category_id') }}</option>
                            @endif
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        <a href="/category/create" class="d-inline btn btn-primary">add</a>
                    </div>
                </div>
                {{-- Description --}}
                <div class="mb-3">
                    <label for="product_description" class="form-label">Product Description :</label>
                    <textarea class="form-control" id="product_description" name="product_description" placeholder="Product Description Here" rows="4">{{ old('product_description') }}</textarea>
                </div>
                {{-- Stock --}}
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock :</label>
                    <input type="number" id="stock" class="form-control" name="stock" min="1" placeholder="Stock" value="{{ old('stock') }}">
                </div>
                {{-- Price --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Price :</label>
                    <input type="number" id="price" class="form-control" name="price" min="1" placeholder="Price" value="{{ old('price') }}">
                </div>
                {{-- Profit --}}
                <div class="mb-3">
                    <label for="profit" class="form-label">Profit :</label>
                    <input type="number" id="profit" class="form-control" name="profit" min="1" placeholder="Profit" value="{{ old('profit') }}">
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
@endsection
