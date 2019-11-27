<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Мечты сбываются</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="ЛЯЛЯ сделать что-нибудь здесь" />

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.maskedinput.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{ asset('js/jquery.dialog.min.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>



    <!-- Fonts -->
    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('css/jquery.dialog.min.css') }}">
    <link href="{{ asset('css/bootstrap.css') }}" rel='stylesheet' type='text/css' /><!-- bootstrap css -->
    <link href="{{ asset('css/styleadmin.css') }}" rel='stylesheet' type='text/css' /><!-- custom css -->


</head>
<body>
<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
        </svg>
    </div>
</div>
<!--*******************
    Preloader end
********************-->


<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <div class="brand-logo">
            <a href="{{ route('/') }}">
                <b class="logo-abbr"><img src=" {{ asset('images/logo.png') }} " alt=""> </b>
                <span class="logo-compact"><img src="{{ asset('images/logo-compact.png') }}" alt=""></span>
                <span class="brand-title">
                        <img src="{{ asset('images/logo-text.png') }}" alt="">
                    </span>
            </a>
        </div>
    </div>

    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
    <div class="header">
        <div class="header-content clearfix">

            <div class="nav-control">
                <div class="hamburger">
                    <span class="toggle-icon"><i class="icon-menu"></i></span>
                </div>
            </div>
            <div class="header-right">
                <ul class="clearfix">
                    <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                            <i class="mdi mdi-email-outline"></i>
                            <span class="badge gradient-1 badge-pill badge-primary">0</span>
                        </a>
                        <div class="drop-down animated fadeIn dropdown-menu">
                            <div class="dropdown-content-heading d-flex justify-content-between">
                                <span class="">Новые сообщения</span>

                            </div>
                        </div>
                    </li>
                    <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                            <i class="mdi mdi-bell-outline"></i>
                            <span class="badge badge-pill gradient-2 badge-primary">0</span>
                        </a>
                        <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                            <div class="dropdown-content-heading d-flex justify-content-between">
                                <span class="">Новые уведомления</span>

                            </div>
                        </div>
                    </li>
                    <li class="icons dropdown d-none d-md-flex">
                        <a href="javascript:void(0)" class="log-user"  data-toggle="dropdown">
                            <span>Русский</span>  <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                        </a>
                        <div class="drop-down dropdown-language animated fadeIn  dropdown-menu">
                            <div class="dropdown-content-body">
                                <ul>
                                    <li><a href="javascript:void()">Русский</a></li>
                                    <li><a href="javascript:void()">В разработке</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="icons dropdown">
                        <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                            <!--**********************************
                            <span class="activity active"></span>
                            Кружок непрочтённых сообщений
                            ***********************************-->
                            <img src="{{ asset('images/user/1.png') }}" height="40" width="40" alt="">
                        </div>
                        <div class="drop-down dropdown-profile   dropdown-menu">
                            <div class="dropdown-content-body">
                                <ul>
                                    <!--**********************************
                                     <li>
                                        <a href="app-profile.html"><i class="icon-user"></i> <span>Профиль</span></a>
                                    </li>
                                    ***********************************-->

                                    <li>
                                        <a href="#"><i class="icon-envelope-open"></i> <span>Входящие</span> <div class="badge gradient-3 badge-pill badge-primary">0</div></a>
                                    </li>

                                    <hr class="my-2">
                                    <li>
                                        <a  class="icon-key" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="display: inline !important;">
                                            Выйти
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--**********************************
        Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <div class="nk-sidebar">
        <div class="nk-nav-scroll">
            <ul class="metismenu" id="menu">
                <li class="nav-label">Аналитика</li>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icon-graph menu-icon"></i>
                        <span class="nav-text">Информация</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('/admin') }}">Собранные данные</a></li>
                    </ul>
                </li>
                <li class="nav-label">Работники/Клиенты</li>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icon-speedometer menu-icon"></i><span class="nav-text">Работники</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('employees.index') }}">Работники</a></li>
                        <li><a href="{{ route('job.index') }}">Должности</a></li>
                        <!-- <li><a href="./index-2.html">Home 2</a></li> -->
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icon-note menu-icon"></i><span class="nav-text">Клиенты</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('customer.index') }}">Клиенты</a></li>
                    </ul>
                </li>
                <li class="nav-label">Экскурсионный отдел</li>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icon-envelope menu-icon"></i><span class="nav-text">Партнёры</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('partners.index') }}">Партнёры</a></li>
                        <!-- <li><a href="./index-2.html">Home 2</a></li> -->
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Экскурсии</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('tours.index') }}">Экскурсии</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--**********************************
        Sidebar end
    ***********************************-->

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">

        <!-- row -->
    @yield('content')
        <!-- #/ container -->
    </div>
    <!--**********************************
        Content body end
    ***********************************-->


    <!--**********************************
        Footer start
    ***********************************-->
    <div class="footer">
        <div class="copyright">
            <p>&copy;  <a href="https://themeforest.net/user/quixlab">Мечты сбываются</a> 2019</p>
        </div>
    </div>
    <!--**********************************
        Footer end
    ***********************************-->
