@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Add a Transaction</h3>
            </div>
            <div class="col-md-12">
                <div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif
                    <form method="post" action="{{ route('transactions.store') }}">
                        @csrf

                        @include('partials.autocomplete-search-client')

                        <div class="form-group">
                            <label for="last_name">Amount:</label>
                            <input type="text" class="form-control" name="amount" value="{{old('amount')}}"/>
                        </div>

                        <button type="submit" class="btn btn-primary">Add</button>
                        <a href="/transactions" class="btn btn-link">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
