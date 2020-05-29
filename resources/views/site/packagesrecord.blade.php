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
	<div class="container py-xl-5 py-lg-12" style="padding-top: 0 !important;">
		<h3 class="heading mt-2 mb-5 text-capitalize text-center"> Запись на мероприятие "{{$tour->Name_Tours}}" </h3>
		{{-- @if()
		<p class="text mt-2 mb-5 text-center">Дата начала: </p>
		@endif --}}
		@if($bus_tour and ($bus_tour->bus->Type_Transport == 'Автобус' or $bus_tour->bus->Type_Transport == 'Микроавтобус'))
		<div class="row">
			<div class="col-12 col-lg-5 text-center">
				@if($bus_tour->bus->Description)
					<p class="text text-center" style="color: black; font-size: 24px;">{{$bus_tour->bus->Title_Transport}}</p>
					<p class="text mb-3 text-center" style="color: black; font-size: 24px;">{{$bus_tour->bus->Description}}</p>
				@else
					<p class="mb-3 text-center" style="color: black; font-size: 24px;">{{$bus_tour->bus->Title_Transport}}</p>
				@endif
				<div class="row justify-content-center">
					@for ($i = 1; $i <= $bus_tour->bus->Amount_Place_Bus - 5; $i++)
						<div class="col-3" style="padding-bottom: 0.5%; @if($i % 2 == 0)padding-left: 0; @else padding-right: 0;@endif">
							<div >
								@if(($PassengerCompliteRecord->Occupied_Place_Bus ?? 0) == $i) 
									<div class="icon iconforsinglepachage @if($i % 2 == 0) divamoutplace @else divamoutplace2 @endif" style="background-color: green " onclick="changeplace(this)"  data-idi="{{$i}}" id="Place{{$i}}">
										<span class="priceforsinglepachage">{{$i}}</span>
									</div>
								@elseif(in_array($i, $EmployePlaceRecorded))  
									<div class="icon iconforsinglepachage @if($i % 2 == 0) divamoutplace @else divamoutplace2 @endif" style="background-color: red" title="Место занято сотрудником" data-idi="{{$i}}" id="Place{{$i}}">
										<span class="priceforsinglepachage">{{$i}}</span>
									</div>
								@elseif(in_array($i, $CustomerPlaceRecordedPaid)) 
									<div class="icon iconforsinglepachage @if($i % 2 == 0) divamoutplace @else divamoutplace2 @endif" style="background-color: red" title="Место выкуплено" data-idi="{{$i}}" id="Place{{$i}}">
										<span class="priceforsinglepachage">{{$i}}</span>
									</div>
								@elseif(in_array($i, $CustomerPlaceRecorded)) 
									<div class="icon iconforsinglepachage @if($i % 2 == 0) divamoutplace @else divamoutplace2 @endif" style="background-color: yellowgreen" title="Место забронировано"  data-idi="{{$i}}" id="Place{{$i}}">
										<span class="priceforsinglepachage">{{$i}}</span>
									</div>
								@else
									<div class="icon iconforsinglepachage @if($i % 2 == 0) divamoutplace @else divamoutplace2 @endif" style="background-color: " onclick="changeplace(this)" data-idi="{{$i}}" id="Place{{$i}}">
										<span class="priceforsinglepachage">{{$i}}</span>
									</div>
								@endif
							</div>
						</div>
					@endfor
					<div class="row justify-content-center" style="margin-right: 0.1%;">
						@for ($i = 1; $i <= 5; $i++)
							<div class="col-2 daddivamoutplacelast" style="padding-left: 2.5%; padding-right: 2.5%;">
								<div>
									<div class="icon iconforsinglepachage divamoutplacelast" data-idi="{{$i + $bus_tour->bus->Amount_Place_Bus - 5}}" id="Place{{$i + $bus_tour->bus->Amount_Place_Bus - 5}}" onclick="changeplace(this)">
										<span class="priceforsinglepachage">{{$i + $bus_tour->bus->Amount_Place_Bus - 5}}</span>
									</div>
								</div>
							</div>
						@endfor
					</div>
				</div>
			</div>
			
			@if($PassengerCompliteRecord)
			<form class="col col-lg-7 text-center" action="{{route('passengers.update', [$tour->id,$PassengerCompliteRecord])}}" method="post" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="put">
			@else
			<form class="col col-lg-7 text-center"  action="{{route('passengers.create', $tour)}}" method="post" enctype="multipart/form-data">
			@endif
				@csrf
			<div>
				<p class="text mb-3 text-center" style="color: black; font-size: 24px;">Рассадка по местам</p>
				<div class="row justify-content-center mb-5">
					<p class="text col-6 mb-2 " style="color: black; font-size: 18px; line-height: 80px;">Выкупленные:</p> 
					<div class="icon iconforsinglepachage "  style="background-color: red; border-radius: 20% !important;" title="">
						<span class="priceforsinglepachage"></span>
					</div>
					<p class="text col-6 mb-2 " style="color: black; font-size: 18px; line-height: 80px;">Забронированные:</p>
					<div class="icon iconforsinglepachage "  style="background-color: yellowgreen; border-radius: 20% !important;" title="">
						<span class="priceforsinglepachage"></span>
					</div>
					<p class="text col-6 mb-2 " style="color: black; font-size: 18px; line-height: 80px;">Свободные:</p>
					<div class="icon iconforsinglepachage "  style="background-color: #047ffc; border-radius: 20% !important;" title="">
						<span class="priceforsinglepachage"></span>
					</div>
				</div>

				<p class="text mb-3 text-center" style="color: black; font-size: 24px;">Подробности</p>
				<div class="row justify-content-center">
					<p class="text col-6 mb-2 " style="color: black; font-size: 18px; ">Дата:</p> 
					<p class="text col-6 mb-2" style="color: black; font-size: 18px;  ">{{date('d.m.Y', strtotime($tour->Start_Date_Tours))}}</p>
					<p class="text col-6 mb-2 " style="color: black; font-size: 18px; ">Время:</p>
					<p class="text col-6 mb-2" style="color: black; font-size: 18px;  ">{{date('H:i', strtotime($tour->Start_Date_Tours))}}</p>
					<p class="text col-12 col-sm-6 mb-2 " style="color: black; font-size: 18px; ">Место отправления:</p>
					<p class="text col-12 col-sm-6 mb-2" style="color: black; font-size: 18px;  ">{{$tour->Start_point}}</p>
					<p class="text col-6 mb-2 " style="color: black; font-size: 18px; " >Ваша цена:</p>
					<p class="text col-6 mb-2" style="color: black; font-size: 18px;  " id="yourprice">@if((Auth::user()->customer->Age_customer >= 65 and Auth::user()->customer->floor == 0) or (Auth::user()->customer->Age_customer >= 60 and Auth::user()->customer->floor == 1)) {{ number_format(($tour->Privilegens_Price != 0 or $tour->Privilegens_Price != null) ? $tour->Privilegens_Price : $tour->Price, 0, ',', ' ') }}₽ @else {{number_format($tour->Price, 0, ',', ' ')}}₽ @endif</p>
					<div class="col-12 mb-3 mt-3 daddivamoutplacelast" style="padding-left: 2.5%; padding-right: 2.5%;">
						<div >
							<div class="icon iconforsinglepachage divamoutplacelast" style="background-color: green"   title="Ваше место">
								<span class="priceforsinglepachage" id="selectplace">@if(($PassengerCompliteRecord->Occupied_Place_Bus ?? null) != null){{$PassengerCompliteRecord->Occupied_Place_Bus}}@else Место @endif</span>
								<input type="number" id="selectplaceinput" id="selectplaceinput" name="Occupied_Place_Bus" value="@if(($PassengerCompliteRecord->Occupied_Place_Bus ?? null) != null){{$PassengerCompliteRecord->Occupied_Place_Bus}}@endif"  hidden>
							</div>
						</div>
					</div>
					<p class="text col-7 col-sm-6 mb-2" style="color: black; font-size: 18px;  ">Способ оплаты</p>
					<div class="form-group col-5 col-sm-6 mb-2">
						<select id="selecttypeprice" class="form-control"  name="Payment_method" required onchange="chengetypeprise()">
						  <option selected hidden disabled value="0">Выберете способ оплаты</option>
						  <option title="С вами свяжется наш оператор" @if(old('Payment_method') == 1) selected @endif  @if(($PassengerCompliteRecord->Payment_method ?? null) == 1) selected @endif value="1">Безналичными</option>
						  {{-- Сделать запись за наличные только за две недели до начала --}}
						  <option value="2" @if(old('Payment_method') == 2) selected @endif @if(($PassengerCompliteRecord->Payment_method ?? null) == 2) selected @endif>Наличными</option>
						</select>
					</div>
					<input hidden type="text" id="checkselecttypeprice" name="checkselecttypeprice" value="@if(old('Payment_method') == 1)Безналичными @elseif(old('Payment_method') == 2)Наличными @endif @if(($PassengerCompliteRecord->Payment_method ?? null) == 2){{$PassengerCompliteRecord->Payment_method = 1 ? 'Наличными' : 'Безналичными'}}@endif">
					<p class="text col-7 col-sm-6 mb-1 " style="color: black; font-size: 18px; ">Итоговая цена:</p>
					<p class="text col-5 col-sm-6 mb-1" style="color: black; font-size: 18px;  " id="finalprice" data-price="">@if($PassengerCompliteRecord) @if((Auth::user()->customer->Age_customer >= 65 and Auth::user()->customer->floor == 0) or (Auth::user()->customer->Age_customer >= 60 and Auth::user()->customer->floor == 1)) {{ number_format(($tour->Privilegens_Price != 0 or $tour->Privilegens_Price != null) ? $tour->Privilegens_Price : $tour->Price, 0, ',', ' ') }}₽ @else {{number_format($tour->Price, 0, ',', ' ')}}₽ @endif @endif</p>
					@if($PassengerCompliteRecord)
						<p class="text col-12 col-sm-6 mb-1 " style="color: black; font-size: 18px; ">Статус оплаты: </p>
						<p class="text col-12 col-sm-6 mb-1" style="color: black; font-size: 18px;  " id="finalprice" data-price="">{{$PassengerCompliteRecord->Paid == 1 ? 'Оплачено' : 'Ожидаем оплаты'}}</p>
					@endif
					<div class="col-12 col-sm-6 mt-3  text-center">
						{!! NoCaptcha::display() !!}
						@if ($errors->has('g-recaptcha-response'))
							<span class="help-block">
								<strong class="text-danger" style="font-family: Raleway, sans-serif; ">{{ $errors->first('g-recaptcha-response') }}</strong>
							</span>
						@endif
					</div>
				<button type="submit"  class="btn btn-success  col-10 col-sm-6 bypackeg  @if(!$PassengerCompliteRecord) mb-4 @endif" style="color: white; line-height: 28px !important;" name="form1" onclick="if(document.getElementById('finalprice').textContent == ''){alert('Выберете пожалуйста место и способ оплаты или обновите страницу и попробуйте снова!'); return false;}; if(document.getElementById('selecttypeprice').value == 1){if(confirm('С вами свяжется наш оператор для уточнения способа безналичной оплаты.')){return true;}{return false}}{}"  id="pacagesunit">@if($PassengerCompliteRecord) Изменить запись @else Записаться @endif</button>
					@error('exisattru')
						<span class="invalid-feedback d-block" style="font-size: 16px;" role="alert">
						<strong>{{ $message }}</strong>
						</span>
					@enderror
					@error('Payment_method')
						<span class="invalid-feedback d-block" style="font-size: 16px;" role="alert">
						<strong>{{ $message }}</strong>
						</span>
					@enderror
					@error('Occupied_Place_Bus')
						<span class="invalid-feedback d-block" style="font-size: 16px;" role="alert">
						<strong>{{ $message }}</strong>
						</span>
					@enderror
					@if($PassengerCompliteRecord)
					<a class="btn col-10 col-sm-6 btn-success mb-4 bypackeg" style="color: white; background-color: #047ffc; line-height: 28px !important;" onclick="document.getElementById('form2').submit();" value="" name="form2">Отменить запись</a>
					@endif
					@error('customers_id')
						<span class="invalid-feedback d-block" style="font-size: 16px;" role="alert">
						<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>
			</form>
			@if($PassengerCompliteRecord)
			<form hidden onsubmit="if(confirm('Удалить?')){return true}else{return false}" id="form2" action="{{route('passengers.destroy',[$tour->id,$PassengerCompliteRecord])}}" method="post">
				<input type="hidden" name="_method" value="DELETE">
				@csrf
			</form>
			@endif
		</div>
		@else
			@if($PassengerCompliteRecord)
			<form class="row justify-content-center" action="{{route('passengers.destroy',[$tour->id,$PassengerCompliteRecord])}}" method="post" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="DELETE">
			@else
			<form class="row justify-content-center"  action="{{route('passengers.create_notbus', $tour)}}" method="post" enctype="multipart/form-data">
			@endif
				@csrf
			
				<p class="col-12 text-center mb-3" style="color: black; font-size: 24px;">Подробности</p>
				
					<p class="text col-6 mb-2 " style="color: black; font-size: 18px; ">Дата:</p> 
					<p class="text col-6 mb-2" style="color: black; font-size: 18px;  ">{{date('d.m.Y', strtotime($tour->Start_Date_Tours))}}</p>
					<p class="text col-6 mb-2 " style="color: black; font-size: 18px; ">Время:</p>
					<p class="text col-6 mb-2" style="color: black; font-size: 18px;  ">{{date('H:i', strtotime($tour->Start_Date_Tours))}}</p>
					<p class="text col-12 col-sm-6 mb-2 " style="color: black; font-size: 18px; ">Место отправления:</p>
					<p class="text col-12 col-sm-6 mb-2" style="color: black; font-size: 18px;  ">{{$tour->Start_point}}</p>
					<p class="text col-6 mb-2 " style="color: black; font-size: 18px; " >Ваша цена:</p>
					<p class="text col-6 mb-2" style="color: black; font-size: 18px;  " id="yourprice">@if((Auth::user()->customer->Age_customer >= 65 and Auth::user()->customer->floor == 0) or (Auth::user()->customer->Age_customer >= 60 and Auth::user()->customer->floor == 1)) {{ number_format(($tour->Privilegens_Price != 0 or $tour->Privilegens_Price != null) ? $tour->Privilegens_Price : $tour->Price, 0, ',', ' ') }}₽ @else {{number_format($tour->Price, 0, ',', ' ')}}₽ @endif</p>
					<p class="text col-7 col-sm-6 mb-2" style="color: black; font-size: 18px;  ">Способ оплаты</p>
					<div class="form-group col-5 col-sm-6 mb-2">
						<select id="selecttypeprice" class="form-control" name="Payment_method" required onchange="chengetypeprise_notbus()">
						<option selected hidden disabled value="0">Выберете способ оплаты</option>
						<option  title="С вами свяжется наш оператор" @if(old('Payment_method') == 1) selected @endif  @if(($PassengerCompliteRecord->Payment_method ?? null) == 1) selected @endif value="1">Безналичными</option>
						{{-- Сделать запись за наличные только за две недели до начала --}}
						<option value="2" @if(old('Payment_method') == 2) selected @endif @if(($PassengerCompliteRecord->Payment_method ?? null) == 2) selected @endif>Наличными </option>
						</select>
					</div>
					<input hidden type="text" id="checkselecttypeprice" name="checkselecttypeprice" value="@if(old('Payment_method') == 1)Безналичными @elseif(old('Payment_method') == 2)Наличными @endif @if(($PassengerCompliteRecord->Payment_method ?? null) == 2){{$PassengerCompliteRecord->Payment_method = 1 ? 'Наличными' : 'Безналичными'}}@endif">
					<p class="text col-7 col-sm-6 mb-1 " style="color: black; font-size: 18px; ">Итоговая цена:</p>
					<p class="text col-5 col-sm-6 mb-1" style="color: black; font-size: 18px;  " id="finalprice" data-price="">@if($PassengerCompliteRecord) @if((Auth::user()->customer->Age_customer >= 65 and Auth::user()->customer->floor == 0) or (Auth::user()->customer->Age_customer >= 60 and Auth::user()->customer->floor == 1)) {{ number_format(($tour->Privilegens_Price != 0 or $tour->Privilegens_Price != null) ? $tour->Privilegens_Price : $tour->Price, 0, ',', ' ') }}₽ @else {{number_format($tour->Price, 0, ',', ' ')}}₽ @endif @endif</p>
					@if($PassengerCompliteRecord)
						<p class="text col-12 col-sm-6 mb-1 " style="color: black; font-size: 18px; ">Статус оплаты: </p>
						<p class="text col-12 col-sm-6 mb-1" style="color: black; font-size: 18px;  " id="finalprice" data-price="">{{$PassengerCompliteRecord->Paid == 1 ? 'Оплачено' : 'Ожидаем оплаты'}}</p>
					@endif
					<div class="col-12 col-sm-6 mt-3  text-center">
						{!! NoCaptcha::display() !!}
						@if ($errors->has('g-recaptcha-response'))
							<span class="help-block">
								<strong class="text-danger" style="font-family: Raleway, sans-serif; ">{{ $errors->first('g-recaptcha-response') }}</strong>
							</span>
						@endif
					</div>
					@if($PassengerCompliteRecord)
						<button type="submit"  class="btn btn-success  col-10 col-sm-6 bypackeg mb-4" style="color: white; line-height: 28px !important;" name="form1"  id="pacagesunit">Отменить запись</button>
					@else
						<button type="submit"  class="btn btn-success  col-10 col-sm-6 bypackeg  mb-4" style="color: white; line-height: 28px !important;" name="form1" onclick="if(document.getElementById('finalprice').textContent == ''){alert('Выберете пожалуйста способ оплаты или обновите страницу и попробуйте снова!'); return false;}; if(document.getElementById('selecttypeprice').value == 1){if(confirm('С вами свяжется наш оператор для уточнения способа безналичной оплаты.')){return true;}{return false}}{}"  id="pacagesunit">Записаться</button>
					@endif
						@error('exisattru')
							<span class="invalid-feedback d-block text-center" style="font-size: 16px;" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
						@error('Payment_method')
							<span class="invalid-feedback d-block text-center" style="font-size: 16px;" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
						@error('Occupied_Place_Bus')
							<span class="invalid-feedback d-block text-center" style="font-size: 16px;" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					
			
			</form>
		@endif
	</div>
