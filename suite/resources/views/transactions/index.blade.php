@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </div>
            <div class="col-md-12">
                <h3>Transactions @if($client): {{ $client->first_name }} {{ $client->last_name }} <small><a href="/clients" class="btn btn-link"><< Back</a></small>@endif <small><a href="{{ route('transactions.create') }}" class="btn btn-link">Add +</a></small></h3>
            </div>
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        @if(!$client)<th scope="col">Client</th>@endif
                        <th scope="col">Transaction date</th>
                        <th scope="col">Amount</th>
                        <th scope="col">@</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if( !empty($transactions) && $transactions->count() )
                        @foreach ($transactions as $key => $transaction)
                        <tr>
                            <th scope="row">{{$transaction->id}}</th>
                            @if(!$client)<td>{{ $transaction->client->first_name }} {{ $transaction->client->last_name }}</td>@endif
                            <td>{{ $transaction->created_at }}</td>
                            <td>{{ number_format($transaction->amount, 2) }}</td>
                            <td><div class="clearfix">
                                    <a href="{{ route('transactions.edit', $transaction->id)}}" title="Edit" class="btn btn-link float-left"><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('transactions.destroy', $transaction->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete?')"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div></td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="5">There are no data.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                {!! $transactions->links() !!}
            </div>
        </div>
    </div>
@endsection
