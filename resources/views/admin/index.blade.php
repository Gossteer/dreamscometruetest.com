@extends('layouts.admin')

@section('content')

    <div class="row " style="padding-left: 10px !important; padding-right: 10px !important;">
        <div class="col-lg-3 col-sm-6" style="margin-top: 1%">
            <div class="card gradient-1">
                <div class="card-body" style="padding-bottom: 3%">
                    <h3 class="card-title text-white">Проведено экскурсий:</h3>
                    <div class="d-inline-block">
                        <h1 class="text-white" id="tour_complite_count" style="padding-top: 13px !important;">{{ $count_tour }}</h1>
                    </div>
                    <span class="float-right display-5 opacity-5" {{$number_complit_tour = 0}}><i class="fa fa-check"></i></span>
                    <span class="oi oi-check"></span>
                    @foreach ($tours_complit as $tour_complit)
                            <div class="mt-4" id="tour_complite_div{{$tour_complit->id}}">
                                <h4>
                                    <span>
                                        <a class="text-white" href="{{ route('tours.show', $tour_complit) }}" title="Дата проведения {{date('d.m.Y', strtotime($tour_complit->Start_Date_Tours))}}">{{++$number_complit_tour}}. {{ $tour_complit->Name_Tours }}</a>
                                        @if($tour_complit->End_Date_Tours <= $today_tour)
                                            @if ($tour_complit->Confirmation_Tours == 0)
                                                <a style="font-size: 85%;" class="text-white" href="{{ route('tours.edit', $tour_complit) }}" data-toggle="tooltip" data-placement="top" title="Редактировать"><i class="fa fa-pencil color-muted m-r-5"></i></a>
                                                <a style="font-size: 85%;"  class="text-white" href="{{route('tourcomplite', $tour_complit->id)}}" title="Подтверждение экскурсии" ><i id="tour_complite_icon{{$tour_complit->id}}" style="cursor: pointer !important;" class="fa fa-check color-muted m-r-5"></i></a>
                                            @else
                                                <a style="font-size: 85%;"  class="text-white" href="{{route('tourcomplite', $tour_complit->id)}}" title="Подтверждение экскурсии"><i id="tour_complite_icon{{$tour_complit->id}}" style="cursor: pointer !important;" class="fa fa-close color-muted m-r-2"></i></a>
                                            @endif
                                        @endif
                                    </span>
                                </h4>
                                <h6 class="m-t-10 text-white">Всего мест<span class="pull-right ">Занято</span></h6>
                                <div class="progress mb-3" style="height: 7px; margin-bottom: 0.7rem !important;">
                                    <div class="progress-bar bg-primary" style="width:{{round( $tour_complit->Occupied_Place / $tour_complit->Amount_Place * 100, 2) }}%;" role="progressbar"><span class="sr-only">50% Order</span>
                                    </div>
                                </div>
                                <h6 class="m-t-10 text-white">{{$tour_complit->Amount_Place}}<span class="pull-right">{{$tour_complit->Occupied_Place}}</span></h6>
                                
                            </div>
                            {{-- {{$duration_for_minuts = 0}} {{$duration_lol = strtotime($tour_not_complit->Start_Date_Tours) - strtotime($tour_not_complit->created_at)}} {{ date('n', $duration_lol)-1 == 0 ? '' : (date('n', $duration_lol)-1 ) }} {{ date('j', $duration_lol)-1 == 0 ? '' : date('j', $duration_lol)-1 . 'дн.'}} {{date('G', $duration_lol) == 0 ? '' : date('G', $duration_lol)-2 . 'ч.'}} --}}
                    @endforeach
                </div>
                <div class="card-body" style="padding-top: 3%">
                    <h3 class="card-title text-white">Непроведённых экскурсий:</h3>
                    <div class="d-inline-block">
                        <h1 class="text-white" id="tour_not_complite_count" style="padding-top: 13px !important;">{{ $count_tour_not_complit }}</h1>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart" {{$number_not_complit_tour = 0}}></i></span>
                    @foreach ($tours_not_complit as $tour_not_complit)
                            <div class="mt-4" id="tour_not_complite_div{{$tour_not_complit->id}}">
                                <h4>
                                    <span>
                                        <a class="text-white" href="{{ route('tours.show', $tour_not_complit) }}" title="Дата проведения {{date('d.m.Y', strtotime($tour_not_complit->Start_Date_Tours))}}">{{++$number_not_complit_tour}}. {{ $tour_not_complit->Name_Tours }}</a>
                                        <a style="font-size: 85%;" class="text-white" href="{{ route('tours.edit', $tour_not_complit) }}" data-toggle="tooltip" data-placement="top" title="Редактировать"><i class="fa fa-pencil color-muted m-r-5"></i></a>
                                        @if($tour_not_complit->End_Date_Tours <= $today_tour)
                                            @if ($tour_not_complit->Confirmation_Tours == 0)
                                                <a style="font-size: 85%;"  class="text-white" href="{{route('tourcomplite', $tour_not_complit->id)}}" title="Подтверждение экскурсии"><i id="tour_complite_icon{{$tour_not_complit->id}}" style="cursor: pointer !important;" class="fa fa-check color-muted m-r-5"></i></a>
                                            @else
                                                <a style="font-size: 85%;"  class="text-white" href="{{route('tourcomplite', $tour_not_complit->id)}}" title="Подтверждение экскурсии"><i id="tour_complite_icon{{$tour_not_complit->id}}" style="cursor: pointer !important;" class="fa fa-close color-muted m-r-5"></i></a>
                                            @endif
                                        @endif
                                    </span>
                                </h4>
                                <h6 class="m-t-10 text-white" {{$duration = strtotime($tour_not_complit->Start_Date_Tours) - strtotime($today_tour)}} >@if($today_tour <= $tour_not_complit->Start_Date_Tours)До начала: {{ date('n', $duration)-1 == 0 ? '' : date('n', $duration)-1 . 'м.'}} {{ date('j', $duration)-1 == 0 ? '' : date('j', $duration)-1 . 'дн.'}} {{date('G', $duration) == 0 ? '' : date('G', $duration)-2 . 'ч.'}} @elseif($tour_not_complit->End_Date_Tours <= $today_tour) <strong>Ожидает подтверждения</strong> @else <strong>Ожидает окончания: {{date('d.m.Y', strtotime($tour_not_complit->End_Date_Tours))}}</strong>@endif</h6>
                                <div class="progress mb-3" style="height: 7px; margin-bottom: 0.7rem !important;">
                                    <div class="progress-bar bg-primary" style="width: @if($today_tour <= $tour_not_complit->Start_Date_Tours) {{round(Carbon\Carbon::parse($today_tour)->diffInMinutes(Carbon\Carbon::parse($tour_not_complit->created_at)) / Carbon\Carbon::parse($tour_not_complit->Start_Date_Tours)->diffInMinutes(Carbon\Carbon::parse($tour_not_complit->created_at)) * 100, 2) }}% @else 100% @endif;" role="progressbar"><span class="sr-only">50% Order</span>
                                    </div>
                                </div>
                                <h6 class="m-t-10 text-white" >Свободных мест:  <span title="Всего мест" style="font-weight: bold">{{ $tour_not_complit->Amount_Place }}</span>/<span style="font-weight: bold; color: white" title="Свободно мест">{{ ($tour_not_complit->Amount_Place - $tour_not_complit->Occupied_Place) }}</span></h6>
                            </div>
                            {{-- {{$duration_for_minuts = 0}} {{$duration_lol = strtotime($tour_not_complit->Start_Date_Tours) - strtotime($tour_not_complit->created_at)}} {{ date('n', $duration_lol)-1 == 0 ? '' : (date('n', $duration_lol)-1 ) }} {{ date('j', $duration_lol)-1 == 0 ? '' : date('j', $duration_lol)-1 . 'дн.'}} {{date('G', $duration_lol) == 0 ? '' : date('G', $duration_lol)-2 . 'ч.'}} --}}
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6" style="margin-top: 1%">
            <div class="card gradient-4">
                <div class="card-body" style="padding-bottom: 2%">
                    <h3 class="card-title text-white">Заработано денег</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white" style="padding-top: 13px !important;">₽
                            {{number_format($sum, 0, ',', ' ') }}
                        </h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
                @if (count($last_tours) != 0)
                    <div class="card-body" style="padding-top: 2%">
                        <h3 class="card-title text-white" style="margin-bottom: 0" {{$number_tour = 0}}>Последние крупные мероприятия:</h3>
                        @foreach ($last_tours as $last_tour)
                            <div class="mt-4">
                                <h4>
                                    <span>
                                        <a class="text-white" href="{{ route('tours.show', $last_tour) }}" title="Дата проведения {{date('d.m.Y', strtotime($last_tour->Start_Date_Tours))}}">{{++$number_tour}}. {{ $last_tour->Name_Tours }}</a>
                                        @if ($tour_complit->Confirmation_Tours == 0)
                                            <a style="font-size: 85%;" class="text-white" href="{{ route('tours.edit', $last_tour) }}" data-toggle="tooltip" data-placement="top" title="Редактировать"><i class="fa fa-pencil color-muted m-r-5"></i></a>
                                        @endif
                                    </span>
                                </h4>
                                <h6 class="m-t-10 text-white">+{{number_format($last_tour->Profit, 0, ',', ' ') }}₽<span class="pull-right">-{{number_format($last_tour->Expenses, 0, ',', ' ') }}₽</span></h6>
                                <div class="progress mb-3" style="height: 7px; margin-bottom: 0.5rem !important;">
                                    <div class="progress-bar bg-primary" style="width: {{round($last_tour->Profit / ($last_tour->Profit + $last_tour->Expenses) * 100, 2) }}%;" role="progressbar"><span class="sr-only">50% Order</span>
                                    </div>
                                </div>
                                <h6 class="m-t-10 text-white" >{{round($last_tour->Profit / ($last_tour->Profit + $last_tour->Expenses) * 100, 2) }}%<span class="pull-right">{{round($last_tour->Expenses / ($last_tour->Profit + $last_tour->Expenses) * 100, 2) }}%</span></h6>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-3 col-sm-6" style="margin-top: 1%">
            <div class="card gradient-8">
                <div class="card-body" style="padding-bottom: 2%">
                    <h3 class="card-title text-white">Пользователей</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white" style="padding-top: 13px !important;">{{ $count_all_customers }}</h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                    @if ($middle_age != 0)
                    <div class="mt-4">
                        <h6 class="m-t-10 text-white">Средний возраст: {{round($middle_age, 2) }} лет</h6>
                        <div class="progress mb-3" style="height: 7px; margin-bottom: 0.5rem !important;">
                            <div class="progress-bar bg-primary" style="width: {{round($middle_age, 2) }}%;" role="progressbar"><span class="sr-only">50% Order</span>
                            </div>
                        </div>
                        <h6 class="m-t-10 text-white" >0<span class="pull-right">100</span></h6>
                    </div>
                    @endif
                </div>
                @if (count($last_all_customers) != 0)
                <div class="card-body" style="padding-top: 3%">
                    <h3 class="card-title text-white" {{$number_last_all_customer = 0}}>Новые пользователи:</h3>
                    @foreach ($last_all_customers as $last_all_customer)
                            <div class="mt-4">
                                <h4>
                                    <span>
                                       <form onsubmit="if(confirm('Удалить?')){return true}else{return false}" action="{{route('customer.destroy',$last_all_customer)}}" method="post">
                                            <input type="hidden" name="_method" value="DELETE">
                                            @csrf
                                            <a class="text-white" title="Дата регистрации {{date('d.m.Y H:i', strtotime($last_all_customer->created_at))}}">{{++$number_last_all_customer}}. {{ $last_all_customer->Surname . ' ' . mb_substr($last_all_customer->Name, 0, 1)  . '. ' . mb_substr($last_all_customer->Middle_Name, 0, 1) . ($last_all_customer->Middle_Name != '' ? '.' : '') }}</a>
                                                @if ($last_all_customer->Condition == 0)
                                                    <a id="customer_complite{{$last_all_customer->id}}" data-condition="{{$last_all_customer->Condition}}" data-idi="{{$last_all_customer->id}}" class="text-white" onclick="if(confirm('Подтвердить клиента?')){complite_customer(this.dataset.idi, this.dataset.condition)}else{return false}" title="Подтвердить Клиента" data-toggle="tooltip" data-placement="top" ><i id="customer_complite_icon{{$last_all_customer->id}}" style="cursor: pointer !important;" class="fa fa-check color-muted m-r-5"></i></a>
                                                @elseif($last_all_customer->Condition == -1)
                                                    <a id="customer_complite{{$last_all_customer->id}}" data-condition="{{$last_all_customer->Condition}}"  data-idi="{{$last_all_customer->id}}"  class="text-danger" onclick="if(confirm('Отменить блокировку?')){complite_customer(this.dataset.idi, this.dataset.condition)}else{return false}" data-toggle="tooltip" data-placement="top" title="Отменить блокировку"><i id="customer_complite_icon{{$last_all_customer->id}}" style="cursor: pointer !important;" class="fa fa-check color-muted m-r-5"></i></a>
                                                @else
                                                    <a id="customer_complite{{$last_all_customer->id}}" data-condition="{{$last_all_customer->Condition}}"  data-idi="{{$last_all_customer->id}}" class="@if($last_all_customer->Condition == 1)text-white @else text-success @endif" onclick="if(confirm('Отменить подтверждение?')){notcomplite_customer(this.dataset.idi, this.dataset.condition)}else{return false}" data-toggle="tooltip" data-placement="top" title="Отменить подтверждение"><i id="customer_complite_icon{{$last_all_customer->id}}" style="cursor: pointer !important;" class="fa fa-close color-muted m-r-5"></i></a>
                                                @endif
                                             <a class="text-white" href="{{ route('customer.edit', $last_all_customer) }}" style="font-size: 85%;" data-toggle="tooltip" data-placement="top" title="Редактировать"><i class="fa fa-pencil color-muted m-r-5"></i></a>
                                            <button class="text-white"  type="submit" style="font-size: 85%; padding: 0 !important; border: none !important; background-color: transparent !important;" data-toggle="tooltip" data-placement="top" title="Удалить"><i style="cursor: pointer !important;" class="fa fa-trash color-danger"></i></button>
                                        </form>
                                    </span>
                                </h4>
                            </div>
                            {{-- {{$duration_for_minuts = 0}} {{$duration_lol = strtotime($tour_not_complit->Start_Date_Tours) - strtotime($tour_not_complit->created_at)}} {{ date('n', $duration_lol)-1 == 0 ? '' : (date('n', $duration_lol)-1 ) }} {{ date('j', $duration_lol)-1 == 0 ? '' : date('j', $duration_lol)-1 . 'дн.'}} {{date('G', $duration_lol) == 0 ? '' : date('G', $duration_lol)-2 . 'ч.'}} --}}
                    @endforeach
                </div>
                @endif
                <div class="card-body" style="padding-top: 2%">
                    <h3 class="card-title text-white">Администраторов</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white" style="padding-top: 13px !important;">{{ $count_all_employee }}</h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-user"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6" style="margin-top: 1%">
            <div class="card card-widget">
                <div class="card-body">
                    @if( $count_all_customers != 0)
                    <h5 class="text-muted">Соотношение полов клиентов</h5>
                    <div class="mt-4">
                        <h4>{{ $count_men_customers }}</h4>
                        <h6>Мужчин@if ( substr( $count_men_customers, -1) == 1 )а @endif <span class="pull-right">{{ $width_bar_men = round($count_men_customers / $count_all_customers * 100, 2) }}%</span></h6>
                        <div class="progress mb-3" style="height: 7px">
                            <div class="progress-bar bg-primary" style="width: {{ $width_bar_men }}%;" role="progressbar"><span class="sr-only">30% Order</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h4>{{ $count_women_customers }}</h4>
                        <h6 class="m-t-10 text-muted">Женщин@if ( $substr_count_women_customers == 1 )а @elseif ( $substr_count_women_customers > 1 and $substr_count_women_customers <= 4)ы @endif <span class="pull-right">{{ $width_bar_vomen = round($count_women_customers / $count_all_customers * 100, 2) }}%</span></h6>
                        <div class="progress mb-3" style="height: 7px">
                            <div class="progress-bar bg-success" style="width: {{ $width_bar_vomen }}%;" role="progressbar"><span class="sr-only">50% Order</span>
                            </div>
                        </div>
                    </div>
                        @else
                        <h5 class="text-muted">Нет ни одного клиента</h5>
                        @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row"  style="padding-left: 10px !important; padding-right: 10px !important;">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body pb-0 d-flex justify-content-between">
                            <div>
                                <h4 class="mb-1">Денежный оборот за год</h4>
                                <p>График поделен по месяцам</p>
                                <h3 class="m-0"> {{number_format($fullmanyforyers - $fullmanyforyersexpens, 0, ',', ' ') }}₽</h3>
                            </div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="bar-chart-grouped"  width="500" height="250"></canvas>
                        </div>
                        {{-- <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="w-100 mr-2">
                                    <h6>Pixel 2</h6>
                                    <div class="progress" style="height: 6px">
                                        <div class="progress-bar bg-danger" style="width: 40%"></div>
                                    </div>
                                </div>
                                <div class="ml-2 w-100">
                                    <h6>iPhone X</h6>
                                    <div class="progress" style="height: 6px">
                                        <div class="progress-bar bg-primary" style="width: 80%"></div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row"  style="padding-left: 10px !important; padding-right: 10px !important;">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body pb-0 d-flex justify-content-between">
                            <div>
                                <h4 class="mb-1">Общая статистика</h4>
                                <p>График поделен по месяцам</p>
                            </div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="line-chart"  width="500" height="250"></canvas>
                        </div>
                        {{-- <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="w-100 mr-2">
                                    <h6>Pixel 2</h6>
                                    <div class="progress" style="height: 6px">
                                        <div class="progress-bar bg-danger" style="width: 40%"></div>
                                    </div>
                                </div>
                                <div class="ml-2 w-100">
                                    <h6>iPhone X</h6>
                                    <div class="progress" style="height: 6px">
                                        <div class="progress-bar bg-primary" style="width: 80%"></div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    
// new Chart(document.getElementById("bar-chart-grouped"), {
//   type: 'bar',
//   data: {
//     labels: [1,2,3,4,5,6,7,8,9,10,11,12],
//     datasets: [{ 
//         data: [ @for ($i = 0; $i < count($summ_profit); $i++) {{$summ_profit[$i]}} ,  @endfor ], 
//         label: "Прибыль",
//         backgroundColor: "#6fd96f",
//         //fill: false
//       },{ 
//         data: [ @for ($i = 0; $i < count($sum_expenses); $i++) {{$sum_expenses[$i]}} ,  @endfor ], 
//         label: "Затраты",
//         backgroundColor: "#7571f9",
//         //fill: false
//       }
//     ]
//   },
//   options: {
//     title: {
//       display: true,
//     }
//   }
// });

var ctx = document.getElementById("bar-chart-grouped");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [1,2,3,4,5,6,7,8,9,10,11,12],
            datasets: [
                {
                    label: "Прибыль",
                    data: [ @for ($i = 0; $i < count($summ_profit); $i++) {{$summ_profit[$i]}} ,  @endfor ],
                    borderColor: "rgba(117, 113, 249, 0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(117, 113, 249, 0.5)"
                },
                {
                    label: "Затраты",
                    data: [ @for ($i = 0; $i < count($sum_expenses); $i++) {{$sum_expenses[$i]}} ,  @endfor ],
                    borderColor: "rgba(144,	104,	190,0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(144,	104,	190,0.7)"
                }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    // Change here
                    barPercentage: 0.5
                }]
            }
        }
    });

    var ctx = document.getElementById("line-chart");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [1,2,3,4,5,6,7,8,9,10,11,12],
            datasets: [
                {
                    label: "Проведено мероприятий",
                    data: [ @for ($i = 0; $i < count($count_tours); $i++) {{$count_tours[$i]}} ,  @endfor ],
                    borderColor: "rgba(117, 113, 249, 0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(117, 113, 249, 0.5)"
                },
                {
                    label: "Зарегестрировалось людей",
                    data: [ @for ($i = 0; $i < count($count_customers); $i++) {{$count_customers[$i]}} ,  @endfor ],
                    borderColor: "rgba(144,	104,	190,0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(144,	104,	190,0.7)"
                },
                {
                    label: "Человек успешно посетивших мероприятия",
                    data: [ @for ($i = 0; $i < count($count_passengers); $i++) {{$count_passengers[$i]}} ,  @endfor ],
                    borderColor: "rgba(171,	95,	190,0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(171,	95,	190,0.5)"
                },
                {
                    label: "Средней отзыв на мероприятие",
                    data: [ @for ($i = 0; $i < count($avg_stars_tour); $i++) {{$avg_stars_tour[$i]}} ,  @endfor ],
                    borderColor: "rgba(198,	86,	190,0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(198,	86,	190,0.7)"
                }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    // Change here
                    barPercentage: 0.5
                }]
            }
        }
    });