</section>
<!-- destinations -->
<script>
                // function notcomplite_tour() {             
                //     $.ajax({
                //         url: '',
                //         type: "POST",
                //         data: {tourid:, },
                //         headers: {
                //             'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                //         },

                //         success: function (data) {
                //             se}");
                //         },
                //         error: function (msg) {
                //             alert('Ошибка');
                //         }
                //     });
                // };

	
	function changeplace(params) {
		$('#Place'+document.getElementById('selectplace').textContent).css("background-color","#047ffc");
		params.style.backgroundColor = "green";
		document.getElementById('selectplace').innerText = params.dataset.idi;
		selectplaceinput.value = params.dataset.idi;
		if (document.getElementById('selecttypeprice').options[document.getElementById('selecttypeprice').selectedIndex].value != 0) {
			document.getElementById('finalprice').innerText = document.getElementById('yourprice').textContent;
		}
	}

	function chengetypeprise() {
		if (document.getElementById('selectplace').textContent != 'Место') {
			document.getElementById('finalprice').innerText = document.getElementById('yourprice').textContent;
			if (document.getElementById('selecttypeprice').value == 2) {
				checkselecttypeprice.value = 'Наличными';
			} else {
				checkselecttypeprice.value = 'Безналичными';
			}
			
		}		
	}

	function chengetypeprise_notbus() {
		if (document.getElementById('selecttypeprice').options[document.getElementById('selecttypeprice').selectedIndex].value != 0) {
			document.getElementById('finalprice').innerText = document.getElementById('yourprice').textContent;	
			if (document.getElementById('selecttypeprice').value == 2) {
				checkselecttypeprice.value = 'Наличными';
			} else {
				checkselecttypeprice.value = 'Безналичными';
			}
		}	
	}

</script>

@endsection

@push('scripts')
    {!! NoCaptcha::renderJs() !!}
@endpush