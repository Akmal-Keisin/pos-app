@extends('admin.layout.main')
@section('title', 'Add Category')
@section('content')
<div class="container">
    <div class="row justify-content-center mt-5 ">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div >
            <a class="btn btn-primary d-inline-block" href="/admin/create">Back</a>
        </div>
        <h1 class="text-center">Add Category</h1>
        {{-- Form --}}
        <form action="/category" method="POST" class="col-md-5 mb-5">
            @csrf
            {{-- Category Name --}}
            <div class="mb-3">
                <label for="category_name" class="form-label">Category Name :</label>
                <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name Here" value="{{ old('product_name') }}">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
            <div class="mt-3">
                <label for="" class="form-label d-block">Category List:</label>
                @foreach ($categories as $category)
                    <a href="/category/{{ $category->id }}" class="btn btn-primary mx-2">{{ $category->category_name }}</a>
                @endforeach
            </div>
        </form>
    </div>
</div>
@endsection
