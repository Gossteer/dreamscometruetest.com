<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<title>Мечты сбываются</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta name="keywords" content="ЛЯЛЯ сделать что-нибудь здесь" />

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>


	

	<!-- Theme main style -->
		<link rel="stylesheet" href="{{ asset('single/style.css') }}">
	<!-- Scripts -->
		<script src="{{ asset('js/bootstrap.js') }}" ></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://kit.fontawesome.com/6947640373.js" ></script>
		<script src="https://unpkg.com/tooltip.js" ></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"  crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"  crossorigin="anonymous"></script>
		<script src="{{ asset('js/jquery.maskedinput.min.js') }}" ></script>
		<script src="{{ asset('js/jquery.dialog.min.js') }}" ></script>


	<!-- Fonts -->
		<link rel="stylesheet" href="{{ asset('css/jquery.dialog.min.css') }}">
		<link href="{{ asset('css/bootstrap.css') }}" rel='stylesheet' type='text/css' /><!-- bootstrap css -->
		<link href="{{ asset('css/style.css') }}" rel='stylesheet' type='text/css' /><!-- custom css -->
		<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet"><!-- fontawesome css -->
		<link href="{{ asset('css/css_slider.css') }}" type="text/css" rel="stylesheet" media="all">
		<link rel="dns-prefetch" href="//fonts.gstatic.com">


	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>

	<!-- google fonts -->
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<style>



	</style>

	<script>
		$(document).ready(function(){
			// Фикмированная шапка при скролле
			$("#header").removeClass("default");
			$(window).scroll(function(){
				if ($(this).scrollTop() > 40) {
					$("#header").addClass('default').fadeIn('fast');
				} else {
					$("#header").removeClass("default").fadeIn('fast');
				};
			});
		});
	</script>


{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> --}}


	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" ></script>



</head>
<body>

<!-- header -->
<header class="" id="header" style="line-height: 24px">
	<div class="container ">
		<!-- nav -->
		<nav class="py-md-4 py-3 d-lg-flex" >
			<div id="logo">
				<h1 class="mt-md-0 mt-2" style=""> <a href="{{ route('/') }}"><span class="fa fa-map-signs"></span> Мечты сбываются </a></h1>
			</div>
			<label for="drop" class="toggle" style="line-height: 24px"><span class="fa fa-bars"></span></label>
			<input type="checkbox" id="drop" />
			<ul class="menu ml-auto mt-1">
				<li class=""><a @if(Route::current()->getName() == '/') style="font-weight: bold" @endif href="{{ route('/') }}">Главная</a></li>
				<li class=""><a @if(Route::current()->getName() == '/about') style="font-weight: bold" @endif href="{{ route('/about') }}">О нас</a></li>
				<li class=""><a @if(Route::current()->getName() == '/packages') style="font-weight: bold" @endif href="{{ route('/packages') }}">Экскурсии</a></li>
				<li class=""><a @if(Route::current()->getName() == '/contact') style="font-weight: bold" @endif href="{{ route('/contact') }}">Контакты</a></li>
				<li id="lineNavbar"><br ></li>
				@guest
					<li class=" ">
						<a @if(Route::current()->getName() == 'login') style="font-weight: bold" @endif id="autorizStile" class="" href="{{ route('login') }}" >Войти</a>
					</li>
					@if (Route::has('register'))
						<li class="">
							<a @if(Route::current()->getName() == 'register') style="font-weight: bold" @endif id="autorizStile" class="" href="{{ route('register') }}" >Регистрация</a>
						</li>
					@endif
				@else
					<li class="nav-item dropdown" >
						<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre >
							{{ Auth::user()->login }} <span class="caret"></span>
						</a>

						<div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown" id="navbarDropdownActiv">
							@if(\App\Employee::where('users_id',(Auth::user()->id))->first() != null and Auth::user()->Type_User == 1)
							<a  class="dropdown-item fa fa-address-card-o" style="font-size: 15px" href="{{ route('/admin') }}">
								Админка
							</a>
							@endif
							@if(\App\Customer::where('users_id',(Auth::user()->id))->first() != null)
							<a  class="dropdown-item fa fa-user-o " style="font-size: 15px" href="{{ route('AccountCustomer') }}">
								Профиль
							</a>
							@endif
							<a class="dropdown-item fa fa-sign-out" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="display: inline !important; font-size: 15px ">Выйти</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
					</li>
				@endguest

			</ul>
		</nav>
		<!-- //nav -->
	</div>
</header>
<!-- //header -->


<main class="">
		@yield('content')
</main>

<!--footer -->
<footer>
<section class="footer footer_w3layouts_section_1its py-4">
	<div class="container py-lg-4 py-3">
		<div class="row footer-top">
			<div class="col-lg-4 col-sm-6 footer-grid_section_1its_w3">
				<div class="footer-title">
					<h3>Контакты</h3>
				</div>
				<div class="footer-text">
					<p>Расположение: г. Домодедово, ул. Корнеева</p>
					<p>Телефон: +7 (903) 222-76-59</p>
					<p>Email: <a href="mailto:vidnoe1976@mail.ru">vidnoe1976@mail.ru</a></p>
					<ul class="social_section_1info">
						<li class="mb-2 facebook"><a href="https://www.facebook.com/groups/1537362279648252/about/" class=""><span class="fa fa-facebook"></span></a></li>
						<li class="mb-2 vk"><a href="https://vk.com/dreams_comet" class=""><span class="fa fa-vk"></span></a></li>
						<li class="mb-2 instagram"><a href="https://www.instagram.com/elena_mehtu_sbuvaytsa/"><span class="fa fa-instagram"></span></a></li>
						<li class="mb-2 odnoklassniki"><a href="https://ok.ru/group/55076417896460"><span class="fa fa-odnoklassniki"></span></a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-4 col-sm-6 footer-grid_section mt-sm-0 mt-4">
				<div class="footer-title">
					<h3>О нас</h3>
				</div>
				<div class="footer-text">
					<p>Комфортабельный транспорт, вариативность по тематике, количеству человек, приятные цены, бонусы.
						Организация вашего отдыха в надёжных руках.🎈</p>
					<p><a href="{{ route('/about') }}">Подробнее...</a></p>
				</div>

			</div>

			<div class="col-lg-4 col-sm-6 mt-lg-0 mt-4 footer-grid_section_1its_w3">
				<div class="footer-title">
					<h3>Новости</h3>
				</div>
				<div class="footer-text">
					<p>Для тех кто очень любит путешествовать, открывать новое и культурно отдыхать, мы предлагаем подписаться на наши новости.</p>
					<form action="#" method="post">
						<input type="email" name="Email" placeholder="Введите ваш Email..." required="">
						<button class="btn1"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
						<div class="clearfix"> </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
</footer>
<!-- //footer -->

<!-- copyright -->
<div class="copyright py-2 text-center">
	<p>© 2020 Мечты Сбываются. Все права защищены </p>
</div>
<!-- //copyright -->

<!-- move top -->
<div class="move-top text-right">
	<a href="#home" class="move-top"> 
		<span class="fa fa-angle-up  mb-3" aria-hidden="true"></span>
	</a>
</div>
<!-- move top -->
</body>
	@stack('scripts')
</html>
</html>