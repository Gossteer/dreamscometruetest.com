@extends('layouts.admin')

@section('content')
    <div class="container">
        <form class="form-horizontal" action="{{route('employees.update', $employees)}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="put">
<br>
<label for="" >Фамилия</label>
    <input  type="text" class="form-control" name="Surname" value="{{ $employees->Surname }}" required autocomplete="family-name" placeholder="Фамилия">
<label for="">Имя</label>
    <input  type="text" class="form-control" name="Name" value="{{ $employees->Name }}" required autocomplete="given-name" placeholder="Имя">
<label for="">Отчество</label>
    <input  type="text" class="form-control" name="Middle_Name" value="{{ $employees->Middle_Name }}" autocomplete="additional-name" placeholder="Отчество">
<label for="">Дата рождения</label>
    <input  type="text" class="form-control" value="{{ $employees->Byrthday }}" name="Date_Birth_Customer" required placeholder="Дата рождения">
<label for="">Телефон</label>
<input  type="text" class="form-control" value="{{ $employees->Phone_Number }}" name="Phone_Number" required placeholder="Телефон">

<label for="">Должность</label>
<select class="custom-select mr-sm-2" id="jobs_id" name="jobs_id">
    <option value="{{ $employees->jobs_id }}" selected> {{ $employees->job->Job_Title . ' зп: ' .  $employees->job->Salary}}</option>
@foreach($jobs as $job)
        @if($job->id != $employees->jobs_id)
            <option value="{{ $job->id }}"> {{ $job->Job_Title . ' зп: ' .  $job->Salary}}</option>
        @endif
@endforeach
</select>

<br>
<br>


<input class="btn mb-1 btn-rounded btn-success" type="submit" value="Добавить">
        </form>
    </div>

@endsection






