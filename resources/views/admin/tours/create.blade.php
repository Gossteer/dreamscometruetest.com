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
                                        <input id="login" type="text" class="form-control @error('Name_Tours') is-invalid @enderror" name="Name_Tours" minlength="2" maxlength="50" value="{{ old('Name_Tours') }}" required  placeholder="Название">
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
                                        <select class="form-control @error('type_tours_id') is-invalid @enderror" multiple id="type_tours_id" onchange="chenge_ubdate_button(this, 'updatebutton')" name="type_tours_id[]" required>
                                             @foreach($type_tours as $type_tour)
                                                <option  value="{{ $type_tour->id }}" id="{{ $type_tour->id }}" @if(old('type_tours_id') == $type_tour->id) selected @endif>{{$type_tour->Name_Type_Tours}}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a  data-toggle="modal" data-target="#addArticle" class="btn input-group-text selectedbutton" style="color: #495057;" title="Добавить"><i class="fa fa-plus-circle color-muted m-r-5"></i></a>
                                        </div>
                                        <div class="input-group-append" id="div_updatebutton">
                                            <a class="btn input-group-text selectedbutton diableddeletedbutton" data-toggle="modal" data-target="#addArticle1" id="updatebutton" style="" name="updatebutton" title="Изменить"><i class="fa fa-pencil color-danger"></i></a>
                                        </div>
                                        @error('type_tours_id')
                                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <script>

                                    onmousedown="this.selected = false ? this.selected = true : this.selected = false"

                                    function lol228(lol) {
                                        if (lol.selected = true){
                                            $(this).prop('selected', false);
                                        }
                                    }
                                </script> --}}
                                {{-- <script>

                                    new SlimSelect({
                                        select: '#type_tours_id',
                                        css: ''
                                    })

                                </script> --}}
                                
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
                                                <button type="button" class="btn btn-default" id="delete_type" name="delete_type" data-dismiss="modal">Удалить</button>
                                                <button type="button" id="ubdate_type" name="ubdate_type" class="btn btn-primary">Изменить</button>
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
                                                <button type="button" id="save_type" name="save_type" class="btn btn-primary">Сохранить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(function() {

                                        // $('#type_tours_id').change(function(type_tours_id) {
                                        //     // если значение не равно пустой строке
                                        //     var updatebutton = document.querySelector("#updatebutton")
                                        //     if($('#type_tours_id').val() == "0") {
                                        //         updatebutton.classList.add("diableddeletedbutton");
                                        //     } else {
                                        //         updatebutton.classList.remove("diableddeletedbutton");
                                        //     }
                                        // });

                                        $("#save_type").on('click',function(){
                                            var Name_Type_Tours = $('#Name_Type_Tours').val();
                                            $.ajax({
                                                url: '{{ route('typetour.store') }}',
                                                type: "POST",
                                                data: {Name_Type_Tours:Name_Type_Tours},
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success: function (data) {
                                                    $('#addArticle').modal('hide');
                                                    $('#articles-wrap').removeClass('hidden').addClass('show');
                                                    $('.alert').removeClass('show').addClass('hidden');
                                                    $('#Name_Type_Tours').val('');
                                                    var str = '<option value="'+data['id']+'" selected>'+data['Name_Type_Tours']+'</option>';
                                                    $('#type_tours_id:last').append(str);
                                                    //document.querySelector("#updatebutton").classList.remove("diableddeletedbutton");
                                                    chenge_ubdate_button($('#type_tours_id'), 'updatebutton')
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
                                                data: {typetourid:typetourid[0]},
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

                                        $('#ubdate_type').on('click',function(){
                                            var typetourid = $('#type_tours_id').val();
                                            var Name_Type_Tours = $('#Name_Type_Tours1').val();

                                            $.ajax({
                                                url: "{{route('typetour.update')}}",
                                                type: "POST",
                                                data: {typetourid:typetourid[0],Name_Type_Tours:Name_Type_Tours},
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success:function (data)
                                                {
                                                    $('#addArticle1').modal('hide');
                                                    $('#articles-wrap').removeClass('hidden').addClass('show');
                                                    $('.alert').removeClass('show').addClass('hidden');
                                                    document.getElementById('type_tours_id').options[document.getElementById('type_tours_id').selectedIndex].text = data['Name_Type_Tours'];
                                                    document.getElementById('type_tours_id').options[document.getElementById('type_tours_id').selectedIndex].id = data['id'];
                                                    document.getElementById('type_tours_id').options[document.getElementById('type_tours_id').selectedIndex].value = data['id'];
                                                    alert('Изменено');
                                                },
                                                error: function (msg) {
                                                    alert('Ошибка: заполните обязательные для ввода поля или данная запись уже существует.');
                                                }
                                            });
                                        });

                                        $('#delete_type').on('click',function(){
                                            var typetourid = $('#type_tours_id').val();

                                            $.ajax({
                                                url: "{{route('typetour.destroy')}}",
                                                type: "POST",
                                                data: {typetourid:typetourid[0], tour_id:null},
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success:function (datas)
                                                {
                                                    document.querySelector("#updatebutton").classList.add("diableddeletedbutton");
                                                    document.getElementById('type_tours_id').options[document.getElementById('type_tours_id').selectedIndex].remove();
                                                    //type_tours_id.value = 0;
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
                                    <label class="col-lg-4 col-form-label" for="buses_id" >Транспорт</label>
                                    <div class="col-lg-6 input-group">
                                        <select class="custom-select @error('buses_id') is-invalid @enderror" id="buses_id" onchange="chenge_ubdate_button(this, 'updatebutton2'), chenge_Main_Transport(this)" multiple name="buses_id[]">
                                            <option value="null" id="dont_select_bus" selected @if($buses_ids->count() == 0) hidden @endif>Без выбора</option>
                                            @foreach($buses_ids as $buses_id)
                                                <option title="{{ $buses_id->Description }}" data-amountplace="{{ $buses_id->Amount_Place_Bus }}"  value="{{ $buses_id->id }}" id="{{ $buses_id->id }}" @if(old('buses_id') == $buses_id->id) selected @endif>{{ $buses_id->Type_Transport . ' ' . $buses_id->Title_Transport . ' ' .   $buses_id->Amount_Place_Bus . 'м '}} @if(($buses_id->Type_Transport == 'Автобус' or $buses_id->Type_Transport == 'Микроавтобус') and $buses_id->employee != null) {{date('d.m.Y', strtotime($buses_id->Year_Issue)) . ' ' . $buses_id->employee->Surname . ' ' . mb_substr($buses_id->employee->Name, 0, 1)  . '. ' . mb_substr($buses_id->employee->Middle_Name, 0, 1) . ($buses_id->employee->Middle_Name != '' ? '.' : '')}} @endif</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a  data-toggle="modal" data-target="#addArticle2" class="btn input-group-text selectedbutton" onclick="close_chenge_tour_bus()" style="color: #495057;" title="Добавить"><i class="fa fa-plus-circle color-muted m-r-5"></i></a>
                                        </div>
                                        <div class="input-group-append"  id="div_updatebutton2">
                                            <a class="btn input-group-text selectedbutton diableddeletedbutton " data-toggle="modal" data-target="#addArticle2" id="updatebutton2" style="" name="updatebutton2"  onclick="index_tour_bus()" title="Изменить"><i class="fa fa-pencil color-danger"></i></a>
                                        </div>
                                        @error('buses_id')
                                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        @error('bus_Main_Transort')
                                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <input type="number" hidden id="bus_Main_Transort" name="bus_Main_Transort" data-idi="" data-amountplace="0"  title="" value="">

                                <div class="modal fade" id="addArticle2" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addArticleLabel">Транспорт</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group" >
                                                    <label for="Type_Transport">Тип транспорта<span class="text-danger">*</span></label>
                                                    <select onchange="Set_Trnaport_hidden_Shenge(this.value)" class="custom-select @error('Type_Transport') is-invalid @enderror" id="Type_Transport" name="Type_Transport" >
                                                        <option value="0" disabled selected hidden>Тип транспорта</option>
                                                        <option value="Водное судно" id="1">Водное судно</option>
                                                        <option value="Возднушное судно" id="2">Воздушное судно</option>
                                                        <option value="Железная дорога" id="3">Железная дорога</option>
                                                        <option value="Автобус" id="4">Автобус</option>
                                                        <option value="Микроавтобус" id="5">Микроавтобус</option>
                                                        <option value="Другой..." id="6">Другой...</option>
                                                    </select>
                                                    @error('Type_Transport')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group"  id="Title_Transport_div" hidden>
                                                    <label for="Title_Transport">Название<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('Title_Transport') is-invalid @enderror" minlength="2" maxlength="100" onKeyPress="if(this.value.length==100) return false;" name="Title_Transport" id="Title_Transport" placeholder="Название">
                                                    @error('Title_Transport')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group"  id="Description_Transport_div" hidden>
                                                    <label for="Description_Transport">Описание</label>
                                                    <textarea  class="form-control @error('Description_Transport') is-invalid @enderror" minlength="2" name="Description_Transport" id="Description_Transport" placeholder="Описание"></textarea>
                                                    @error('Description_Transport')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group"  id="Company_div" hidden>
                                                    <label for="Company">Компания</label>
                                                    <input type="text" class="form-control @error('Company') is-invalid @enderror" minlength="2" maxlength="100" onKeyPress="if(this.value.length==100) return false;" name="Company" id="Company" placeholder="Компания">
                                                    @error('Company')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group"  id="Classes_div" hidden>
                                                    <label for="Classes">Классы</label>
                                                    <input type="text" class="form-control @error('Classes') is-invalid @enderror" minlength="2" maxlength="100" onKeyPress="if(this.value.length==100) return false;" name="Classes" id="Classes" placeholder="Люкс; Эконом;...">
                                                    @error('Classes')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group" id="State_Registration_Number_div" hidden>
                                                    <label for="State_Registration_Number">ГРНТС<span class="text-danger">*</span></label>
                                                    <input title="Государственный регистрационный номер транспортного средства" type="text" class="form-control @error('State_Registration_Number') is-invalid @enderror" minlength="2" maxlength="14" onKeyPress="if(this.value.length==14) return false;" name="State_Registration_Number" id="State_Registration_Number" placeholder="ГРНТС">
                                                    @error('State_Registration_Number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group" id="Year_Issue_div" hidden>
                                                    <label for="Year_Issue">Год выпуска<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('Year_Issue') is-invalid @enderror"  name="Year_Issue" id="Year_Issue" placeholder="Год выпуска">
                                                    @error('Year_Issue')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <script>
                                                    $(function() {
                                                        $("#Year_Issue").mask("99-99-9999");
                                                        $("#Validity_Date").mask("99-99-9999");
                                                    });
                                                </script>
                                                <div class="form-group"  id="Diagnostic_card_div" hidden>
                                                    <label for="Diagnostic_card">Регистрационный номер<span class="text-danger">*</span></label>
                                                    <input title="Из диагностической карты" type="text" class="form-control @error('Diagnostic_card') is-invalid @enderror" minlength="2" maxlength="16" name="Diagnostic_card" id="Diagnostic_card" placeholder="Номер">
                                                    @error('Diagnostic_card')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group" id="Validity_Date_div" hidden>
                                                    <label for="Validity_Date">Срок действия<span class="text-danger">*</span></label>
                                                    <input title="Диагностическая карта годна до:" type="text" class="form-control @error('Validity_Date') is-invalid @enderror"  name="Validity_Date" id="Validity_Date" placeholder="Годен до:">
                                                    @error('Validity_Date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group" id="Amount_Place_Bus_div" hidden> 
                                                    <label for="Amount_Place_Bus">Вместимость<span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control @error('Amount_Place_Bus') is-invalid @enderror" min="0" max="1000" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" name="Amount_Place_Bus" id="Amount_Place_Bus" placeholder="Количество мест">
                                                    @error('Amount_Place_Bus')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group" id="employee_id_div" hidden>
                                                    <label for="employee_id">Водитель</label>
                                                    <select class="custom-select @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id" >
                                                        <option value="0" disabled selected hidden>Водитель</option>
                                                        @foreach(\App\Employee::all() as $employee_bus)
                                                            @if($employee_bus->jobs_id != null && isset($employee_bus->job))
                                                                @if(mb_strtolower($employee_bus->job->Job_Title) == 'водитель' || mb_strtolower($employee_bus->job->Job_Title) == 'шофёр')
                                                                    <option title="{{ $employee_bus->Surname . ' ' . $employee_bus->Name  . ' ' . $employee_bus->Middle_Name}}" value="{{ $employee_bus->id }}" id="{{ $employee_bus->id }}">{{ $employee_bus->Surname . ' ' . mb_substr($employee_bus->Name, 0, 1)  . '. ' . mb_substr($employee_bus->Middle_Name, 0, 1) . ($employee_bus->Middle_Name != '' ? '.' : '')}}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('employee_id')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group" id="Tachograph_div" hidden>
                                                    <label for="Tachograph">Тахограф</label>
                                                    <input class="form-check-input" type="checkbox" id="Tachograph" name="Tachograph" style="margin-left: 5px !important; border: 1px solid #ced4da;" value="1" >
                                                    @error('Tachograph')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group" id="Glonas_GPS_div" hidden>
                                                    <label for="Glonas_GPS">ГЛОНАСС/GPS</label>
                                                    <input class="form-check-input" type="checkbox" id="Glonas_GPS" name="Glonas_GPS" style="margin-left: 5px !important; border: 1px solid #ced4da;" value="1" >
                                                    @error('Glonas_GPS')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group" id="Main_Transort_div" hidden>
                                                    <label for="Main_Transort">Основной</label>
                                                    <input class="form-check-input" type="checkbox" id="Main_Transort" name="Main_Transort" style="margin-left: 5px !important; border: 1px solid #ced4da;" value="1" >
                                                    @error('Main_Transort')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="close2" class="btn btn-default" onclick="close_chenge_tour_bus()"  data-dismiss="modal">Закрыть</button>
                                                <button type="button" id="save2" onclick="create_tour_bus()" class="btn btn-primary">Добавить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    // $(function() {

                                    //     $('#buses_id').change(function(buses_id) {
                                    //         // если значение не равно пустой строке
                                    //         var updatebutton2 = document.querySelector("#updatebutton")
                                    //         if($('#buses_id').val() == "0") {
                                    //             updatebutton2.classList.add("diableddeletedbutton");
                                    //         } else {
                                    //             updatebutton2.classList.remove("diableddeletedbutton");
                                    //         }
                                    //     });
                                    // });
                                    function chenge_Main_Transport(value){
                                        var buses_id = $( "#buses_id" ).val() || [];
                                        if (!buses_id.includes(bus_Main_Transort.dataset.idi)) {
                                            document.getElementById('bus_Main_Transort').dataset.amountplace = 0;
                                            document.getElementById('bus_Main_Transort').value = "0";
                                            $('#bus_Main_Transort').prop('title', '');
                                        } else{
                                            //$( "#buses_id" )toArray().map(item => item.text).join();
                                            document.getElementById('bus_Main_Transort').dataset.amountplace = $("#buses_id :selected").map(function(i, el) {if(bus_Main_Transort.dataset.idi == el.value){return el.dataset.amountplace;}}).get();
                                            document.getElementById('bus_Main_Transort').value = bus_Main_Transort.dataset.idi;
                                            $('#bus_Main_Transort').prop('title',  $("#buses_id :selected").map(function(i, el) { if(bus_Main_Transort.dataset.idi == el.value){return el.text;}  }).get());
                                        }
                                    };

                                    function Hidden_All_Transport(){
                                        Description_Transport_div.hidden = true;
                                        Title_Transport_div.hidden = true;
                                        Main_Transort_div.hidden = true;
                                        Amount_Place_Bus_div.hidden = true;
                                        employee_id_div.hidden = true;
                                            State_Registration_Number_div.hidden = true;
                                            Year_Issue_div.hidden = true;
                                            Diagnostic_card_div.hidden = true;
                                            Validity_Date_div.hidden = true;
                                            Tachograph_div.hidden = true;
                                            Glonas_GPS_div.hidden = true;
                                            Company_div.hidden = true;
                                            Classes_div.hidden = true;
                                    };
                                    function Set_Trnaport_hidden_Shenge(value){
                                        Description_Transport_div.hidden = false;
                                        Title_Transport_div.hidden = false;
                                        Main_Transort_div.hidden = false;
                                        Amount_Place_Bus_div.hidden = false;

                                        if(value == 'Автобус' || value == 'Микроавтобус'){
                                            Company_div.hidden = true;
                                            Classes_div.hidden = true;
                                            Company.value = '';
                                            Classes.value = '';

                                            Title_Transport.placeholder = 'Марка';
                                            State_Registration_Number_div.hidden = false;
                                            Year_Issue_div.hidden = false;
                                            Diagnostic_card_div.hidden = false;
                                            Validity_Date_div.hidden = false;
                                            Tachograph_div.hidden = false;
                                            Glonas_GPS_div.hidden = false;
                                            employee_id_div.hidden = false;
                                        }
                                        else{
                                            employee_id_div.hidden = true;
                                            State_Registration_Number_div.hidden = true;
                                            Year_Issue_div.hidden = true;
                                            Diagnostic_card_div.hidden = true;
                                            Validity_Date_div.hidden = true;
                                            Tachograph_div.hidden = true;
                                            Glonas_GPS_div.hidden = true;
                                            State_Registration_Number.value = '';
                                            Year_Issue.value = '';
                                            Diagnostic_card.value = '';
                                            Validity_Date.value = '';
                                            Tachograph.checked = false;
                                            Glonas_GPS.checked = false;

                                            Company_div.hidden = false;
                                            Classes_div.hidden = false;
                                            Title_Transport.placeholder = 'Название';
                                        }
                                    };
                                    
                                    function create_tour_bus() {
                                        var Title_Transport = $('#Title_Transport').val();
                                        var State_Registration_Number = $('#State_Registration_Number').val();
                                        var Description = $('#Description_Transport').val();
                                        var Company = $('#Company').val();
                                        var Classes = $('#Classes').val();
                                        var Type_Transport = $('#Type_Transport').val();
                                        var Year_Issue = $('#Year_Issue').val();
                                        var Diagnostic_card = $('#Diagnostic_card').val();
                                        var Validity_Date = $('#Validity_Date').val();
                                        var Amount_Place_Bus = $('#Amount_Place_Bus').val();
                                        var employee_id = $('#employee_id').val();
                                        if ($('#Glonas_GPS').prop('checked'))
                                            var Glonas_GPS = 1;
                                        else
                                            var Glonas_GPS = 0;
                                        
                                        if ($('#Main_Transort').prop('checked'))
                                            var Main_Transort = 1; 
                                        else
                                            var Main_Transort = 0;

                                        if ($('#Tachograph').prop('checked'))
                                            var Tachograph = 1;
                                        else
                                            var Tachograph = 0;
                                        
                                        $.ajax({
                                            url: '{{ route('bus.store') }}',
                                            type: "POST",
                                            data: { Title_Transport:Title_Transport, Description:Description,Classes:Classes, Type_Transport:Type_Transport,
                                                Company:Company, State_Registration_Number:State_Registration_Number,Main_Transort:Main_Transort,
                                                Year_Issue:Year_Issue, Diagnostic_card:Diagnostic_card, Validity_Date:Validity_Date,
                                                Amount_Place_Bus:Amount_Place_Bus, employee_id:employee_id, Glonas_GPS:Glonas_GPS, Tachograph:Tachograph},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },

                                            success: function (data) {
                                                Hidden_All_Transport();
                                                $('#Title_Transport').val('');
                                                $('#Description_Transport').val('');
                                                $('#Company').val('');
                                                $('#Classes').val('');
                                                $('#Type_Transport').val('0');
                                                $('#State_Registration_Number').val('');
                                                $('#Year_Issue').val('');
                                                $('#Diagnostic_card').val('');
                                                $('#Validity_Date').val('');
                                                $('#Amount_Place_Bus').val('0');
                                                $('#employee_id').val('0');
                                                $('#dont_select_bus').prop('hidden', false);
                                                $('#Glonas_GPS').prop('checked', false);
                                                $('#Tachograph').prop('checked', false);
                                                $('#Main_Transort').prop('checked', false);
                                                $('#addArticle2').modal('hide');
                                                $('#articles-wrap').removeClass('hidden').addClass('show');
                                                $('.alert').removeClass('show').addClass('hidden');
                                                document.getElementById('buses_id').options[document.getElementById('buses_id').selectedIndex].selected = false;
                                                var str = '<option value="'+data['id']+'" data-amountplace="'+data['Amount_Place_Bus']+'" id="'+data['id']+'" title= "'+data['Description']+'" selected>'+data['String']+'</option>';
                                                $('#buses_id:last').append(str);
                                                if(Main_Transort == 1){
                                                    document.getElementById('bus_Main_Transort').value = data['id'];
                                                    bus_Main_Transort.title = data['String'];
                                                    document.getElementById('bus_Main_Transort').dataset.amountplace = data['Amount_Place_Bus'];
                                                    document.getElementById('bus_Main_Transort').dataset.idi = data['id'];
                                                }
                                                    // $('#bus_Main_Transort').val('1');
                                                    // $('#bus_Main_Transort').data('idi', data['id'];
                                                $('#dont_select_bus').prop('selected', false);
                                                chenge_ubdate_button($('#buses_id'), 'updatebutton2');
                                                alert('Добавлено');
                                            },
                                            error: function (msg) {
                                                alert('Ошибка: заполните обязательные для ввода поля или данная запись уже существует.');
                                            }
                                        });
                                    };

                                    function update_tour_bus() {

                                        var Title_Transport = $('#Title_Transport').val();
                                        var State_Registration_Number = $('#State_Registration_Number').val();
                                        var Description = $('#Description_Transport').val();
                                        var Company = $('#Company').val();
                                        var Classes = $('#Classes').val();
                                        var Type_Transport = $('#Type_Transport').val();
                                        var Year_Issue = $('#Year_Issue').val();
                                        var Diagnostic_card = $('#Diagnostic_card').val();
                                        var Validity_Date = $('#Validity_Date').val();
                                        var Amount_Place_Bus = $('#Amount_Place_Bus').val();
                                        var employee_id = $('#employee_id').val();
                                        if ($('#Glonas_GPS').prop('checked'))
                                            var Glonas_GPS = 1;
                                        else
                                            var Glonas_GPS = 0;
                                        
                                        if ($('#Main_Transort').prop('checked'))
                                            var Main_Transort = 1;
                                        else
                                            var Main_Transort = 0;

                                        if ($('#Tachograph').prop('checked'))
                                            var Tachograph = 1;
                                        else
                                            var Tachograph = 0;
                                        var buses_id = $('#buses_id').val();

                                        $.ajax({
                                            url: "{{route('bus.update')}}",
                                            type: "POST",
                                            data: {id:buses_id[0], Title_Transport:Title_Transport,Description:Description,Classes:Classes,Type_Transport:Type_Transport,
                                                Company:Company, State_Registration_Number:State_Registration_Number,Main_Transort:Main_Transort,
                                                Year_Issue:Year_Issue, Diagnostic_card:Diagnostic_card, Validity_Date:Validity_Date,
                                                Amount_Place_Bus:Amount_Place_Bus, employee_id:employee_id, Glonas_GPS:Glonas_GPS, Tachograph:Tachograph},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success: function (data) {
                                                $('#addArticle2').modal('hide');
                                                $('#articles-wrap').removeClass('hidden').addClass('show');
                                                $('.alert').removeClass('show').addClass('hidden');
                                                close_chenge_tour_bus();
                                                $('#dont_select_bus').prop('selected', false);
                                                if(data['Main_Transort'] == 1){
                                                    document.getElementById('bus_Main_Transort').value = data['id'];
                                                    bus_Main_Transort.title = data['String'];
                                                    document.getElementById('bus_Main_Transort').dataset.amountplace = data['Amount_Place_Bus'];
                                                    document.getElementById('bus_Main_Transort').dataset.idi = data['id'];
                                                } else if(data['Main_Transort'] == 0 &&  document.getElementById('bus_Main_Transort').value == buses_id){
                                                    document.getElementById('bus_Main_Transort').value = 0;
                                                    document.getElementById('bus_Main_Transort').dataset.amountplace = 0;
                                                    document.getElementById('bus_Main_Transort').dataset.idi = 0;
                                                    bus_Main_Transort.title = '';
                                                }
                                                document.getElementById('buses_id').options[document.getElementById('buses_id').selectedIndex].dataset.amountplace = data['Amount_Place_Bus'];
                                                document.getElementById('buses_id').options[document.getElementById('buses_id').selectedIndex].text = data['String'];
                                                alert('Изменено');

                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };

                                    function close_chenge_tour_bus() {
                                        if(document.getElementById('bus_Main_Transort').dataset.idi == null || document.getElementById('bus_Main_Transort').dataset.idi == 0){
                                                    $('#Main_Transort').prop('checked', 0);
                                                    $('#Main_Transort').prop('disabled', false);
                                                    $('#Main_Transort').prop('title', '');
                                                }
                                                else {
                                                    $('#Main_Transort').prop('checked', 0);
                                                    $('#Main_Transort').prop('disabled', true);
                                                    $('#Main_Transort').prop('title', 'Основной транспорт уже назначен: ' + $("#buses_id option[value='"+bus_Main_Transort.dataset.idi+"']").text());
                                                }
                                        Hidden_All_Transport();
                                                $('#Title_Transport').val('');
                                                $('#Description_Transport').val('');
                                                $('#Company').val('');
                                                $('#Classes').val('');
                                                $('#Type_Transport').val('0');
                                                $('#State_Registration_Number').val('');
                                                $('#Year_Issue').val('');
                                                $('#Diagnostic_card').val('');
                                                $('#Validity_Date').val('');
                                                $('#Amount_Place_Bus').val('0');
                                                $('#employee_id').val('0');
                                                $('#Glonas_GPS').prop('checked', false);
                                                $('#Tachograph').prop('checked', false);
                                        $('#save2').text('Добавить');
                                        $('#save2').attr("onclick","create_tour_bus()");
                                        $('#close2').text('Закрыть');
                                        $('#close2').attr("onclick","");
                                    }

                                    function index_tour_bus() {
                                        var id = $('#buses_id').val();
                                        $.ajax({
                                            url: "{{route('bus.index')}}",
                                            type: "POST",
                                            data: {id:id[0]},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success:function (data)
                                            {
                                                Set_Trnaport_hidden_Shenge(data['Type_Transport']);
                                                $('#Description_Transport').val(data['Description']);
                                                $('#Company').val(data['Company']);
                                                $('#Classes').val(data['Classes']);
                                                $('#Type_Transport').val(data['Type_Transport']);
                                                $('#Title_Transport').val(data['Title_Transport']);
                                                $('#State_Registration_Number').val(data['State_Registration_Number']);
                                                $('#Year_Issue').val(data['Year_Issue']);
                                                $('#Diagnostic_card').val(data['Diagnostic_card']);
                                                $('#Validity_Date').val(data['Validity_Date']);
                                                $('#Amount_Place_Bus').val(data['Amount_Place_Bus']);
                                                $('#employee_id').val(data['employee_id'] ? data['employee_id'] : '0');
                                                $('#Glonas_GPS').prop('checked', data['Glonas_GPS']);
                                                $('#Tachograph').prop('checked', data['Tachograph']);
                                                if(document.getElementById('bus_Main_Transort').value == data['id']){
                                                    $('#Main_Transort').prop('checked', 1);
                                                    $('#Main_Transort').prop('disabled', false);
                                                }
                                                else if(document.getElementById('bus_Main_Transort').dataset.idi == null || document.getElementById('bus_Main_Transort').dataset.idi == 0){
                                                    $('#Main_Transort').prop('checked', 0);
                                                    $('#Main_Transort').prop('disabled', false);
                                                    $('#Main_Transort').prop('title', '');
                                                }
                                                else {
                                                    $('#Main_Transort').prop('checked', 0);
                                                    $('#Main_Transort').prop('disabled', true);
                                                    $('#Main_Transort').prop('title', 'Основной транспорт уже назначен: ' + $("#buses_id option[value='"+bus_Main_Transort.dataset.idi+"']").text());
                                                }
                                                $('#save2').text('Изменить');
                                                $('#close2').text('Удалить');
                                                $('#save2').attr("onclick","update_tour_bus()");
                                                $('#close2').attr("onclick","destroy_tour_bus()");
                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };
                                    function destroy_tour_bus() {
                                        var buses_id = $('#buses_id').val();
                                        $.ajax({
                                            url: "{{route('bus.destroy')}}",
                                            type: "POST",
                                            data: {id:buses_id[0]},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success:function (data)
                                            {
                                                document.querySelector("#updatebutton2").classList.add("diableddeletedbutton");
                                                document.getElementById('buses_id').options[document.getElementById('buses_id').selectedIndex].remove();
                                                $('#dont_select_bus').prop('selected', true);
                                                if(document.getElementById('bus_Main_Transort').value == buses_id){
                                                    document.getElementById('bus_Main_Transort').dataset.amountplace = 0;
                                                    document.getElementById('bus_Main_Transort').value = "0";
                                                    document.getElementById('bus_Main_Transort').dataset.idi = 0;
                                                    $('#bus_Main_Transort').prop('title', '');
                                                }
                                                //$('#buses_id').val('0');
                                                close_chenge_tour_bus();
                                                alert('Удалено');
                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };

                                </script>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="routes_id" >Маршрут</label>
                                    <div class="col-lg-6 input-group">
                                        <select class="custom-select @error('routes_id') is-invalid @enderror" multiple onchange="chenge_ubdate_button(this, 'updatebutton3');" id="routes_id" name="routes_id[]">
                                            <option value="null" id="dont_select_route" selected @if(count($routes_ids) == 0) hidden @endif>Без выбора</option>
                                            @foreach($routes_ids as $routes_id)
                                                <option value="{{ $routes_id->id }}" id="{{ $routes_id->id }}" @if(old('routes_id') == $routes_id->id) selected @endif>{{$routes_id->Itinerary_Route}}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a  data-toggle="modal" data-target="#addArticle3" class="btn input-group-text selectedbutton" onclick="close_chenge_tour_route()" style="color: #495057;" title="Добавить"><i class="fa fa-plus-circle color-muted m-r-5"></i></a>
                                        </div>
                                        <div class="input-group-append"  id="div_updatebutton3">
                                            <a class="btn input-group-text selectedbutton diableddeletedbutton" data-toggle="modal" data-target="#addArticle3" id="updatebutton3" style="" name="updatebutton3"  onclick="index_tour_route()" title="Изменить"><i class="fa fa-pencil color-danger"></i></a>
                                        </div>
                                        @error('$routes_id')
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
                                                <h4 class="modal-title" id="addArticleLabel">Маршрут</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="Itinerary_Route">Маршрут следования<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('Itinerary_Route') is-invalid @enderror" minlength="2" maxlength="191" onKeyPress="if(this.value.length==191) return false;" name="Itinerary_Route" id="Itinerary_Route" placeholder="Маршрут следования">
                                                    @error('Itinerary_Route')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="Distination_From_Initial_Pop">Место посадки 1<span class="text-danger">*</span></label>
                                                    <input title="из начального пункта" type="text" class="form-control @error('Distination_From_Initial_Pop') is-invalid @enderror" minlength="2" maxlength="191" onKeyPress="if(this.value.length==191) return false;" name="Distination_From_Initial_Pop" id="Distination_From_Initial_Pop" placeholder="Место ">
                                                    @error('Distination_From_Initial_Pop')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="Time_Sending_From_Initial_Pop">Время отправление 1<span class="text-danger">*</span></label>
                                                    <input title="из начального пункта" type="text" class="form-control @error('Time_Sending_From_Initial_Pop') is-invalid @enderror"  name="Time_Sending_From_Initial_Pop" id="Time_Sending_From_Initial_Pop" placeholder="Время">
                                                    @error('Time_Sending_From_Initial_Pop')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <script>
                                                    $(function() {
                                                        $("#Time_Sending_From_Initial_Pop").mask("99:99");
                                                        $("#Time_Sending_From_End_Point").mask("99:99");
                                                    });
                                                </script>
                                                <div class="form-group">
                                                    <label for="Distination_From_End_Point">Место посадки 2<span class="text-danger">*</span></label>
                                                    <input title="из конечного пункта" type="text" class="form-control @error('Distination_From_End_Point') is-invalid @enderror" minlength="2" maxlength="16" name="Distination_From_End_Point" id="Distination_From_End_Point" placeholder="Место">
                                                    @error('Distination_From_End_Point')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="Time_Sending_From_End_Point">Время отправления 2<span class="text-danger">*</span></label>
                                                    <input title="из конечного пункта" type="text" class="form-control @error('Time_Sending_From_End_Point') is-invalid @enderror"  name="Time_Sending_From_End_Point" id="Time_Sending_From_End_Point" placeholder="Время">
                                                    @error('Time_Sending_From_End_Point')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="Name_Car_Dorough_Dorog_Report_Transportation">Автомобильные дороги<span class="text-danger">*</span></label>
                                                    <input title="Перечислить через ';'" type="text" class="form-control @error('Name_Car_Dorough_Dorog_Report_Transportation') is-invalid @enderror" minlength="2" maxlength="191"  name="Name_Car_Dorough_Dorog_Report_Transportation" id="Name_Car_Dorough_Dorog_Report_Transportation" placeholder="Дороги">
                                                    @error('Name_Car_Dorough_Dorog_Report_Transportation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="Name_Car_Dorough_Dorog_Report_Transportation">Карта<span class="text-danger">*</span></label>
                                                    <div class="custom-file">
                                                        <input type="file" name="Map" accept=".txt,.pdf,.docx,.docm,.doc,.xls,.xml,.xlsx,.xlsm" onchange="
                                        switch (this.value.match(/\.([^\.]+)$/)[1]) {
                                            case 'png':
                                            case 'jpg':
                                            case 'jpeg':
                                            case 'iso':
                                            case 'img':
                                            document.getElementById('Fille_Conract_Partners').textContent= this.files.item(0).name;
                                                break;
                                            default:
                                                alert('Файл не подходит!');
                                                this.value = 'Некорректный файл';
                                                break;
                                        }
                                            " class="custom-file-input">
                                                        <label id="Map" for="Map" class="custom-file-label">Файл не выбран</label>
                                                    </div>
                                                    @error('Map')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="close3" class="btn btn-default" onclick="close_chenge_tour_route()"  data-dismiss="modal">Закрыть</button>
                                                <button type="button" id="save3" onclick="create_tour_route()" class="btn btn-primary">Добавить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    // $(function() {

                                    //     $('#routes_id').change(function(buses_id) {
                                    //         // если значение не равно пустой строке
                                    //         var updatebutton3 = document.querySelector("#updatebutton")
                                    //         if($('#routes_id').val() == "0") {
                                    //             updatebutton3.classList.add("diableddeletedbutton");
                                    //         } else {
                                    //             updatebutton3.classList.remove("diableddeletedbutton");
                                    //         }
                                    //     });
                                    // });

                                    function create_tour_route() {
                                        var Map = $('#Map').val();
                                        var Itinerary_Route = $('#Itinerary_Route').val();
                                        var Distination_From_Initial_Pop = $('#Distination_From_Initial_Pop').val();
                                        var Time_Sending_From_Initial_Pop = $('#Time_Sending_From_Initial_Pop').val();
                                        var Distination_From_End_Point = $('#Distination_From_End_Point').val();
                                        var Time_Sending_From_End_Point = $('#Time_Sending_From_End_Point').val();
                                        var Name_Car_Dorough_Dorog_Report_Transportation = $('#Name_Car_Dorough_Dorog_Report_Transportation').val();
                                        $.ajax({
                                            url: '{{ route('route.store') }}',
                                            type: "POST",
                                            data: {Map:Map, Itinerary_Route:Itinerary_Route,
                                                Distination_From_Initial_Pop:Distination_From_Initial_Pop, Time_Sending_From_Initial_Pop:Time_Sending_From_Initial_Pop, Distination_From_End_Point:Distination_From_End_Point,
                                                Time_Sending_From_End_Point:Time_Sending_From_End_Point, Name_Car_Dorough_Dorog_Report_Transportation:Name_Car_Dorough_Dorog_Report_Transportation},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },

                                            success: function (data) {
                                                $('#Map').val('');
                                                $('#Itinerary_Route').val('');
                                                $('#Distination_From_Initial_Pop').val('');
                                                $('#Time_Sending_From_Initial_Pop').val('');
                                                $('#Distination_From_End_Point').val('');
                                                $('#Time_Sending_From_End_Point').val('');
                                                $('#dont_select_route').prop('hidden', false);
                                                $('#dont_select_route').prop('selected', false);
                                                $('#Name_Car_Dorough_Dorog_Report_Transportation').val('');
                                                $('#addArticle3').modal('hide');
                                                $('#articles-wrap').removeClass('hidden').addClass('show');
                                                $('.alert').removeClass('show').addClass('hidden');
                                                var str = '<option value="'+data['id']+'" id="'+data['id']+'" selected>'+data['Itinerary_Route']+'</option>';
                                                $('#routes_id:last').append(str);
                                                chenge_ubdate_button($('#routes_id'), 'updatebutton3');
                                                alert('Добавлено');
                                            },
                                            error: function (msg) {
                                                alert('Ошибка: заполните обязательные для ввода поля или данная запись уже существует.');
                                            }
                                        });
                                    };

                                    function update_tour_route() {
                                        var Map = $('#Map').val();
                                        var Itinerary_Route = $('#Itinerary_Route').val();
                                        var Distination_From_Initial_Pop = $('#Distination_From_Initial_Pop').val();
                                        var Time_Sending_From_Initial_Pop = $('#Time_Sending_From_Initial_Pop').val();
                                        var Distination_From_End_Point = $('#Distination_From_End_Point').val();
                                        var Time_Sending_From_End_Point = $('#Time_Sending_From_End_Point').val();
                                        var Name_Car_Dorough_Dorog_Report_Transportation = $('#Name_Car_Dorough_Dorog_Report_Transportation').val();
                                        var routes_id = $('#routes_id').val();
                                        $.ajax({
                                            url: "{{route('route.update')}}",
                                            type: "POST",
                                            data: {id:routes_id[0], Map:Map, Itinerary_Route:Itinerary_Route,
                                                Distination_From_Initial_Pop:Distination_From_Initial_Pop, Time_Sending_From_Initial_Pop:Time_Sending_From_Initial_Pop, Distination_From_End_Point:Distination_From_End_Point,
                                                Time_Sending_From_End_Point:Time_Sending_From_End_Point, Name_Car_Dorough_Dorog_Report_Transportation:Name_Car_Dorough_Dorog_Report_Transportation},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success: function (data) {
                                                $('#Map').val('');
                                                $('#Itinerary_Route').val('');
                                                $('#Distination_From_Initial_Pop').val('');
                                                $('#Time_Sending_From_Initial_Pop').val('');
                                                $('#Distination_From_End_Point').val('');
                                                $('#Time_Sending_From_End_Point').val('');
                                                $('#Name_Car_Dorough_Dorog_Report_Transportation').val('');
                                                $('#addArticle3').modal('hide');
                                                $('#articles-wrap').removeClass('hidden').addClass('show');
                                                $('.alert').removeClass('show').addClass('hidden');
                                                document.getElementById('routes_id').options[document.getElementById('routes_id').selectedIndex].text = data['Itinerary_Route'];
                                                $('#save3').text('Добавить');
                                                $('#save3').attr("onclick","create_tour_route()");
                                                alert('Изменено');

                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };

                                    function close_chenge_tour_route() {
                                        $('#Map').val('');
                                        $('#Itinerary_Route').val('');
                                        $('#Distination_From_Initial_Pop').val('');
                                        $('#Time_Sending_From_Initial_Pop').val('');
                                        $('#Distination_From_End_Point').val('');
                                        $('#Time_Sending_From_End_Point').val('');
                                        $('#Name_Car_Dorough_Dorog_Report_Transportation').val('');
                                        $('#save3').text('Добавить');
                                        $('#save3').attr("onclick","create_tour_route()");
                                        $('#close3').text('Закрыть');
                                        $('#close3').attr("onclick","");
                                    }

                                    function index_tour_route() {
                                        var id = $('#routes_id').val();
                                        $.ajax({
                                            url: "{{route('route.index')}}",
                                            type: "POST",
                                            data: {id:id[0]},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success:function (data)
                                            {
                                                $('#Itinerary_Route').val(data['Itinerary_Route']);
                                                $('#Distination_From_Initial_Pop').val(data['Distination_From_Initial_Pop']);
                                                $('#Time_Sending_From_Initial_Pop').val(data['Time_Sending_From_Initial_Pop']);
                                                $('#Distination_From_End_Point').val(data['Distination_From_End_Point']);
                                                $('#Time_Sending_From_End_Point').val(data['Time_Sending_From_End_Point']);
                                                $('#Name_Car_Dorough_Dorog_Report_Transportation').val(data['Name_Car_Dorough_Dorog_Report_Transportation']);
                                                $('#save3').text('Изменить');
                                                $('#close3').text('Удалить');
                                                $('#save3').attr("onclick","update_tour_route()");
                                                $('#close3').attr("onclick","destroy_tour_route()");
                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };
                                    function destroy_tour_route(id) {
                                        var routes_id = $('#routes_id').val();
                                        $.ajax({
                                            url: "{{route('route.destroy')}}",
                                            type: "POST",
                                            data: {id:routes_id[0]},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success:function (data)
                                            {
                                                document.querySelector("#updatebutton3").classList.add("diableddeletedbutton");
                                                document.getElementById('routes_id').options[document.getElementById('routes_id').selectedIndex].remove();
                                                $('#dont_select_route').prop('selected', true);
                                                //$('#routes_id').val('0');
                                                close_chenge_tour_route();
                                                alert('Удалено');
                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };

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
                                    <label class="col-lg-4 col-form-label" for="End_Date_Tours" >Возвращение<span class="text-danger">*</span></label>
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
                                    <label class="col-lg-4 col-form-label" for="Start_point" >Место отправления<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input id="Start_point" type="text" class="form-control @error('Start_point') is-invalid @enderror" name="Start_point" minlength="2" maxlength="191" value="{{ old('Start_point') }}" required  placeholder="Название">
                                        @error('Start_point')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

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
                                    <label class="col-lg-4 col-form-label" for="Expenses" >Прибыль</label>
                                    <div class="col-lg-6">
                                        <input  type="number" class="form-control @error('Profit') is-invalid @enderror" min="0" max="2147483647" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" value="{{ old('Profit') }}" name="Profit" id="Profit" placeholder="Прибыль">
                                        @error('Profit')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Amount_Place" >Количество мест<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input  type="number" class="form-control @error('Amount_Place') is-invalid @enderror" min="0" max="1000" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" value="{{ old('Amount_Place') }}" name="Amount_Place" id="Amount_Place" placeholder="Количество мест" required>
                                        @error('Amount_Place')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Occupied_Place" >Занятых мест</label>
                                    <div class="col-lg-6">
                                        <input  type="number" class="form-control @error('Occupied_Place') is-invalid @enderror" min="0" max="1000" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" value="{{ old('Occupied_Place') }}" name="Occupied_Place" id="Occupied_Place" placeholder="Количество мест" >
                                        @error('Occupied_Place')
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
                                    <label class="col-lg-4 col-form-label" for="Program" >Программа</label>
                                    <div class="col-lg-6">
                                        <textarea  type="text" class="form-control @error('Program') is-invalid @enderror" name="Program" id="Program" placeholder="Описание">{{ old('Program') }}</textarea>
                                        @error('Program')
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
                                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Confidentiality" >Скрытый<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <select class="custom-select mr-sm-2" id="Confidentiality" name="Confidentiality" required>
                                            <option value="" disabled selected hidden>Есть?</option>
                                            <option value="0" @if(old('Confidentiality') == 0) selected @endif>Нет</option>
                                            <option value="1" @if(old('Confidentiality') == 1) selected @endif>Да</option>
                                        </select>
                                        @error('Confidentiality')
                                        <span class="invalid-feedback d-block" role="alert">
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
                                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" onclick="if(document.getElementById('bus_Main_Transort').value != 0 && document.getElementById('bus_Main_Transort').value != null && document.getElementById('bus_Main_Transort').dataset.amountplace !=  Amount_Place.value)if(confirm('Количество мест указанных в экскурсии: ' + Amount_Place.value + ', отличается от количества мест на основном транспорте: '+ document.getElementById('bus_Main_Transort').dataset.amountplace + '. Пользователь увидит количество мест указанных в самой экскурсии. Желаете продолжить?')){return true}else{return false} "  class="btn btn-primary">Добавить</button>
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
    </script>

@endsection
