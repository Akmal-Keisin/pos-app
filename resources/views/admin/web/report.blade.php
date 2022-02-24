@extends('admin.layout.main')
@section('title', 'Report')
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="d-flex justify-content-between">
            <h1>Report</h1>
            <span>Order By :
                <a href="/report?report=week" class="btn btn-primary">This Week</a>
                <a href="/report?report=month" class="btn btn-primary">This Month</a>
                <a href="/report" class="btn btn-primary">All</a>
            </span>
        </div>
        <h1>Modal : Rp. @convert($modal)</h1>
        <h1>Income : Rp. @convert($income)</h1>
        @if ($income <= $modal)
            <div class="mt-5">
                <h1 class="text-danger">Loss : Rp. @convert($modal - $income)</h1>
            </div>
        @else
            <div class="mt-5">
                <h1 class="text-success">Profit : Rp. @convert($income - $modal)</h1>
            </div>
        @endif
    </div>
</div>
@endsection
