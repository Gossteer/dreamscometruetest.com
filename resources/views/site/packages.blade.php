@extends('layouts.site')

@section('content')

<!-- banner -->
<section class="banner_inner" id="home">
	<div class="banner_inner_overlay">
	</div>
</section>
<!-- //banner -->


<!-- tour packages -->
<section class="packages pt-5">
	<div class="container py-lg-4 py-sm-3">
		<h2 class="heading text-capitalize text-center"> Ознакомьтесь с нашими предложениями </h2>
		<p class="text mt-2 mb-5 text-center">Инфо... необязательно</p>
		<div class="row">
			
			<div class="col-lg-3 col-sm-6 mb-5" href="">
				<div class="image-tour position-relative">
					<img src="images/p1.jpg" alt="" class="img-fluid" />
					<p><span class="fa fa-tags"></span> <span>Цена₽</span></p>
				</div>
				<div class="package-info">
					<h6 class="mt-1"><span class="fa fa-map-marker mr-2"></span>Место назначение</h6>
					<h5 class="my-2">Название</h5>
					<p class="">Краткое описания (продолжение на ...)</p>
					<ul class="listing mt-3">
						<li><span class="fa fa-clock-o mr-2"></span>Длительность: <span>10 дней</span></li>
					</ul>
				</div>
			</div>

		</div>
	</div>
</section>
<!-- tour packages -->

<!-- destinations -->
<section class="destinations py-5" id="destinations">
	<div class="container py-xl-5 py-lg-3">
		<h3 class="heading text-capitalize text-center"> Популярные направления </h3>
		<p class="text mt-2 mb-5 text-center">Инфо... необязательно</p>
		<div class="row inner-sec-w3layouts-w3pvt-lauinfo">
			<div class="col-md-3 col-sm-6 col-6 destinations-grids text-center">
				<h4 class="destination mb-3">Псков</h4>
				<div class="image-position position-relative">
					<img src="images/china.jpg" class="img-fluid" alt="">
					<div class="rating">
						<ul>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
						</ul>
					</div>
				</div>
				<div class="destinations-info">
					<div class="caption mb-lg-3">
						<h4>Псков</h4>
						<a href="booking.html">Подробнее</a>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
<!-- destinations -->

@endsection