</div>
<!--**********************************
    Main wrapper end
***********************************-->
<script src="{{ asset('js/plugins/common/common.min.js') }}"></script>
<script src="{{ asset('js/js/custom.min.js') }}"></script>
<script src="{{ asset('js/js/settings.js') }}"></script>
<script src="{{ asset('js/js/gleek.js') }}"></script>
<script src="{{ asset('js/js/styleSwitcher.js') }}"></script>


{{--<script src="https://momentjs.com/downloads/moment.js"></script>--}}
{{--<script src="{{ asset('js/js/bootstrap-material-datetimepicker.js') }}"></script>--}}
<!-- Clock Plugin JavaScript -->
<script src="{{ asset('js/plugins/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>
<!-- Color Picker Plugin JavaScript -->
<script src="{{ asset('js/plugins/jquery-asColorPicker-master/libs/jquery-asColor.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js') }}"></script>
<!-- Date Picker Plugin JavaScript -->
<script src="{{ asset('js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<!-- Date range Plugin JavaScript -->
<script src="{{ asset('js/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('js/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

{{--<script src="{{ asset('js/js/plugins-init/form-pickers-init.js') }}"></script>--}}

<script src="{{ asset('js/plugins/validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/validation/jquery.validate-init.js') }}"></script>
<script  src="{{ asset('js/js/jquery.printPage.js') }}"></script>

{{--Зафиксированный хедер--}}
{{--<script>hljs.initHighlightingOnLoad();</script>--}}
{{--<script>--}}
{{--    (function($) {--}}
{{--        "use strict"--}}

{{--        new quixSettings({--}}
{{--            version: "light", //2 options "light" and "dark"--}}
{{--            layout: "vertical", //2 options, "vertical" and "horizontal"--}}
{{--            navheaderBg: "color_1", //have 10 options, "color_1" to "color_10"--}}
{{--            headerBg: "color_1", //have 10 options, "color_1" to "color_10"--}}
{{--            sidebarStyle: "full", //defines how sidebar should look like, options are: "full", "compact", "mini" and "overlay". If layout is "horizontal", sidebarStyle won't take "overlay" argument anymore, this will turn into "full" automatically!--}}
{{--            sidebarBg: "color_1", //have 10 options, "color_1" to "color_10"--}}
{{--            sidebarPosition: "static", //have two options, "static" and "fixed"--}}
{{--            headerPosition: "fixed", //have two options, "static" and "fixed"--}}
{{--            containerLayout: "wide",  //"boxed" and  "wide". If layout "vertical" and containerLayout "boxed", sidebarStyle will automatically turn into "overlay".--}}
{{--            direction: "ltr" //"ltr" = Left to Right; "rtl" = Right to Left--}}
{{--        });--}}


{{--    })(jQuery);--}}
{{--</script>--}}


</div>

</body>

</html>
</html>