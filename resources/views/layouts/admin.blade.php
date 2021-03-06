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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js" integrity="sha256-nZaxPHA2uAaquixjSDX19TmIlbRNCOrf5HO1oHl5p70=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" integrity="sha256-TQq84xX6vkwR0Qs1qH5ADkP+MvH0W+9E7TdHJsoIQiM=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js" integrity="sha256-8zyeSXm+yTvzUN1VgAOinFgaVFEFTyYzWShOy9w7WoQ=" crossorigin="anonymous"></script>

    <!-- Fonts https://fontawesome.com/v4.7.0/icons/ -->
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/jquery.dialog.min.css') }}">
    <link href="{{ asset('css/bootstrap.css') }}" rel='stylesheet' type='text/css' /><!-- bootstrap css -->
    <link href="{{ asset('css/styleadmin.css') }}" rel='stylesheet' type='text/css' /><!-- custom css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css" integrity="sha256-IvM9nJf/b5l2RoebiFno92E5ONttVyaEEsdemDC6iQA=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" integrity="sha256-aa0xaJgmK/X74WM224KMQeNQC2xYKwlAt08oZqjeF0E=" crossorigin="anonymous" />

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
                <b class="logo-abbr mr-2"><img src=" {{ asset('images/logo.png') }} " alt=""> </b>
                <span class="logo-compact "><img src="{{ asset('images/logo-compact.png') }}" alt=""></span>
                <span class="brand-title ml-4 mt-2">
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
                            <span class="badge gradient-1 badge-pill badge-primary">{{\App\Passenger::where('Stars', '!=' ,0)->where('LogicalDelete', 0)->orderByDesc('updated_at')->paginate(3)->count()}}</span>
                        </a>
                        <div class="drop-down animated fadeIn dropdown-menu">
                            <div class="dropdown-content-heading ">
                                <ul class="row">
                                    <li class="mb-1">Последние отзывы:</li>
                                    @foreach (\App\Passenger::where('Stars', '!=' ,0)->where('LogicalDelete', 0)->orderByDesc('updated_at')->paginate(3) as $passeger)
                                    <li class="mb-1">                                
                                        <a href="{{route('tours.show', $passeger->tours_id)}}">{{$passeger->customer->Name . ' ' . $passeger->customer->Surname . ' ' . ($passeger->customer->Middle_Name ?? '') . '. Экскурсия: ' . $passeger->tour->Name_Tours . ' ' .  date('H:i d.m.Y',strtotime($passeger->tour->Start_Date_Tours))}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                            <i class="mdi mdi-bell-outline"></i>
                            <span class="badge badge-pill gradient-2 badge-primary">{{\App\Customer::where('Condition',0)->orderByDesc('created_at')->paginate(3)->count() + \App\Tour::whereRaw('Start_Date_Tours >= ? and Start_Date_Tours <= ? ',[Carbon\Carbon::now(),Carbon\Carbon::now()->addDays(14)])->where('LogicalDelete', 0)->orderBy('Start_Date_Tours')->paginate(3)->count() + \App\Tour::where('End_Date_Tours', '<=' ,Carbon\Carbon::now())->where('LogicalDelete', 0)->where('Confirmation_Tours', 0)->orderByDesc('created_at')->paginate(3)->count()}}</span>
                        </a>
                        <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                            <div class="dropdown-content-heading ">
                                <ul class="row">
                                    <li class="mb-2">Последние не подтверждённые пользователи:</li>
                                    @foreach (\App\Customer::where('Condition',0)->where('LogicalDelete', 0)->orderByDesc('created_at')->paginate(3) as $customer)
                                    <li class="mb-1">                                
                                        <a href="{{route('customer.edit', $customer->id)}}">{{$customer->Name . ' ' . $customer->Surname . ' ' . $customer->Middle_Name ?? ''}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                <ul class="row mt-3">
                                    <li class="mb-2">Скорые мероприятия:</li>
                                    @foreach (\App\Tour::whereRaw('Start_Date_Tours >= ? and Start_Date_Tours <= ? ',[Carbon\Carbon::now(),Carbon\Carbon::now()->addDays(14)])->where('LogicalDelete', 0)->orderBy('Start_Date_Tours')->paginate(3) as $tour)
                                    <li class="mb-1">                     
                                        <a href="{{route('tours.show', $tour->id)}}">{{$tour->Name_Tours . ' ' .  date('H:i d.m.Y',strtotime($tour->Start_Date_Tours))}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                <ul class="row mt-3">
                                    <li class="mb-2">Мероприятия ожидающие подтверждения:</li>
                                    @foreach (\App\Tour::where('End_Date_Tours', '<=' ,Carbon\Carbon::now())->where('LogicalDelete', 0)->where('Confirmation_Tours', 0)->orderByDesc('created_at')->paginate(3) as $tour)
                                    <li class="mb-1">                     
                                        <a href="{{route('tourcomplite', $tour->id)}}">{{$tour->Name_Tours . ' ' .  date('H:i d.m.Y',strtotime($tour->Start_Date_Tours))}}</a>
                                    </li>
                                    @endforeach
                                </ul>
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
                                    <li><a href="">Русский</a></li>
                                    <li><a href="">В разработке</a></li>
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
                                        <a  class="fa fa-window-restore" href="{{ route('/') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();" style="display: inline !important;">
                                            На главную
                                        </a>
                                    </li>
                                    <li>
                                        <a  class="fa fa-sign-out" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="display: inline !important;">
                                            Выйти
                                        </a>
                                    </li>
                                    <li>
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
                <li class="nav-label">Сотрудники/Клиенты</li>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icon-speedometer menu-icon"></i><span class="nav-text">Сотрудники</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('employees.index') }}">Сотрудники</a></li>
                        <li><a href="{{ route('employees.indexdelete') }}">Удалённые сотрудники</a></li>
{{--                        <li><a href="{{ route('job.index') }}">Должности</a></li>--}}
                        <!-- <li><a href="./index-2.html">Home 2</a></li> -->
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icon-note menu-icon"></i><span class="nav-text">Клиенты</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('customer.index') }}">Клиенты</a></li>
                        <li><a href="{{ route('customer.indexdelete') }}">Удалённые клиенты</a></li>
                    </ul>
                </li>
                <li class="nav-label">Экскурсионный отдел</li>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icon-envelope menu-icon"></i><span class="nav-text">Партнёры</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('partners.index') }}">Партнёры</a></li>
                        <li><a href="{{ route('partners.indexdelete') }}">Удалённые Партнёры</a></li>
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
            <p>&copy;  <a href="https://themeforest.net/user/quixlab">Мечты сбываются</a> 2020</p>
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
<script src="{{asset('js/plugins/tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins/tables/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/plugins/tables/js/datatable-init/datatable-basic.min.js')}}"></script>
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

    @stack('scripts')
</html>
</html>