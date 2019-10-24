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
<div class="shop-section mb-80">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-xs-12">
				<!-- single-product-area start -->
				<div class="single-product-area mb-80">
					<div class="row">
						<!-- imgs-zoom-area start -->
						<div class="col-md-5 col-sm-5 col-xs-12">
							<div class="imgs-zoom-area">
								<img id="zoom_03" src="{{asset('images/product/6.jpg')}}" data-zoom-image="{{asset('images/product/6.jpg')}}" alt="">
								<div class="row">
									<div class="col-xs-12">
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
							</div>
						</div>
						<!-- imgs-zoom-area end -->
						<!-- single-product-info start -->
						<div class="col-md-7 col-sm-7 col-xs-12">
							<div class="single-product-info">
								<h3 class="text-black-1">Dummy Product Name </h3>
								<h6 class="brand-name-2">brand name</h6>
								<!-- hr -->
								<hr>
								<!-- single-product-tab -->
								<div class="single-product-tab">
									<ul class="reviews-tab mb-20">
										<li  class="active"><a href="#description" data-toggle="tab">description</a></li>
										<li ><a href="#information" data-toggle="tab">information</a></li>
										<li ><a href="#reviews" data-toggle="tab">reviews</a></li>
									</ul>
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane active" id="description">
											<p>There are many variations of passages of Lorem Ipsum available, but the majo Rity have be suffered alteration in some form, by injected humou or randomis Rity have be suffered alteration in some form, by injected humou or randomis words which donot look even slightly believable. If you are going to use a passage Lorem Ipsum.</p>
										</div>
										<div role="tabpanel" class="tab-pane" id="information">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem, neque fugit inventore quo dignissimos est iure natus quis nam illo officiis,  deleniti consectetur non ,aspernatur.</p>
											<p>rerum blanditiis dolore dignissimos expedita consequatur deleniti consectetur non exercitationem.</p>
										</div>
										<div role="tabpanel" class="tab-pane" id="reviews">
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
																<h6 class="media-heading"><a href="#">Gerald Barnes</a></h6>
																<p class="mb-10">27 Jun, 2016 at 2:30pm</p>
															</div>
															<div class="pull-right">
																<ul class="reply-delate">
																	<li><a href="#">Reply</a></li>
																	<li>/</li>
																	<li><a href="#">Delate</a></li>
																</ul>
															</div>
														</div>
														<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas .</p>
													</div>
												</div>
												<!-- single comments -->
												<div class="media mt-30">
													<div class="media-left">
														<a href="#"><img class="media-object" src="{{asset('images/author/2.jpg')}}" alt="#"></a>
													</div>
													<div class="media-body">
														<div class="clearfix">
															<div class="name-commenter pull-left">
																<h6 class="media-heading"><a href="#">Gerald Barnes</a></h6>
																<p class="mb-10">27 Jun, 2016 at 2:30pm</p>
															</div>
															<div class="pull-right">
																<ul class="reply-delate">
																	<li><a href="#">Reply</a></li>
																	<li>/</li>
																	<li><a href="#">Delate</a></li>
																</ul>
															</div>
														</div>
														<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas .</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--  hr -->
								<hr>
								<!-- single-pro-color-rating -->
								<div class="single-pro-color-rating clearfix">
									<div class="sin-pro-color f-left">
										<p class="color-title f-left">Color</p>
										<div class="widget-color f-left">
											<ul>
												<li class="color-1"><a href="#"></a></li>
												<li class="color-2"><a href="#"></a></li>
												<li class="color-3"><a href="#"></a></li>
												<li class="color-4"><a href="#"></a></li>
											</ul>
										</div>
									</div>
									<div class="pro-rating sin-pro-rating f-right">
										<a href="#" tabindex="0"><i class="zmdi zmdi-star"></i></a>
										<a href="#" tabindex="0"><i class="zmdi zmdi-star"></i></a>
										<a href="#" tabindex="0"><i class="zmdi zmdi-star"></i></a>
										<a href="#" tabindex="0"><i class="zmdi zmdi-star-half"></i></a>
										<a href="#" tabindex="0"><i class="zmdi zmdi-star-outline"></i></a>
										<span class="text-black-5">( 27 Rating )</span>
									</div>
								</div>
								<!-- hr -->
								<hr>
								<!-- plus-minus-pro-action -->
								<div class="plus-minus-pro-action">
									<div class="sin-plus-minus f-left clearfix">
										<p class="color-title f-left">Qty</p>
										<div class="cart-plus-minus f-left">
											<input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
										</div>
									</div>
									<div class="sin-pro-action f-right">
										<ul class="action-button">
											<li>
												<a href="#" title="Wishlist" tabindex="0"><i class="zmdi zmdi-favorite"></i></a>
											</li>
											<li>
												<a href="#" data-toggle="modal" data-target="#productModal" title="Quickview" tabindex="0"><i class="zmdi zmdi-zoom-in"></i></a>
											</li>
											<li>
												<a href="#" title="Compare" tabindex="0"><i class="zmdi zmdi-refresh"></i></a>
											</li>
											<li>
												<a href="#" title="Add to cart" tabindex="0"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<!-- single-product-info end -->
					</div>
				</div>
			</div>

		</div>
		<div class="row">
			<section class="packages pt-5" style="padding-top: 40px !important;">
				<div class="container py-lg-4 py-sm-3">
					<div class="row">
						<div class="col-md-12">
							<div class="section-title text-left mb-40">
								<h2 class="uppercase">related product</h2>
								<h6>There are many variations of passages of brands available,</h6>
							</div>
						</div>
					</div>
					<div class="row">
						@foreach($tours as $tour)
							<div class="col-lg-3 col-sm-6 mb-5" href="">
								<div class="image-tour position-relative">
									<img src="{{asset('images/banner1.jpg')}}" alt="" class="img-fluid" />
									<p><span class="fa fa-tags"></span> <span>
							{{--@if( $Age_Group != 0  or $Condition == 1)--}}
											{{--{{ $tour->Privilegens_Price }}--}}
											{{--@else--}}
											{{ $tour->Price }}
											{{--@endif--}}
							₽
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
		</div>

	</div>
</div>
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
