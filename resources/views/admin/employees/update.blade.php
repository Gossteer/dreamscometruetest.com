@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" action="{{route('employees.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="login" >Логин<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ $user->login }}" required  placeholder="Логин">
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
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required  placeholder="Email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="password" >Новый пароль</label>
                                    <div class="col-lg-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Пароль">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="password_confirmation" >Подтвердите пароль </label>
                                    <div class="col-lg-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Подтвердите пароль">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Surname" >Фамилия<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input  type="text" class="form-control @error('Surname') is-invalid @enderror" name="Surname" value="{{ $employees->Surname }}" required  placeholder="Фамилия">
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
                                        <input  type="text" class="form-control @error('Name') is-invalid @enderror" name="Name" value="{{ $employees->Name }}" required  placeholder="Имя">
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
                                        <input  type="text" class="form-control @error('Middle_Name') is-invalid @enderror" name="Middle_Name" value="{{ $employees->Middle_Name }}" placeholder="Отчество">
                                        @error('Middle_Name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Byrthday" >Дата рождения<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input  type="text" class="form-control @error('Byrthday') is-invalid @enderror" id="Byrthday" name="Byrthday" value="{{  date('d-m-Y', strtotime($employees->Byrthday)) }}" placeholder="Дата рождения">
                                        @error('Byrthday')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Phone_Number" >Телефон<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input  type="text" class="form-control @error('Phone_Number') is-invalid @enderror" name="Phone_Number" id="Phone_Number" value="{{ $employees->Phone_Number }}" placeholder="Телефон">
                                        @error('Phone_Number')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="jobs_id" >Должность<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 input-group">
                                        <select class="custom-select @error('jobs_id') is-invalid @enderror" id="jobs_id" name="jobs_id" required>
                                            @foreach($jobs as $job)
                                                <option value="{{ $job->id }}" @if($employees->jobs_id == $job->id) selected @endif> {{ $job->Job_Title . ' зп: ' .  ( ($job->Salary == null)? 'договорная': $job->Salary)}}</option>
                                            @endforeach
                                        </select>
                                        @error('jobs_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="input-group-append">
                                            <a  data-toggle="modal" data-target="#addArticle" class="btn input-group-text selectedbutton" style="color: #495057;" >Создать</a>
                                        </div>
                                        <div class="input-group-append">
                                            <a class="btn input-group-text selectedbutton diableddeletedbutton" id="updatebutton" style="" name="updatebutton">Изменить</a>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(function() {
                                        $('#jobs_id').change(function(select_type_activitie) {
                                            // если значение не равно пустой строке
                                            var deletedbutton = document.querySelector("#deletedbutton")
                                            if($('#jobs_id').val() == "0") {
                                                deletedbutton.classList.add("diableddeletedbutton");
                                            } else {
                                                deletedbutton.classList.remove("diableddeletedbutton");
                                            }
                                        });
                                    });
                                </script>

                                <div class="modal fade" id="addArticle" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addArticleLabel">Добавление должности</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="Job_Title">Название должности <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('Job_Title') is-invalid @enderror" id="Job_Title" placeholder="Название">
                                                    @error('Job_Title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="Salary">Зарплата</label>
                                                    <input type="number" class="form-control @error('Salary') is-invalid @enderror" id="Salary" placeholder="Зарплата ₽">
                                                    @error('Salary')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="Company">Название компании</label>
                                                    <input type="text" class="form-control @error('Company') is-invalid @enderror" id="Company" placeholder="Компания">
                                                    @error('Company')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                                <button type="button" id="save" class="btn btn-primary">Сохранить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(function() {
                                        $('#save').on('click',function(){
                                            var Name_Type_Activity = $('#Name_Type_Activity').val();

                                            $.ajax({
                                                url: '{{ route('typeactivity.store') }}',
                                                type: "POST",
                                                data: {Name_Type_Activity:Name_Type_Activity},
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success: function (data) {
                                                    $('#Name_Type_Activity').val(' ');
                                                    $('#addArticle').modal('hide');
                                                    $('#articles-wrap').removeClass('hidden').addClass('show');
                                                    $('.alert').removeClass('show').addClass('hidden');
                                                    var str = '<option value="'+data['id']+'">'+data['Name_Type_Activity']+'</option>';
                                                    $('#select_type_activitie:last').append(str);
                                                },
                                                error: function (msg) {
                                                    alert('Ошибка');
                                                }
                                            });
                                        });

                                        $('#updatebutton').on('click',function(){
                                            var typeactivity = $('#jobs_id').val();

                                            $.ajax({
                                                url: "typeactivity/"+typeactivity,
                                                type: "GET",
                                                data: {typeactivity:typeactivity},
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success:function (datas)
                                                {
                                                    var str;

                                                    datas.forEach(function(data){
                                                        str += '<option value="'+data['id']+'">'+data['Name_Type_Activity']+'</option>';
                                                    });
                                                    $('#jobs_id option').remove();
                                                    $('#jobs_id:last').append(str);
                                                    alert('Готово');
                                                },
                                                error: function (msg) {
                                                    alert('Ошибка: заполните обязательные для ввода поля или данная запись уже существует.');
                                                }
                                            });
                                        });
                                    })
                                </script>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Type_User" >Права<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <select class="custom-select mr-sm-2" id="Type_User" name="Type_User" required>
                                            <option value="0" @if($user->Type_User == 0) selected @endif>Без прав</option>
                                            <option value="1" @if($user->Type_User == 1) selected @endif>С правами</option>
                                        </select>
                                        @error('Type_User')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <script>
                                    $(function() {
                                        $("#Phone_Number").mask("+7 (999) 999-99-99");
                                        $("#Byrthday").mask("99-99-9999");
                                    });
                                </script>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Type_User" ></label>
                                    <div class="col-lg-6">
                                        <div class="col-md-12 form-group contact-forms" style="margin-top: 15px !important;">
                                            <input class="form-check-input" type="checkbox"  id="Processing_Personal_Data" name="Processing_Personal_Data" @if($user->Processing_Personal_Data == 1) checked @endif value="1"  style="margin-left: -12px !important;" required>
                                            <label class="form-check-label" for="Processing_Personal_Data" style="margin-left: 20px !important;" >Разрешить обработку персональных данных.<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-12 form-group contact-forms" >
                                            <input class="form-check-input" type="checkbox" id="Notifications" name="Notifications" value="1" @if($user->Notifications == 1) checked @endif  style="margin-left: -12px !important;">
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
