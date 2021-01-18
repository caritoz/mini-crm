@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->get('errors'))
                    <div class="alert alert-danger">
                        {{ session()->get('errors') }}
                    </div>
            @endif
        </div>
        <div class="col-md-12">
            <h3>Clients <small><a href="{{ route('clients.create') }}" class="btn btn-link">Add +</a></small></h3>
        </div>
        <div class="col-md-12">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Email</th>
                    <th scope="col">Transactions</th>
                    <th scope="col">@</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($clients as $key => $client)
                    <tr>
                        <th scope="row">{{$client->id}}</th>
                        <td>{{ $client->first_name }}</td>
                        <td>{{ $client->last_name }}</td>
                        <td>{{ $client->email }}</td>
                        <td><a href="{{ route('transactions.index', $client->id)}}" title="Transactions">{{ $client->transactions->count()  }}</a></td>
                        <td>
                            <div class="clearfix">
                                <a href="{{ route('clients.edit', $client->id)}}" title="Edit" class="btn btn-link float-left"><i class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('clients.destroy', $client->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            {{ $clients->links() }}
        </div>
    </div>
</div>
@endsection
