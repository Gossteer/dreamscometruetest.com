@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" action="{{ route('partners.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Name_Partners">Наименование <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control @error('Name_Partners') is-invalid @enderror"  name="Name_Partners" placeholder="Наименование" required>
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
                                        <input type="text" class="form-control @error('INN') is-invalid @enderror" onKeyPress="cislo()" maxlength="191"  name="INN" placeholder="ИНН">
                                        @error('Name_Partners')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="select_type_activitie">Тип деятельности</label>
                                    <div class="col-lg-6 input-group">
                                        <select class="custom-select @error('select_type_activitie') is-invalid @enderror" id="select_type_activitie" name="select_type_activitie" required>
                                            <option value="" disabled selected hidden>Тип занятости</option>
                                            @foreach($type_activities as $type_activitie)
                                            <option value="{{$type_activitie->id}}" id="{{$type_activitie->id}}">{{$type_activitie->Name_Type_Activity}}</option>
                                                @endforeach
                                        </select>
                                        @error('select_type_activitie')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="input-group-append">
                                            <a  data-toggle="modal" data-target="#addArticle" class="btn input-group-text selectedbutton" style="color: #495057;" >Создать</a>
                                        </div>
                                        <div class="input-group-append">
                                            <a class="btn input-group-text selectedbutton diableddeletedbutton" id="deletedbutton" style="" name="deletedbutton"  >Удалить</a>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(function() {
                                        $('#select_type_activitie').change(function(select_type_activitie) {
                                            // если значение не равно пустой строке
                                            var deletedbutton = document.querySelector("#deletedbutton")
                                            if($('#select_type_activitie').val() == "0") {
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
                                                    var str = '<option value="'+data['id']+'" selected>'+data['Name_Type_Activity']+'</option>';
                                                    $('#select_type_activitie:last').append(str);
                                                    alert('Добавлено');
                                                    document.querySelector("#deletedbutton").classList.remove("diableddeletedbutton");
                                                },
                                                error: function (msg) {
                                                    alert('Ошибка: заполните обязательные для ввода поля или данная запись уже существует.');
                                                }
                                            });
                                        });
                                        $('#deletedbutton').on('click',function(){
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
                                                    var str;

                                                    datas.forEach(function(data){
                                                        str += '<option value="'+data['id']+'" selected>'+data['Name_Type_Activity']+'</option>';
                                                    });
                                                    $('#select_type_activitie option').remove();
                                                    $('#select_type_activitie:last').append(str);
                                                    alert('Удалено');

                                                },
                                                error: function (msg) {
                                                    alert('Ошибка');
                                                }
                                            });
                                        });
                                    })
                                </script>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Conract_Partners">Договор</label>
                                    <div class="col-lg-6">
                                            <div class="custom-file">
                                                <input type="file" name="Conract_Partners" accept=".txt,.pdf,.docx,.docm,.doc,.xls,.xml,.xlsx,.xlsm" onchange="
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
                                <div id="address_place" >
                                    <template class=""   id="address-template"  v-for="(n, index) in address_place" >
                                <div class="form-group row" :key='n' >
                                    <label class="col-lg-4 col-form-label" for="Address">Адрес @{{ index + 1 }}</label>
                                    <div name='bounce' class="col-lg-6">
                                            <div >
                                                <div class="row justify-content-end">
                                                    <a @click="remove(n)" style="position: absolute;" ><span  class="col-4 fa fa-close color-danger " style="cursor: pointer; margin-right: 5px"></span></a>
                                                </div>
                                                <input type="text" class="form-control @error('Address') is-invalid @enderror" style="margin-bottom: 10px"  maxlength="191"   :id="n"  name="Address[]" placeholder="Адрес" required>
                                                @error('Address')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                    </div>
                                </div>
                                    </template>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" ></label>
                                        <div   name='bounce' class="col-lg-6">
                                            <a @click="add"  class="btn btn-primary col-lg-12"  style="color: #fff;">Добавить адрес</a>
                                        </div>
                                    </div>
                                </div>

                                <div id="phone_number">
                                <template id="phone-template"  v-for="(nn, index) in phone_numbers" >
                                <div class="form-group row" :key='nn'>
                                    <label class="col-lg-4 col-form-label" for="Phone_Number">Телефон @{{  index + 1 }}</label>
                                    <div   name='bounce' class="col-lg-6">
                                                <div class="row justify-content-end">
                                                    <a @click="remove(nn)" style="position: absolute;" ><span  class="col-4 fa fa-close color-danger " style="cursor: pointer; margin-right: 5px"></span></a>
                                                </div>
                                                <input type="text" class="form-control @error('Phone_Number') is-invalid @enderror" style="margin-bottom: 10px" :id="n"  maxlength="191"  name="Phone_Number[]" id="Phone_Number" placeholder="Телефонный номер" required>
                                                @error('Phone_Number')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <input type="text" class="form-control @error('Representative') is-invalid @enderror" style="margin-bottom: 10px"  maxlength="191" :id="n"  name="Representative[]" placeholder="Представитель" >
                                                @error('Representative')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                    </div>
                                </div>
                                    <script>
                                        $(function() {
                                            $("#Phone_Number").mask("+7 (999) 999-99-99");
                                        });
                                    </script>
                                </template>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" ></label>
                                        <div   name='bounce' class="col-lg-6">
                                            <a @click="add"  class="btn btn-primary col-lg-12"  style="color: #fff;">Добавить телефон</a>
                                        </div>
                                    </div>
                                </div>
                                <div id="email">
                                <template id="address-template"  v-for="(nn, index) in emails" >
                                <div class="form-group row" :key='nn'>
                                    <label class="col-lg-4 col-form-label" for="Email">Почта @{{ index + 1 }}</label>
                                    <div name='bounce' class="col-lg-6">
                                                <div class="row justify-content-end">
                                                    <a @click="remove(nn)" style="position: absolute;" ><span  class="col-4 fa fa-close color-danger " style="cursor: pointer; margin-right: 5px"></span></a>
                                                </div>
                                                <input type="email" class="form-control @error('Email') is-invalid @enderror" style="margin-bottom: 10px"  maxlength="191"  :id="n" name="Email[]" placeholder="Email" required>
                                                @error('Email')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <input type="text" class="form-control @error('Representative_Email') is-invalid @enderror" style="margin-bottom: 10px"  maxlength="191" :id="n" name="Representative_Email[]" placeholder="Представитель">
                                                @error('Representative_Email')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                    </div>
                                </div>
                                </template>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" ></label>
                                    <div   name='bounce' class="col-lg-6">
                                        <a @click="add"  class="btn btn-primary col-lg-12"  style="color: #fff;">Добавить Email</a>
                                    </div>
                                </div>
                                </div>
                                <div id="site">
                                <template class="" v-for="(n, index) in sites" >
                                <div class="form-group row" :key='n'>
                                    <label class="col-lg-4 col-form-label" for="Site">Сайт @{{ index + 1 }}</label>
                                    <div id="site"  name='bounce' class="col-lg-6">
                                                <div class="row justify-content-end">
                                                    <a @click="remove(n)" style="position: absolute;" ><span  class="col-4 fa fa-close color-danger " style="cursor: pointer; margin-right: 5px"></span></a>
                                                </div>
                                                <input type="text" class="form-control @error('Site') is-invalid @enderror" style="margin-bottom: 10px"  maxlength="191" :id="n"  name="Site[]" placeholder="Сайт" required>
                                                @error('Site')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                    </div>
                                </div>
                                </template>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" ></label>
                                    <div   name='bounce' class="col-lg-6">
                                        <a @click="add"  class="btn btn-primary col-lg-12"  style="color: #fff;">Добавить Сайт</a>
                                    </div>
                                </div>
                                </div>

                                <script>

                                        var o=0;
                                        new Vue({
                                            el: '#address_place',
                                            data: {
                                                count: 0,
                                                address_place: []
                                            },
                                            methods: {
                                                add() {
                                                    this.address_place.push(o++)
                                                },
                                                remove(n) {
                                                    let index = this.address_place.indexOf(n);
                                                    this.address_place.splice(index, 1);
                                                }
                                            }
                                        });

                                        new Vue({
                                            el: '#phone_number',
                                            data: {
                                                phone_numbers: []
                                            },
                                            methods: {
                                                add() {
                                                    this.phone_numbers.push(o++)

                                                },
                                                remove(nn) {
                                                    let index = this.phone_numbers.indexOf(nn);
                                                    this.phone_numbers.splice(index, 1);
                                                },
                                                asdada(){

                                                }
                                            }
                                        });

                                        new Vue({
                                            el: '#email',
                                            data: {
                                                emails: []
                                            },
                                            methods: {
                                                add() {
                                                    this.emails.push(o++)
                                                },
                                                remove(nn) {
                                                    let index = this.emails.indexOf(nn);
                                                    this.emails.splice(index, 1);
                                                }
                                            }
                                        });

                                        new Vue({
                                            el: '#site',
                                            data: {
                                                sites: []
                                            },
                                            methods: {
                                                add() {
                                                    this.sites.push(o++)
                                                },
                                                remove(nn) {
                                                    let index = this.sites.indexOf(nn);
                                                    this.sites.splice(index, 1);
                                                }
                                            }
                                        });

                                        function cislo(){
                                            if (event.keyCode < 48 || event.keyCode > 57)
                                                event.returnValue= false;
                                        }

                                        var file = document.getElementById('Conract_Partners');

                                        file.onchange = function(e) {
                                            var ext = this.value.match(/\.([^\.]+)$/)[1];
                                            switch (ext) {
                                                case 'jpg':
                                                case 'bmp':
                                                case 'png':
                                                case 'tif':
                                                    alert('Allowed');
                                                    break;
                                                default:
                                                    alert('Not allowed');
                                                    this.value = '';
                                            }
                                        };
                                </script>



                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">Создать</button>
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