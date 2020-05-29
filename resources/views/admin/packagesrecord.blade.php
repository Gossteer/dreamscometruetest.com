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
								@if(in_array($i, $EmployePlaceRecorded))  
									<div class="icon iconforsinglepachage @if($i % 2 == 0) divamoutplace @else divamoutplace2 @endif" style="background-color: red" title="Место занято сотрудником: {{ \App\Passenger::fullnameemploye($tour->id, $i)}}" data-idi="{{$i}}" id="Place{{$i}}">
										<span class="priceforsinglepachage">{{$i}}</span>
									</div>
								@elseif(in_array($i, $CustomerPlaceRecordedPaid)) 
									<div class="icon iconforsinglepachage @if($i % 2 == 0) divamoutplace @else divamoutplace2 @endif" style="background-color: red" title="Место выкуплено: {{ \App\Passenger::fullname($tour->id, $i)}}" data-idi="{{$i}}" id="Place{{$i}}">
										<span class="priceforsinglepachage">{{$i}}</span>
									</div>
								@elseif(in_array($i, $CustomerPlaceRecorded)) 
                                    <div class="icon iconforsinglepachage @if($i % 2 == 0) divamoutplace @else divamoutplace2 @endif" style="background-color: yellowgreen" title="Место забронировано: {{ \App\Passenger::fullname($tour->id, $i)}}"  data-idi="{{$i}}" id="Place{{$i}}">
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
			<form class="col col-lg-7 text-center"  action="{{route('passengers.createadmin', $tour)}}" method="post" enctype="multipart/form-data">
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
                        <p class="text col-12 mb-2 " style="color: black; font-size: 18px; ">Cвободных мест всего:</p> 
                        <p class="text col-6 mb-2" style="color: black; font-size: 18px;  ">{{ $tour->Amount_Place - $tour->Occupied_Place}}</p>
                        <p class="text col-12 mb-2 " style="color: black; font-size: 18px; ">Cвободных мест в автобусе:</p> 
                        <p class="text col-6 mb-2" style="color: black; font-size: 18px;  ">{{ $bus_tour->bus->Amount_Place_Bus - $passenger->count() - $Amount_place_employees}}</p>
                        <div class="col-12 mb-3 mt-3 daddivamoutplacelast" style="padding-left: 2.5%; padding-right: 2.5%;">
                        <div class="row mt-3 mb-3 text-center " style="margin-right: 0px;">
                                    <div class="col-lg-4 col-6 counter"style="	padding-bottom: 20px ;" >
                                        <div >
                                            <div class="icon iconforsinglepachage" >
                                                <span class="priceforsinglepachage">{{ number_format($tour->Price, 0, ',', ' ') }}₽</span>
                                                <input type="number" hidden id="Price" value="{{$tour->Price}}">
                                            </div>
                                            <h4 >Цена</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-6 counter" style="	padding-bottom: 20px ;">
                                        <div >
                                            <div class="icon iconforsinglepachage">
                                                <span class="priceforsinglepachage">{{ number_format($tour->Privilegens_Price ?? $tour->Price, 0, ',', ' ') }}₽</span>
                                                <input type="number" hidden id="Privilegens_Price" value="{{$tour->Privilegens_Price ?? $tour->Price}}">
                                            </div>
                                            <h4 style="">Пенсионеры</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-6 counter" style="	padding-bottom: 20px ;">
                                        <div >
                                            <div class="icon iconforsinglepachage">
                                                <span class="priceforsinglepachage">{{ number_format($tour->Children_price ?? $tour->Price, 0, ',', ' ') }}₽</span>
                                                <input type="number" hidden id="Children_price" value="{{$tour->Children_price ?? $tour->Price}}">
                                            </div>
                                            <h4>Дети</h4>
                                        </div>
                                    </div>
                        </div>
                            <div >
                                <div class="icon iconforsinglepachage divamoutplacelast" style="background-color: green"   title="Ваше место">
                                    <span class="priceforsinglepachage" id="selectplace">Место</span>
                                    <input type="number" id="selectplaceinput" name="Occupied_Place_Bus" value="0"  hidden>
                                </div>
                            </div>
                        </div>
                        <p class="text col-7 col-sm-6 mb-2" style="color: black; font-size: 18px;  ">Способ оплаты</p>
                        <div class="form-group col-5 col-sm-6 mb-2">
                            <select id="selecttypeprice" class="form-control @error('Payment_method') is-invalid @enderror"  name="Payment_method" required onchange="chengetypeprise()">
                            <option selected hidden disabled value="0">Выберете способ оплаты</option>
                            <option value="1"  @if(old('Payment_method') == 1) selected @endif>Безналичными</option>
                            {{-- Сделать запись за наличные только за две недели до начала --}}
                            <option value="2" @if(old('Payment_method') == 2) selected @endif>Наличными</option>
                            </select>
                            @error('Payment_method')
                                <span class="invalid-feedback d-block" style="font-size: 16px;" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <p class="text col-7 col-sm-6 mb-2" style="color: black; font-size: 18px;  ">Клиент</p>
                        <div class="form-group col-5 col-sm-6 mb-2">
                            <select class="selectpicker form-control @error('customers_id') is-invalid @enderror" data-id="" onchange="index(this.value, 0)" name="customers_id" id="customer_select" data-live-search="true"  data-live-search-style="startsWith" data-size="8" title="Выберете клиента" data-show-subtext="true">
                                @foreach ($customers as $customer)
                                    <option  
                                    @if(in_array($customer->id, $CustomerRecordedPaid_array))  
                                        data-icon="fa fa-pencil"  style="background-color: red;"
								    @elseif(in_array($customer->id, $CustomerRecorded_array)) 
                                        data-icon="fa fa-pencil"  style="background-color: yellowgreen;"
								    @endif

                                    data-tokens="{{substr(str_replace($str_delete,'',$customer->Phone_Number_Customer), 1)}}" data-subtext="
                                        @switch($customer->Condition)
                                            @case(-1)
                                                Заблокирован
                                                @break

                                            @case(0)
                                                Неподтверждён
                                                @break
                                            
                                            @case(1)
                                                Подтверждён
                                                @break

                                            @case(2)
                                                Постоянный
                                                @break
                                        @endswitch
                                        " value="{{$customer->id}}" >{{ $customer->Surname . ' ' . mb_substr($customer->Name, 0, 1)  . '. ' . mb_substr($customer->Middle_Name, 0, 1) . ($customer->Middle_Name != '' ? '.' : '') }}</option>
                                @endforeach
                            </select>
                            @error('customers_id')
                                <span class="invalid-feedback d-block" style="font-size: 16px;" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input hidden type="text" id="checkselecttypeprice" name="checkselecttypeprice" value="">
                        <p class="text col-3 col-sm-6 mb-1 " style="color: black; font-size: 18px; " id="full_name_customer_text" hidden>ФИО:</p>
                        <p class="text col-12 col-sm-6 mb-1" style="color: black; font-size: 18px;  " id="full_name_customer" hidden></p>
                        <p class="text col-6 col-sm-6 mb-1 " style="color: black; font-size: 18px; " id="duration_date_text" hidden>Возраст:</p>
                        <p class="text col-6 col-sm-6 mb-1" style="color: black; font-size: 18px;  " id="duration_date" data-price="" hidden></p>
                        <p class="text col-12 col-sm-6 mb-1 " style="color: black; font-size: 18px; " id="phone_customer_text" hidden>Телефон:</p>
                        <p class="text col-12 col-sm-6 mb-1" style="color: black; font-size: 18px;  " id="phone_customer" data-price="" hidden></p>
                        <p class="text col-12 col-sm-6 mb-1 " style="color: black; font-size: 18px; " id="count_tours_text" hidden>Совместных мероприятий:</p>
                        <p class="text col-3 col-sm-6 mb-1" style="color: black; font-size: 18px;  " id="count_tours" data-price="" hidden></p>
                        <p class="text col-12 col-sm-6 mb-1 " style="color: black; font-size: 18px; " id="inviter_text" hidden>Пригласивший:</p>
                        <p class="text col-12 col-sm-6 mb-1" style="color: black; font-size: 18px;  " id="inviter" data-price="" hidden></p>
                        <p class="text col-12 col-sm-6 mb-1 " style="color: black; font-size: 18px; " id="Amount_Children_text" hidden>Количество детей:</p>
                        <div class="form-group col-10 col-sm-6 mb-2" id="Amount_Children_div" hidden>
                            <input  type="number" min="0" max="1000" pattern="/^-?\d+\.?\d*$/" oninput="Amount_Children_Cheng(this.value)" onKeyPress="if(this.value.length==4) return false;" class="form-control @error('Amount_Children') is-invalid @enderror" name="Amount_Children" hidden id="Amount_Children" placeholder="Количество детей">
                            @error('Amount_Children')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <p class="text col-12 col-sm-6 mb-1 " style="color: black; font-size: 18px; " id="Free_Children_text" hidden>Бесплатные дети:</p>
                        <div class="form-group col-10 col-sm-6 mb-2" id="Free_Children_div" hidden>
                            <input  type="number" min="0" max="1000" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" class="form-control @error('Free_Children') is-invalid @enderror" name="Free_Children" hidden id="Free_Children" placeholder="Количество бесплатных детей">
                            @error('Free_Children')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <p class="text col-7 col-sm-6 mb-1 " style="color: black; font-size: 18px; " id="Accompanying_text" hidden>Сопровождающий:</p>
                        <div class="form-group col-10 col-sm-6 mb-2" id="Accompanying_div" hidden>
                            <select id="Accompanying" class="form-control"  name="Accompanying" onchange="AccompanyingCheng(this.value)">
                            <option selected hidden disabled >Сопровождающий?</option>
                            <option value="0" @if(old('Accompanying') == 0) selected @endif>Нет</option>
                            {{-- Сделать запись за наличные только за две недели до начала --}}
                            <option value="1" @if(old('Accompanying') == 1) selected @endif>Да</option>
                            </select>
                            @error('Accompanying')
                                <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <p class="text col-7 col-sm-6 mb-1 " style="color: black; font-size: 18px; " id="Paid_text" hidden>Оплата:</p>
                        <div class="form-group col-10 col-sm-6 mb-2" id="Paid_div" hidden>
                            <select id="Paid" class="form-control"  name="Paid" >
                            <option value="0" selected @if(old('Paid') == 0) selected @endif>Нет</option>
                            {{-- Сделать запись за наличные только за две недели до начала --}}
                            <option value="1" @if(old('Paid') == 1) selected @endif>Да</option>
                            </select>
                            @error('Paid')
                                <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <p class="text col-12 col-sm-6 mb-1 " style="color: black; font-size: 18px; " id="finalprice_text" >Итоговая цена:</p>
                        <div class="form-group col-11 col-sm-6 mb-2" id="Final_Price_div" >
                            <input  type="number" min="0" max="2147483647" pattern="/^-?\d+\.?\d*$/" data-amountchildren="0" data-agegroop="" onKeyPress="if(this.value.length==10) return false;" class="form-control @error('Final_Price') is-invalid @enderror" name="Final_Price" disabled id="finalprice" placeholder="Итоговая цена">
                            @error('Final_Price')
                                <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit"  class="btn btn-success col-10 col-sm-6 bypackeg " style="color: white; line-height: 28px !important;" name="form1" onclick="if(document.getElementById('selectplaceinput').value == 0){if(confirm('Вы не выбрали место, продолжить?')){return true}{return false}}"  id="pacagesunit">Записать</button>
                        @error('exisattru')
                            <span class="invalid-feedback d-block" style="font-size: 16px;" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('Occupied_Place_Bus')
                            <span class="invalid-feedback d-block" style="font-size: 16px;" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <a class="btn col-10 col-sm-6 btn-success bypackeg" hidden style="color: white; background-color: #047ffc; line-height: 28px !important;" onclick="document.getElementById('form2').submit();" id="delete_button" value="" name="form2">Отменить запись</a>
                        <a href="{{ route('tours.show', $tour) }}" class="btn btn-success col-10 col-sm-6 bypackeg mb-3" style="background-color:#047ffc;  color: white; line-height: 28px !important;" >Назад</a>
                        
                    </div>
                </div>
            </form>
            <form hidden onsubmit="if(confirm('Удалить?')){return true}else{return false}" id="form2" action="{{route('destroyadmin',$tour->id)}}" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="number" hidden name="customers_id" id="customers_select_form2">
				@csrf
			</form>
		</div>
		@else
			<form class="row justify-content-center"  action="{{route('passengers.createadmin', $tour)}}" method="post" enctype="multipart/form-data">
				@csrf
                    <p class="col-12 mb-3 text-center" style="color: black; font-size: 24px;">Подробности</p>
                        <p class="text col-6 mb-2 " style="color: black; font-size: 18px; ">Дата:</p> 
                        <p class="text col-6 mb-2" style="color: black; font-size: 18px;  ">{{date('d.m.Y', strtotime($tour->Start_Date_Tours))}}</p>
                        <p class="text col-6 mb-2 " style="color: black; font-size: 18px; ">Время:</p>
                        <p class="text col-6 mb-2" style="color: black; font-size: 18px;  ">{{date('H:i', strtotime($tour->Start_Date_Tours))}}</p>
                        <p class="text col-12 col-sm-6 mb-2 " style="color: black; font-size: 18px; ">Место отправления:</p>
                        <p class="text col-12 col-sm-6 mb-2" style="color: black; font-size: 18px;  ">{{$tour->Start_point}}</p>
                        <div class=" col-12 col-sm-12 mb-2">
                            <div class="row mt-3 mb-3 text-center ">
                                <div class="col-lg-4 col-6 counter"style="	padding-bottom: 20px ;" >
                                    <div >
                                        <div class="icon iconforsinglepachage" >
                                            <span class="priceforsinglepachage">{{ number_format($tour->Price, 0, ',', ' ') }}₽</span>
                                            <input type="number" hidden id="Price" value="{{$tour->Price}}">
                                        </div>
                                        <h4 >Цена</h4>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-6 counter" style="	padding-bottom: 20px ;">
                                    <div >
                                        <div class="icon iconforsinglepachage">
                                            <span class="priceforsinglepachage">{{ number_format($tour->Privilegens_Price ?? $tour->Price, 0, ',', ' ') }}₽</span>
                                            <input type="number" hidden id="Privilegens_Price" value="{{$tour->Privilegens_Price ?? $tour->Price}}">
                                        </div>
                                        <h4 style="">Пенсионеры</h4>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-6 counter" style="	padding-bottom: 20px ;">
                                    <div >
                                        <div class="icon iconforsinglepachage">
                                            <span class="priceforsinglepachage">{{ number_format($tour->Children_price ?? $tour->Price, 0, ',', ' ') }}₽</span>
                                            <input type="number" hidden id="Children_price" value="{{$tour->Children_price ?? $tour->Price}}">
                                        </div>
                                        <h4>Дети</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <p class="text col-7 col-sm-6 mb-2" style="color: black; font-size: 18px;  ">Способ оплаты</p>
                        <div class="form-group col-5 col-sm-6 mb-2">
                            <select id="selecttypeprice" class="form-control  @error('Payment_method') is-invalid @enderror" name="Payment_method" onchange="chengetypeprise_notbus()">
                            <option selected hidden disabled value="0">Выберете способ оплаты</option>
                            <option value="1">Безналичными</option>
                            {{-- Сделать запись за наличные только за две недели до начала --}}
                            <option value="2">Наличными </option>
                            </select>
                            @error('Payment_method')
                                <span class="invalid-feedback d-block" style="font-size: 16px;" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <p class="text col-7 col-sm-6 mb-2" style="color: black; font-size: 18px;  ">Клиент</p>
                        <div class="form-group col-5 col-sm-6 mb-2">
                            <select class="selectpicker form-control @error('customers_id') is-invalid @enderror" data-id="asdasd" onchange="index(this.value, 1)" name="customers_id" id="customer_select" data-live-search="true"  data-live-search-style="startsWith" data-size="8" title="Выберете клиента" data-show-subtext="true">
                                @foreach ($customers as $customer)
                                    <option
                                    @if(in_array($customer->id, $CustomerRecordedPaid_array))  
                                        data-icon="fa fa-pencil"  style="background-color: red;"
								    @elseif(in_array($customer->id, $CustomerRecorded_array)) 
                                        data-icon="fa fa-pencil"  style="background-color: yellowgreen;"
								    @endif
                                     data-tokens="{{substr(str_replace($str_delete,'',$customer->Phone_Number_Customer), 1)}}" data-subtext="
                                        @switch($customer->Condition)
                                            @case(-1)
                                                Заблокирован
                                                @break

                                            @case(0)
                                                Неподтверждён
                                                @break
                                            
                                            @case(1)
                                                Подтверждён
                                                @break

                                            @case(2)
                                                Постоянный
                                                @break
                                        @endswitch
                                        "  value="{{$customer->id}}">{{ $customer->Surname . ' ' . mb_substr($customer->Name, 0, 1)  . '. ' . mb_substr($customer->Middle_Name, 0, 1) . ($customer->Middle_Name != '' ? '.' : '') }}</option>
                                @endforeach
                            </select>
                            @error('customers_id')
                                <span class="invalid-feedback d-block" style="font-size: 16px;" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input hidden type="text" id="checkselecttypeprice" name="checkselecttypeprice" value="">
                        <p class="text col-3 col-sm-6 mb-1 " style="color: black; font-size: 18px; " id="full_name_customer_text" hidden>ФИО:</p>
                        <p class="text col-12 col-sm-6 mb-1" style="color: black; font-size: 18px;  " id="full_name_customer" hidden></p>
                        <p class="text col-6 col-sm-6 mb-1 " style="color: black; font-size: 18px; " id="duration_date_text" hidden>Возраст:</p>
                        <p class="text col-6 col-sm-6 mb-1" style="color: black; font-size: 18px;  " id="duration_date" data-price="" hidden></p>
                        <p class="text col-12 col-sm-6 mb-1 " style="color: black; font-size: 18px; " id="phone_customer_text" hidden>Телефон:</p>
                        <p class="text col-12 col-sm-6 mb-1" style="color: black; font-size: 18px;  " id="phone_customer" data-price="" hidden></p>
                        <p class="text col-12 col-sm-6 mb-1 " style="color: black; font-size: 18px; " id="count_tours_text" hidden>Совместных мероприятий:</p>
                        <p class="text col-3 col-sm-6 mb-1" style="color: black; font-size: 18px;  " id="count_tours" data-price="" hidden></p>
                        <p class="text col-12 col-sm-6 mb-1 " style="color: black; font-size: 18px; " id="inviter_text" hidden>Пригласивший:</p>
                        <p class="text col-12 col-sm-6 mb-1" style="color: black; font-size: 18px;  " id="inviter" data-price="" hidden></p>
                        <p class="text col-12 col-sm-6 mb-1 " style="color: black; font-size: 18px; " id="Amount_Children_text" hidden>Количество детей:</p>
                        <div class="form-group col-10 col-sm-6 mb-2" id="Amount_Children_div" hidden>
                            <input  type="number" min="0" max="1000" pattern="/^-?\d+\.?\d*$/" oninput="Amount_Children_Cheng(this.value)" onKeyPress="if(this.value.length==4) return false;" class="form-control @error('Amount_Children') is-invalid @enderror" name="Amount_Children" hidden id="Amount_Children" placeholder="Количество детей">
                            @error('Amount_Children')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <p class="text col-12 col-sm-6 mb-1 " style="color: black; font-size: 18px; " id="Free_Children_text" hidden>Бесплатные дети:</p>
                        <div class="form-group col-10 col-sm-6 mb-2" id="Free_Children_div" hidden>
                            <input  type="number" min="0" max="1000" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" class="form-control @error('Free_Children') is-invalid @enderror" name="Free_Children" hidden id="Free_Children" placeholder="Количество бесплатных детей">
                            @error('Free_Children')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <p class="text col-7 col-sm-6 mb-1 " style="color: black; font-size: 18px; " id="Accompanying_text" hidden>Сопровождающий:</p>
                        <div class="form-group col-10 col-sm-6 mb-2" id="Accompanying_div" hidden>
                            <select id="Accompanying" class="form-control"  name="Accompanying" onchange="AccompanyingCheng(this.value)">
                            <option selected hidden disabled >Сопровождающий?</option>
                            <option value="0" @if(old('Accompanying') == 0) selected @endif>Нет</option>
                            {{-- Сделать запись за наличные только за две недели до начала --}}
                            <option value="1" @if(old('Accompanying') == 1) selected @endif>Да</option>
                            </select>
                            @error('Accompanying')
                                <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <p class="text col-7 col-sm-6 mb-1 " style="color: black; font-size: 18px; " id="Paid_text" hidden>Оплата:</p>
                        <div class="form-group col-10 col-sm-6 mb-2" id="Paid_div" hidden>
                            <select id="Paid" class="form-control"  name="Paid" >
                            <option value="0" selected @if(old('Paid') == 0) selected @endif>Нет</option>
                            {{-- Сделать запись за наличные только за две недели до начала --}}
                            <option value="1" @if(old('Paid') == 1) selected @endif>Да</option>
                            </select>
                            @error('Paid')
                                <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="text col-12 col-sm-6 mb-1 " style="color: black; font-size: 18px; " id="finalprice_text" >Итоговая цена:</p>
                        <div class="form-group col-11 col-sm-6 mb-2" id="Final_Price_div" >
                            <input  type="number" min="0" max="2147483647" pattern="/^-?\d+\.?\d*$/" data-amountchildren="0" data-agegroop="" onKeyPress="if(this.value.length==10) return false;" class="form-control @error('Final_Price') is-invalid @enderror" name="Final_Price" disabled id="finalprice" placeholder="Итоговая цена">
                            @error('Final_Price')
                                <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit"  class="btn btn-success col-10 col-sm-6 bypackeg " style="color: white; line-height: 28px !important;" name="form1"   id="pacagesunit">Записать</button>
                        @error('exisattru')
                            <span class="invalid-feedback d-block" style="font-size: 16px;" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('Occupied_Place_Bus')
                            <span class="invalid-feedback d-block" style="font-size: 16px;" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <a class="btn col-10 col-sm-6 btn-success bypackeg" style="color: white; background-color: #047ffc; line-height: 28px !important;" onclick="document.getElementById('form2').submit();" id="delete_button" value="" name="form2">Отменить запись</a>
                        <a href="{{ route('tours.show', $tour) }}" class="btn btn-success col-10 col-sm-6 bypackeg mb-3" style="background-color:#047ffc;  color: white; line-height: 28px !important;" >Назад</a>
            </form>
            <form hidden onsubmit="if(confirm('Удалить?')){return true}else{return false}" id="form2" action="{{route('destroyadmin',$tour->id)}}" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="number" hidden name="customers_id" id="customers_select_form2">
				@csrf
			</form>
		@endif
	</div>
