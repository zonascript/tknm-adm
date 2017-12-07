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
<body class="hold-transition register-page">
<div class="login-box">
    <div class="login-logo">
        <b>Tokenomy</b>Admin
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Register a new account</p>

        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Full name" name="name" value="{{ old('name') }}" required autofocus>
                <span class="ion ion-person form-control-feedback "></span>
            </div>
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                <span class="ion ion-email form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password" required>
                <span class="ion ion-locked form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation" required>
                <span class="ion ion-log-in form-control-feedback "></span>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-info btn-block btn-flat margin-top-10" style="font-size:15px">REGISTER</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <div class="margin-top-30 text-center">
            <p>Already have an account? <a href="{{URL::to("/login")}}" class="text-info m-l-5">Sign In</a></p>
        </div>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<!-- jQuery 3 -->
<script src="{{ asset('/assets/vendor_components/jquery/dist/jquery.min.js') }}"></script>

<!-- popper -->
<script src="{{ asset('/assets/vendor_components/popper/dist/popper.min.js') }}"></script>

<!-- Bootstrap 4.0-->
<script src="{{ asset('/assets/vendor_components/bootstrap/dist/js/bootstrap.js') }}"></script>

</body>
</html>

