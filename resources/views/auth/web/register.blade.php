@extends('auth.layout.main')
@section('title', 'Register')
@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <h1 class="text-center">Register Here</h1>
        <form action="/register" method="POST" class="col-md-5 mb-5">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username :</label>
                <input type="text" class="form-control" id="username" name="name" placeholder="Your Name"
                    value="{{ old('user_name') }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="email" class="form-control" id="username" name="email" placeholder="Your Email"
                    value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label for="address">Address :</label>
                <textarea name="address" id="address" cols="30" rows="6" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password :</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Your Password">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password :</label>
                <input type="password" class="form-control" id="confirm_password" name="password_confirm"
                    placeholder="Conrifm Password">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <div class="mt-3">
                <a class="text-decoration-none" href="/login">Already has any account?</a>
            </div>
        </form>
    </div>
</div>
@endsection
