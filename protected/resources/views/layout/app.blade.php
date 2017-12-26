<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('/images/LOGO_FIX_GRAM.png') }}">

    <title>Tokenomy Admin</title>

    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="{{ asset('/assets/vendor_components/bootstrap/dist/css/bootstrap.css') }}">

    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="{{ asset('/assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css') }}">

    <!-- font awesome -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor_components/font-awesome/css/font-awesome.css') }}">

    <!-- ionicons -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor_components/Ionicons/css/ionicons.css') }}">

    <!-- theme style -->
    <link rel="stylesheet" href="{{ asset('/css/dashboard/master_style.css') }}">

    <!-- minimal_admin skins. choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('/css/dashboard/skins/_all-skins.css') }}">

    <!-- weather weather -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor_components/weather-icons/weather-icons.css') }}">

    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor_components/jvectormap/jquery-jvectormap.css') }}">

    <!-- date picker -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.css') }}">

    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css') }}">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- google analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-108819104-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-108819104-1');
    </script>

</head>

<div id="divAddressCount">

</div>

<body class="hold-transition skin-black-light sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{URL::to("/")}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="{{ asset('/images/LOGO_FIX_GRAM.png') }}" style="width: 40px;height: 40px"  alt=""></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><img src="{{ asset('/images/LOGO_TOKENOMY-_COLOR.png') }}" style="width: 180px;height: 30px" alt=""></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            @if($userProfile['photo'] == '')
                                <img src="{{ asset('/uploads/photo/default.jpg') }}" class="user-image rounded-circle" alt="User Image">
                            @endif
                            @if($userProfile['photo'] != '')
                                <img src="{{ asset('/uploads/photo/'.$userProfile['photo']) }}" class="user-image rounded-circle" alt="User Image">
                            @endif
                        </a>
                        <ul class="dropdown-menu scale-up">
                            <!-- User image -->
                            <li class="user-header">
                                @if($userProfile['photo'] == '')
                                    <img src="{{ asset('/uploads/photo/default.jpg') }}" class="float-left rounded-circle" alt="User Image">
                                @endif
                                @if($userProfile['photo'] != '')
                                    <img src="{{ asset('/uploads/photo/'.$userProfile['photo']) }}" class="float-left rounded-circle" alt="User Image">
                                @endif

                                <p>
                                    {{ $userProfile['name'] }}
                                    <small class="mb-5">{{ $userProfile['email'] }}</small>
{{--                                    <a href="{{URL::to("/profile")}}" class="btn btn-danger btn-sm">View Profile</a>--}}
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" data-toggle="modal" data-target="#changePasswordModal" class="btn btn-block btn-danger"><i class="fa fa-lock"></i> Change Password</a>
                                </div>
                                <div class="pull-right">
                                    <form method="post" action="{{ route('logout') }}">
                                        {!! csrf_field() !!}
                                        <a href="javascript:;" onclick="parentNode.submit();" class="btn btn-block btn-danger"><i class="ion ion-power"></i> Logout</a>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    @if (session('pwd_success'))
        <div class="myadmin-alert myadmin-alert-icon myadmin-alert-click alert-success myadmin-alert-top alerttop"> <i class="ti-user"></i> {{ session('pwd_success') }} <a href="#" class="closed">&times;</a> </div>
    @endif
    @if (session('pwd_fail'))
        <div class="myadmin-alert myadmin-alert-icon myadmin-alert-click alert-error myadmin-alert-top alerttop"> <i class="ti-user"></i>
            {{ session('pwd_fail') }}
            @if($errors)
                {{ $errors->first() }}
            @endif
            <a href="#" class="closed">&times;</a>
        </div>
    @endif


    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="image float-left">
                    @if($userProfile['photo'] == '')
                        <img src="{{ asset('/uploads/photo/default.jpg') }}" class="rounded-circle" alt="User Image">
                    @endif
                    @if($userProfile['photo'] != '')
                        <img src="{{ asset('/uploads/photo/'.$userProfile['photo']) }}" class="rounded-circle" alt="User Image">
                    @endif
                </div>
                <div class="info float-left">
                    <p>{{ $userProfile['name'] }}</p>
                </div>

            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">

                <li class="{{ Active::check(['home','/'],true) }}">
                    <a href="{{URL::to("/")}}">
                        <i class="fa fa-home"></i> <span>Home</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                </li>
                @if(isset($userMenu))
                    @foreach($userMenu as $menu)
                        @php
                            $path = $menu['path'];
                        @endphp
                        @if(isset($menu['child']))
                            <li class="treeview {{ Active::check($menu['childPath'],true) }}">
                                <a href="#">
                                    <i class="fa {{ $menu['icon'] }}"></i>
                                    <span>{{ $menu['name'] }}</span>
                                    <span class="pull-right-container">
                                  <i class="fa fa-angle-left pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    @foreach($menu['child'] as $childMenu)
                                        @php
                                            $childPath = $childMenu->path;
                                        @endphp
                                        <li class="{{ Active::check([$childPath],true) }}"><a href="{{URL::to("/$childPath")}}">{{ $childMenu->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="{{ Active::check($menu['path'],true) }}">
                                <a href="{{URL::to("/$path")}}">
                                    <i class="fa {{ $menu['icon'] }}"></i> <span>{{ $menu['name'] }}</span>
                                    <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif

            </ul>
        </section>

    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @yield('content-header')

    <!-- Main content -->
        <section class="content">

            @yield('content')

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right d-none d-sm-inline-block">
        </div>Copyright &copy; 2017 Tokenomy. All Rights Reserved.
    </footer>

    <!-- modal -->
    <div id="changePasswordModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Change Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-element" method="POST" action="{{ URL::to("/changepassword") }}">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <input type="text" name="id" value="{{ $userProfile['id'] }}" hidden>
                            <div class="form-group row">
                                <label for="name" class="col-sm-5 control-label">Name</label>

                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="name" value="{{ $userProfile['name'] }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-5 control-label">Email</label>

                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="email" value="{{ $userProfile['email'] }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="oldpwd" class="col-sm-5 control-label">Old Password</label>

                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="oldpwd" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-5 control-label">New Password</label>

                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirmation" class="col-sm-5 control-label">Re-type Password</label>

                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">Save</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('/assets/vendor_components/jquery/dist/jquery.js') }}"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('/assets/vendor_components/jquery-ui/jquery-ui.js') }}"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- popper -->
