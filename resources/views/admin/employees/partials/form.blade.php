<br>
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
<select class="custom-select mr-sm-2" id="jobs_id" name="jobs_id">
@foreach($jobs as $job)
    <option value="{{ $job->id }}"> {{ $job->Job_Title . ' зп: ' .  $job->Salary}}</option>
@endforeach
</select>

<script>
    $(function() {
        $("#Phone_Number").mask("+7 (999) 999-99-99");
        $("#Byrthday").mask("99-99-9999");
    });
</script>

<br>
<br>


<input class="btn mb-1 btn-rounded btn-success" type="submit" value="Добавить">








