@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Transaction</h3>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="client_id">Client: {{ $transaction->ClientName()  }}</label>
                </div>

                <div class="form-group">
                    <label for="last_name">Amount:</label>
                    <input type="text" class="form-control" name="amount" value={{ $transaction->amount }} readonly />
                </div>

                <a href="/transactions" class="btn btn-link">Cancel</a>
            </div>
        </div>
    </div>
@endsection
