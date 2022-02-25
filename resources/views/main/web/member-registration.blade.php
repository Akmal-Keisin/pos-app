@extends('main.layout.main')
@section('title', 'Member Registration')
@section('content')
    <div class="container">
        <div class="row mt-5">
            @if ($message = Session::get('failed'))
                <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h1>Join Member Now <br> And Get Many Benefits</h1>
            <h3 class="mt-3 text-success">Rp. 150.000,00</h3>
            <form action="/member-registration" method="POST">
                @csrf
                <button class="btn btn-primary mt-3">Join Now</button>
            </form>
        </div>
    </div>
@endsection
