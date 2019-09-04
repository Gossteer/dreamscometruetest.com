@extends('layouts.site')

@section('content')

<!-- banner -->
<section class="banner_inner" id="home">
	<div class="banner_inner_overlay">
	</div>
</section>
<!-- //banner -->

<!-- about -->
<section class="about py-5">
	<div class="container py-lg-5 py-sm-4">
		<div class="row">
			<div class="col-lg-5 about-left">
				<h2 class="mt-lg-3">Мы отвезём вас в самые популярные направления в мире, <strong>исследуйте с нами!</strong></h2>
				<p class="mt-4">Основываясь на личном опыте и на отзывах наших клиентах о услугах предоставленных ранее другими компаниями,
					 можно сделать выводы, что на рынке туризма развелось множество некомпетентных и безразличных к собственной работе предпринимателей.</p>
				<p class="mt-3"> Наша компания делает ставку на то, что в наше время невозможно
					работать в сфере услуг без качественного сервиса, любви к своим клиентам и собственному делу.</p>
			</div>
			<div class="col-lg-7 about-left text-lg-right mt-lg-0 mt-5">
				<figure>
					<img src="images/about.jpg" alt="" class="img-fluid abt-image" />
					<figcaption><p class="mt-3 text-center">Разводим мосты, в погоне за вашей мечтой!</p></figcaption>
				</figure>

			</div>
		</div>
		<div class="row mt-5 text-center">
			<div class="col-lg-3 col-6">
				<div class="counter">
					<span class="fa fa-smile-o"></span>
					<div class="timer count-title count-number">5000+</div>
					<p class="count-text text-uppercase">Счастливых клиентов</p>
				</div>
			</div>
			<div class="col-lg-3 col-6">
				<div class="counter">
					<span class="fa fa-ship"></span>
					<div class="timer count-title count-number">800</div>
					<p class="count-text text-uppercase">Туров и Экскурсий </p>
				</div>
			</div>
			<div class="col-lg-3 col-6 mt-lg-0 mt-5">
				<div class="counter">
					<span class="fa fa-users"></span>
					<div class="timer count-title count-number">100</div>
					<p class="count-text text-uppercase">Школьных поездок</p>
				</div>
			</div>
			<div class="col-lg-3 col-6 mt-lg-0 mt-5">
				<div class="counter">
					<span class="fa fa-gift"></span>
					<div class="timer count-title count-number">7+<span>лет</span></div>
					<p class="count-text text-uppercase">опыта</p>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- //about -->


<!-- tabs -->
<section class="choose" id="choose">
	<div class="overlay-all py-5">
		<div class="container py-lg-5 py-sm-4">
			<h2 class="heading text-capitalize text-center   mb-4">Наш сервис</h2>
			<div class="edu-exp-grids">
				<div class="row text-center">
					<div class="col-lg-4 col-md-6 inner-w3pvt-wrap">
						<div class="ser-fashion-grid">
							<div class="about-icon mb-md-4 mb-3">
								<span class="fa fa-building" aria-hidden="true"></span>
							</div>
							<div class="ser-sevice-grid">
								<h4 class="pb-3">Школы</h4>
								<p>Организуем экскурсии для школьных, корпоративных групп со всеми необходимыми документами</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 inner-w3pvt-wrap">
						<div class="ser-fashion-grid">
							<div class="about-icon mb-md-4 mb-3">
								<span class="fa fa-free-code-camp" aria-hidden="true"></span>
							</div>
							<div class="ser-sevice-grid">
								<h4 class="pb-3">Горячие туры</h4>
								<p>Позвоните нам в любое время года и мы подберём для вас горячее предложение</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 inner-w3pvt-wrap">
						<div class="ser-fashion-grid">
							<div class="about-icon mb-md-4 mb-3">
								<span class="fa fa-users" aria-hidden="true"></span>
							</div>
							<div class="ser-sevice-grid">
								<h4 class="pb-3">Опыт</h4>
								<p>Мы прошли через огонь и воду, чтобы вы плавали в горячих источниках.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 inner-w3pvt-wrap">
						<div class="ser-fashion-grid">
							<div class="about-icon mb-md-4 mb-3">
								<span class="fa fa-money" aria-hidden="true"></span>
							</div>
							<div class="ser-sevice-grid">
								<h4 class="pb-3">Низкие цены</h4>
								<p>Мечты сбываются - сочетание слов, которое идеально описывает соотношение цена/качество.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 inner-w3pvt-wrap">
						<div class="ser-fashion-grid">
							<div class="about-icon mb-md-4 mb-3">
								<span class="fa fa-binoculars" aria-hidden="true"></span>
							</div>
							<div class="ser-sevice-grid">
								<a href=""><h4 class="pb-3">Индвивидуальные заказы</h4></a>
								<p>Если вы c компанией не нашли подходящего для вас предложения, мы всегда рады составить для вас индивидуальную программу</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 inner-w3pvt-wrap">
						<div class="ser-fashion-grid">
							<div class="about-icon mb-md-4 mb-3">
								<span class="fa fa-camera" aria-hidden="true"></span>
							</div>
							<div class="ser-sevice-grid">
								<h4 class="pb-3">Новые Впечатления</h4>
								<p>Заботясь о желаниях наших клиентов мы хотим, чтобы у каждого была возможность побывать в интересных, красивых и духовных местах</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- tabs -->

