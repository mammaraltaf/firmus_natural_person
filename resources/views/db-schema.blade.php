@extends('layouts.app')

@section('content')
    <h1>Database Configuration</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('database.config.save') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="DB_CONNECTION">Database Connection</label>
            <input type="text" name="DB_CONNECTION" id="DB_CONNECTION" class="form-control" value="{{ old('DB_CONNECTION', env('DB_CONNECTION')) }}" placeholder="mysql" required>
        </div>
        <div class="form-group">
            <label for="DB_HOST">Database Host</label>
            <input type="text" name="DB_HOST" id="DB_HOST" class="form-control" value="{{ old('DB_HOST', env('DB_HOST')) }}" placeholder="127.0.0.1" required>
        </div>
        <div class="form-group">
            <label for="DB_PORT">Database Port</label>
            <input type="number" name="DB_PORT" id="DB_PORT" class="form-control" value="{{ old('DB_PORT', env('DB_PORT')) }}" placeholder="3306" required>
        </div>
        <div class="form-group">
            <label for="DB_DATABASE">Database Name</label>
            <input type="text" name="DB_DATABASE" id="DB_DATABASE" class="form-control" value="{{ old('DB_DATABASE', env('DB_DATABASE')) }}" placeholder="firmusfinancial" required>
        </div>
        <div class="form-group">
            <label for="DB_USERNAME">Database Username</label>
            <input type="text" name="DB_USERNAME" id="DB_USERNAME" class="form-control" value="{{ old('DB_USERNAME', env('DB_USERNAME')) }}" placeholder="root" required>
        </div>
        <div class="form-group">
            <label for="DB_PASSWORD">Database Password</label>
            <input type="password" name="DB_PASSWORD" id="DB_PASSWORD" class="form-control" value="{{ old('DB_PASSWORD', env('DB_PASSWORD')) }}" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Save Configuration</button>
    </form>
@endsection
