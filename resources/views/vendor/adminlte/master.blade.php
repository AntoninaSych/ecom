<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Backoffice</title>
     <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('css/libraries/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/libraries/datatables/buttons.dataTables.min.css') }}">
    <script src="{{ asset('/js/libraries/jquery.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">

    @if(config('adminlte.plugins.datatables'))
            <link rel="stylesheet" href="{{ asset('/css/libraries/datatables/dataTables.bootstrap.min.css') }}">
    @endif

    @yield('adminlte_css')

    <script src="{{ asset('/js/config.js') }}"></script>
    <script src="{{ asset('/js/libraries/alertify/alertify.min.js') }}"></script>

    <!--[if lt IE 9]>
    <script src="{{ asset('/js/libraries/other/html5shiv.min.js')}}"></script>
    <script src="{{ asset('/js/libraries/other/respond.min.js')}}"></script>
    <![endif]-->
 </head>
<body class="hold-transition @yield('body_class')">

@yield('body')

<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

@if(config('adminlte.plugins.chartjs'))
    <!-- ChartJS -->
    <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/libraries/chart/Chart.bundle.min.js') }}"></script>
@endif

@yield('adminlte_js')

<script src="{{ asset('/js/libraries/jquery.v.1.12.4.js') }}"></script>
<script src="{{ asset('/js/libraries/jquery-ui.js') }}"></script>
{{--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>--}}
{{--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
{{--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}
<link rel="stylesheet" href="{{ asset('/css/libraries/jquery-ui/jquery-ui.v.1.12.1.css') }}">

<script src="{{ asset('js/libraries/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('/js/libraries/moment/moment.js') }}"></script>
<script src="{{ asset('/js/libraries/datarangepicker/daterangepicker.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('/css/libraries/datarangepicker/daterangepicker.css') }}">
<script src="{{ asset('js/libraries/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('js/libraries/select2/ru.js') }}"></script>
<!-- DatePicker 3.3.7 -->
<script src="{{ asset('js/user-list.js') }}"></script>
</body>

</html>
