
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! asset('assets/backend/plugins/fontawesome-free/css/all.min.css') !!}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{!! asset('assets/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') !!}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{!! asset('assets/backend/plugins/select2/css/select2.min.css') !!}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{!! asset('assets/backend/dist/css/adminlte.min.css') !!}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
@yield('main_content')

<!-- jQuery -->
<script src="{!! asset('assets/backend/plugins/jquery/jquery.min.js') !!}"></script>
<!-- Bootstrap 4 -->
<script src="{!! asset('assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- Select2 -->
<script src="{!! asset('assets/backend/plugins/select2/js/select2.full.min.js') !!}"></script>
<!-- AdminLTE App -->
<script src="{!! asset('assets/backend/dist/js/adminlte.min.js') !!}"></script>

<script>
    //Initialize Select2 Elements
    $('.select2').select2()
</script>
</body>
</html>
