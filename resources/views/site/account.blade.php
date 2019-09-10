@extends('layouts.site')

@section('content')

    <section class="destinations py-4" id="destinations">
        <div class="container py-xl-2 py-lg-3">
            <h3 class="heading text-capitalize text-center">Как спланировать поездку</h3>
            <div class="row mt-5 text-center">
                <div class="col-lg-4 col-sm-6">
                    <div >
                        <div class="icon">
                            <span class="fa fa-map-signs"></span>
                        </div>
                        <h3>Выбрать направление</h3>
                        <p class="text mt-3 mb-5 text-center">Разобраться в своих желаниях, посмотреть доступные предложения, попытаться всё совместить.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mt-sm-0 mt-5">
                    <div class="">
                        <div class="icon">
                            <span class="fa fa-calendar"></span>
                        </div>
                        <h3>Выбрать дату</h3>
                        <p class="text mt-3 mb-5 text-center">Многие из нас весьма занятые люди и на отдых нам порой совсем не хватает время. Решитесь и сделайте себе подарок!</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mt-lg-0 mt-5">
                    <div class="">
                        <div class="icon">
                            <span class="fa fa-gift"></span>
                        </div>
                        <h3>Наслаждайтесь</h3>
                        <p class="text mt-3 mb-5 text-center">Выбрав направление, обозначив дату поездки, оставьте всё плохое позади и наслаждайтесь!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="packages py-5">
        <div class="container py-lg-4 py-sm-3">
            <h3 class="heading text-capitalize text-center mt-2 mb-5">Наши предложения</h3>
            <div class="row">
                @foreach($tours as $tour)
                    <div class="col-lg-3 col-sm-6 mb-5" href="">
                        <div class="image-tour position-relative">
                            <a href="{{ route('/packages') }}"><img  src="images/p1.jpg" alt="" class="img-fluid" /></a>
                            <p><span class="fa fa-tags"></span> <span>{{ $tour->Price }}₽</span></p>
                        </div>
                        <div class="package-info">
                            <h6 class="mt-1"><span class="fa fa-map-marker mr-2"></span>{{ $tour->Name_Tours }}</h6>
                            <h5 class="my-2">{{ $tour->Name_Tours }}</h5>
                            <p class="">{{str_limit($tour->Description,22,'...')}}</p>
                            <ul class="listing mt-3">
                                <li><span class="fa fa-clock-o mr-2"></span>Дата: <span> {{ $tour->Start_Date_Tours }}</span></li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="view-package text-center mt-4">
                <a href="{{ route('/packages') }}" style="margin-right: 15px">Посмотреть все</a>
                <a href="{{ route('/contact') }}">Индивидуальный заказ</a>
            </div>
        </div>
    </section>

@endsection