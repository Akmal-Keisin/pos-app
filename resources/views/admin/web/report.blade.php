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
        <div class="row mt-5">
            <div class="col-sm-6">
                <h3 class="">Transaction List</h3>
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Total Transaction</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ $transaction->total_cost }}</td>
                                <td>{{ $transaction->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-sm-6">
                <h3 class="">Modal List</h3>
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Stock</th>
                            <th>Cost</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modals as $modal)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $modal->product->product_name }}</td>
                                <td>{{ $modal->stock }}</td>
                                <td>{{ $modal->cost }}</td>
                                <td>{{ $modal->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
