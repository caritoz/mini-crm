@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Edit a Transaction</h3>
            </div>
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <br />
                @endif
                <form method="post" action="{{ route('transactions.update', $transaction->id) }}">
                    @method('PATCH')
                    @csrf

                    <div class="form-group">
                        <label for="client_id">Client: {{ $transaction->ClientName()  }}</label>
                        <input name="client_id" id="client_id" type="hidden" value="{{$transaction->client_id}}">
                    </div>

                    <div class="form-group">
                        <label for="last_name">Amount:</label>
                        <input type="text" class="form-control" name="amount" value={{ $transaction->amount }} />
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="/transactions" class="btn btn-link">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
