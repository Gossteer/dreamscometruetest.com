@extends('layouts.admin')

@section('content')
    <div class="container">
        <form class="form-horizontal" action="{{route('employees.update', $employees)}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="put">
<br>
            <label for="" >Логин</label>
            <input id="login" type="text" class="form-control @error('login') is-invalid @enderror"  name="login" value="{{ $user->login }}" required autocomplete="login" autofocus placeholder="Логин">


            @error('login')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror


            <label for="" >Почта</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email  }}" required autocomplete="email" placeholder="Email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

<label for="" >Фамилия</label>
    <input  type="text" class="form-control" name="Surname" value="{{ $employees->Surname }}" required autocomplete="family-name" placeholder="Фамилия">
<label for="">Имя</label>
    <input  type="text" class="form-control" name="Name" value="{{ $employees->Name }}" required autocomplete="given-name" placeholder="Имя">
<label for="">Отчество</label>
    <input  type="text" class="form-control" name="Middle_Name" value="{{ $employees->Middle_Name }}" autocomplete="additional-name" placeholder="Отчество">
<label for="">Дата рождения</label>
    <input  type="text" class="form-control @error('Byrthday') is-invalid @enderror" id="Byrthday" value="{{ date('d-m-Y', strtotime($employees->Byrthday)) }}" name="Byrthday" required placeholder="Дата рождения">
            @error('Byrthday')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
<label for="">Телефон</label>
<input  type="text" class="form-control @error('Phone_Number') is-invalid @enderror" id="Phone_Number" value="{{ $employees->Phone_Number }}" name="Phone_Number" required placeholder="Телефон">
            @error('Phone_Number')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
<label for="">Должность</label>
<select class="custom-select mr-sm-2" id="jobs_id" name="jobs_id">
    @if($employees->jobs_id != null)
        <option value="{{ $employees->jobs_id }}" selected> {{ $employees->job->Job_Title . ' зп: ' .  $employees->job->Salary}}</option>
    @else
        <option value="" selected> Неназначен</option>
    @endif
@foreach($jobs as $job)
        @if($job->id != $employees->jobs_id)
            <option value="{{ $job->id }}"> {{ $job->Job_Title . ' зп: ' .  $job->Salary}}</option>
        @endif
@endforeach
</select>

            <label for="">Права</label>
            <select class="custom-select mr-sm-2" id="Type_User" name="Type_User" required>
                <option value="0">Без прав</option>
                <option value="1">С правами</option>
            </select>

<br>
<br>

            <script>
                $(function() {
                    $("#Phone_Number").mask("+7 (999) 999-99-99");
                    $("#Byrthday").mask("99-99-9999");
                });
            </script>


<input class="btn mb-1 btn-rounded btn-success" type="submit" value="Сохранить">
        </form>
    </div>

@endsection






