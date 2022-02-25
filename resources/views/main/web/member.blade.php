@extends('main.layout.main')
@section('title', 'Member Service')
@section('content')
    <div class="container">
        <div class="row mt-5">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($check_member === false)
            <h1 class="text-center">You're not a member</h1>
                <div class="d-flex justify-content-center">
                    <a href="/member-registration" class="btn btn-primary">Join Member Now</a>
                </div>
            @elseif ($check_member === true)
            <div class="d-flex justify-content-between">
                <h1 class="text-center">Exchange your member point here</h1>
                <h1>Your Point : {{ $member->point }}Pt</h1>
            </div>
            <div class="row mt-5">
                @foreach ($products as $product)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-head">
                                <img class="img-fluid" src="{{ $product->image }}" alt="{{ $product->product_name }}">
                            </div>
                            <div class="card-body">
                                <h4>{{ $product->product_name }}</h4>
                                <p class="description">{{ Str::limit($product->product_description, 100, '...') }}</p>
                                <div class="d-flex justify-content-between align-items-center ">
                                    <p><a class="btn btn-primary" href="/member/{{ $product->id }}">More</a></p>
                                    <p class="text-primary">{{ $product->point }}Pt</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
@endsection
