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
<meta name="keywords" content="Grand Tour Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Scripts -->
	<script src="{{ asset('js/bootstrap.js') }}" defer></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/6947640373.js"></script>
	<script src="{{ asset('js/jquery.maskedinput.min.js') }}" defer></script>

	<!-- Fonts -->
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

</head>
<body>

<!-- header -->
<header class="" id="header">
	<div class="container ">
		<!-- nav -->
		<nav class="py-md-4 py-3 d-lg-flex">
			<div id="logo">
				<h1 class="mt-md-0 mt-2"> <a href="index.html"><span class="fa fa-map-signs"></span> Мечты сбываются </a></h1>
			</div>
			<label for="drop" class="toggle"><span class="fa fa-bars"></span></label>
			<input type="checkbox" id="drop" />
			<ul class="menu ml-auto mt-1">
				<li class=""><a href="index.html">Главная</a></li>
				<li class=""><a href="../site/about.html">О нас</a></li>
				<li class=""><a href="../site/packages.html">Экскурсии</a></li>
				<li class=""><a href="../site/contact.html">Контакты</a></li>
				@guest
					<li class=" ">
						<a class="" href="{{ route('login') }}" style="align-self: flex-end">Войти</a>
					</li>
					@if (Route::has('register'))
						<li class="">
							<a class="" href="{{ route('register') }}"  style="align-self: flex-end">Регистрация</a>
						</li>
					@endif
				@else
					<li class="nav-item dropdown">
						<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							{{ Auth::user()->name }} <span class="caret"></span>
						</a>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="{{ route('logout') }}"
							   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>

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
						<li class="mb-2 facebook"><a href="#" class=""><span class="fa fa-facebook"></span></a></li>
						<li class="mb-2 vk"><a href="#" class=""><span class="fa fa-vk"></span></a></li>
						<li class="mb-2 instagram"><a href="#"><span class="fa fa-instagram"></span></a></li>
						<li class="mb-2 odnoklassniki"><a href="#"><span class="fa fa-odnoklassniki"></span></a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-4 col-sm-6 footer-grid_section mt-sm-0 mt-4">
				<div class="footer-title">
					<h3>Насчёт нас</h3>
				</div>
				<div class="footer-text">
					<p>Комфортабельный транспорт, вариативность по тематике, количеству человек, приятные цены, бонусы.
						Организация вашего отдыха в надёжных руках.🎈</p>
					<p><a href="">Подробнее...</a></p>
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
	<p>© 2019 Grand Tour. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="=_blank"> W3layouts </a></p>
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

</html>
</html>