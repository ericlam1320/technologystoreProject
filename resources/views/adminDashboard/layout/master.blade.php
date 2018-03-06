<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <base href="{{asset('')}}"> <!--  Trở lại thư mục gốc (css,js)  -->
    <link rel="apple-touch-icon" sizes="76x76" href="adminassets/assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="adminassets/assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('tittle')</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="adminassets/assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="adminassets/assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="adminassets/assets/css/demo.css" rel="stylesheet" />
    <link href="adminassets/assets/css/styleadmin.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="adminassets/assets/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="adminassets/assets/ckfinder/ckfinder.js"></script>

</head>





<body>
    <div class="wrapper">
        <div class="sidebar" data-color="purple" data-image="adminassets/assets/img/sidebar-1.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <!-- Logo -->
            <div class="logo">
                <a href="" class="simple-text">
                    TechnologyStore
                </a>
            </div>

            <!-- Side Bar -->
            @yield('sidebar')


        </div>


        <div class="main-panel">
            <!-- Header -->
            @include('adminDashboard.layout.header')


            <!-- Content -->
            @yield('content')

            <!-- Footer -->
            @include('adminDashboard.layout.footer')

        </div>
    </div>
</body>





<!--   Core JS Files   -->
<script src="adminassets/assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="adminassets/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="adminassets/assets/js/material.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="adminassets/assets/js/chartist.min.js"></script>
<!--  Dynamic Elements plugin -->
<script src="adminassets/assets/js/arrive.min.js"></script>
<!--  PerfectScrollbar Library -->
<script src="adminassets/assets/js/perfect-scrollbar.jquery.min.js"></script>
<!--  Notifications Plugin    -->
<script src="adminassets/assets/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Material Dashboard javascript methods -->
<script src="adminassets/assets/js/material-dashboard.js?v=1.2.0"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="adminassets/assets/js/demo.js"></script>
<script src="adminassets/assets/js/myscript.js"></script>
</html>
