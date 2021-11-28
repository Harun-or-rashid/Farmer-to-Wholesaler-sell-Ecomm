<!DOCTYPE html>
<html>
<head>
    @include('backend.layout_partials._head')
</head>
<body class="hold-transition sidebar-mini">

<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <span>58%</span>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
        </div>
    </div>
</div>


<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    @include('backend.layout_partials._navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('backend.layout_partials._sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('backend.layout_partials._breadcrumb')

        @yield('main_content')

    </div>
    <!-- /.content-wrapper -->

    @include('backend.layout_partials._footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('backend.layout_partials._scripts')
</body>
</html>
