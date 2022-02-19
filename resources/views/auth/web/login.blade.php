@extends('auth.layout.main')
@section('title', 'Login')
@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif ($message = Session::get('failed'))
            <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1 class="text-center">Login Here</h1>
        <form action="/login" method="POST" class="col-md-4 mb-5">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" value="{{ old('user_name') }}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password :</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Your Password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <div class="mt-3">
                <a class="text-decoration-none" href="/register">Didn't have any account yet?</a>
            </div>
        </form>
    </div>
</div>
@endsection
