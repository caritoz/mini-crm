@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Client</h3>
            </div>
            <div class="col-md-8">
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" class="form-control" name="first_name" value={{ $client->first_name }} readonly />
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" class="form-control" name="last_name" value={{ $client->last_name }} readonly />
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" name="email" value={{ $client->email }} readonly />
                    </div>

                    <a href="/clients" class="btn btn-link">Cancel</a>
            </div>
            <div class="col-md-4">
                @if($client->avatar)
                    <img src="{{ asset('storage/'. $client->avatar) }}" class="img-thumbnail" alt="Responsive image">
                @endif
            </div>
        </div>
    </div>
@endsection
