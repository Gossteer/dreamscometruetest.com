@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" action="{{route('customer.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="login" >Логин<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" minlength="2" maxlength="20" value="{{ old('login') }}" required  placeholder="Логин">
                                        @error('login')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="email" >Почта<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" minlength="2" maxlength="191" required  placeholder="Email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="password" >Пароль<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" minlength="8" maxlength="16" required  placeholder="Пароль">
                                        <p id="capsWarning" style="color: red; display: none;">Внимание! Caps lock включен.</p>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="password_confirmation" >Подтвердите пароль<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required  placeholder="Подтвердите пароль">
                                        <p id="capsWarning2" style="color: red; display: none;">Внимание! Caps lock включен.</p>
                                    </div>
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

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Surname" >Фамилия<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input  type="text" class="form-control @error('Surname') is-invalid @enderror" name="Surname" value="{{ old('Surname') }}" minlength="2" maxlength="50" required  placeholder="Фамилия">
                                        @error('Surname')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Name" >Имя<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input  type="text" class="form-control @error('Name') is-invalid @enderror" name="Name" value="{{ old('Name') }}" minlength="2" maxlength="50" required  placeholder="Имя">
                                        @error('Name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Middle_Name" >Отчество</label>
                                    <div class="col-lg-6">
                                        <input  type="text" class="form-control @error('Middle_Name') is-invalid @enderror" name="Middle_Name" value="{{ old('Middle_Name') }}" minlength="2" maxlength="50" placeholder="Отчество">
                                        @error('Middle_Name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Date_Birth_Customer" >Дата рождения<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input  type="text" class="form-control @error('Date_Birth_Customer') is-invalid @enderror" id="Date_Birth_Customer" name="Date_Birth_Customer" value="{{ old('Date_Birth_Customer') }}" placeholder="Дата рождения" required>
                                        @error('Date_Birth_Customer')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Phone_Number_Customer" >Телефон<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input  type="tel" class="form-control @error('Phone_Number_Customer') is-invalid @enderror" name="Phone_Number_Customer" id="Phone_Number_Customer" value="{{ old('Phone_Number_Customer') }}" placeholder="Телефон" required>
                                        @error('Phone_Number_Customer')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Phone_Customer_Inviter" >Телефон пригласившего</label>
                                    <div class="col-lg-6">
                                        <input  type="tel" class="form-control @error('Phone_Customer_Inviter') is-invalid @enderror" value="{{ old('Phone_Customer_Inviter') }}" placeholder="Пригласивший" >
                                        @error('Phone_Customer_Inviter')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Description" >Описание</label>
                                    <div class="col-lg-6">
                                        <textarea  type="text" class="form-control @error('Description') is-invalid @enderror" name="Description" id="Description" maxlength="191" placeholder="Описание">{{ old('Description') }}</textarea>
                                        @error('Description')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row" id="Set_Permission_hidden">
                                    <label class="col-lg-4 col-form-label" for="White_Days" >Белых дней</label>
                                    <div class="col-lg-6">
                                        <input  type="number" class="form-control @error('White_Days') is-invalid @enderror" min="0" max="32767" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==5) return false;" value="{{ old('White_Days') }}" name="White_Days" id="White_Days" placeholder="Белых дней">
                                        @error('White_Days')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row" id="Set_Permission_hidden">
                                    <label class="col-lg-4 col-form-label" for="Black_Days" >Чёрных дней</label>
                                    <div class="col-lg-6">
                                        <input  type="number" class="form-control @error('Black_Days') is-invalid @enderror" min="0" max="32767" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==5) return false;" value="{{ old('Black_Days') }}" name="Black_Days" id="Black_Days" placeholder="Чёрных дней">
                                        @error('Black_Days')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row" id="Set_Permission_hidden">
                                    <label class="col-lg-4 col-form-label" for="The_amount_of_tokens_spent" >Количество использованных билетиков</label>
                                    <div class="col-lg-6">
                                        <input  type="number" class="form-control @error('The_amount_of_tokens_spent') is-invalid @enderror" min="0" max="2147483647" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" value="{{ old('The_amount_of_tokens_spent') }}" name="The_amount_of_tokens_spent" id="The_amount_of_tokens_spent" placeholder="Количество использованных билетиков">
                                        @error('The_amount_of_tokens_spent')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Photo">Фото</label>
                                    <div class="col-lg-6">
                                        <div class="custom-file">
                                            <input type="file" name="Photo" accept=".jpg,.png" onchange="
                                        switch (this.value.match(/\.([^\.]+)$/)[1]) {
                                            case 'png':
                                            case 'jpg':
                                            document.getElementById('Fille_Conract_Partners').textContent= this.files.item(0).name;
                                                break;
                                            default:
                                                alert('Файл не подходит!');
                                                this.value = 'Некорректный файл';
                                                break;
                                        }
                                            " class="custom-file-input">
                                            <label id="Fille_Conract_Partners" for="Photo" class="custom-file-label">Файл не выбран</label>
                                        </div>
                                        @error('Photo')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="floor" >Пол<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <select class="custom-select mr-sm-2 form-control @error('floor') is-invalid @enderror" id="floor" name="floor" required>
                                            <option value="" disabled selected hidden>Пол</option>
                                            <option value="0" @if(old('Floor') == 0) selected @endif>Мужской</option>
                                            <option value="1" @if(old('Floor') == 1) selected @endif>Женский</option>
                                        </select>
                                        @error('floor')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Condition" >Статус<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <select class="custom-select mr-sm-2 form-control @error('Condition') is-invalid @enderror" id="Condition" name="Condition">
                                            <option value="-1" title="У пользователя будет заблокирована возможность записи на мероприятие"  @if(old('Condition') == -1) selected @endif>Ненадёжный</option>
                                            <option value="0" title="У пользователя будет заблокирована возможность записи на мероприятие" @if(old('Condition') == 0) selected @endif>Неподтверждён</option>
                                            <option value="1"  @if(old('Condition') == 1) selected @endif>Подтверждён</option>
                                            <option value="2" @if(old('Condition') == 2) selected @endif>Золотой клиент</option>
                                        </select>
                                        @error('Condition')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Name_Category_Source" >Источник<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <select class="custom-select mr-sm-2 form-control @error('Name_Category_Source') is-invalid @enderror" id="Name_Category_Source" name="Name_Category_Source">
                                            <option value="" disabled selected hidden>Как вы о нас узнали</option>
                                            <option value="1">От знакомых</option>
                                            <option value="2">Другое</option>
                                        </select>
                                        @error('Name_Category_Source')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <!--
                                КАК БУДЕТ РЕАЛИЗОВАНАЯ СИСТЕМА ИСТОЧНИКОВ ПОПРАВИТЬ ЕЙ В ВЫВОДЕ КОНКРЕТНОЙ ИНФОРМАЦИИ О ПОЛЬЗОВАТЕЛЕ
                                -->

                                <div class="form-group row" id="addSelect">

                                </div>

                                <script >
                                    $(function() {

                                        $('#Name_Category_Source').prop('selectedIndex',"");

                                        $('select[name="Name_Category_Source"]').change(function (Name_Category_Source) {
                                            if ($("#Name_Category_Source option:selected").text() != "От знакомых") {
                                                    if (!$("#Name_Source").length && !$("#Phone_Customer_Inviter").length){
                                                        $('#addSelect').slideUp( 0 ).delay( 150 ).fadeIn( 1000 ).append('<label class="col-lg-4 col-form-label" id="namesourse" for="The_amount_of_tokens_spent" >Название источника</label>' +
                                                            '<div class="col-lg-6"><input id="Name_Source" type="text" class="form-control" name="Name_Source" maxlength="191"  placeholder="А именно?"></div>');
                                                    }
                                                    else {
                                                        $('#Phone_Customer_Inviter').slideUp( 0 ).delay( 150 ).fadeIn( 1000 ).replaceWith('<input id="Name_Source" type="text" class="form-control" maxlength="191"  name="Name_Source"  placeholder="А именно?">');
                                                        namesourse.innerHTML = 'Название источник';
                                                    }
                                            } else
                                                if (!$("#Name_Source").length && !$("#Phone_Customer_Inviter").length){
                                                    $('#addSelect').slideUp( 0 ).delay( 150 ).fadeIn( 1000 ).append('<label class="col-lg-4 col-form-label" id="namesourse" for="The_amount_of_tokens_spent" >Номер телефона</label>' +
                                                        '<div class="col-lg-6"><input type="tel" class="form-control" id="Phone_Customer_Inviter" placeholder="Телефон знакомого" name="Phone_Customer_Inviter"></div>');
                                                }
                                                else {
                                                    namesourse.innerHTML = 'Номер телефона';
                                                    $('#Name_Source').slideUp( 0 ).delay( 150 ).fadeIn( 1000 ).replaceWith('<input type="tel" class="form-control" id="Phone_Customer_Inviter" placeholder="Телефон знакомого" name="Phone_Customer_Inviter" >');
                                                }
                                                $("#Phone_Customer_Inviter").mask("+7 (999) 999-99-99");
                                        });
                                    });
                                </script>

                                <script>
                                    $(function() {
                                        $("#Phone_Number_Customer").mask("+7 (999) 999-99-99");
                                        $("#Date_Birth_Customer").mask("99-99-9999");
                                    });
                                </script>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Type_User" ></label>
                                    <div class="col-lg-6">
                                        <div class="col-md-12 form-group contact-forms" style="margin-top: 15px !important;">
                                            <input class="form-check-input" type="checkbox" id="Processing_Personal_Data" name="Processing_Personal_Data" value="1" style="margin-left: -12px !important;" required>
                                            <label class="form-check-label" for="Processing_Personal_Data" style="margin-left: 20px !important;" >Разрешить обработку персональных данных.<span class="text-danger">*</span></label>
                                            <small style="margin-left: 3.3% !important;" id="passwordHelpBlock" class="form-text text-muted">
                                                <a href="{{asset('politica.html')}}" target="_blank">Ознакомиться с политикой конфеденциальности</a>
                                            </small>
                                        </div>
                                        <div class="col-md-12 form-group contact-forms" >
                                            <input class="form-check-input" type="checkbox" id="Notifications" name="Notifications" value="1"  style="margin-left: -12px !important;">
                                            <label class="form-check-label" for="Notifications" style="margin-left: 20px !important;" >Подписаться на уведомления о новых экскурсиях и скидках.</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">Добавить</button>
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
