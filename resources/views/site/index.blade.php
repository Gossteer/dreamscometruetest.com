@extends('layouts.site')

@section('content')
	<!-- banner -->
	<section class="banner_w3lspvt" id="home">
		<div class="csslider infinity" id="slider1">
			<input type="radio" name="slides" checked="checked" id="slides_1" />
			<input type="radio" name="slides" id="slides_2" />
			<input type="radio" name="slides" id="slides_3" />
			<input type="radio" name="slides" id="slides_4" />
			<ul>
				<li>
					<div class="banner-top">
						<div class="overlay">
							<div class="container">
								<div class="w3layouts-banner-info">
									<h3 class="text-wh" style="text-transform: inherit !important;">Никогда не позволяй своему прошлому быть ярче, своих мечтаний!</h3>
									<h4 class="text-wh">(Что-то красивое)</h4>
									<div class="buttons mt-4">
										<a href="{{ route('/about') }}" class="btn mr-2">О нас</a>
										<a href="{{ route('/contact') }}" class="btn">Написать нам</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="banner-top1">
						<div class="overlay">
							<div class="container">
								<div class="w3layouts-banner-info">
									<h3 class="text-wh">(Слова, которые вас возбудят)</h3>
									<h4 class="text-wh">(Аррр)</h4>
									<div class="buttons mt-4">
										<a href="{{ route('/about') }}" class="btn mr-2">О нас</a>
										<a href="{{ route('/contact') }}" class="btn">Написать нам</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="banner-top2">
						<div class="overlay">
							<div class="container">
								<div class="w3layouts-banner-info">
									<h3 class="text-wh">(Надеюсь у вас хорошее настроение)</h3>
									<h4 class="text-wh">(Мы очень на это надеимся)</h4>
									<div class="buttons mt-4">
										<a href="{{ route('/about') }}" class="btn mr-2">О нас</a>
										<a href="{{ route('/contact') }}" class="btn">Написать нам</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="banner-top3">
						<div class="overlay1">
							<div class="container">
								<div class="w3layouts-banner-info">
									<h3 class="text-wh">It is better to travel than to arrive. Let's Be Adventurers.</h3>
									<h4 class="text-wh">tristique senectus et netus et malesuada</h4>
									<div class="buttons mt-4">
										<a href="about.html" class="btn mr-2">About Us</a>
										<a href="booking.html" class="btn">Book a Tour</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</li>
			</ul>
			<div class="arrows">
				<label for="slides_1"></label>
				<label for="slides_2"></label>
				<label for="slides_3"></label>
				<label for="slides_4"></label>
			</div>
		</div>
	</section>
	<!-- //banner -->

	<!-- destinations -->
	<section class="destinations py-4" id="destinations">
		<div class="container py-xl-2 py-lg-3">
			<h3 class="heading text-capitalize text-center">Как спланировать поездку</h3>
			<div class="row mt-5 text-center">
				<div class="col-lg-4 col-sm-6">
					<div >
						<div class="icon">
							<span class="fa fa-map-signs"></span>
						</div>
						<h3>Выбрать направление</h3>
						<p class="text mt-3 mb-5 text-center">Разобраться в своих желаниях, посмотреть доступные предложения, попытаться всё совместить.</p>
					</div>
				</div>
				<div class="col-lg-4 col-sm-6 mt-sm-0 mt-5">
					<div class="">
						<div class="icon">
							<span class="fa fa-calendar"></span>
						</div>
						<h3>Выбрать дату</h3>
						<p class="text mt-3 mb-5 text-center">Многие из нас весьма занятые люди и на отдых нам порой совсем не хватает время. Решитесь и сделайте себе подарок!</p>
					</div>
				</div>
				<div class="col-lg-4 col-sm-6 mt-lg-0 mt-5">
					<div class="">
						<div class="icon">
							<span class="fa fa-gift"></span>
						</div>
						<h3>Наслаждайтесь</h3>
						<p class="text mt-3 mb-5 text-center">Выбрав направление, обозначив дату поездки, оставьте всё плохое позади и наслаждайтесь!</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- destinations -->

	<!-- text -->
	<section class="text-content">
		<div class="overlay-inner py-5">
			<div class="container py-md-3">
				<div class="test-info">
					<h4 class="tittle">Ваш выбор</h4>
					<p class="mt-3">Все мы люди и нам свойственно переживать, к примеру за свой выбор. Для того, чтобы от зародившегося желания и
						до его исполнения вы испытывали лишь радость, нами был создан проект - 'Реальные мечты', а так же вы можете ознакомиться с более подробной информацией
					о нашей организации.</p>
					<div class="text-left mt-4">
						<a href="">Реальные мечты</a>
						<a href="{{route('/about')}}" style="margin-left: 10px">О нас</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- //text -->

	<!-- tour packages -->
	<section class="packages py-5">
		<div class="container py-lg-4 py-sm-3">
			<h3 class="heading text-capitalize text-center mt-2 mb-5">Наши предложения</h3>
			<div class="row">
				@foreach($tours as $tour)
					<div class="col-lg-3 col-sm-6 mb-5" href="">
						<div class="image-tour position-relative">
							<a href="{{ route('/packages') }}"><img  src="images/p1.jpg" alt="" class="img-fluid" /></a>
							<p><span class="fa fa-tags"></span> <span>{{ $tour->Price }}₽</span></p>
						</div>
						<div class="package-info">
							<h6 class="mt-1"><span class="fa fa-map-marker mr-2"></span>{{ $tour->Name_Tours }}</h6>
							<h5 class="my-2">{{ $tour->Name_Tours }}</h5>
							<p class="">{{str_limit($tour->Description,20,'...')}}</p>
							<ul class="listing mt-3">
								<li><span class="fa fa-clock-o mr-2"></span>Дата: <span> {{ $tour->Start_Date_Tours }}</span></li>
							</ul>
						</div>
					</div>
				@endforeach
			</div>
			<div class="view-package text-center mt-4">
				<a href="{{ route('/packages') }}" style="margin-right: 15px">Посмотреть все</a>
				<a href="{{ route('/contact') }}">Индивидуальный заказ</a>
			</div>
		</div>
	</section>
	<!-- tour packages -->


@endsection


