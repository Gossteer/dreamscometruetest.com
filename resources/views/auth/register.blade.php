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
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 form-group contact-forms">
                                <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" minlength="2" maxlength="20" required autocomplete="login" autofocus placeholder="Логин">
                                @error('login')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 form-group contact-forms">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required minlength="2" maxlength="191" autocomplete="email" placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 form-group contact-forms">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" minlength="8" maxlength="16" required autocomplete="new-password" placeholder="Пароль">
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    Ваш пароль должен состоиять от 8 до 16 символо.
                                </small>
                                <p id="capsWarning" style="color: red; display: none;">Внимание! Caps lock включен.</p>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 form-group contact-forms">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Подтвердите пароль">
                                <p id="capsWarning2" style="color: red; display: none;">Внимание! Caps lock включен.</p>
                            </div>

                            <div class="col-sm-6 form-group contact-forms">
                                <input id="Surname" type="text" class="form-control @error('Surname') is-invalid @enderror" name="Surname" value="{{ old('Surname') }}" required autocomplete="family-name" minlength="2" maxlength="50" placeholder="Фамилия">
                                @error('Surname')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <script>

                                // Получить поле ввода
                                    var input = document.getElementById("password");
                                    var input2 = document.getElementById("password-confirm");
        
                                    // Получить текст предупреждения
                                    var text = document.getElementById("capsWarning");
                                    var text2 = document.getElementById("capsWarning2");
        
                                    // Когда пользователь нажимает любую клавишу на клавиатуре, запустите функцию
                                    input.addEventListener("keyup", function(event) {
        
                                    // Если "caps lock" нажат, отобразится текст предупреждения
                                    if (event.getModifierState("CapsLock")) {
                                        text.style.display = "block";
                                        text2.style.display = "block";
                                    } else {
                                        text.style.display = "none"
                                        text2.style.display = "none";
                                    }
                                    });
    
                                    input2.addEventListener("keyup", function(event) {
        
                                    // Если "caps lock" нажат, отобразится текст предупреждения
                                    if (event.getModifierState("CapsLock")) {
                                        text.style.display = "block";
                                        text2.style.display = "block";
                                    } else {
                                        text.style.display = "none"
                                        text2.style.display = "none";
                                    }
                                    });
                                    
                            </script>

                            <div class="col-sm-6 form-group contact-forms">
                                <input id="Name" type="text" class="form-control @error('Name') is-invalid @enderror" name="Name" value="{{ old('Name') }}" required autocomplete="given-name" minlength="2" maxlength="50" placeholder="Имя">
                                @error('Name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 form-group contact-forms">
                                <input id="Middle_Name" type="text" class="form-control @error('Middle_Name') is-invalid @enderror" name="Middle_Name" value="{{ old('Middle_Name') }}" minlength="2" maxlength="50" autocomplete="additional-name" placeholder="Отчество">
                                @error('Middle_Name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 form-group contact-forms">
                                <input id="Date_Birth_Customer" type="text" class="form-control @error('Date_Birth_Customer') is-invalid @enderror" value="{{ old('Date_Birth_Customer') }}" name="Date_Birth_Customer" required placeholder="Дата рождения">
                                @error('Date_Birth_Customer')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 form-group contact-forms" id="">
                                <select class="form-control @error('Floor') is-invalid @enderror" id="Floor" name="Floor" required>
                                    <option value="" disabled selected>Пол</option>
                                    <option value="0" @if(old('Floor') == 0) selected @endif>Мужской</option>
                                    <option value="1" @if(old('Floor') == 1) selected @endif>Женский</option>
                                </select>
                                @error('Floor')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 form-group contact-forms">
                                <input type="tel" class="form-control @error('Phone_Number_Customer') is-invalid @enderror" id="Phone_Number_Customer" placeholder="Номер телефона" name="Phone_Number_Customer" value="{{ old('Phone_Number_Customer') }}" required autocomplete="tel" >
                                @error('Phone_Number_Customer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @error('number_error')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 form-group contact-forms" id="">
                                <select class="form-control @error('Name_Category_Source') is-invalid @enderror" id="Name_Category_Source"  name="Name_Category_Source" required>
                                    <option value="" disabled selected>Как вы о нас узнали</option>
                                    <option value="1">От знакомых</option>
                                    <option value="2">Другое</option>
                                </select>
                                @error('Name_Category_Source')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 form-group contact-forms" id="addSelect">
                                
                            </div>

                            <div class="col-md-12 form-group contact-forms" >
                                <input class="form-check-input" type="checkbox" id="Processing_Personal_Data" name="Processing_Personal_Data" value="1" style="margin-left: 0px !important;" required>
                                <label class="form-check-label text-muted" for="Processing_Personal_Data" style="font-size: 15px; margin-left: 20px !important;" >Разрешить обработку персональных данных.<span class="text-danger" style="size: 5%">*</span></label>
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    <a href="{{asset('politica.html')}}" style="padding-left: 3.3%" target="_blank">Ознакомиться с политикой конфеденциальности</a>
                                </small>
                            </div>
                            <div class="col-md-12 form-group contact-forms" >
                                <input class="form-check-input" type="checkbox" id="Notifications" name="Notifications" value="1"  style="margin-left: 0px !important;">
                                <label class="form-check-label text-muted" for="Notifications" style="font-size: 15px; margin-left: 20px !important;" >Подписаться на уведомления о новых экскурсиях и скидках.</label>
                            </div>

                            <script>
                                $(function() {
                                    $("#Phone_Number_Customer").mask("+7 (999) 999-99-99");
                                    $("#Date_Birth_Customer").mask("99-99-9999");
                                });
                            </script>

                            <div class="col-md-12 form-group contact-forms">
                                {!! NoCaptcha::display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong class="text-danger" style="font-family: Raleway, sans-serif;">{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <style>
                                @media screen and (max-height: 700px){
                                    #rc-imageselect, .g-recaptcha {
                                        transform:scale(0.87);
                                        -webkit-transform:scale(0.87);
                                        transform-origin:0 0;
                                        -webkit-transform-origin:0 0;
                                    }
                                }
                                @media screen and (max-height: 575px){
                                    #rc-imageselect, .g-recaptcha {
                                        transform:scale(0.77);
                                        -webkit-transform:scale(0.77);
                                        transform-origin:0 0;
                                        -webkit-transform-origin:0 0;
                                    }
                                }

                            </style>

                            <script >
                                $(function() {
                                    var ClickReg = 0;
                                    $('#Registr').click(function () {
                                        ClickReg++;
                                        if (ClickReg == 4)
                                        {
                                            ClickReg = 0;
                                            dialog.prompt({
                                                title: "Проблемы с регистрацией",
                                                message: "Если регистрация вызывает у вас трудности, можете обратиться к нам по номеру +7 (903) 222-76-59 или оставить свой. Наш менеджер проконсультирует вас или самостоятельно зарегистрирует.",
                                                button: "Отправить",
                                                position: "static",
                                                animation: "slide",
                                                input: {
                                                    type: "tel",
                                                    placeholder: "Введите номер вашего телефона",
                                                    id: "amswerForPromt"
                                                },
                                                validate: function(value){
                                                    if( $.trim(value) === "" ){
                                                        return false;
                                                    }
                                                    else
                                                        dialog.alert({
                                                            title: "Уведомление",
                                                            message: "Спасибо за обращение. В ближайшее время с вами свяжется наш менеджер."
                                                        });
                                                },
                                            });

                                        }
                                    })

                                    $('#Name_Category_Source').prop('selectedIndex',"");

                                    $('select[name="Name_Category_Source"]').change(function (Retailer) {
                                        if ($("#Name_Category_Source option:selected").text() != "От знакомых") {

                                            if ($("#Name_Category_Source option:selected").text() == "Другое"){
                                                if (!$("#Name_Source").length && !$("#Phone_Customer_Inviter").length){
                                                    $('#addSelect').slideUp( 0 ).delay( 150 ).fadeIn( 1000 ).append('<input id="Name_Source" type="text" class="form-control" name="Name_Source" required placeholder="А именно?">');
                                                }
                                                else {
                                                    $('#Phone_Customer_Inviter').slideUp( 0 ).delay( 150 ).fadeIn( 1000 ).replaceWith('<input id="Name_Source" type="text" class="form-control" required  name="Name_Source"  placeholder="А именно?">');
                                                    $('#Name_Source').slideUp( 0 ).delay( 150 ).fadeIn( 1000 ).replaceWith('<input id="Name_Source" type="text" class="form-control" name="Name_Source" required placeholder="А именно?">');
                                                }
                                            }
 
                                        } else if ($("#Name_Category_Source option:selected").text() == "От знакомых") {
                                            if (!$("#Name_Source").length && !$("#Phone_Customer_Inviter").length){
                                                $('#addSelect').slideUp( 0 ).delay( 150 ).fadeIn( 1000 ).append('<input type="text" class="form-control" id="Phone_Customer_Inviter" placeholder="Телефон знакомого" name="Phone_Customer_Inviter" required autocomplete="tel" >');
                                            }
                                            else {
                                                $('#Name_Source').slideUp( 0 ).delay( 150 ).fadeIn( 1000 ).replaceWith('<input type="text" class="form-control" id="Phone_Customer_Inviter" placeholder="Телефон знакомого" name="Phone_Customer_Inviter" required autocomplete="tel" >');
                                            }
                                            $("#Phone_Customer_Inviter").mask("+7 (999) 999-99-99");
                                        }
                                    });
                                });
                            </script>


                            <div class="col-md-12 booking-button"  style="padding-left: 0px !important; margin-left: 0px !important; padding-right: 0px;">
                                    <button type="submit" class="btn btn-block sent-butnn" style="padding-left: 0px !important; margin-left: 0px; margin-right: 0px; padding-right: 0px;" id="Registr">
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

@push('scripts')
    {!! NoCaptcha::renderJs() !!}
@endpush
