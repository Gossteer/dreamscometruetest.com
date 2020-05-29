@extends('layouts.site')

@section('content')

    <!-- banner -->
    <section class="banner_inner" id="home">
        <div class="banner_inner_overlay">
        </div>
    </section>
    <!-- //banner -->

    <section class="destinations py-4" id="destinations">
        <div class="container py-xl-2 py-lg-3">
            <h3 class="heading text-capitalize text-center">Ваши данные</h3>
            <div class="row mt-5 text-center">
                <div class="col-lg-4 col-sm-6 mt-sm-0 mt-5">
                    <div class="">
                        <div class="icon">
                            <span class="fa fa-calendar"></span>
                        </div>
                        <h3>Аккаунт</h3>
                        <p class="text mt-3 text-left" style="padding-left: 25%">Логин: {{ $customer->user->login }}</p>
                        <p class="text text-left" style="padding-left: 25%">Email: {{ $customer->user->email }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div >
                        <div class="icon">
                            <span class="fa fa-map-signs"></span>
                        </div>
                        <h3>Подробнее</h3>
                        <p class="text mt-3 text-left" style="padding-left: 20%">ФИО: {{ $customer->Name . ' ' . $customer->Surname . ' ' . $customer->Middle_Name  }}</p>
                        <p class="text text-left" style="padding-left: 20%">Телефон: {{ $customer->Phone_Number_Customer  }}</p>
                        <p class="text text-left" style="padding-left: 20%">Человек пришедших от вас: {{ $customer->Amount_Customers_Listed  }}</p>
                        <p class="text text-left" style="padding-left: 20%">Экскурсий: {{ $customer->White_Days  }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mt-lg-0 mt-5">
                    <div class="">
                        <div class="icon">
                            <span class="fa fa-gift"></span>
                        </div>
                        <h3>Статусы</h3>
                        <span>
                            @if(($customer->Age_customer >= 65 and $customer->floor == 0) or ($customer->Age_customer >= 60 and $customer->floor == 1))
                            <p class="text mt-3 text-center"><strong>Льготник</strong></p>
                            @else
                            <p hidden {{$calss = 'mt-3'}}></p>
                            @endif
                            @switch($customer->Condition)
                            @case(-1)
                            <p  class="text {{$calss ?? '' }} text-center" style="color: red;"><strong>Ненадёжный</strong></p>
                            <small id="passwordHelpBlock" class="form-text text-muted">
                                Вы отмечены как ненадёжный клиент, вам заблокирована возможность записи на мероприятия. Для уточнения подробностей пожалуйста свяжитесь с нами!
                            </small>
                                @break
                            @case(0)
                            <p  class="text {{$calss ?? ''}} text-center" style="">Неподтверждён</p>
                            <small id="passwordHelpBlock" class="form-text text-muted">
                                Ваш аккаунт в процессе подтверждения, пока вам заблокирована возможность записи на мероприятия через сайт. Если процесс затянулся пожалуйста обратитьесь к нам!
                            </small>
                            @break
                            @case(1)
                            <p  class="text {{$calss ?? ''}} text-center" style="color: green;"><strong>Подверждён</strong></p>
                            @break
                            @case(2)
                            <p  class="text {{$calss ?? ''}} text-center" style="color: gold;"><strong>Золотой клиент</strong></p>
                            @break
                        @endswitch
                        </span>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="packages ">
        <div class="container py-lg-4 py-sm-3">
            <h3 class="heading text-capitalize text-center mt-2 mb-5">Предстоящие мероприятия</h3>
            <div class="row">
                @foreach($passengers as $passenger)
                <div class="col-lg-3 col-sm-6 mb-4" href="">
					<div class="image-tour position-relative">
						<a href="{{route('tourdescript',[$passenger->id, str_slug($passenger->Name_Tours, '-')])}}"><img src="images/banner1.jpg"  alt="" class="img-fluid" /></a>
						<p><span class="fa fa-tags"></span> <span id="{{$passenger->id}}">
								{{ number_format((($passenger->Privilegens_Price > $passenger->Children_price and $passenger->Children_price != null) ? $passenger->Children_price : $passenger->Privilegens_Price) ?? $passenger->Price, 0, ',', ' ') }}₽
							</span></p>
					</div>
					<div class="package-info">
						<h6 class="mt-1" style="font-family: Open Sans, sans-serif;"><span class="fa fa-map-marker mr-2"></span>{{ $passenger->Name_Tours }}</h6>
						<h5 class="my-2" style="font-family: Open Sans, sans-serif;">{{ $passenger->Name_Tours }}</h5>
						<p class="" style="font-family: Open Sans, sans-serif;">{{str_limit($passenger->Description,20,'...')}}</p>
						<ul class="listing mt-3" style="font-family: Open Sans, sans-serif;">
							<li><span  class="fa fa-clock-o mr-2" ></span>Дата: <span @if($Carbon  >= $passenger->Start_Date_Tours and $Cardon_hot <= $passenger->Start_Date_Tours) style="color: red;" title="Экскурсия состоится мене чем через 2 недели. Успейте записаться!" @endif @if($Carbon  < $passenger->Start_Date_Tours) style="color: green;" @endif> {{date('d-m-Y H:i', strtotime($passenger->Start_Date_Tours)) }}</span></li>
                            <li><span  class="fa fa-money mr-1" ></span>Оплата: {{$passenger->Paid == 1 ? 'Оплачено' : 'Ожидаем'}}</li>
                        </ul>
						
                        <a class="btn btn-success" id="pacagesunit" href="{{route('tourdescript',[$passenger->id, str_slug($passenger->Name_Tours, '-')])}}">Подробнее</a>
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
            @if($passengers->total() > $passengers->count())
                <div class="row mb-5 justify-content-center">
                    <div class="bootstrap-pagination" >
                        <nav>
                            <ul class="pagination">
                                {{ $passengers->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section class="packages ">
        <div class="container py-lg-4 py-sm-3">
            <h3 class="heading text-capitalize text-center mt-2 mb-5">Прошедшие мероприятия</h3>
            <div class="row">
                @foreach($passengers_end as $passenger_end)
                <div class="col-lg-3 col-sm-6 mb-4" href="">
					<div class="image-tour position-relative">
						<a href="{{route('tourdescript',[$passenger_end->id, str_slug($passenger_end->Name_Tours, '-')])}}"><img src="images/banner1.jpg"  alt="" class="img-fluid" /></a>
						<p><span class="fa fa-tags"></span> <span id="{{$passenger_end->id}}">
								{{ number_format((($passenger_end->Privilegens_Price > $passenger_end->Children_price and $passenger_end->Children_price != null) ? $passenger_end->Children_price : $passenger_end->Privilegens_Price) ?? $passenger_end->Price, 0, ',', ' ') }}₽
							</span></p>
					</div>
					<div class="package-info">
						<h6 class="mt-1" style="font-family: Open Sans, sans-serif;"><span class="fa fa-map-marker mr-2"></span>{{ $passenger_end->Name_Tours }}</h6>
						<h5 class="my-2" style="font-family: Open Sans, sans-serif;">{{ $passenger_end->Name_Tours }}</h5>
						<p class="" style="font-family: Open Sans, sans-serif;">{{str_limit($passenger_end->Description,20,'...')}}</p>
						<ul class="listing mt-3" style="font-family: Open Sans, sans-serif;">
							<li><span  class="fa fa-clock-o mr-2" ></span>Дата: <span @if($Cardon_hot  >= $passenger_end->Start_Date_Tours and $Cardon_hot <= $passenger_end->End_Date_Tours) style="color: LightBlue;" title="Экскурсия продолжается!" @endif> {{date('d-m-Y H:i', strtotime($passenger_end->Start_Date_Tours)) }}</span></li>
                            <li><span  class="fa fa-money mr-1" ></span>Оплата: {{$passenger_end->Paid == 1 ? 'Оплачено' : 'Ожидаем'}}</li>
                        </ul>
						
                            <a class="btn btn-success" style="line-height: 28px !important;" id="pacagesunit" href="{{route('tourdescript',[$passenger_end->id, str_slug($passenger_end->Name_Tours, '-')])}}">Подробнее</a>
                        @if($Cardon_hot  >= $passenger_end->Start_Date_Tours and $Cardon_hot >= $passenger_end->End_Date_Tours and $passenger_end->Paid == 1)
                        <a class="btn btn-success text-white pacagesunitbutton" data-toggle="modal" style="margin-top: 6px; line-height: 28px !important;" data-target="#addArticle" data-idi="{{$passenger_end->id}}" onclick="document.getElementById('save_stars').dataset.idi = this.dataset.idi; {{($passenger_end->Stars == null and $passenger_end->Comment_Customer == null) ? '' : 'indexstar(this.dataset.idi)'}}" id="pacagesunit{{$passenger_end->id}}" >{{($passenger_end->Stars == null and $passenger_end->Comment_Customer == null) ? 'Оставить отзыв' : 'Изменить отзыв'}}</a>
                        @endif
					</div>
			    </div>
                @endforeach
            </div>
            <div class="modal fade mt-5 pt-5" style="" id="addArticle" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title " id="addArticleLabel">Ваш отзыв</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group ">
                                <label for="Stars">Ваша оценка: <span class="text-danger" id="valuestars">5*</span></label>
                                <input type="range" class="custom-range col-12" style="padding-left: 0px; padding-right: 0px;" oninput="chowvalue(this.value)" onchange="chowvaluebad(this.value)" min="0" max="10" value="5" id="Stars">
                                <h6 class="m-t-10" style="font-size: 14px">0 (Без оценки)<span class="pull-right">10 (Прекрасно)</span></h6>
                                <small id="passwordHelpBlock" hidden class="form-text text-center text-muted mt-2">
                                    Если вам что-либо доставило дискомфорт, пожалуйста свяжитесь с нами 
                                </small>
                                @error('Stars')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Comment_Customer">Ваш комментарий</label>
                                <textarea class="form-control" name="Comment_Customer" id="Comment_Customer" cols="30" rows="5"></textarea>
                                @error('Comment_Customer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" style="font-family: Open Sans, sans-serif; font-size: 16px; line-height: 28px !important;" id="close" name="close" data-dismiss="modal">Закрыть</button>
                            <button type="button" id="save_stars" data-idi="" onclick="createstars(this.dataset.idi)" name="save_stars" style="font-family: Open Sans, sans-serif; font-size: 16px; line-height: 28px !important;" class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <script>
                function createstars(params){
                                            var tours_id = params;
                                            var Stars = $('#Stars').val();
                                            var Comment_Customer = $('#Comment_Customer').val();
                                            $.ajax({
                                                url: '{{ route('passengers.createstar') }}',
                                                type: "POST",
                                                data: {Stars:Stars, Comment_Customer:Comment_Customer, tours_id:tours_id},
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success: function (data) {
                                                    $('#Name_Type_Tours').val(' ');
                                                    $('#addArticle').modal('hide');
                                                    $('#articles-wrap').removeClass('hidden').addClass('show');
                                                    $('.alert').removeClass('show').addClass('hidden');
                                                    if (data['errornumber'] == 1) {
                                                        alert('Диапазон оценивания от 0 до 10!');
                                                    } else{
                                                        document.getElementById('pacagesunit' + params).innerText = 'Изменить отзыв';
                                                        $('#pacagesunit' + params).attr("onclick","document.getElementById('save_stars').dataset.idi = this.dataset.idi; indexstar(this.dataset.idi);");
                                                        //document.getElementById('pacagesunit' + params).onclick = function(){document.getElementById('save_stars').dataset.idi = this.dataset.idi; indexstar();}
                                                        alert('Добавлено');
                                                    }   
                                                },
                                                error: function (msg) {
                                                    alert('Ошибка');
                                                }
                                            });
                };

                function indexstar(params){
                                            var tours_id = params;
                                            $.ajax({
                                                url: "{{route('passengers.indexforcustomer')}}",
                                                type: "POST",
                                                data: {tours_id:tours_id},
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success:function (data)
                                                {   
                                                    if (data['Stars'] < 5 && data['Stars'] != 0) {
                                                        document.getElementById('passwordHelpBlock').hidden = false;
                                                    } else {
                                                        document.getElementById('passwordHelpBlock').hidden = true;
                                                    }
                                                    document.getElementById('valuestars').innerText = data['Stars'];
                                                    $('#save_stars').attr("onclick","updatebutton(this.dataset.idi);");
                                                    $('#Stars').val(data['Stars']);
                                                    $('#Comment_Customer').val(data['Comment_Customer']);
                                                    $('#pacagesunit' + params).attr("onclick","document.getElementById('save_stars').dataset.idi = this.dataset.idi; indexstar(this.dataset.idi);");
                                                },
                                                error: function (msg) {
                                                    alert('Ошибка');
                                                }
                                            });
                };

                function updatebutton(params){
                                            var tours_id = params;
                                            var Stars = $('#Stars').val();
                                            var Comment_Customer = $('#Comment_Customer').val();

                                            $.ajax({
                                                url: "{{route('passengers.createstar')}}",
                                                type: "POST",
                                                data: {Stars:Stars, Comment_Customer:Comment_Customer, tours_id:tours_id},
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success:function (data)
                                                {
                                                    $('#addArticle').modal('hide');
                                                    $('#articles-wrap').removeClass('hidden').addClass('show');
                                                    $('.alert').removeClass('show').addClass('hidden');
                                                    if (data['errornumber'] == 1) {
                                                        alert('Диапазон оценивания от 0 до 10!');
                                                    } else{
                                                        alert('Изменено');
                                                    }       
                                                },
                                                error: function (msg) {
                                                    alert('Ошибка');
                                                }
                                            });
                };          

                function chowvalue(params) {
                    //alert(params);
                    document.getElementById('valuestars').innerText = params;
                }
                function chowvaluebad(params) {
                    if (params < 5 && params != 0) {
                        document.getElementById('passwordHelpBlock').hidden = false;
                    } else {
                        document.getElementById('passwordHelpBlock').hidden = true;
                    }
                    
                }
            </script>
            @if($passengers->total() > $passengers->count())
                <div class="row mb-5 justify-content-center">
                    <div class="bootstrap-pagination" >
                        <nav>
                            <ul class="pagination">
                                {{ $passengers->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            @endif
        </div>
    </section>

   

    <section class="packages ">
        <div class="container py-lg-4 py-sm-3">
            <h3 class="heading text-capitalize text-center mt-2 mb-5">Рекомендуем</h3>
            <div class="row">
                @foreach($passengers_end as $passenger_end)
                <div class="col-lg-3 col-sm-6 mb-4" href="">
					<div class="image-tour position-relative">
						<a href="{{route('tourdescript',[$passenger_end->id, str_slug($passenger_end->Name_Tours, '-')])}}"><img src="images/banner1.jpg"  alt="" class="img-fluid" /></a>
						<p><span class="fa fa-tags"></span> <span id="{{$passenger_end->id}}">
								{{ number_format((($passenger_end->Privilegens_Price > $passenger_end->Children_price and $passenger_end->Children_price != null) ? $passenger_end->Children_price : $passenger_end->Privilegens_Price) ?? $passenger_end->Price, 0, ',', ' ') }}₽
							</span></p>
					</div>
					<div class="package-info">
						<h6 class="mt-1" style="font-family: Open Sans, sans-serif;"><span class="fa fa-map-marker mr-2"></span>{{ $passenger_end->Name_Tours }}</h6>
						<h5 class="my-2" style="font-family: Open Sans, sans-serif;">{{ $passenger_end->Name_Tours }}</h5>
						<p class="" style="font-family: Open Sans, sans-serif;">{{str_limit($passenger_end->Description,20,'...')}}</p>
						<ul class="listing mt-3" style="font-family: Open Sans, sans-serif;">
							<li><span  class="fa fa-clock-o mr-2" ></span>Дата: <span @if($Cardon_hot  >= $passenger_end->Start_Date_Tours and $Cardon_hot <= $passenger_end->End_Date_Tours) style="color: LightBlue;" title="Экскурсия продолжается!" @endif> {{date('d-m-Y H:i', strtotime($passenger_end->Start_Date_Tours)) }}</span></li>
                            <li><span  class="fa fa-money mr-1" ></span>Оплата: {{$passenger_end->Paid == 1 ? 'Оплачено' : 'Ожидаем'}}</li>
                        </ul>
						
                        <a class="btn btn-success" id="pacagesunit" href="{{route('tourdescript',[$passenger_end->id, str_slug($passenger_end->Name_Tours, '-')])}}">Подробнее</a>
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
            @if($passengers->total() > $passengers->count())
                <div class="row mb-5 justify-content-center">
                    <div class="bootstrap-pagination" >
                        <nav>
                            <ul class="pagination">
                                {{ $passengers->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection