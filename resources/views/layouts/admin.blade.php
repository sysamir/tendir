<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ Auth::guard('admin')->user()->role->display_name }}</title>

    <!-- Custom Theme Style -->
    <link href="{{ elixir('admin/style.css') }}" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="/" class="site_title">
                        <img style="width: 85%;" src="{{ asset('icons/logo.png') }}">
                    </a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                        <img src="/icons/avatar.png" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <h2>{{ Auth::guard('admin')->user()->name }}</h2>
                        <span>{{ Auth::guard('admin')->user()->role->display_name }}</span>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu ">
                    <div class="menu_section">
                        <h3>&nbsp</h3>
                        <ul class="nav side-menu">

                            <li>
                                <a href="/"><i class="fa fa-home"></i> Dashboard </a>
                            </li>

                            @permission('users-read')
                            <li>
                                <a href="{{ route('users.index') }}"><i class="fa fa-users"></i> Users </a>
                            </li>
                            @endpermission

                            @permission('companies-read')
                            <li>
                                <a href="{{ route('companies.index') }}"><i class="fa fa-suitcase"></i> Companies </a>
                            </li>
                            @endpermission

                            @permission('tenders-read')
                            <li>
                                <a href="#"><i class="fa fa-sort-alpha-desc"></i> Tenders </a>
                            </li>
                            @endpermission

                            @permission('appeals-read')
                            <li>
                                <a href="#"><i class="fa fa-signing"></i> Appeals </a>
                            </li>
                            @endpermission

                            @permission('emails-read')
                            <li>
                                <a href="#"><i class="fa fa-envelope"></i> Emails </a>
                            </li>
                            @endpermission

                            @permission('settings-read')
                            <li>
                                <a href="#"><i class="fa fa-sliders"></i> Settings </a>
                            </li>
                            @endpermission

                            @permission('admin_in_menu-view')
                            <li>
                                <a>
                                    <i class="fa fa-magic"></i> Admin <span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    @permission('admins-read')
                                    <li><a href="{{ route('admins.index') }}">Admins</a></li>
                                    @endpermission

                                    @permission('roles-read')
                                    <li><a href="{{ route('roles.index') }}">Roles</a></li>
                                    @endpermission

                                    {{--@permission('permissions-read')
                                    <li><a href="#">Permissions</a></li>
                                    @endpermission--}}
                                </ul>
                            </li>
                            @endpermission

                            @permission('bugs-read')
                            <li>
                                <a href="/logs"><i class="fa fa-bug"></i> Bugs </a>
                            </li>
                            @endpermission

                        </ul>
                    </div>

                </div>
                <!-- /sidebar menu -->

                {{--<!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a href="/logout" data-toggle="tooltip" data-placement="top" title="Logout">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->--}}
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

            <div class="nav_menu">
                <nav class="" role="navigation">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                <img src="/icons/avatar.png" alt="">{{ Auth::guard('admin')->user()->name }}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>

        </div>
        <!-- /top navigation -->


        <!-- page content -->
        <div class="right_col" role="main">
            @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Developed by <a target="_blank" href="http://nijatasadov.com">Nijat Asadov</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<!-- Pusher -->
<script src="https://js.pusher.com/3.1/pusher.min.js"></script>

<!-- Google MAP -->
{{--<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=true&libraries=places'></script>--}}

<!-- Custom Theme Scripts -->
<script src="{{ elixir('admin/script.js') }}"></script>

@stack('scripts')
<script>

    /*Pusher.logToConsole = true;

    var pusher = new Pusher('1b98eeb45224eec0d4e6', {
        encrypted: true
    });

    var channel = pusher.subscribe('desktop');
    channel.bind('admin', function (data) {
        desktopNotification(data);
    });

    function desktopNotification(data) {
        if (!Notification) {
            alert('Desktop notifications not available in your browser. Try Chromium.');
            return;
        }

        if (Notification.permission !== "granted")
            Notification.requestPermission();
        else {
            var notification = new Notification(data.title, {
                icon: '',
                body: data.text,
            });

            notification.onclick = function () {
                window.open(data.url);
            };

        }
        new PNotify({
            title: data.title,
            text: data.text,
            type: data.type,
            hide: false,
            styling: 'bootstrap3'
        });
    }*/
</script>

@include('sweet::alert')
</body>
</html>