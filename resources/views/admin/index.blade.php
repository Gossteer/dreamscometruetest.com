@extends('layouts.admin')

@section('content')

    <div class="row " style="padding-left: 10px !important; padding-right: 10px !important;">
        <div class="col-lg-3 col-sm-6" style="margin-top: 1%">
            <div class="card gradient-1">
                <div class="card-body" style="padding-bottom: 3%">
                    <h3 class="card-title text-white">Проведено экскурсий</h3>
                    <div class="d-inline-block">
                        <h1 class="text-white" style="padding-top: 13px !important;">{{ $count_tour }}</h1>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                </div>
                <div class="card-body" style="padding-top: 3%">
                    <h3 class="card-title text-white">Непроведённых экскурсий:</h3>
                    <div class="d-inline-block">
                        <h1 class="text-white" style="padding-top: 13px !important;">{{ $count_tour_not_complit }}</h1>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart" {{$number_not_complit_tour = 0}}></i></span>
                    @foreach ($tours_not_complit as $tour_not_complit)
                            <div class="mt-4">
                                <a href="{{ route('tours.edit', $tour_not_complit) }}"><h4 class="text-white">{{++$number_not_complit_tour}}. {{ $tour_not_complit->Name_Tours }}</h4></a>
                                <h6 class="m-t-10 text-white" {{$duration = strtotime($tour_not_complit->Start_Date_Tours) - strtotime($today_tour)}} >До начала: {{ date('n', $duration)-1 == 0 ? '' : date('n', $duration)-1 . 'м.'}} {{ date('j', $duration)-1 == 0 ? '' : date('j', $duration)-1 . 'дн.'}} {{date('G', $duration) == 0 ? '' : date('G', $duration)-2 . 'ч.'}}</h6>
                                <div class="progress mb-3" style="height: 7px; margin-bottom: 0.7rem !important;">
                                    <div class="progress-bar bg-primary" style="width: {{round(Carbon\Carbon::parse($today_tour)->diffInMinutes(Carbon\Carbon::parse($tour_not_complit->created_at)) / Carbon\Carbon::parse($tour_not_complit->Start_Date_Tours)->diffInMinutes(Carbon\Carbon::parse($tour_not_complit->created_at)) * 100, 2) }}%;" role="progressbar"><span class="sr-only">50% Order</span>
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
            <div class="card gradient-2">
                <div class="card-body" style="padding-bottom: 2%">
                    <h3 class="card-title text-white">Зработано денег</h3>
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
                                <a href="{{ route('tours.edit', $last_tour) }}"><h4 class="text-white" title="Дата проведения {{date('d.m.Y', strtotime($last_tour->Start_Date_Tours))}}">{{++$number_tour}}. {{ $last_tour->Name_Tours }}</h4></a>
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
            <div class="card gradient-3">
                <div class="card-body" style="padding-bottom: 2%">
                    <h3 class="card-title text-white">Пользователей</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white" style="padding-top: 13px !important;">{{ $count_all_customers }}</h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
                <div class="card-body" style="padding-top: 2%">
                    <h3 class="card-title text-white">Администраторов</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white" style="padding-top: 13px !important;">{{ $count_all_employee }}</h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
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


@endsection