// new Chart(document.getElementById("line-chart"), {
//   type: 'bar',
//   data: {
//     labels: [1,2,3,4,5,6,7,8,9,10,11,12],
//     datasets: [{ 
//         data: [ @for ($i = 0; $i < count($count_tours); $i++) {{$count_tours[$i]}} ,  @endfor ],
//         label: "Проведено мероприятий",
//         backgroundColor: "#6fd96f",
//         //fill: false
//       }, { 
//         data: [ @for ($i = 0; $i < count($count_customers); $i++) {{$count_customers[$i]}} ,  @endfor ],
//         label: "Зарегестрировалось людей",
//         backgroundColor: "#7571f9",
//         //fill: false
//       }, { 
//         data: [ @for ($i = 0; $i < count($count_passengers); $i++) {{$count_passengers[$i]}} ,  @endfor ],
//         label: "Человек успешно посетивших мероприятия",
//         backgroundColor: "green",
//         //fill: false
//       }, { 
//         data: [ @for ($i = 0; $i < count($avg_stars_tour); $i++) {{$avg_stars_tour[$i]}} ,  @endfor ],
//         label: "Средней отзыв на мероприятие",
//         backgroundColor: "#3cba9f",
//         //fill: false
//       }
//     ]
//   },
//   options: {
//     title: {
//       display: true,
      
