@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" action="{{route('tours.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Name_Tours" >Название<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input id="login" type="text" class="form-control @error('Name_Tours') is-invalid @enderror" name="Name_Tours" minlength="2" maxlength="20" value="{{ old('Name_Tours') }}" required  placeholder="Название">
                                        @error('Name_Tours')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="type_tours_id" >Тип экскурсии<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 input-group">
                                        <select class="custom-select @error('jobs_id') is-invalid @enderror" id="type_tours_id" name="type_tours_id" required>
                                            <option value="0" disabled selected hidden>Тип экскурсии</option>
                                            @foreach($type_tours as $type_tour)
                                                <option value="{{ $type_tour->id }}" id="{{ $type_tour->id }}" @if(old('type_tours_id') == $type_tour->id) selected @endif>{{$type_tour->Name_Type_Tours}}</option>
                                            @endforeach
                                        </select>
                                        @error('type_tours_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="input-group-append">
                                            <a  data-toggle="modal" data-target="#addArticle" class="btn input-group-text selectedbutton" style="color: #495057;" title="Добавить"><i class="fa fa-plus-circle color-muted m-r-5"></i></a>
                                        </div>
                                        <div class="input-group-append">
                                            <a class="btn input-group-text selectedbutton diableddeletedbutton" data-toggle="modal" data-target="#addArticle1" id="updatebutton" style="" name="updatebutton" title="Изменить"><i class="fa fa-pencil color-danger"></i></a>
                                        </div>
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
                                                    <label for="Name_Type_Tours1">Название<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('Name_Type_Tours1') is-invalid @enderror" id="Name_Type_Tours1" minlength="2" maxlength="191" name="Name_Type_Tours1" placeholder="Название">
                                                    @error('Name_Type_Tours1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" id="delete" name="delete" data-dismiss="modal">Удалить</button>
                                                <button type="button" id="ubdate" name="ubdate" class="btn btn-primary">Изменить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="addArticle" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addArticleLabel">Добавление типа экскурсии</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="Job_Title">Названиея<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('Name_Type_Tours') is-invalid @enderror" minlength="2" maxlength="191" name="Name_Type_Tours" id="Name_Type_Tours" placeholder="Название">
                                                    @error('Name_Type_Tours')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" id="close" name="close" data-dismiss="modal">Закрыть</button>
                                                <button type="button" id="save" name="save" class="btn btn-primary">Сохранить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(function() {

                                        $('#type_tours_id').change(function(type_tours_id) {
                                            // если значение не равно пустой строке
                                            var updatebutton = document.querySelector("#updatebutton")
                                            if($('#type_tours_id').val() == "0") {
                                                updatebutton.classList.add("diableddeletedbutton");
                                            } else {
                                                updatebutton.classList.remove("diableddeletedbutton");
                                            }
                                        });

                                        $("#save").on('click',function(){
                                            var Name_Type_Tours = $('#Name_Type_Tours').val();
                                            $.ajax({
                                                url: '{{ route('typetour.store') }}',
                                                type: "POST",
                                                data: {Name_Type_Tours:Name_Type_Tours},
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success: function (data) {
                                                    $('#Name_Type_Tours').val(' ');
                                                    $('#addArticle').modal('hide');
                                                    $('#articles-wrap').removeClass('hidden').addClass('show');
                                                    $('.alert').removeClass('show').addClass('hidden');
                                                    var str = '<option value="'+data['id']+'" selected>'+data['Name_Type_Tours']+'</option>';
                                                    $('#type_tours_id:last').append(str);
                                                    document.querySelector("#updatebutton").classList.remove("diableddeletedbutton");
                                                    alert('Добавлено');
                                                },
                                                error: function (msg) {
                                                    alert('Ошибка: заполните обязательные для ввода поля или данная запись уже существует.');
                                                }
                                            });
                                        });

                                        $('#updatebutton').on('click',function(){
                                            var typetourid = $('#type_tours_id').val();

                                            $.ajax({
                                                url: "{{route('typetour.index')}}",
                                                type: "POST",
                                                data: {typetourid:typetourid},
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success:function (data)
                                                {
                                                    $('#Name_Type_Tours1').val(data['Name_Type_Tours']);
                                                },
                                                error: function (msg) {
                                                    alert('Ошибка');
                                                }
                                            });
                                        });

                                        $('#ubdate').on('click',function(){
                                            var typetourid = $('#type_tours_id').val();
                                            var Name_Type_Tours = $('#Name_Type_Tours1').val();

                                            $.ajax({
                                                url: "{{route('typetour.update')}}",
                                                type: "POST",
                                                data: {typetourid:typetourid,Name_Type_Tours:Name_Type_Tours},
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success:function (datas)
                                                {
                                                    $('#addArticle1').modal('hide');
                                                    $('#articles-wrap').removeClass('hidden').addClass('show');
                                                    $('.alert').removeClass('show').addClass('hidden');
                                                    var str;
                                                    datas.forEach(function(data){
                                                        str += '<option value="'+data['id']+'" '+((data['id'] == typetourid) ? 'selected' : '')+'>'+data['Name_Type_Tours']+'</option>';
                                                    });
                                                    $('#type_tours_id option').remove();
                                                    $('#type_tours_id:last').append(str);
                                                    alert('Изменено');
                                                },
                                                error: function (msg) {
                                                    alert('Ошибка: заполните обязательные для ввода поля или данная запись уже существует.');
                                                }
                                            });
                                        });

                                        $('#delete').on('click',function(){
                                            var typetourid = $('#type_tours_id').val();

                                            $.ajax({
                                                url: "{{route('typetour.destroy')}}",
                                                type: "POST",
                                                data: {typetourid:typetourid},
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success:function (datas)
                                                {
                                                    type_tours_id.removeChild(type_tours_id.querySelector('[value="'+ typetourid +'"]'));
                                                    type_tours_id.value = 0;
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
                                    <label class="col-lg-4 col-form-label" for="Start_Date_Tours" >Отправление<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input  type="text" class="form-control @error('Start_Date_Tours') is-invalid @enderror" id="Start_Date_Tours" name="Start_Date_Tours" value="{{ old('Start_Date_Tours') }}" placeholder="Отправление" required>
                                        @error('Start_Date_Tours')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="End_Date_Tours" >Возвращение</label>
                                    <div class="col-lg-6">
                                        <input  type="text" class="form-control @error('End_Date_Tours') is-invalid @enderror" id="End_Date_Tours" name="End_Date_Tours" value="{{ old('End_Date_Tours') }}" placeholder="Возвращение">
                                        @error('End_Date_Tours')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <script>
                                    $(function() {
                                        $("#Start_Date_Tours").mask("99-99-9999 99:99");
                                        $("#End_Date_Tours").mask("99-99-9999 99:99");
                                    });
                                </script>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Assessment" >Оценка</label>
                                    <div class="col-lg-6">
                                        <input  type="number" class="form-control @error('Assessment') is-invalid @enderror" min="0" max="10" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;" value="{{ old('Assessment') }}" name="Assessment" id="Assessment" placeholder="Оценка">
                                        @error('Assessment')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Price" >Цена<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input  type="number" class="form-control @error('Price') is-invalid @enderror" min="0" max="8388607" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==7) return false;" value="{{ old('Price') }}" name="Price" id="Price" placeholder="Цена" required>
                                        @error('Price')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Children_price" >Привилегированная цена</label>
                                    <div class="col-lg-6">
                                        <input  type="number" class="form-control @error('Privilegens_Price') is-invalid @enderror" min="0" max="8388607" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==7) return false;" value="{{ old('Privilegens_Price') }}" name="Privilegens_Price" id="Privilegens_Price" placeholder="Привилегированная цена">
                                        @error('Privilegens_Price')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Children_price" >Цена для детей</label>
                                    <div class="col-lg-6">
                                        <input  type="number" class="form-control @error('Children_price') is-invalid @enderror" min="0" max="8388607" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==7) return false;" value="{{ old('Children_price') }}" name="Children_price" id="Children_price" placeholder="Цена для детей">
                                        @error('Children_price')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Expenses" >Затраты<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input  type="number" class="form-control @error('Expenses') is-invalid @enderror" min="0" max="2147483647" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" value="{{ old('Expenses') }}" name="Expenses" id="Expenses" placeholder="Затраты" required>
                                        @error('Expenses')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Amount_Place" >Количество мест<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input  type="number" class="form-control @error('Amount_Place') is-invalid @enderror" min="0" max="8388607" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==7) return false;" value="{{ old('Amount_Place') }}" name="Amount_Place" id="Amount_Place" placeholder="Количество мест" required>
                                        @error('Amount_Place')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Description" >Описание</label>
                                    <div class="col-lg-6">
                                        <textarea  type="text" class="form-control @error('Description') is-invalid @enderror" name="Description" id="Description" placeholder="Описание">{{ old('Description') }}</textarea>
                                        @error('Description')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Notification_OPDA">Уведомление об ОПДА</label>
                                    <div class="col-lg-6">
                                        <div class="custom-file">
                                            <input type="file" name="Notification_OPDA" accept=".txt,.pdf,.docx,.docm,.doc,.xls,.xml,.xlsx,.xlsm" onchange="
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
                                            <label id="Fille_Conract_Partners" for="Notification_OPDA" class="custom-file-label">Файл не выбран</label>
                                        </div>
                                        @error('Notification_OPDA')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Seating" >Рассадка<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <select class="custom-select mr-sm-2" id="Seating" name="Seating" required>
                                            <option value="" disabled selected hidden>Есть?</option>
                                            <option value="0" @if(old('Seating') == 0) selected @endif>Нет</option>
                                            <option value="1" @if(old('Seating') == 1) selected @endif>Да</option>
                                        </select>
                                        @error('Seating')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Popular" >Популярные</label>
                                    <div class="col-lg-6">
                                        <select class="custom-select mr-sm-2" id="Popular" name="Popular">
                                            <option value="" disabled selected hidden>Популярные?</option>
                                            <option value="0" @if(old('Popular') == 0) selected @endif>Нет</option>
                                            <option value="1" @if(old('Popular') == 1) selected @endif>Да</option>
                                        </select>
                                        @error('Popular')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
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
