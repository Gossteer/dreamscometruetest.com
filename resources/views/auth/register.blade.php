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
                                <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autocomplete="login" autofocus placeholder="Логин">
                                @error('login')
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
                                <input id="Surname" type="text" class="form-control" name="Surname" value="{{ old('Surname') }}" required autocomplete="family-name" placeholder="Фамилия">
                            </div>

                            <div class="col-sm-6 form-group contact-forms">
                                <input id="Name" type="text" class="form-control" name="Name" value="{{ old('Name') }}" required autocomplete="given-name" placeholder="Имя">
                            </div>

                            <div class="col-sm-6 form-group contact-forms">
                                <input id="Middle_Name" type="text" class="form-control" name="Middle_Name" value="{{ old('Middle_Name') }}" autocomplete="additional-name" placeholder="Отчество">
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
                                <select class="form-control" id="Floor" name="Floor" required>
                                    <option value="" disabled selected>Пол</option>
                                    <option value="0">Мужской</option>
                                    <option value="1">Женский</option>
                                </select>
                            </div>

                            <div class="col-sm-6 form-group contact-forms">
                                <input type="tel" class="form-control @error('Phone_Number_Customer') is-invalid @enderror" id="Phone_Number_Customer" placeholder="Номер телефона" name="Phone_Number_Customer" value="{{ old('Phone_Number_Customer') }}" required autocomplete="tel" >
                                @error('Phone_Number_Customer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 form-group contact-forms" id="">
                                <select class="form-control" id="Name_Category_Source" name="Name_Category_Source" required>
                                    <option value="" disabled selected>Как вы о нас узнали</option>
                                    <option value="1">От знакомых</option>
                                    <option value="2">Другое</option>
                                </select>
                            </div>

                            <div class="col-sm-6 form-group contact-forms" id="addSelect">

                            </div>

                            <div class="col-md-12 form-group contact-forms" >
                                <input class="form-check-input" type="checkbox" id="Processing_Personal_Data" name="Processing_Personal_Data" value="1" style="margin-left: 0px !important;" required>
                                <label class="form-check-label" for="Processing_Personal_Data" style="margin-left: 20px !important;" >Разрешить обработку персональных данных.</label>
                            </div>
                            <div class="col-md-12 form-group contact-forms" >
                                <input class="form-check-input" type="checkbox" id="Notifications" name="Notifications" value="1"  style="margin-left: 0px !important;">
                                <label class="form-check-label" for="Notifications" style="margin-left: 20px !important;" >Подписаться на уведомления о новых экскурсиях и скидках.</label>
                            </div>

                            <script>
                                $(function() {
                                    $("#Phone_Number_Customer").mask("+7 (999) 999-99-99");
                                    $("#Date_Birth_Customer").mask("99-99-9999");
                                });
                            </script>

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
                                            //$("#amswerForPromt").mask("+7 (999) 99-99-999");
                                        }
                                    })

                                    $('#Name_Category_Source').prop('selectedIndex',"");

                                    $('select[name="Name_Category_Source"]').change(function (Retailer) {
                                        if ($("#Name_Category_Source option:selected").text() != "От знакомых") {
                                            //$("#Sources").addClass('animateSelect').fadeIn('fast');
                                            //$("#SourcesDiv").removeClass('col-md-12').fadeIn('fast');
                                            //$("#SourcesDiv").addClass('col-sm-6').fadeIn('fast');
                                            if ($("#Name_Category_Source option:selected").text() == "Другое"){
                                                if (!$("#Name_Source").length && !$("#Number_Customers_Inviter").length){
                                                    $('#addSelect').slideUp( 0 ).delay( 150 ).fadeIn( 1000 ).append('<input id="Name_Source" type="text" class="form-control" name="Name_Source" required placeholder="А именно?">');
                                                }
                                                else {
                                                    $('#Number_Customers_Inviter').slideUp( 0 ).delay( 150 ).fadeIn( 1000 ).replaceWith('<input id="Name_Source" type="text" class="form-control" required  name="Name_Source"  placeholder="А именно?">');
                                                    $('#Name_Source').slideUp( 0 ).delay( 150 ).fadeIn( 1000 ).replaceWith('<input id="Name_Source" type="text" class="form-control" name="Name_Source" required placeholder="А именно?">');
                                                }
                                            }
                                            // else {
                                            //     if (!$("#Name_Source").length && !$("#Number_Customers_Inviter").length){
                                            //         $('#addSelect').slideUp( 0 ).delay( 150 ).fadeIn( 1000 ).append('' +
                                            //             '<select class="form-control" id="Name_Source" name="Name_Source" required disabled="">' +
                                            //             '<option value="" disabled selected>Выберите источник</option>' +
                                            //             '</select>');
                                            //     }
                                            //     else {
                                            //         $('#Number_Customers_Inviter').slideUp( 0 ).delay( 150 ).fadeIn( 1000 ).replaceWith('' +
                                            //             '<select class="form-control" id="Name_Source" name="Name_Source" required disabled="">' +
                                            //             '<option value="" disabled selected>Выберите источник</option>' +
                                            //             '</select>');
                                            //         $('#Name_Source').slideUp( 0 ).delay( 150 ).fadeIn( 1000 ).replaceWith('' +
                                            //             '<select class="form-control" id="Name_Source" name="Name_Source" required disabled="">' +
                                            //             '<option value="" disabled selected>Выберите источник</option>' +
                                            //             '</select>');
                                            //     }
                                            // }
                                            //$("#Name_Source").prop('disabled', false);
                                        } else if ($("#Name_Category_Source option:selected").text() == "От знакомых") {
                                            if (!$("#Name_Source").length && !$("#Number_Customers_Inviter").length){
                                                $('#addSelect').slideUp( 0 ).delay( 150 ).fadeIn( 1000 ).append('<input type="text" class="form-control" id="Number_Customers_Inviter" placeholder="Телефон знакомого" name="Number_Customers_Inviter" required autocomplete="tel" >');
                                            }
                                            else {
                                                $('#Name_Source').slideUp( 0 ).delay( 150 ).fadeIn( 1000 ).replaceWith('<input type="text" class="form-control" id="Number_Customers_Inviter" placeholder="Телефон знакомого" name="Number_Customers_Inviter" required autocomplete="tel" >');
                                            }
                                            $("#Number_Customers_Inviter").mask("+7 (999) 999-99-99");
                                        }
                                    });
                                });
                            </script>


                            <div class="col-md-12 booking-button">
                                    <button type="submit" class="btn btn-block sent-butnn" id="Registr">
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