//     }
//   }
// });

</script>

<script>
    function complite_customer(customer_id, condition) {             
                        $.ajax({
                            url: '{{ route('customer.condition_complite') }}',
                            type: "POST",
                            data: {id:customer_id, answer:1 },
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },

                            success: function (data) {
                                if (condition == -1) {
                                    document.querySelector('#customer_complite' + customer_id).classList.remove("text-danger");
                                    document.querySelector('#customer_complite' + customer_id).classList.add("text-white");
                                    document.querySelector('#customer_complite_icon' + customer_id).classList.remove("fa-check");
                                    document.querySelector('#customer_complite_icon' + customer_id).classList.add("fa-close");
                                }else{
                                    document.querySelector('#customer_complite_icon' + customer_id).classList.remove("fa-check");
                                    document.querySelector('#customer_complite_icon' + customer_id).classList.add("fa-close");
                                }
                                document.getElementById('customer_complite' + customer_id ).dataset.originalTitle = "Отменить подтверждение";
                                //$('#customer_complite' + customer_id).attr("title","Отменить подтверждение");
                                $('#customer_complite' + customer_id).attr("onclick","if(confirm('Отменить подтверждение?')){notcomplite_customer(this.dataset.idi)}else{return false}");
                                alert('Клиент подтвержден');
                            },
                            error: function (msg) {
                                alert('Ошибка');
                            }
                        });
                    };
            
                    function notcomplite_customer(customer_id, condition) {             
                        $.ajax({
                            url: '{{ route('customer.condition_complite') }}',
                            type: "POST",
                            data: {id:customer_id, answer:0},
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },

                            success: function (data) {
                                if (condition == 2) {
                                    document.querySelector('#customer_complite' + customer_id).classList.remove("text-success");
                                    document.querySelector('#customer_complite' + customer_id).classList.add("text-white");
                                }
                                document.querySelector('#customer_complite_icon' + customer_id).classList.remove("fa-close");
                                document.querySelector('#customer_complite_icon' + customer_id).classList.add("fa-check");
                                document.getElementById('customer_complite' + customer_id ).dataset.originalTitle = "Подтвердить клиента";
                                //$('#customer_complite' + customer_id).attr("title","Подтвердить клиента");
                                $('#customer_complite' + customer_id).attr("onclick","if(confirm('Подтвердить клиента?')){complite_customer(this.dataset.idi)}else{return false}");
                                alert('Подтверждение убрано');
                            },
                            error: function (msg) {
                                alert('Ошибка');
                            }
                        });
                    };

    function complite_tour(tour_id) {             
                    $.ajax({
                        url: '{{ route('tours.complite') }}',
                        type: "POST",
                        data: {id:tour_id, answer:1},
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function (data) {
                            alert('Экскурсия подтверждена');
                            location.reload();
                            // $("#tour_not_complite_count").text({{ $count_tour_not_complit }} - 1);
                            // $("#tour_not_complite_div" + tour_id).remove();
                            // document.querySelector('#tour_complite_icon' + tour_id).classList.remove("fa-check");
                            // document.querySelector('#tour_complite_icon' + tour_id).classList.add("fa-close");
                            // $('#tour_complite' + tour_id).attr("title","Отменить подтверждение");
                            // $('#tour_complite' + tour_id).attr("onclick","if(confirm('Отменить подтверждение?')){notcomplite_tour(this.dataset.idi)}else{return false}");
                        },
                        error: function (msg) {
                            alert('Ошибка');
                        }
                    });
                };
        
                function notcomplite_tour(tour_id) {             
                    $.ajax({
                        url: '{{ route('tours.complite') }}',
                        type: "POST",
                        data: {id:tour_id, answer:0},
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function (data) {
                            alert('Подтверждение убрано');
                            location.reload();
                            // $("#tour_complite_count").text({{ $count_tour }} - 1);
                            // $("#tour_complite_div" + tour_id).remove();
                            // document.querySelector('#tour_complite_icon' + tour_id).classList.remove("fa-close");
                            // document.querySelector('#tour_complite_icon' + tour_id).classList.add("fa-check");
                            // $('#tour_complite' + tour_id).attr("title","Подтвердить экскурсию");
                            // $('#tour_complite' + tour_id).attr("onclick","if(confirm('Подтвердить экскурсию?')){complite_tour(this.dataset.idi)}else{return false}");
                        },
                        error: function (msg) {
                            alert('Ошибка');
                        }
                    });
                };

</script>

@endsection