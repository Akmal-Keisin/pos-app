@extends('admin.layout.main')
@section('title', 'Add Discount')
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
        <h1 class="text-center">Add Discount</h1>

        {{-- Form --}}
        <form action="/discount" method="POST" class="col-md-5 mb-5">
            @csrf
            {{-- Product Name --}}
            <div class="mb-3">
                <label for="coupon" class="form-label">Discount Coupon :</label>
                <input type="text" class="form-control" id="coupon" name="coupon"
                    placeholder="Product Name Here" value="{{ old('coupon') }}">
            </div>
            <div class="mb-3">
                <label for="value" class="form-label">Discount Value : %</label>
                <input type="number" class="form-control" id="value" name="value"
                    placeholder="Product Name Here" value="{{ old('value') }}">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</div>
@endsection
