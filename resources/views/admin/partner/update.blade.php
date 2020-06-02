@extends('layouts.admin')

@section('content')


    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" action="{{ route('partners.update', $partner->id) }}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_method" value="put">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Name_Partners">Наименование <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control @error('Name_Partners') is-invalid @enderror" value="{{$partner->Name_Partners}}" name="Name_Partners" placeholder="Наименование" required>
                                        @error('Name_Partners')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="INN">ИНН</label>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control @error('INN') is-invalid @enderror"  maxlength="12"  onKeyPress="if(this.value.length==12) return false;" value="{{$partner->INN}}"  name="INN" placeholder="ИНН">
                                        @error('Name_Partners')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="select_type_activitie">Тип деятельности<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 input-group">
                                        <select class="custom-select @error('select_type_activitie') is-invalid @enderror" id="select_type_activitie" name="select_type_activitie" required>
                                            <option value="0" disabled hidden>Тип занятости</option>
                                            @foreach($type_activities as $type_activitie)
                                            <option value="{{$type_activitie->id}}" id="{{$type_activitie->id}}" @if( $partner->type_activities_id == $type_activitie->id) selected @endif>{{$type_activitie->Name_Type_Activity}}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a  data-toggle="modal" data-target="#addArticle" class="btn input-group-text selectedbutton" style="color: #495057;" title="Добавить"><i class="fa fa-plus-circle color-muted m-r-5"></i></a>
                                        </div>
                                        <div class="input-group-append" id="div_updatebutton">
                                            <a class="btn input-group-text selectedbutton" data-toggle="modal" data-target="#addArticle1" id="updatebutton_type_activitie" style="" name="updatebutton_type_activitie" title="Изменить"><i class="fa fa-pencil color-danger"></i></a>
                                        </div>
                                        @error('select_type_activitie')
                                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="modal fade" id="addArticle1" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addArticleLabel">Изменение типа занятости</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="title">Название типа занятости <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('Name_Type_Activity1') is-invalid @enderror" minlength="2" maxlength="191" id="Name_Type_Activity1" placeholder="Название">
                                                    @error('Name_Type_Activity1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" id="delete_Type_Activity" name="delete_Type_Activity" data-dismiss="modal">Удалить</button>
                                                <button type="button" id="ubdate_Type_Activity" name="ubdate_Type_Activity" class="btn btn-primary">Изменить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="addArticle" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addArticleLabel">Добавление типа занятости</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="title">Название типа занятости <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('Name_Type_Activity') is-invalid @enderror" minlength="2" maxlength="191" id="Name_Type_Activity" placeholder="Название">
                                                    @error('Name_Type_Activity')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                                <button type="button" id="save_Type_Activity" name="save_Type_Activity" class="btn btn-primary">Сохранить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                        $('#select_type_activitie').change(function(select_type_activitie) {
                                            // если значение не равно пустой строке
                                            var deletedbutton = document.querySelector("#updatebutton_type_activitie")
                                            if($('#select_type_activitie').val() == "0") {
                                                deletedbutton.classList.add("diableddeletedbutton");
                                            } else {
                                                deletedbutton.classList.remove("diableddeletedbutton");
                                            }
                                        });


                                    $(function() {

                                        $('#save_Type_Activity').on('click',function(){
                                            var Name_Type_Activity = $('#Name_Type_Activity').val();
                                            $.ajax({
                                                url: "{{route('typeactivity.store')}}",
                                                type: "POST",
                                                data: {Name_Type_Activity:Name_Type_Activity},
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },

                                                success: function (data) {
                                                    $('#Name_Type_Activity').val('');
                                                    $('#addArticle').modal('hide');
                                                    $('#articles-wrap').removeClass('hidden').addClass('show');
                                                    $('.alert').removeClass('show').addClass('hidden');
                                                    var str = '<option value="'+data['id']+'" selected>'+data['Name_Type_Activity']+'</option>';
                                                    $('#select_type_activitie:last').append(str);
                                                    alert('Добавлено');
                                                    document.getElementById("updatebutton_type_activitie").classList.remove("diableddeletedbutton");
                                                },
                                                error: function (msg) {
                                                    alert('Ошибка: заполните обязательные для ввода поля или данная запись уже существует.');
                                                }
                                            });
                                        });

                                        $('#updatebutton_type_activitie').on('click',function(){
                                            var id = $('#select_type_activitie').val();

                                            $.ajax({
                                                url: "{{route('typeactivity.index')}}",
                                                type: "POST",
                                                data: {id:id},
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success:function (data)
                                                {
                                                    $('#Name_Type_Activity1').val(data['Name_Type_Activity']);
                                                },
                                                error: function (msg) {
                                                    alert('Ошибка');
                                                }
                                            });
                                        });

                                        
                                        $('#ubdate_Type_Activity').on('click',function(){
                                            var id = $('#select_type_activitie').val();
                                            var Name_Type_Activity = $('#Name_Type_Activity1').val();

                                            $.ajax({
                                                url: "{{route('typeactivity.update')}}",
                                                type: "POST",
                                                data: {id:id,Name_Type_Activity:Name_Type_Activity},
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success:function (data)
                                                {
                                                    $('#addArticle1').modal('hide');
                                                    $('#articles-wrap').removeClass('hidden').addClass('show');
                                                    $('.alert').removeClass('show').addClass('hidden');
                                                    document.getElementById('select_type_activitie').options[document.getElementById('select_type_activitie').selectedIndex].text = data['Name_Type_Activity'];
                                                    document.getElementById('select_type_activitie').options[document.getElementById('select_type_activitie').selectedIndex].id = data['id'];
                                                    document.getElementById('select_type_activitie').options[document.getElementById('select_type_activitie').selectedIndex].value = data['id'];
                                                    alert('Изменено');
                                                },
                                                error: function (msg) {
                                                    alert('Ошибка: заполните обязательные для ввода поля или данная запись уже существует.');
                                                }
                                            });
                                        });

                                        $('#delete_Type_Activity').on('click',function(){
                                            var typeactivity = $('#select_type_activitie').val();

                                            $.ajax({
                                                url: "{{route('typeactivity.destroy')}}",
                                                type: "POST",
                                                data: {typeactivity:typeactivity},
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success:function (datas)
                                                {
                                                    var info = '. Данный тип занятости находится ещё в: '
                                                    select_type_activitie.removeChild(select_type_activitie.querySelector('[value="'+ typeactivity +'"]'));
                                                    select_type_activitie.value = 0;
                                                    datas.forEach((element) => {
                                                        info += ' ' + element['Name_Partners'] + '; '
                                                        });
                                                    document.getElementById("updatebutton_type_activitie").classList.add("diableddeletedbutton");
                                                    alert('Удалено' + (datas.length != 0 ? info : ""));
                                                },
                                                error: function (msg) {
                                                    alert('Ошибка');
                                                }
                                            });
                                        });
                                    });
                                </script>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Conract_Partners">Договор</label>
                                    <div class="col-lg-6">
                                        <div class="custom-file">
                                            <input type="file" name="Conract_Partners" value="{{$partner->Conract_Partners}}" accept=".txt,.pdf,.docx,.docm,.doc,.xls,.xml,.xlsx,.xlsm" onchange="
                                        switch (this.value.match(/\.([^\.]+)$/)[1]) {
                                            case 'txt':
                                            case 'pdf':
                                            case 'docx':
                                            case 'docm':
                                            case 'doc':
                                            case 'xls':
                                            case 'xml':
                                            case 'xlsx':
                                            case 'xlsm':
                                            document.getElementById('Fille_Conract_Partners').textContent= this.files.item(0).name;
                                                break;
                                            default:
                                                alert('Файл не подходит!');
                                                this.value = 'Некорректный файл';
                                                break;
                                        }
                                            " class="custom-file-input">
                                            <label id="Fille_Conract_Partners" class="custom-file-label">Файл не выбран</label>
                                        </div>
                                        @error('Name_Partners')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
 
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Address" >Адрес</label>
                                    <div class="col-lg-6 input-group">
                                        <select class="custom-select @error('Address') is-invalid @enderror" multiple onchange="chenge_ubdate_button(this, 'updatebutton2');" id="Address" name="Address[]">
                                            <option value="null" id="dont_select_Address" @if(count($address) == 0) selected @endif >Без выбора</option>
                                            @foreach ($address as $addres)
                                                <option value="{{$addres->id}}" id="{{$addres->id}}" selected >{{$addres->Address}}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a  data-toggle="modal" data-target="#addArticle2" class="btn input-group-text selectedbutton" style="color: #495057;" title="Добавить"><i class="fa fa-plus-circle color-muted m-r-5"></i></a>
                                        </div>
                                        <div class="input-group-append"  id="div_updatebutton2">
                                            <a class="btn input-group-text selectedbutton diableddeletedbutton" data-toggle="modal" data-target="#addArticle3" id="updatebutton2" style="" name="updatebutton2"  onclick="index_Address()" title="Изменить"><i class="fa fa-pencil color-danger"></i></a>
                                        </div>
                                        @error('$Address')
                                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="modal fade" id="addArticle3" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addArticleLabel">Изменение адреса</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="Address2">Адрес<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('Address2') is-invalid @enderror" minlength="2" maxlength="191" id="Address2" placeholder="Адрес">
                                                    @error('Address2')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" id="delete_Address" name="delete_Address" onclick="destroy_Address()" data-dismiss="modal">Удалить</button>
                                                <button type="button" id="ubdate_Address" name="ubdate_Address" onclick="update_Address()" class="btn btn-primary">Изменить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="addArticle2" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addArticleLabel">Добавление адреса</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="Address1">Адрес<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('Address1') is-invalid @enderror" minlength="2" maxlength="191" id="Address1" placeholder="Адрес">
                                                    @error('Address1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                                <button type="button" id="save_Address" onclick="create_Address()" name="save_Address" class="btn btn-primary">Сохранить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>

                                    function create_Address() {
                                        var Address = $('#Address1').val();
                                    
                                        $.ajax({
                                            url: '{{ route('address.store') }}',
                                            type: "POST",
                                            data: {Address:Address},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },

                                            success: function (data) {
                                                $('#Address1').val('');
                                                $('#addArticle2').modal('hide');
                                                $('#articles-wrap').removeClass('hidden').addClass('show');
                                                $('.alert').removeClass('show').addClass('hidden');
                                                $('#dont_select_Address').prop('selected', false);
                                                var str = '<option value="'+data['id']+'" id="'+data['id']+'" selected>'+data['Address']+'</option>';
                                                $('#Address:last').append(str);
                                                chenge_ubdate_button($('#Address'), 'updatebutton2');
                                                alert('Добавлено');
                                            },
                                            error: function (msg) {
                                                alert('Ошибка: заполните обязательные для ввода поля или данная запись уже существует.');
                                            }
                                        });
                                    };

                                    function update_Address() {
                                        var Address = $('#Address2').val();
                                        var id = $('#Address').val();
                                        $.ajax({
                                            url: "{{route('address.update')}}",
                                            type: "POST",
                                            data: {id:id[0], Address:Address},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success: function (data) {
                                                $('#Address2').val('');
                                                $('#addArticle3').modal('hide');
                                                $('#articles-wrap').removeClass('hidden').addClass('show');
                                                $('.alert').removeClass('show').addClass('hidden');
                                                $('#dont_select_Address').prop('selected', false);
                                                document.getElementById('Address').options[document.getElementById('Address').selectedIndex].text = data['Address'];
                                                alert('Изменено');

                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };

                                    function index_Address() {
                                        var id = $('#Address').val();
                                        $.ajax({
                                            url: "{{route('address.index')}}",
                                            type: "POST",
                                            data: {id:id[0]},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success:function (data)
                                            {
                                                $('#Address2').val(data['Address']);
                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };
                                    function destroy_Address() {
                                        var Address = $('#Address').val();
                                        $.ajax({
                                            url: "{{route('address.destroy')}}",
                                            type: "POST",
                                            data: {id:Address[0]},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success:function (data)
                                            {
                                                $('#Address2').val('');
                                                document.querySelector("#updatebutton2").classList.add("diableddeletedbutton");
                                                document.getElementById('Address').options[document.getElementById('Address').selectedIndex].remove();
                                                $('#dont_select_Address').prop('selected', true);
                                                //$('#routes_id').val('0');
                                                alert('Удалено');
                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };

                                </script>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Phone_Number" >Номер телефона</label>
                                    <div class="col-lg-6 input-group">
                                        <select class="custom-select @error('Phone_Number') is-invalid @enderror" multiple onchange="chenge_ubdate_button(this, 'updatebutton3');" id="Phone_Number" name="Phone_Number[]">
                                            <option value="null" id="dont_select_Phone_Number" @if(count($phone_nombers) == 0) selected @endif >Без выбора</option>
                                            @foreach ($phone_nombers as $phone_nomber)
                                                <option value="{{$phone_nomber->id}}" id="{{$phone_nomber->id}}" selected >{{$phone_nomber->Representative}}: {{$phone_nomber->Phone_Number}}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a  data-toggle="modal" data-target="#addArticle4" class="btn input-group-text selectedbutton" style="color: #495057;" title="Добавить"><i class="fa fa-plus-circle color-muted m-r-5"></i></a>
                                        </div>
                                        <div class="input-group-append"  id="div_updatebutton3">
                                            <a class="btn input-group-text selectedbutton diableddeletedbutton" data-toggle="modal" data-target="#addArticle5" id="updatebutton3" style="" name="updatebutton3"  onclick="index_Phone_Number()" title="Изменить"><i class="fa fa-pencil color-danger"></i></a>
                                        </div>
                                        @error('$Phone_Number')
                                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="modal fade" id="addArticle5" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addArticleLabel">Изменение номера телефона</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="Representative">Представитель<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('Representative') is-invalid @enderror" minlength="2" maxlength="191" id="Representative" placeholder="ФИО">
                                                    @error('Representative')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="Phone_Number1">Номер телефона<span class="text-danger">*</span></label>
                                                    <input type="tel" class="form-control @error('Phone_Number1') is-invalid @enderror" minlength="2" maxlength="191" id="Phone_Number1" placeholder="Номер телефона">
                                                    @error('Phone_Number1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" id="delete_Phone_Number" name="delete_Phone_Number" onclick="destroy_Phone_Number()" data-dismiss="modal">Удалить</button>
                                                <button type="button" id="ubdate_Phone_Number" name="ubdate_Phone_Number" onclick="update_Phone_Number()" class="btn btn-primary">Изменить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="addArticle4" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addArticleLabel">Добавление номера телефона</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="Representative1">Представитель<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('Representative1') is-invalid @enderror" minlength="2" maxlength="191" id="Representative1" placeholder="ФИО">
                                                    @error('Representative1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="Phone_Number2">Номер телефона<span class="text-danger">*</span></label>
                                                    <input type="tel" class="form-control @error('Phone_Number2') is-invalid @enderror" minlength="2" maxlength="191" id="Phone_Number2" placeholder="Номер телефона">
                                                    @error('Phone_Number2')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                                <button type="button" id="save_Phone_Number" onclick="create_Phone_Number()" name="save_Phone_Number" class="btn btn-primary">Сохранить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>

                                    function create_Phone_Number() {
                                        var Representative = $('#Representative1').val();
                                        var Phone_Number = $('#Phone_Number2').val();
                                    
                                        $.ajax({
                                            url: '{{ route('phonenomber.store') }}',
                                            type: "POST",
                                            data: {Representative:Representative, Phone_Number:Phone_Number },
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },

                                            success: function (data) {
                                                $('#Phone_Number2').val('');
                                                $('#Representative1').val('');
                                                $('#addArticle4').modal('hide');
                                                $('#articles-wrap').removeClass('hidden').addClass('show');
                                                $('.alert').removeClass('show').addClass('hidden');
                                                $('#dont_select_Phone_Number').prop('selected', false);
                                                var str = '<option value="'+data['id']+'" id="'+data['id']+'" selected>'+data['Representative']+': '+data['Phone_Number']+'</option>';
                                                $('#Phone_Number:last').append(str);
                                                chenge_ubdate_button($('#Phone_Number'), 'updatebutton3');
                                                alert('Добавлено');
                                            },
                                            error: function (msg) {
                                                alert('Ошибка: заполните обязательные для ввода поля или данная запись уже существует.');
                                            }
                                        });
                                    };

                                    function update_Phone_Number() {
                                        var Representative = $('#Representative').val();
                                        var Phone_Number = $('#Phone_Number1').val();
                                        var id = $('#Phone_Number').val();
                                        $.ajax({
                                            url: "{{route('phonenomber.update')}}",
                                            type: "POST",
                                            data: {id:id[0], Representative:Representative, Phone_Number:Phone_Number},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success: function (data) {
                                                $('#Phone_Number1').val('');
                                                $('#Representative').val('');
                                                $('#addArticle5').modal('hide');
                                                $('#articles-wrap').removeClass('hidden').addClass('show');
                                                $('.alert').removeClass('show').addClass('hidden');
                                                $('#dont_select_Phone_Number').prop('selected', false);
                                                document.getElementById('Phone_Number').options[document.getElementById('Phone_Number').selectedIndex].text = data['Representative'] + ': ' + data['Phone_Number'];
                                                alert('Изменено');

                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };

                                    function index_Phone_Number() {
                                        var id = $('#Phone_Number').val();
                                        $.ajax({
                                            url: "{{route('phonenomber.index')}}",
                                            type: "POST",
                                            data: {id:id[0]},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success:function (data)
                                            {
                                                $('#Phone_Number1').val(data['Phone_Number']);
                                                $('#Representative').val(data['Representative']);
                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };
                                    function destroy_Phone_Number() {
                                        var Phone_Number = $('#Phone_Number').val();
                                        $.ajax({
                                            url: "{{route('phonenomber.destroy')}}",
                                            type: "POST",
                                            data: {id:Phone_Number[0]},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success:function (data)
                                            {
                                                $('#Phone_Number1').val('');
                                                $('#Representative').val('');
                                                document.querySelector("#updatebutton3").classList.add("diableddeletedbutton");
                                                document.getElementById('Phone_Number').options[document.getElementById('Phone_Number').selectedIndex].remove();
                                                $('#dont_select_Phone_Number').prop('selected', true);
                                                //$('#routes_id').val('0');
                                                alert('Удалено');
                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };


                                    $(function() {
                                            $("#Phone_Number1").mask("+7 (999) 999-99-99");
                                            $("#Phone_Number2").mask("+7 (999) 999-99-99");
                                        });
                                </script>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Email" >Почта</label>
                                    <div class="col-lg-6 input-group">
                                        <select class="custom-select @error('Email') is-invalid @enderror" multiple onchange="chenge_ubdate_button(this, 'updatebutton4');" id="Email" name="Email[]">
                                            <option value="null" id="dont_select_Email" @if(count($emails) == 0) selected @endif>Без выбора</option>
                                            @foreach ($emails as $email)
                                                <option value="{{$email->id}}" id="{{$email->id}}" selected >{{$email->Representative_Email	}}: {{$email->Email}}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a  data-toggle="modal" data-target="#addArticle6" class="btn input-group-text selectedbutton" style="color: #495057;" title="Добавить"><i class="fa fa-plus-circle color-muted m-r-5"></i></a>
                                        </div>
                                        <div class="input-group-append"  id="div_updatebutton4">
                                            <a class="btn input-group-text selectedbutton diableddeletedbutton" data-toggle="modal" data-target="#addArticle7" id="updatebutton4" style="" name="updatebutton4"  onclick="index_Email()" title="Изменить"><i class="fa fa-pencil color-danger"></i></a>
                                        </div>
                                        @error('$Email')
                                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="modal fade" id="addArticle7" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addArticleLabel">Изменение почты</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="Email1">Почта<span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control @error('Email1') is-invalid @enderror" minlength="2" maxlength="191" id="Email1" placeholder="email">
                                                    @error('Email1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="Representative_Email">Представитель<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('Representative_Email') is-invalid @enderror" minlength="2" maxlength="191" id="Representative_Email" placeholder="ФИО">
                                                    @error('Representative_Email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" id="delete_Email" name="delete_Email" onclick="destroy_Email()" data-dismiss="modal">Удалить</button>
                                                <button type="button" id="ubdate_Email" name="ubdate_Email" onclick="update_Email()" class="btn btn-primary">Изменить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="addArticle6" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addArticleLabel">Добавление почты</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="Email2">Почта<span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control @error('Email2') is-invalid @enderror" minlength="2" maxlength="191" id="Email2" placeholder="email">
                                                    @error('Email2')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="Representative_Email1">Представитель<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('Representative_Email1') is-invalid @enderror" minlength="2" maxlength="191" id="Representative_Email1" placeholder="ФИО">
                                                    @error('Representative_Email1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                                <button type="button" id="save_Email" onclick="create_Email()" name="save_Email" class="btn btn-primary">Сохранить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>

                                    function create_Email() {
                                        var Email = $('#Email2').val();
                                        var Representative_Email = $('#Representative_Email1').val();
                                    
                                        $.ajax({
                                            url: '{{ route('email.store') }}',
                                            type: "POST",
                                            data: {Email:Email, Representative_Email:Representative_Email },
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },

                                            success: function (data) {
                                                $('#Email2').val('');
                                                $('#Representative_Email1').val('');
                                                $('#addArticle6').modal('hide');
                                                $('#articles-wrap').removeClass('hidden').addClass('show');
                                                $('.alert').removeClass('show').addClass('hidden');
                                                $('#dont_select_Email').prop('selected', false);
                                                var str = '<option value="'+data['id']+'" id="'+data['id']+'" selected>'+data['Representative_Email']+': '+data['Email']+'</option>';
                                                $('#Email:last').append(str);
                                                chenge_ubdate_button($('#Email'), 'updatebutton4');
                                                alert('Добавлено');
                                            },
                                            error: function (msg) {
                                                alert('Ошибка: заполните обязательные для ввода поля или данная запись уже существует.');
                                            }
                                        });
                                    };

                                    function update_Email() {
                                        var Email = $('#Email1').val();
                                        var Representative_Email = $('#Representative_Email').val();
                                        var id = $('#Email').val();
                                        $.ajax({
                                            url: "{{route('email.update')}}",
                                            type: "POST",
                                            data: {id:id[0], Email:Email, Representative_Email:Representative_Email},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success: function (data) {
                                                $('#Email1').val('');
                                                $('#Representative_Email').val('');
                                                $('#addArticle7').modal('hide');
                                                $('#articles-wrap').removeClass('hidden').addClass('show');
                                                $('.alert').removeClass('show').addClass('hidden');
                                                $('#dont_select_Email').prop('selected', false);
                                                document.getElementById('Email').options[document.getElementById('Email').selectedIndex].text = data['Representative_Email'] + ': ' + data['Email'];
                                                alert('Изменено');

                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };

                                    function index_Email() {
                                        var id = $('#Email').val();
                                        $.ajax({
                                            url: "{{route('email.index')}}",
                                            type: "POST",
                                            data: {id:id[0]},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success:function (data)
                                            {
                                                $('#Email1').val(data['Email']);
                                                $('#Representative_Email').val(data['Representative_Email']);
                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };
                                    function destroy_Email() {
                                        var Email = $('#Email').val();
                                        $.ajax({
                                            url: "{{route('email.destroy')}}",
                                            type: "POST",
                                            data: {id:Email[0]},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success:function (data)
                                            {
                                                $('#Email1').val('');
                                                $('#Representative_Email').val('');
                                                document.querySelector("#updatebutton4").classList.add("diableddeletedbutton");
                                                document.getElementById('Email').options[document.getElementById('Email').selectedIndex].remove();
                                                $('#dont_select_Email').prop('selected', true);
                                                //$('#routes_id').val('0');
                                                alert('Удалено');
                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };

                                </script>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Websites" >Сайт</label>
                                    <div class="col-lg-6 input-group">
                                        <select class="custom-select @error('Websites') is-invalid @enderror" multiple onchange="chenge_ubdate_button(this, 'updatebutton5');" id="Websites" name="Websites[]">
                                            <option value="null" id="dont_select_Websites" @if(count($websites) == 0) selected @endif>Без выбора</option>
                                            @foreach ($websites as $website)
                                                <option value="{{$website->id}}" id="{{$website->id}}" selected >{{$website->Site}}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a  data-toggle="modal" data-target="#addArticle8" class="btn input-group-text selectedbutton" style="color: #495057;" title="Добавить"><i class="fa fa-plus-circle color-muted m-r-5"></i></a>
                                        </div>
                                        <div class="input-group-append"  id="div_updatebutton5">
                                            <a class="btn input-group-text selectedbutton diableddeletedbutton" data-toggle="modal" data-target="#addArticle9" id="updatebutton5" style="" name="updatebutton5"  onclick="index_Site()" title="Изменить"><i class="fa fa-pencil color-danger"></i></a>
                                        </div>
                                        @error('$Websites')
                                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="modal fade" id="addArticle9" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addArticleLabel">Изменение сайта</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="Site">Сайт<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('Site') is-invalid @enderror" minlength="2" maxlength="191" id="Site" placeholder="Сайт">
                                                    @error('Site')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" id="delete_Site" name="delete_Site" onclick="destroy_Site()" data-dismiss="modal">Удалить</button>
                                                <button type="button" id="ubdate_Site" name="ubdate_Site" onclick="update_Site()" class="btn btn-primary">Изменить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="addArticle8" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addArticleLabel">Добавление сайта</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="Site1">Сайт<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('Site1') is-invalid @enderror" minlength="2" maxlength="191" id="Site1" placeholder="Сайт">
                                                    @error('Site1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                                <button type="button" id="save_Site" onclick="create_Site()" name="save_Site" class="btn btn-primary">Сохранить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>

                                    function create_Site() {
                                        var Site = $('#Site1').val();
                                    
                                        $.ajax({
                                            url: '{{ route('website.store') }}',
                                            type: "POST",
                                            data: {Site:Site},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },

                                            success: function (data) {
                                                $('#Site1').val('');
                                                $('#addArticle8').modal('hide');
                                                $('#articles-wrap').removeClass('hidden').addClass('show');
                                                $('.alert').removeClass('show').addClass('hidden');
                                                $('#dont_select_Websites').prop('selected', false);
                                                var str = '<option value="'+data['id']+'" id="'+data['id']+'" selected>'+data['Site']+'</option>';
                                                $('#Websites:last').append(str);
                                                chenge_ubdate_button($('#Websites'), 'updatebutton5');
                                                alert('Добавлено');
                                            },
                                            error: function (msg) {
                                                alert('Ошибка: заполните обязательные для ввода поля или данная запись уже существует.');
                                            }
                                        });
                                    };

                                    function update_Site() {
                                        var Site = $('#Site').val();
                                        var id = $('#Websites').val();
                                        $.ajax({
                                            url: "{{route('website.update')}}",
                                            type: "POST",
                                            data: {id:id[0], Site:Site},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success: function (data) {
                                                $('#Site').val('');
                                                $('#addArticle9').modal('hide');
                                                $('#articles-wrap').removeClass('hidden').addClass('show');
                                                $('.alert').removeClass('show').addClass('hidden');
                                                $('#dont_select_Websites').prop('selected', false);
                                                document.getElementById('Websites').options[document.getElementById('Websites').selectedIndex].text = data['Site'];
                                                alert('Изменено');

                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };

                                    function index_Site() {
                                        var id = $('#Websites').val();
                                        $.ajax({
                                            url: "{{route('website.index')}}",
                                            type: "POST",
                                            data: {id:id[0]},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success:function (data)
                                            {
                                                $('#Site').val(data['Site']);
                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };
                                    function destroy_Site() {
                                        var Websites = $('#Websites').val();
                                        $.ajax({
                                            url: "{{route('website.destroy')}}",
                                            type: "POST",
                                            data: {id:Websites[0]},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success:function (data)
                                            {
                                                $('#Site').val('');
                                                document.querySelector("#updatebutton5").classList.add("diableddeletedbutton");
                                                document.getElementById('Websites').options[document.getElementById('Websites').selectedIndex].remove();
                                                $('#dont_select_Websites').prop('selected', true);
                                                //$('#routes_id').val('0');
                                                alert('Удалено');
                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };

                                </script>

                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">Изменить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
$(document).ready(function(){
    
    chenge_ubdate_button(document.getElementById('Address'), 'updatebutton2');
    chenge_ubdate_button(document.getElementById('Phone_Number'), 'updatebutton3'); 
    chenge_ubdate_button(document.getElementById('Email'), 'updatebutton4'); 
    chenge_ubdate_button(document.getElementById('Websites'), 'updatebutton5'); 
});

        function chenge_ubdate_button(celect, button_select) {
                    if ($(celect).val().length > 1) {
                        document.querySelector("#" + button_select).classList.add("diableddeletedbutton");
                        document.querySelector("#div_" + button_select).title = "Для редактирования, пожалуйста выберете одну запись";
                    }  else if ($(celect).val() == "null") {
                        document.querySelector("#" + button_select).classList.add("diableddeletedbutton");
                        document.querySelector("#div_" + button_select).title = "Выберете пожалуйста другую запись!";
                    } else {
                        document.querySelector("#" + button_select).classList.remove("diableddeletedbutton");
                        document.querySelector("#div_" + button_select).title = "";
                    }
                }
            
        function cislo(){
            if (event.keyCode < 48 || event.keyCode > 57)
                event.returnValue= false;
        }

        // var file = document.getElementById('Conract_Partners');

        // file.onchange = function(e) {
        //     var ext = this.value.match(/\.([^\.]+)$/)[1];
        //     switch (ext) {
        //         case 'jpg':
        //         case 'bmp':
        //         case 'png':
        //         case 'tif':
        //             alert('Allowed');
        //             break;
        //         default:
        //             alert('Not allowed');
        //             this.value = '';
        //     }
        // };


</script>

@endsection