</section>
<!-- destinations -->

<script>
    function Amount_Children_Cheng(params) {
        if ( document.getElementById('finalprice').dataset.amountchildren < params) {
            document.getElementById('finalprice').value = parseInt(document.getElementById('finalprice').value) + ((params - document.getElementById('finalprice').dataset.amountchildren) * parseInt(document.getElementById('Children_price').value));
            document.getElementById('finalprice').dataset.amountchildren = params;
        } else if(document.getElementById('finalprice').dataset.amountchildren > params) {
            document.getElementById('finalprice').value = parseInt(document.getElementById('finalprice').value) - ((document.getElementById('finalprice').dataset.amountchildren - params) * parseInt(document.getElementById('Children_price').value));
            document.getElementById('finalprice').dataset.amountchildren = params;
        }
    }

    function AccompanyingCheng(params) {
        if (params == 1) {
            if (document.getElementById('finalprice').dataset.agegroop == 1) {
                document.getElementById('finalprice').value -= document.getElementById('Privilegens_Price').value;
            } else {
                document.getElementById('finalprice').value -= document.getElementById('Price').value;
            }
            
        } else {
            if (document.getElementById('finalprice').dataset.agegroop == 1) {
                document.getElementById('finalprice').value = parseInt(document.getElementById('finalprice').value) + parseInt(document.getElementById('Privilegens_Price').value);

            } else {
                document.getElementById('finalprice').value = parseInt(document.getElementById('finalprice').value) + parseInt(document.getElementById('Price').value);
            }
        }
    }

                    function index(params, bus_not){
                                            var customer_id = params;
                                            var tour_id = {{$tour->id}}
                                            document.getElementById('customers_select_form2').value = params;
                                            $.ajax({
                                                url: "{{route('customer.indexrecord')}}",
                                                type: "POST",
                                                data: {customer_id:customer_id, tour_id:tour_id},
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success:function (data)
                                                {   
                                                    if (data['exists_for_rour']) {
                                                        document.getElementById('pacagesunit').innerText = 'Изменить запись';
                                                        if (!bus_not) {
                                                            document.getElementById('selectplaceinput').value = data['Occupied_Place_Bus']; 
                                                            document.getElementById('selectplace').innerText = data['Occupied_Place_Bus'] == 0 ? 'Место' : data['Occupied_Place_Bus'] ;
                                                        }
                                                        document.getElementById('delete_button').hidden = false;
                                                        document.getElementById('Paid').value = data['Paid'];
                                                        document.getElementById('Amount_Children').value = data['Amount_Children'];
                                                        document.getElementById('Free_Children').value = data['Free_Children'];
                                                        document.getElementById('Accompanying').value = data['Accompanying']; 
                                                        document.getElementById('selecttypeprice').value = data['Payment_method'];
                                                        document.getElementById('checkselecttypeprice').value = data['Payment_method_text'];
                                                    } else {
                                                        if (!bus_not) {
                                                            document.getElementById('selectplaceinput').value = data['Occupied_Place_Bus'];
                                                            document.getElementById('selectplace').innerText = data['Occupied_Place_Bus'] == 0 ? 'Место' : data['Occupied_Place_Bus'] ;
                                                        }
                                                        document.getElementById('delete_button').hidden = true;
                                                        document.getElementById('Paid').value = data['Paid'];
                                                        document.getElementById('pacagesunit').innerText = 'Записать';
                                                        document.getElementById('Amount_Children').value = data['Amount_Children'];
                                                        document.getElementById('Free_Children').value = data['Free_Children'];
                                                        document.getElementById('Accompanying').value = data['Accompanying'];
                                                        if (document.getElementById('selecttypeprice').value == 0) {
                                                            document.getElementById('selecttypeprice').value = data['Payment_method'];
                                                            document.getElementById('checkselecttypeprice').value = data['Payment_method_text'];
                                                        } 
                                                        
                                                    }
                                                    
                                                    document.getElementById('Paid_text').hidden = false; 
                                                    document.getElementById('Paid_div').hidden = false;
                                                    document.getElementById('full_name_customer').innerText =  data['full_name_customer'];
                                                    document.getElementById('full_name_customer').hidden = false; 
                                                    document.getElementById('full_name_customer_text').hidden = false; 
                                                    document.getElementById('duration_date').innerText = data['duration_date'] + ' лет';
                                                    document.getElementById('duration_date_text').hidden = false; 
                                                    document.getElementById('duration_date').hidden = false;
                                                    document.getElementById('phone_customer').innerText = data['phone_customer'];
                                                    document.getElementById('phone_customer').hidden = false;
                                                    document.getElementById('phone_customer_text').hidden = false; 
                                                    if (data['inviter'] != 0) {
                                                        document.getElementById('inviter').innerText = data['inviter'];
                                                        document.getElementById('inviter').hidden = false;
                                                        document.getElementById('inviter_text').hidden = false; 
                                                    } else {
                                                        document.getElementById('inviter').hidden = true;
                                                        document.getElementById('inviter_text').hidden = true; 
                                                    }
                                                    document.getElementById('finalprice').value = data['finalprice'];
                                                    document.getElementById('finalprice').dataset.agegroop = data['age_groop'];
                                                    document.getElementById('finalprice').disabled = false;
                                                    document.getElementById('Accompanying_div').hidden = false;
                                                    document.getElementById('Amount_Children_div').hidden = false;
                                                    document.getElementById('Free_Children_div').hidden = false;
                                                    document.getElementById('Accompanying_text').hidden = false; 
                                                    document.getElementById('Amount_Children').hidden = false;
                                                    document.getElementById('Amount_Children_text').hidden = false; 
                                                    document.getElementById('Free_Children').hidden = false;
                                                    document.getElementById('Free_Children_text').hidden = false; 
                                                    document.getElementById('count_tours').innerText = data['count_tours'];
                                                    document.getElementById('count_tours').hidden = false;
                                                    document.getElementById('count_tours_text').hidden = false; 
                                                },
                                                error: function (msg) {
                                                    alert('Ошибка');
                                                }
                                            });
                };
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
	}

	function chengetypeprise() {
			if (document.getElementById('selecttypeprice').value == 2) {
				checkselecttypeprice.value = 'Наличными';
			} else {
				checkselecttypeprice.value = 'Безналичными';
			}
	
	}

	function chengetypeprise_notbus() {
		if (document.getElementById('selecttypeprice').options[document.getElementById('selecttypeprice').selectedIndex].value != 0) {
			
			if (document.getElementById('selecttypeprice').value == 2) {
				checkselecttypeprice.value = 'Наличными';
			} else {
				checkselecttypeprice.value = 'Безналичными';
			}
		}	
	}

</script>

@endsection

