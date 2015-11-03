@extends('dashboard/master')

@section('content')
<div class="jumbotron col-sm-4 col-sm-push-4" style="margin-top: 8em;">
    <h1>Login</h1>
    <form method="POST" action="/auth/login">
        {!! csrf_field() !!}

        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="password">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
        
    </form>
</div>
@endsection