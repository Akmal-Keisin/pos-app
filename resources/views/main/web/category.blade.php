@extends('main.layout.main')
@section('title', 'Category')
@section('content')
    <div class="container">
        <h1 class="mt-5">Category List</h1>
        <div class="mt-4">
            @foreach ($categories as $category)
                <a href="/category/{{ $category->id }}" class="btn btn-primary mx-3">{{ $category->category_name }}</a>
            @endforeach
        </div>
    </div>
@endsection
