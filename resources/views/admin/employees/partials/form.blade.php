<br>

<label for="" >Логин</label>
    <input id="login" type="text" class="form-control @error('name') is-invalid @enderror" name="login" value="{{ old('login') }}" required autocomplete="login" autofocus placeholder="Логин">

    @error('name')
    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror

<label for="" >Почта</label>
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

    @error('email')
    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror

<label for="" >Пароль</label>
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Пароль">

    @error('password')
    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror


<label for="" >Подтвердите пароль</label>
    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Подтвердите пароль">


<label for="" >Фамилия</label>
    <input  type="text" class="form-control" name="Surname" value="{{ old('Surname') }}" required autocomplete="family-name" placeholder="Фамилия">
<label for="">Имя</label>
    <input  type="text" class="form-control" name="Name" value="{{ old('Name') }}" required autocomplete="given-name" placeholder="Имя">
<label for="">Отчество</label>
    <input  type="text" class="form-control" name="Middle_Name" value="{{ old('Middle_Name') }}" autocomplete="additional-name" placeholder="Отчество">
<label for="">Дата рождения</label>
    <input  type="text" class="form-control" id="Byrthday" value="{{ old('Byrthday') }}" name="Byrthday" required placeholder="Дата рождения">
<label for="">Телефон</label>
<input  type="text" class="form-control" id="Phone_Number" value="{{ old('Phone_Number') }}" name="Phone_Number" required placeholder="Телефон">

<label for="">Должность</label>
<select class="custom-select mr-sm-2" id="jobs_id" name="jobs_id" required>
@foreach($jobs as $job)
    <option value="{{ $job->id }}"> {{ $job->Job_Title . ' зп: ' .  $job->Salary}}</option>
@endforeach
</select>

<label for="">Права</label>
<select class="custom-select mr-sm-2" id="Type_User" name="Type_User" required>
    <option value="0">Без прав</option>
    <option value="1">С правами</option>
</select>


<div class="col-md-12 form-group contact-forms" style="margin-top: 15px !important;">
    <input class="form-check-input" type="checkbox" id="Processing_Personal_Data" name="Processing_Personal_Data" value="1" style="margin-left: 0px !important;" required>
    <label class="form-check-label" for="Processing_Personal_Data" style="margin-left: 20px !important;" >Разрешить обработку персональных данных.</label>
</div>
<div class="col-md-12 form-group contact-forms" >
    <input class="form-check-input" type="checkbox" id="Notifications" name="Notifications" value="1"  style="margin-left: 0px !important;">
    <label class="form-check-label" for="Notifications" style="margin-left: 20px !important;" >Подписаться на уведомления о новых экскурсиях и скидках.</label>
</div>


<script>
    $(function() {
        $("#Phone_Number").mask("+7 (999) 999-99-99");
        $("#Byrthday").mask("99-99-9999");
    });
</script>

<br>
<br>


<input class="btn mb-1 btn-rounded btn-success" type="submit" value="Добавить">








