<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">


</head>
<body>


<div class="container">
    <div class="row">
        <div class="col-md-3 center-block"style="margin-top: 30%">
            <div class="error-page">
                <h2 class="headline text-red pull-left">Code:{{$code}}</h2>

                <div class="error-content pull-right">
                    <h3><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h3>
                    <p>
                        Message: {{$message}}
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>