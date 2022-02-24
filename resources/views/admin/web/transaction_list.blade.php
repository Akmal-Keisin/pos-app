@extends('admin.layout.main')
@section('title', 'Transaction List')
@section('content')
<div class="container">
    <div class="title d-flex justify-content-between my-3">
        <h1 class="">List Transaction</h1>
    </div>
    <table class="table">
        <thead class="align-middle">
            <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 10em">Name</th>
                <th scope="col">Total Cost</th>
                <th scope="col">Profit</th>
                <th scope="col">Address</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach ($transactions as $transaction)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $transaction->user->name }}</td>
                <td>{{ $transaction->total_cost }}</td>
                <td>{{ $transaction->profit}}</td>
                <td>{{ $transaction->address  }}</td>
                <td>{{ $transaction->created_at  }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
