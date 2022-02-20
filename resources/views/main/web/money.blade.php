@extends('main.layout.main')
@section('title', 'Money')
@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="text-center">
                <h3>Your Money</h3>
                <h1 class="fw-bold">Rp. @convert(Auth::user()->money)</h1>
            </div>
            <div class="mt-5">
                <h4 class="text-center mt-5">Top Up Now</h4>
            </div>
            <div class="mt-3">
                <form action="/money" method="POST">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-sm-3 d-flex justify-content-center">
                            <input type="radio" class="btn-check" name="money" value="10000" id="10000"
                                autocomplete="off">
                            <label class="btn btn-outline-primary" for="10000">Rp. 10.000,00</label>
                        </div>
                        <div class="col-sm-3 d-flex justify-content-center">
                            <input type="radio" class="btn-check" name="money" value="20000" id="20000"
                                autocomplete="off">
                            <label class="btn btn-outline-primary" for="20000">Rp. 20.000,00</label>
                        </div>
                        <div class="col-sm-3 d-flex justify-content-center">
                            <input type="radio" class="btn-check" name="money" value="50000" id="50000"
                                autocomplete="off">
                            <label class="btn btn-outline-primary" for="50000">Rp. 50.000,00</label>
                        </div>
                        <div class="col-sm-3 d-flex justify-content-center">
                            <input type="radio" class="btn-check" name="money" value="100000" id="100000"
                                autocomplete="off">
                            <label class="btn btn-outline-primary" for="100000">Rp. 100.000,00</label>
                        </div>
                        <div class="col-sm-3">
                            <div class="mt-3 d-flex justify-content-center">
                                <button class="btn btn-primary" type="submit">Top Up!</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
