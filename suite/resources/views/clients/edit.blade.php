@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Edit a Client</h3>
            </div>
            <div class="col-md-8">
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
                <form method="post" action="{{ route('clients.update', $client->id) }}" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" class="form-control" name="first_name" value={{ $client->first_name }} />
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" class="form-control" name="last_name" value={{ $client->last_name }} />
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" name="email" value={{ $client->email }} />
                    </div>

                    @include('partials.upload-image-file', ['required' => ''])

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="/clients" class="btn btn-link">Cancel</a>
                </form>
            </div>
            <div class="col-md-4">
                @if($client->avatar)
                <img src="{{ asset('storage/'. $client->avatar) }}" class="img-thumbnail" alt="Responsive image">
                @endif
            </div>
        </div>
    </div>
@endsection
