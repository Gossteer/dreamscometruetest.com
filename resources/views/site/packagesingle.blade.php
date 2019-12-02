    @extends('layouts.site')

@section('content')

	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/icon/favicon.png') }}">

	<!-- All CSS Files -->
	<!-- Bootstrap fremwork main css -->
	<link rel="stylesheet" href="{{ asset('single/bootstrap.min.css') }}">
	<!-- Nivo-slider css -->
	<link rel="stylesheet" href="{{ asset('single/nivo-slider.css') }}">
	<!-- This core.css file contents all plugings css file. -->
	<link rel="stylesheet" href="{{ asset('single/core.css') }}">

	<link rel="stylesheet" href="{{ asset('single/style.css') }}">
	<!-- Responsive css -->
	<link rel="stylesheet" href="{{ asset('single/responsive.css') }}">
	<!-- Template color css -->
	<link href="{{ asset('single/color/color-core.css') }}" data-style="styles" rel="stylesheet">
	<!-- User style -->
	<link rel="stylesheet" href="{{ asset('single/custom.css') }}">
	<!-- Modernizr JS -->
	<script src="{{ asset('js/single/modernizr-2.8.3.min.js') }}"></script>

<!-- banner -->
<section class="banner_inner" id="home">
	<div class="banner_inner_overlay">
	</div>
</section>
<!-- //banner -->

