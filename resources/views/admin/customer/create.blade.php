@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form method="POST" action="{{ route('customer.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6 form-group contact-forms">
                                        <input id="login" type="text" class="form-control @error('name') is-invalid @enderror" name="login" value="{{ old('login') }}" required autocomplete="login" autofocus placeholder="Логин">

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
                                        <input id="Surname" type="text" class="form-control" name="Surname" value="{{ old('Surname') }}" required autocomplete="family-name" placeholder="Фамилия">
                                    </div>

                                    <div class="col-sm-6 form-group contact-forms">
                                        <input id="Name" type="text" class="form-control" name="Name" value="{{ old('Name') }}" required autocomplete="given-name" placeholder="Имя">
                                    </div>

                                    <div class="col-sm-6 form-group contact-forms">
                                        <input id="Middle_Name" type="text" class="form-control" name="Middle_Name" value="{{ old('Middle_Name') }}" autocomplete="additional-name" placeholder="Отчество">
                                    </div>

                                    <div class="col-sm-6 form-group contact-forms">
                                        <input id="Date_Birth_Customer" type="text" class="form-control" value="{{ old('Date_Birth_Customer') }}" name="Date_Birth_Customer" required placeholder="Дата рождения">
                                    </div>

                                    <div class="col-sm-6 form-group contact-forms" id="">
                                        <select class="form-control" id="Floor" name="Floor" required>
                                            <option value="0">Мужской</option>
                                            <option value="1">Женский</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6 form-group contact-forms">
                                        @if (session('error'))
                                            <div class="alert alert-danger">{{ session('error') }}</div>
                                        @endif
                                        <input type="tel" class="form-control" id="Phone_Number_Customer" placeholder="Номер телефона" name="Phone_Number_Customer" value="{{ old('Phone_Number_Customer') }}" required autocomplete="tel" >
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
                                                        },
                                                        callback: function(value){
                                                            dialog.alert({
                                                                title: "Уведомление",
                                                                message: "Спасибо за обращение. В ближайшее время с вами свяжется наш менеджер."
                                                            });
                                                        }
                                                    });
                                                    //$("#amswerForPromt").mask("+7 (999) 99-99-999");
                                                }
                                            })
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
    </div>





@endsection
