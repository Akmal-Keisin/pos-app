@extends('admin.layout.main')
@section('title', 'Discount')
@section('content')
<div class="container">
    <div class="title d-flex justify-content-between my-3">
        <h1 class="">List Product</h1>
        <div class="add-button d-flex align-items-end">
            <a href="/discount/create" class="btn btn-primary">Add Coupon</a>
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
                <th>Coupon</th>
                <th scope="col">Value</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach ($discounts as $discount)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $discount->coupon }}</td>
                <td>{{ $discount->value }}%</td>
                <td class="">
                    <form class="d-flex justify-content-evenly" action="/discount/{{ $discount->id }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <a href="discount/{{ $discount->id }}/edit" class="btn btn-warning">Edit</a>
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
