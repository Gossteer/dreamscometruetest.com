@extends('layouts.admin')

@section('content')

    <div class="row " style="padding-left: 10px !important; padding-right: 10px !important;">
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">Проведено экскурсий</h3>
                    <div class="d-inline-block">
                        <h1 class="text-white" style="padding-top: 13px !important;">{{ \App\tour::whereRaw('Start_Date_Tours < ?',[now()->subDay()])->count() }}</h1>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-2">
                <div class="card-body">
                    <h3 class="card-title text-white">Зработано денег</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white" style="padding-top: 13px !important;">₽
                        {{ $sum }}
                        </h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-3">
                <div class="card-body">
                    <h3 class="card-title text-white">Клиентов</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white" style="padding-top: 13px !important;">{{ \App\Customer::all()->count() }}</h2>

                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card card-widget">
                <div class="card-body">
                    @if( count(\App\Customer::all()) != 0)
                    <h5 class="text-muted">Соотношение полов</h5>
                    <div class="mt-4">
                        <h4>{{ \App\Customer::where('Floor', 0)->count() }}</h4>
                        <h6>Мужчин <span class="pull-right">{{ round(\App\Customer::where('Floor', 0)->count() / \App\Customer::all()->count() * 100, 2) }}%</span></h6>
                        <div class="progress mb-3" style="height: 7px">
                            <div class="progress-bar bg-primary" style="width: {{ \App\Customer::where('Floor', 0)->count() / \App\Customer::all()->count() * 100 }}%;" role="progressbar"><span class="sr-only">30% Order</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h4>{{ \App\Customer::where('Floor', 1)->count() }}</h4>
                        <h6 class="m-t-10 text-muted">Женщины <span class="pull-right">{{ round(\App\Customer::where('Floor', 1)->count() / \App\Customer::all()->count() * 100, 2) }}%</span></h6>
                        <div class="progress mb-3" style="height: 7px">
                            <div class="progress-bar bg-success" style="width: {{ \App\Customer::where('Floor', 1)->count() / \App\Customer::all()->count() * 100 }}%;" role="progressbar"><span class="sr-only">50% Order</span>
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