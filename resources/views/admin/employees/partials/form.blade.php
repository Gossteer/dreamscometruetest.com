<br>
<label for="" >Фамилия</label>
    <input  type="text" class="form-control" name="Surname" value="{{ old('Surname') }}" required autocomplete="family-name" placeholder="Фамилия">
<label for="">Имя</label>
    <input  type="text" class="form-control" name="Name" value="{{ old('Name') }}" required autocomplete="given-name" placeholder="Имя">
<label for="">Отчество</label>
    <input  type="text" class="form-control" name="Middle_Name" value="{{ old('Middle_Name') }}" autocomplete="additional-name" placeholder="Отчество">
<label for="">Дата рождения</label>
    <input  type="text" class="form-control" value="{{ old('Date_Birth_Customer') }}" name="Date_Birth_Customer" required placeholder="Дата рождения">
<label for="">Должность</label>
<select class="custom-select mr-sm-2" id="jobs_id" name="jobs_id">
    @foreach($jobs as $job)
    <option value="{{ $job->id }}"> {{ $job->Job_Title . ' зп: ' . $job->Salary  }}</option>
        @endforeach
</select>




<label for="">Номер телефона</label>
<input  type="tel" onkeyup="return proverka(this);"  onchange="return proverka(this);" class="form-control" value="{{ old('Phone_Number') }}" name="Phone_Number" required placeholder="Номер телефона">
<br>
<input class="btn mb-1 btn-rounded btn-success" type="submit" value="Добавить">

<script type="text/javascript">
    function proverka(input) {
        input.value = input.value.replace(/[^\d,]/g, '');
    };

</script>










