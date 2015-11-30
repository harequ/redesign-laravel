<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="{{ url(elixir('css/dashboard.css')) }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="jumbotron col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1" style="margin-top: 8em;">
                <h2>Dahsboard</h2>
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
                    @include('errors/list')
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/vendor/dashboard-vendor.js') }}"></script>
    <script type="text/javascript" src="{{ url(elixir('js/dashboard.js')) }}"></script>
</body>
</html>
