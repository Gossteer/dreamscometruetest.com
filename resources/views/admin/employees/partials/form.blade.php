<br>
<label for="" >Фамилия</label>
    <input  type="text" class="form-control" name="Surname" value="{{ old('Surname') }}" required autocomplete="family-name" placeholder="Фамилия">
<label for="">Имя</label>
    <input  type="text" class="form-control" name="Name" value="{{ old('Name') }}" required autocomplete="given-name" placeholder="Имя">
<label for="">Отчество</label>
    <input  type="text" class="form-control" name="Middle_Name" value="{{ old('Middle_Name') }}" autocomplete="additional-name" placeholder="Отчество">
<label for="">Дата рождения</label>
    <input  type="text" class="form-control" value="{{ old('Date_Birth_Customer') }}" name="Date_Birth_Customer" required placeholder="Дата рождения">
<br>
<input class="btn mb-1 btn-rounded btn-success" type="submit" value="Добавить">








