<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />


    <title>{{$page_title}}</title>

    <!-- Bootstrap -->
    <link href="{{url('public/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{url('public/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{url('public/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{url('public/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{url('public/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{url('public/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{url('public/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{url('public/build/css/custom.min.css')}}" rel="stylesheet">
    <link href="{{url('public/css/toastr.min.css')}}" rel="stylesheet">
    <link href="{{url('public/css/jquery.bootgrid.min.css')}}" rel="stylesheet">
    @yield('header-styles')
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        @include('common.side_bar')

        <!-- top navigation -->
        @include('common.top_nav')
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <!-- top tiles -->
            <div class="title_left">
                <h3>{{$page_heading}}</h3>
                <div class="clearfix"></div>
                @yield('main-section')
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<!-- jQuery -->
<script src="{{url('public/vendors/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{url('public/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{url('public/vendors/fastclick/lib/fastclick.js')}}"></script>
<!-- NProgress -->
<script src="{{url('public/vendors/nprogress/nprogress.js')}}"></script>
<!-- Chart.js -->
<script src="{{url('public/vendors/Chart.js/dist/Chart.min.js')}}"></script>
<!-- gauge.js -->
<script src="{{url('public/vendors/gauge.js/dist/gauge.min.js')}}"></script>
<!-- bootstrap-progressbar -->
<script src="{{url('public/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
<!-- iCheck -->
<script src="{{url('public/vendors/iCheck/icheck.min.js')}}"></script>
<!-- Skycons -->
<script src="{{url('public/vendors/skycons/skycons.js')}}"></script>
<!-- Flot -->
<script src="{{url('public/vendors/Flot/jquery.flot.js')}}"></script>
<script src="{{url('public/vendors/Flot/jquery.flot.pie.js')}}"></script>
<script src="{{url('public/vendors/Flot/jquery.flot.time.js')}}"></script>
<script src="{{url('public/vendors/Flot/jquery.flot.stack.js')}}"></script>
<script src="{{url('public/vendors/Flot/jquery.flot.resize.js')}}"></script>
<!-- Flot plugins -->
<script src="{{url('public/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
<script src="{{url('public/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
<script src="{{url('public/vendors/flot.curvedlines/curvedLines.js')}}"></script>
<!-- DateJS -->
<script src="{{url('public/vendors/DateJS/build/date.js')}}"></script>
<!-- JQVMap -->
<script src="{{url('public/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
<script src="{{url('public/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
<script src="{{url('public/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{url('public/vendors/moment/min/moment.min.js')}}"></script>
<script src="{{url('public/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

<!-- Custom Theme Scripts -->
<script src="{{url('public/build/js/custom.min.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var ajax_loader = '<img src="{{url('public/images/ajax_loader.gif')}}" width="50px" height="50px">';
</script>
<script src="{{url('public/js/toastr.min.js')}}"></script>
<script>
    $(document).ready(function () {
        toastr.options.progressBar = true;
        toastr.options.preventDuplicates = true;
        toastr.options.closeDuration = 300;
        toastr.options.closeButton = true;
    });
</script>

<script src="{{url('public/js/jquery.bootgrid.min.js')}}"></script>
<script src="{{url('public/js/jquery.bootgrid.fa.min.js')}}"></script>
<script>
    @if(Session::has('success'))
    toastr.success("{{Session::pull('success')}}");
    @endif
    @if(Session::has('error'))
    toastr.error("{{Session::pull('error')}}");
    @endif
</script>
@yield('footer-scripts')
</body>
</html>
