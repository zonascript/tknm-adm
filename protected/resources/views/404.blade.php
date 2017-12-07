<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('/images/LOGO_FIX_GRAM.png') }}">

    <title>Tokenomy Admin</title>

    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="{{ asset('/assets/vendor_components/bootstrap/dist/css/bootstrap.min.css') }}">

    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="{{ asset('/assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css') }}">

    <!-- font awesome -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor_components/font-awesome/css/font-awesome.min.css') }}">

    <!-- ionicons -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor_components/Ionicons/css/ionicons.min.css') }}">

    <!-- theme style -->
    <link rel="stylesheet" href="{{ asset('/css/dashboard/master_style.css') }}">

    <!-- minimal_admin skins. choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('/css/dashboard/skins/_all-skins.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

</head>
<body class="hold-transition">
<div class="error-body">
    <div class="error-page">

        <div class="error-content">
            <div class="container">

                <h2 class="headline text-yellow"> 404</h2>

                <h3 class="margin-top-0"><i class="fa fa-warning text-yellow"></i> PAGE NOT FOUND !</h3>

                <p>
                    YOU SEEM TO BE TRYING TO FIND YOUR WAY HOME
                </p>
                <div class="text-center">
                    <a href="{{URL::to("/")}}" class="btn btn-info btn-block btn-flat margin-top-10">Back to dashboard</a>
                </div>
            </div>
        </div>
        <!-- /.error-content -->
        <footer class="main-footer">
            Copyright 2017 Tokenomy. All Rights Reserved.
        </footer>

    </div>
    <!-- /.error-page -->
</div>


<!-- jQuery 3 -->
<script src="{{ asset('/assets/vendor_components/jquery/dist/jquery.min.js') }}"></script>

<!-- popper -->
<script src="{{ asset('/assets/vendor_components/popper/dist/popper.min.js') }}"></script>

<!-- Bootstrap 4.0-->
<script src="{{ asset('/assets/vendor_components/bootstrap/dist/js/bootstrap.js') }}"></script>

</body>
</html>