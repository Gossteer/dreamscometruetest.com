@extends('layouts.site')

@section('content')

    <section class="banner_inner" id="home">
        <div class="banner_inner_overlay">
        </div>
    </section>

    <section class="about py-5">
<div class="container py-lg-5 py-sm-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="col-lg-12 contact-left-form">

                <div class="contact-grids">
                    <h4 class="heading text-capitalize text-center mb-lg-5 mb-4"> Регистрация</h4>



                    <div id="example-1">
                        <button @click="show = !show">
                            Переключить отрисовку
                        </button>
                        <transition name="slide-fade">
                            <p v-if="show">привет</p>
                        </transition>
                    </div>

                    <div id="transition-components-demo"  >
                        <input type="radio" value="v-a" id="a" name="view">
                        <label for="a">А</label>
                        <input type="radio" value="v-b" id="b" name="view">
                        <label for="b">Б</label>
                        <transition name="component-fade" mode="out-in">
                        <component v-bind:is="view"></component>
                        </transition>
                    </div>

                    <script>
                        new Vue({
                            el: '#example-1',
                            data: {
                                show: true
                            }
                        });

                        new Vue({
                            el: '#transition-components-demo',
                            data: {
                                view: 'v-b'
                            },
                            components: {
                                'v-a': {
                                    template: '<div>Компонент А</div>'
                                },
                                'v-b': {
                                    template: '<div>Компонент Б</div>'
                                }
                            }
                        })
                    </script>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 form-group contact-forms">
                                <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autocomplete="login" autofocus placeholder="Логин">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 form-group contact-forms">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 form-group contact-forms">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Пароль">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 form-group contact-forms">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Подтвердите пароль">
                            </div>

                            <div class="col-sm-6 form-group contact-forms">
                                <input id="Surname" type="text" class="form-control" name="Surname" required autocomplete="family-name" placeholder="Фамилия">
                            </div>

                            <div class="col-sm-6 form-group contact-forms">
                                <input id="Name" type="text" class="form-control" name="Name" value="{{ old('name') }}" required autocomplete="given-name" placeholder="Имя">
                            </div>

                            <div class="col-sm-6 form-group contact-forms">
                                <input id="Middle_Name" type="text" class="form-control" name="Middle_Name" autocomplete="additional-name" placeholder="Отчество">
                            </div>

                            <div class="col-sm-6 form-group contact-forms">
                                <input id="Phone_Number_Customer" type="tel" class="form-control" name="Phone_Number_Customer" required autocomplete="tel" placeholder="Телефон">
                            </div>



                            <div class="col-md-12 form-group contact-forms">
                                <select class="form-control" id="Sources"name="Sources" required>
                                    <option value="" disabled selected>Как о нас узнали</option>
                                    <option value="1">От знакомых</option>
                                    <option value="2">Из рекламы</option>
                                    <option value="3">Луль</option>
                                </select>
                            </div>


                            <script>
                                $(function() {

                                    $('select[name="Sources"]').change(function() {
                                        alert($(this).val());
                                        var $selected =  $(this).val();

                                        if(($selected == "1") || ($selected == "2")) {
                                            $("#Sources").addClass('default').fadeIn('fast');
                                        }
                                        else {
                                            $("#Sources").removeClass("default").fadeIn('fast');
                                        }
                                    });
                                });


                            </script>

                            <div class="col-md-12 booking-button">
                                    <button type="submit" class="btn btn-block sent-butnn">
                                        Зарегистрироваться
                                    </button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </section>
@endsection