<!-- SHOP SECTION START -->

	<!-- tour packages -->
	<section class="packages pt-5">
		<div class="container py-lg-4 py-sm-3">
			<!-- single-product-area start -->
			<div class="single-product-area mb-80">
				<div class="row">
					<!-- imgs-zoom-area start -->
					<div class="col-md-5 col-sm-5 col-xs-12"  >
						<div class="imgs-zoom-area">
							<img id="zoom_03"  src="{{asset('images/product/6.jpg')}}" data-zoom-image="{{asset('images/product/6.jpg')}}" alt="">
							<div class="row">
								<div class="col-xs-12" >
									<div id="gallery_01" class="carousel-btn slick-arrow-3 mt-30">
										<div class="p-c">
											<a href="#" data-image="{{asset('images/product/2.jpg')}}" data-zoom-image="{{asset('images/product/2.jpg')}}">
												<img class="zoom_03" src="{{asset('images/product/2.jpg')}}" alt="">
											</a>
										</div>
										<div class="p-c">
											<a href="#" data-image="{{asset('images/product/3.jpg')}}" data-zoom-image="{{asset('images/product/3.jpg')}}">
												<img class="zoom_03" src="{{asset('images/product/3.jpg')}}" alt="">
											</a>
										</div>
										<div class="p-c">
											<a href="#" data-image="{{asset('images/product/4.jpg')}}" data-zoom-image="{{asset('images/product/4.jpg')}}">
												<img class="zoom_03" src="{{asset('images/product/4.jpg')}}" alt="">
											</a>
										</div>
										<div class="p-c">
											<a href="#" data-image="{{asset('images/product/5.jpg')}}" data-zoom-image="{{asset('images/product/5.jpg')}}">
												<img class="zoom_03" src="{{asset('images/product/5.jpg')}}" alt="">
											</a>
										</div>
										<div class="p-c">
											<a href="#" data-image="{{asset('images/product/6.jpg')}}" data-zoom-image="{{asset('images/product/6.jpg')}}">
												<img class="zoom_03" src="{{asset('images/product/6.jpg')}}" alt="">
											</a>
										</div>
										<div class="p-c">
											<a href="#" data-image="{{asset('images/product/7.jpg')}}" data-zoom-image="{{asset('images/product/7.jpg')}}">
												<img class="zoom_03" src="{{asset('images/product/7.jpg')}}" alt="">
											</a>
										</div>
									</div>
								</div>
							</div>
							<a class="btn btn-success  col-md-12 bypackeg" id="pacagesunit" href="{{route('tourdescript',[$tour, str_slug($tour->Name_Tours, '-')])}}">Записаться</a>
						</div>

					</div>
					<!-- imgs-zoom-area end -->
					<!-- single-product-info start -->
					<div class="col-md-7 col-sm-7 col-xs-12" id="">
						<div class="single-product-info">
							<h3 class="text-black-1 " style="font-size: 25px; padding-bottom: 10px;">Название экскурсии </h3>
							<h6 class="brand-name-2 ">Типа экскурсии</h6>
							<div class="pro-rating sin-pro-rating f-right">
								<a href="#" tabindex="0"><i class="zmdi zmdi-star"></i></a>
								<a href="#" tabindex="0"><i class="zmdi zmdi-star"></i></a>
								<a href="#" tabindex="0"><i class="zmdi zmdi-star"></i></a>
								<a href="#" tabindex="0"><i class="zmdi zmdi-star-half"></i></a>
								<a href="#" tabindex="0"><i class="zmdi zmdi-star-outline"></i></a>
								<span class="text-black-5">( 27 Оценок )</span>
							</div>
							<!-- hr -->
							<hr class="hrsingle">
							<!-- single-product-tab -->
							<div class="single-product-tab">
								<ul class="reviews-tab mb-20 " style="margin-bottom: 0 !important;">
									<li  class="active "><a class="colorsingledescriptioninfo1 sizedescriptioninsingl" href="#description" data-toggle="tab">Описание</a></li>
									<li><a class="colorsingledescriptioninfo1 sizedescriptioninsingl" href="#schedule" data-toggle="tab">Программа</a></li>
									<li><a class="colorsingledescriptioninfo1 sizedescriptioninsingl" href="#escorting" data-toggle="tab">Сопровождающие</a></li>
								</ul>
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active " id="description">
										<p class="">Описание</p>
									</div>
									<div role="tabpanel" class="tab-pane" id="schedule">
										<p>Программа</p>
									</div>
									<div role="tabpanel" class="tab-pane" id="escorting">
										<!-- reviews-tab-desc -->
										<div class="reviews-tab-desc">
											<!-- single comments -->
											<div class="media mt-30">
												<div class="media-left">
													<a href="#"><img class="media-object" src="{{asset('images/author/1.jpg')}}" alt="#"></a>
												</div>
												<div class="media-body">
													<div class="clearfix">
														<div class="name-commenter pull-left">
															<h6 class="media-heading"><a href="#">ФИО</a></h6>
															<p class="mb-10">Должность</p>
														</div>
													</div>
													<p class="mb-0">Описание</p>
												</div>
											</div>
											<!-- single comments -->

										</div>
									</div>
								</div>
							</div>
							<!--  hr -->
							<hr style="margin-bottom: 0px !important;">
							<!-- single-pro-color-rating -->
							<div class="single-pro-color-rating clearfix">
								<div class="row mt-5 text-center ">
									<div class="col-lg-4 col-6 counter">
										<span class="fa fa-smile-o singledescriptioninfo2"></span>
										<div class="timer count-title count-number singledescriptioninfo1 colorsingledescriptioninfo1">24.10.19</div>

										<p class="count-text text-uppercase colorsingledescriptioninfo2">Дата</p>
									</div>
									<div class="col-lg-4 col-6 counter">
										<span class="fa fa-smile-o singledescriptioninfo2"></span>
										<div class="timer count-title count-number singledescriptioninfo1 colorsingledescriptioninfo1">8:00</div>
										<p class="count-text text-uppercase colorsingledescriptioninfo2">Время</p>
									</div>
									<div class="col-lg-4 col-6 counter">
										<span class="fa fa-smile-o singledescriptioninfo2"></span>
										<div class="timer count-title count-number singledescriptioninfo1 colorsingledescriptioninfo1">10</div>
										<p class="count-text text-uppercase colorsingledescriptioninfo2">Свободных мест</p>
									</div>

								</div>
							</div>
							<hr style="margin-top: 12px ">
							<div class="">
								<p class="colorsingledescriptioninfo3">Место отправления: ДК МИР</p>
								<p class="colorsingledescriptioninfo3">Примерная продолжительность: 8 часов</p>
								<p class="colorsingledescriptioninfo3">Дополнительные услуги: </p>
								<p class="colorsingledescriptioninfo3" style="padding-left: 10px">1. Счастье; </p>
								<p class="colorsingledescriptioninfo3">Марка автобуса: Мерседес</p>
								<p class="colorsingledescriptioninfo3" style="text-decoration: underline;">Требования: </p>
								<p class="colorsingledescriptioninfo3" style="padding-left: 10px">1. Российский паспорт; </p>
							</div>
							<hr style="margin-bottom: 15px">
							<!-- plus-minus-pro-action -->
							<div class="plus-minus-pro-action">
								<div class=" mt-5 text-center ">
									<div class="col-lg-4 col-6 counter"style="	padding-bottom: 20px ;" >
										<div >
											<div class="icon iconforsinglepachage" >
												<span class="priceforsinglepachage">{{ number_format($tour->Price, 0, ',', ' ') }}₽</span>
											</div>
											<h3 >Цена</h3>
										</div>
									</div>
									<div class="col-lg-4 col-6 counter" style="	padding-bottom: 20px ;">
										<div >
											<div class="icon iconforsinglepachage">
												<span class="priceforsinglepachage">{{ number_format(1000, 0, ',', ' ') }}₽</span>
											</div>
											<h3 style="">Пенсионеры</h3>
										</div>
									</div>
									<div class="col-lg-4 col-6 counter" style="	padding-bottom: 20px ;">
										<div >
											<div class="icon iconforsinglepachage">
												<span class="priceforsinglepachage">10&nbsp000₽</span>
											</div>
											<h3>Дети</h3>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- single-product-info end -->
				</div>
			</div>
		</div>
	</section>
	<!-- tour packages -->

	<!-- destinations -->
	<section class="packages pt-5" style="padding-top: 10px !important;">
		<div class="container py-lg-4 py-sm-3">
				<div class="row">
					<div class="col-md-12">
						<div class="section-title text-left mb-40">
							<h2 class="uppercase" style="font-size: 26px">Рекомендуемые экскурсии</h2>
						</div>
					</div>
				</div>
				<div class="row">
					@foreach($tours as $tour)
						<div class="col-lg-3 col-sm-6 mb-5" href="">
							<div class="image-tour position-relative">
								<a href="{{route('tourdescript',[$tour, str_slug($tour->Name_Tours, '-')])}}"><img src="{{asset('images/banner1.jpg')}}" alt="" class="img-fluid" /></a>
								<p><span class="fa fa-tags"></span> <span>
							{{--@if( $Age_Group != 0  or $Condition == 1)--}}
										{{--{{ $tour->Privilegens_Price }}--}}
										{{--@else--}}
										{{ number_format($tour->Price, 0, ',', ' ') }}₽
										{{--@endif--}}
						</span></p>
							</div>
							<script>
								function alert_occupaid ()
								{
									dialog.alert({
										title: "Уведомление",
										message: "Вы уже записаны на данное мероприятие!",
									});

									return false
								}

								function alert_occupaid_null_plase ()
								{
									dialog.alert({
										title: "Уведомление",
										message: "На данный момент места заняты.",
									});

									return false
								}
							</script>
							<div class="package-info">
								<h6 class="mt-1"><span class="fa fa-map-marker mr-2"></span>{{ $tour->Name_Tours }}</h6>
								<h5 class="my-2">{{ $tour->Name_Tours }}</h5>
								<p class="">{{str_limit($tour->Description,20,'...')}}</p>
								<ul class="listing mt-3">
									<li><span  class="fa fa-clock-o mr-2"></span>Дата: <span> {{ $tour->Start_Date_Tours }}</span></li>
								</ul>
								<a class="btn btn-success" id="pacagesunit" style="font-size: 16px" href="{{route('tourdescript',[$tour, str_slug($tour->Name_Tours, '-')])}}">Подробнее</a>
								{{--@if($tour->Start_Date_Tours >= now()->subDay())--}}
								{{--@if (Route::has('register') and $customer_activ != null )--}}
								{{--<a class="btn mb-1 btn-success" onclick="{{ (\App\Passenger::whereRaw('tours_id = ? and customers_id = ?', [$tour->id, $customer_activ->id])->exists()) ? 'return alert_occupaid ()' :--}}
								{{--((($tour->Amount_Place - $tour->Occupied_Place) == 0) ? 'return alert_occupaid_null_plase ()' : 'lol') }}" style="background-color: #047ffc; margin-top: 15px;" href="{{route('passengers.create',['tours_id' => $tour->id])}}">Записаться на тур</a>--}}
								{{--@endif--}}
								{{--@else--}}
								{{--<p class="" style="color: green; padding-top: 10px !important;">Экскурсия прошла</p>--}}
								{{--@endif--}}
							</div>
						</div>
					@endforeach

				</div>
			</div>
	</section>
	<!-- destinations -->



<!-- SHOP SECTION END -->

	<!-- jquery latest version -->
	<script src="{{asset('js/single/jquery-3.1.1.min.js')}}"></script>
	<!-- Bootstrap framework js -->
	<script src="{{asset('js/single/bootstrap.min.js')}}"></script>
	<!-- jquery.nivo.slider js -->
	<script src="{{asset('js/single/jquery.nivo.slider.js')}}"></script>
	<!-- All js plugins included in this file. -->
	<script src="{{asset('js/single/plugins.js')}}"></script>
	<!-- Main js file that contents all jQuery plugins activation. -->
	<script src="{{asset('js/single/main.js')}}"></script>

@endsection