<!-- places -->
<section class="trav-grids py-5" id="desti">
	<div class="container py-xl-5 py-lg-3">
		<h3 class="heading text-capitalize text-center mb-lg-5 mb-4">Туристические места</h3>
		<div class="row">
			<div class="col-lg-6 mt-4">
				<div class="grids-tem-one">
					<div class="row">
						<div class="col-sm-5 grids-img-left">
							<a href=""><img src="images/japan.jpg" alt="" class="img-fluid"></a>
						</div>
						<div class="col-sm-7 right-cont">
							<a href=""><h4 class="mb-2 let mt-sm-0 mt-2 tm-clr">Санкт Петербург</h4></a>
							<ul class="d-flex">
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
							</ul>
							<p class="mt-3">Второй по величине город России. Он был основан 16 мая 1703 года при Петре I,
								самый творческий и душевный город нашей необъятной страны.</p>
							<p class="duration mt-2"><span class="fa fa-clock-o mr-2"></span><strong>Длительность</strong> : 4 дня</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 mt-4">
				<div class="grids-tem-one">
					<div class="row">
						<div class="col-sm-5 grids-img-left">
							<a href=""><img src="images/singapore.jpg" alt="" class="img-fluid"></a>
						</div>
						<div class="col-sm-7 right-cont">
							<a href=""><h4 class="mb-2 let mt-sm-0 mt-2 tm-clr">Республика Беларусь</h4></a>
							<ul class="d-flex">
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
							</ul>
							<p class="mt-3">Страна в которой очень любят туристов. Прекрасная нетронутая природа и разнообразные крупные исторические объекты.</p>
							<p class="duration mt-2"><span class="fa fa-clock-o mr-2"></span><strong>Длительность</strong> : 4 дня</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row pt-lg-3">
			<div class="col-lg-6 mt-4">
				<div class="grids-tem-one">
					<div class="row">
						<div class="col-sm-5 grids-img-left">
							<a href=""><img src="images/malaysia.jpg" alt="" class="img-fluid"></a>
						</div>
						<div class="col-sm-7 right-cont">
							<a href=""><h4 class="mb-2 let mt-sm-0 mt-2 tm-clr">Сочи</h4></a>
							<ul class="d-flex">
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
							</ul>
							<p class="mt-3">Искрящееся Чёрное море, залитые солнцем пляжи, цветущие магнолии, стройные кипарисы и горные лыжи. Это ли не отдых мечты?</p>
							<p class="duration mt-2"><span class="fa fa-clock-o mr-2"></span><strong>Дата</strong> : 23.10.19</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 mt-4">
				<div class="grids-tem-one">
					<div class="row">
						<div class="col-sm-5 grids-img-left">
							<a href=""><img src="images/china.jpg" alt="" class="img-fluid"></a>
						</div>
						<div class="col-sm-7 right-cont">
							<a href=""><h4 class="mb-2 mt-sm-0 mt-2 let tm-clr">Псков</h4></a>
							<ul class="d-flex">
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
								<li><span class="fa fa-star"></span></li>
							</ul>
							<p class="mt-3">Псков считают одним их лучших городов для неспешных путешествий. Каменная крепость, сохранившаяся в нем, самая крупная в Европе.</p>
							<p class="duration mt-2"><span class="fa fa-clock-o mr-2"></span><strong>Длительность</strong> : 4 дня</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- //places -->

<!-- text -->
<section class="text-content">
	<div class="overlay-inner py-5">
		<div class="container py-md-3">
			<div class="test-info">
				<h4 class="tittle">Ваш выбор</h4>
				<p class="mt-3">Все мы люди и нам свойственно переживать, к примеру за свой выбор. Для того, чтобы от зародившегося желания и
					до его исполнения вы испытывали лишь радость, нами был создан проект - 'Реальные мечты'.</p>
				<div class="text-left mt-4">
					<a href="booking.html">посмотреть</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- //text -->


<!-- testimonials -->
<section class="testimonials py-5" id="testi">
	<div class="container py-md-3 ">
			<h3 class="heading  text-center mb-lg-5 mb-4">Что говорят наши клиенты</h3>
		<div class="row pt-xl-4 ">
			<div class="col-md-4 test-grid px-lg-4">
				<div class="testi-info text-center">
					<p class="text-li">"Пока свежи мои воспоминания о вчерашнем незабываемом дне, я решила написать отзыв😉
						Скажу сразу, что название "Мечты сбываются" самое точное какое можно придумать<a href="https://vk.com/topic-147694504_35442023?post=36">...</a>"</p>
					<div class="test-img text-center mt-4">
						<img src="images/te1.jpg" class="img-fluid" alt="user-image">
					</div>
					<h3 class="mt-md-4 mt-3">Татьяна</h3>
				</div>
			</div>
			<div class="col-md-4 test-grid px-lg-4 my-md-0 my-5">
				<div class="testi-info text-center">
					<p class="text-li">"Сегодня мы были у Мотренушке, поездка супер, спасибо организаторам поездкт.
						Мечты действительно сбываются, мечтать не вредно, вредно не мечтать."</p>
					<div class="test-img text-center mt-4">
						<img src="images/te2.jpg" class="img-fluid" alt="user-image">
					</div>
					<h3 class="mt-md-4 mt-3">Валентина</h3>
				</div>
			</div>
			<div class="col-md-4 test-grid px-lg-4 mb-5">
				<div class="testi-info text-center">
					<p class="text-li">"Все нравится!! Погода великолепная, отель хороший,
							отличное питание, киприоты жизнерадостные и гостеприимные люди! Море впечатлений и позитива<a href="https://vk.com/dreams_comet?w=wall-147694504_1079">...</a>"</p>
					<div class="test-img text-center mt-4">
						<img src="images/te3.jpg" class="img-fluid" alt="user-image">
					</div>
					<h3 class="mt-md-4 mt-3">Анастасия</h3>
				</div>
			</div>

		</div>
		<div class="row justify-content-md-center">
			<a class="btn sent-butnn col-md-6 " href="">Оставить свой отзыв</a>
		</div>

	</div>
</section>
<!-- //testimonials -->

@endsection