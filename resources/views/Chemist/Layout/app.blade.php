<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from atmos.atomui.com/default/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Feb 2021 16:40:58 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="author" />
    <title>{{env('APP_NAME')}} | @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png" />
    <link rel="icon" href="assets/img/logo.png" type="image/png" sizes="16x16">
    <link rel='stylesheet' href="{{asset('assets/css/pace.css')}}" />
    <link rel='stylesheet' href="{{asset('assets/css/pace.min.js')}}" />
    <!--vendors-->
    <link rel='stylesheet' href="{{asset('assets/css/vendor.css')}}" />
    <link rel='stylesheet' href="{{asset('assets/css/vendor-addon.css')}}" />

    <link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600" rel="stylesheet">
    <!-- <link rel='stylesheet' href="{{asset('assets/css/jost.css')}}" /> -->
    <link rel='stylesheet' href='https://d33wubrfki0l68.cloudfront.net/css/04cc97dcdd1c8f6e5b9420845f0fac26b54dab84/default/assets/fonts/jost/jost.css' />
    <!--Material Icons-->
    <link rel='stylesheet' type='text/css' href='https://d33wubrfki0l68.cloudfront.net/css/548117a22d5d22545a0ab2dddf8940a2e32c04ed/default/assets/fonts/materialdesignicons/materialdesignicons.min.css' />
    <!-- <link rel='stylesheet' href="{{asset('assets/css/materialdesignicons.min')}}" /> -->
    <link rel='stylesheet' href="{{asset('assets/css/admin.css')}}" />
    <link rel='stylesheet' href="{{asset('assets/css/theme-default.min.css')}}" />
    <link rel='stylesheet' href="{{asset('assets/css/datatable.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>

<body class="sidebar-pinned page-home">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    @include('common.notification')
    <style type="text/css">
        .error {
            color: red;
        }
    </style>

    @include('Admin.Layout.topheader1') 
    @yield('content')
    @include('Admin.Layout.topheader2')

    <script src="{{asset('assets/js/vendors.js')}}"></script>
    <script src="{{asset('assets/js/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/js/dashboard-01.js')}}"></script>
    <script src="{{asset('assets/js/vendor.js')}}"></script>
    <script src="{{asset('assets/js/jquery.form-validator.min.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="{{asset('assets/js/form-validation.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on("click", '.del_btn', function() {
                return confirm("Do you want to delete it ?");
            });
        });
    </script>
</body>

</html>