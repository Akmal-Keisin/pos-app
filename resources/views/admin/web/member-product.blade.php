@extends('admin.layout.main')
@section('title', 'Member Product')
@section('content')
<div class="container">
    <div class="title d-flex justify-content-between my-3">
        <h1 class="">List Product</h1>
        <div class="add-button d-flex align-items-end">
            <a href="/member_admin/create" class="btn btn-primary">Add Product</a>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <table class="table">
        <thead class="align-middle">
            <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 10em">Image</th>
                <th scope="col">Product Name</th>
                <th scope="col" style="width:30em">Description</th>
                <th scope="col">Stock</th>
                <th scope="col">Point</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach ($products as $product)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td><img class="img-thumbnail img-fluid" src="{{ $product->image }}" alt="{{ $product->product_name }}"></td>
                <td>{{ $product->product_name }}</td>
                <td>{{ Str::limit($product->product_description, 100, '...')  }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->point }}</td>
                <td class="">
                    <form class="d-flex justify-content-evenly" action="/member_admin/{{ $product->id }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <a href="/member_admin/{{ $product->id }}/edit" class="btn btn-warning">Edit</a>
                        <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are You Sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