<script src="{{ asset('/assets/vendor_components/popper/dist/popper.min.js') }}"></script>

<!-- Bootstrap 4.0-->
<script src="{{ asset('/assets/vendor_components/bootstrap/dist/js/bootstrap.js') }}"></script>

<!-- ChartJS -->
<script src="{{ asset('/assets/vendor_components/chart-js/chart.js') }}"></script>

<!-- Sparkline -->
<script src="{{ asset('/assets/vendor_components/jquery-sparkline/dist/jquery.sparkline.js') }}"></script>

<!-- jvectormap -->
<script src="{{ asset('/assets/vendor_plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('/assets/vendor_plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

<!-- jQuery Knob Chart -->
<script src="{{ asset('/assets/vendor_components/jquery-knob/js/jquery.knob.js') }}"></script>

<!-- daterangepicker -->
<script src="{{ asset('/assets/vendor_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

<!-- datepicker -->
<script src="{{ asset('/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('/assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}"></script>

<!-- Slimscroll -->
<script src="{{ asset('/assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

<!-- FastClick -->
<script src="{{ asset('/assets/vendor_components/fastclick/lib/fastclick.js') }}"></script>

<!-- minimal_admin App -->
<script src="{{ asset('/js/dashboard/template.js') }}"></script>

<!-- minimal_admin dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('/js/dashboard/pages/dashboard.js') }}"></script>

<!-- minimal_admin for demo purposes -->
<script src="{{ asset('/js/dashboard/demo.js') }}"></script>

<!-- weather for demo purposes -->
<script src="{{ asset('/assets/vendor_plugins/weather-icons/WeatherIcon.js') }}"></script>

<!-- toast -->
<script src="{{ asset('/assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js') }}"></script>
<script src="{{ asset('/js/dashboard/pages/toastr.js') }}"></script>

<script type="text/javascript">
    $( document ).ready(function() {
        $(".alerttop").fadeToggle(350);

        //cek sisa address
//        $.ajax({
//            url: 'getAddressCount',
//            error: function() {
//            },
//            success: function(data) {
//                var addressCount = data;
//                if(addressCount < 10){
//                    document.getElementById('divAddressCount').innerHTML = '<div class="myadmin-alert myadmin-alert-icon myadmin-alert-click alert-error myadmin-alert-top alerttop"> Prepared address count < 10! Please contact IT Team! <a href="#" class="closed">&times;</a> </div>';
//                }
//
//                $(".alerttop").fadeToggle(350);
//
//                $(".myadmin-alert .closed").click(function(event) {
//                    $(this).parents(".myadmin-alert").fadeToggle(350);
//                    return false;
//                });
//            },
//            type: 'GET'
//        });

    });

    $(".myadmin-alert .closed").click(function(event) {
        $(this).parents(".myadmin-alert").fadeToggle(350);
        return false;
    });

    //cek sisa address
//    setInterval(function(){
//        $.ajax({
//            url: 'getAddressCount',
//            error: function() {
//            },
//            success: function(data) {
//                var addressCount = data;
//                if(addressCount < 10){
//                    document.getElementById('divAddressCount').innerHTML = '<div class="myadmin-alert myadmin-alert-icon myadmin-alert-click alert-error myadmin-alert-top alerttop"> Prepared address count < 10! Please contact IT Team! <a href="#" class="closed">&times;</a> </div>';
//                }
//
//                $(".alerttop").fadeToggle(350);
//
//                $(".myadmin-alert .closed").click(function(event) {
//                    $(this).parents(".myadmin-alert").fadeToggle(350);
//                    return false;
//                });
//            },
//            type: 'GET'
//        });
//    }, 180000);


</script>

@yield('add-js')

</body>
</html>
