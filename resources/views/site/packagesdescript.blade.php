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
            <div class="row">
			<div class="col-lg-3 col-sm-6 mb-5" href="">
				<div class="image-tour position-relative">
					<img src="images/banner1.jpg" alt="" class="img-fluid" />
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
					<a class="btn mb-1 btn-success" id="pacagesunit" href="{{route('passengers.create',['tours_id' => $tour->id])}}">Подробнее</a>
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
		</div>
		</div>
	</div>

</section>
<!-- tour packages -->

<!-- destinations -->
<section class="destinations py-5" id="destinations">
	<div class="container py-xl-5 py-lg-3" style="padding-top: 0 !important;">
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
						<a href="#">Подробнее</a>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
<!-- destinations -->

@endsection