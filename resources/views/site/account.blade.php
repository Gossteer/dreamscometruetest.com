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
                        <p class="text mt-3 mb-5 text-center">Логин: {{ $customer->user->login }} <br>
                            Email: {{ $customer->user->email }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div >
                        <div class="icon">
                            <span class="fa fa-map-signs"></span>
                        </div>
                        <h3>ФИО</h3>
                        <p class="text mt-3 mb-5 text-center">{{ $customer->Name . ' ' . $customer->Surname . ' ' . $customer->Middle_Name  }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mt-lg-0 mt-5">
                    <div class="">
                        <div class="icon">
                            <span class="fa fa-gift"></span>
                        </div>
                        <h3>Привилегии</h3>
                        <p class="text mt-3 mb-5 text-center">Льготник: {{ $customer->Age_Group != 0 ? 'Да' : 'Нет' }} <br>
                           <span style="color: #bbb529">Золотой клиент:</span> {{ $customer->Condition == 1 ? 'Да' : 'Нет' }} </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="packages ">
        <div class="container py-lg-4 py-sm-3">
            <h3 class="heading text-capitalize text-center mt-2 mb-5">Ваши экскурсии</h3>
            <div class="row">
                @foreach($passengers as $passenger)
                    <div class="col-lg-3 col-sm-6 mb-5" href="">
                        <div class="image-tour position-relative">
                            <a href="{{ route('/packages') }}"><img  src="images/p1.jpg" alt="" class="img-fluid" /></a>
                            <p><span class="fa fa-tags"></span> <span>{{ $passenger->tour->Price }} ₽</span></p>
                        </div>
                        <div class="package-info">
                            <h6 class="mt-1"><span class="fa fa-map-marker mr-2"></span>{{ $passenger->tour->Name_Tours }}</h6>
                            <h5 class="my-2">{{ $passenger->tour->Name_Tours }}</h5>
                            <p class="">{{str_limit($passenger->tour->Description,22,'...')}}</p>
                            <ul class="listing mt-3">
                                <li><span class="fa fa-clock-o mr-2"></span>Дата: <span> {{ $passenger->tour->Start_Date_Tours }}</span></li>
                            </ul>
                            @if($passenger->tour->Start_Date_Tours >= now()->subDay())
                            <form onsubmit="if(confirm('Отказаться?')){return true}else{return false}" action="{{route('passengers.destroy',$passenger)}}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                @csrf
                                <button type="submit" class="btn mb-1 btn-success"  style="background-color: #047ffc; margin-top: 15px;" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="fa fa-close color-danger"></i></button>
                            </form>
                                @else
                                <p class="" style="color: green; padding-top: 10px !important;">Экскурсия прошла</p>
                                @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection