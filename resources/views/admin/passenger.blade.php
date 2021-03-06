@extends('layouts.admin')

@section('content')
    <div class="container-fluid" id="idtour" data-idi="{{$tour->id}}">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row card-header" style="padding-bottom: 25px ">
                            <div class="col-sm-12 col-md-7" >
                                <h4 class="">{{$tour->Name_Tours}} - Пассажиры</h4>
                            </div>
                            <div class="col-sm-12 col-md-5">
                                @if ($tour->Confirmation_Tours == 0)
                                    <a href="{{route('tourgoadmin', $tour)}}" data-toggle="tooltip"  data-placement="top"  class="btn btn-info btn-rounded btnheader" style="float: right; margin-right: 3px">Добавить/Изменить/Удалить</a>
                                @else
                                    <a href="" onclick="return false;" class="btn btn-info btn-rounded btnheader" title="После подтверждения экскурсии, все её изменения запрещены" style="cursor: default; color: currentColor; float: right; margin-right: 3px">Добавить/Изменить/Удалить</a>
                                @endif
                                <a href="{{route('printpastour', $tour)}}" data-toggle="tooltip"  data-placement="top"  class="btn btn-info btn-rounded btnheader" style="float: right; margin-right: 3px">Список</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle text-center">
                                <thead>
                                <tr>
                                    <th scope="col">ФИО</th>
                                    <th scope="col" title="Телеофон">Тел.</th>
                                    <th scope="col" title="Место">М.</th>
                                    <th scope="col" title="Платные/бесплатные">Дети</th>
                                    <th scope="col" title="Сопровождающий">Сопр.</th>
                                    <th scope="col">С.О.</th>
                                    <th scope="col">Отзыв</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($passengers as $passenger)
                                <tr title="Дата записи: {{ date('H:i d.m.Y ',strtotime($passenger->created_at))}}" @if($passenger->Paid == 1) class="divlightsalmon" @else class="divlightgreen" @endif>
                                    <td>  <a href="{{ route('customer.edit', $passenger->customer->id) }}" title="Просмотреть">{{ $passenger->customer->Name . ' ' . $passenger->customer->Surname . ' ' . $passenger->customer->Middle_Name }}</a></td>
                                    <td> {{ $passenger->customer->Phone_Number_Customer }}</td>
                                    <td> {{ $passenger->Occupied_Place_Bus }}</td>
                                    <td>
                                        <span title="Платные/бесплатные">{{$passenger->Amount_Children}}/{{$passenger->Free_Children}}</span>
                                    </td>
                                    <td> {{ $passenger->Accompanying == 0 ? 'Нет' : 'Да'}}</td>
                                    <td> {{ $passenger->Payment_method == 1 ? 'Безнал.' : 'Нал.'}}</td>
                                    <td> {{ ($passenger->Stars or $passenger->Comment_Customer) ? ('Оценка: ' . $passenger->Stars . '. Комментарий: ' . $passenger->Comment_Customer) : 'Отсутствует'}} </td>
                                    @if ($tour->Confirmation_Tours == 0)
                                    <td align="center">
                                        <span>
                                            @if($passenger->Paid == 1) 
                                                <a style="cursor: pointer !important;" onclick="if(confirm('Отменить подтверждение оплаты?')){document.getElementById('form1{{$passenger->id}}').submit();}else{return false}" title="Отменить подтверждение оплаты"><i class="fa fa-close color-muted m-r-5"></i></a>
                                            @else  
                                                <a style="cursor: pointer !important;" onclick="if(confirm('Подтвердить оплату?')){document.getElementById('form1{{$passenger->id}}').submit();}else{return false}"  title="Подтвердить оплату"><i  class="fa fa-check  color-muted m-r-5"></i></a>
                                            @endif
                                            <a  title="Удалить" style="cursor: pointer;" onclick="if(confirm('Удалить?')){document.getElementById('form2{{$passenger->id}}').submit();}else{return false}"><i class="fa fa-trash color-danger"></i></a>
                                            <form hidden onsubmit="" id="form1{{$passenger->id}}" action="{{route('complitepaid',$tour)}}" method="post">
                                                <input type="number" hidden name="Paid" value="{{$passenger->Paid}}">
                                                <input type="number" hidden name="customers_id" value="{{$passenger->customer->id}}">
                                                @csrf
                                            </form>
                                            <form hidden onsubmit="" id="form2{{$passenger->id}}" action="{{route('destroyadmin',$tour)}}" method="post">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="number" hidden name="customers_id" value="{{$passenger->customer->id}}">
                                                @csrf
                                            </form>
                                        </span>
                                    </td>
                                    @endif

                                </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        @if($passengers->total() > $passengers->count())
                        <div class="row mt-3 justify-content-center">
                            <div class="bootstrap-pagination" >
                                <nav>
                                    <ul class="pagination">
                                        {{$passengers->links() }}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <script>
            function alert_precence_true ()
            {
                dialog.alert({
                    title: "Уведомление",
                    message: "Вы уже отметили пользователя, как присутствуещего!",
                });

                return false
            }


            function alert_occupaid_true_forfalse ()
            {
                dialog.confirm({
                    title: "Предупреждение",
                    message: "Вы действительно хотите изменить состояние клиента на 'Присутствовал'?",
                    cancel: "Нет",
                    button: "Да",
                    required: true,
                    callback: function(value){
                        if (value == 1)
                            $("#Precence_True").submit()
                        else
                            return false
                    }
                });
            }

            function alert_occupaid_false_fortrue ()
            {
                dialog.confirm({
                    title: "Предупреждение",
                    message: "Вы действительно хотите изменить состояние клиента на 'Отсутствовал'?",
                    cancel: "Нет",
                    button: "Да",
                    required: true,
                    callback: function(value){
                        if (value == 1)
                            $("#Precence_False").submit()
                        else
                            return false
                    }
                });
            }

            function Precence_True_submit ($lol)
            {
                $($lol).submit()
            }

            function alert_occupaid_false ()
            {
                dialog.alert({
                    title: "Уведомление",
                    message: "Вы уже отметили пользователя, как отсутсвующего!",
                });

                return false
            }
        </script>

        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row card-header" style="padding-bottom: 25px ">
                            <div class="col-sm-12 col-md-7" >
                                <h4 class="">{{$tour->Name_Tours}} - Партнёры</h4>
                            </div>
                            <div class="col-sm-12 col-md-5">

                                <script>
                                    function create_tour_contract() {
                                        var Name_Contract_doc = $('#Name_Contract_doc').val();
                                        var Salary = $('#Salary').val();
                                        var Document_Contract = $('#Document_Contract').val();
                                        var partners_id = $('#partners_id').val();
                                        var tour_id = document.getElementById('idtour').dataset.idi;
                                        $.ajax({
                                            url: '{{ route('Contract.store') }}',
                                            type: "POST",
                                            data: {Name_Contract_doc:Name_Contract_doc, Salary:Salary, Document_Contract:Document_Contract, partners_id:partners_id, tours_id:tour_id},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },

                                            success: function (data) {
                                                $('#Name_Contract_doc').val('');
                                                $('#Salary').val('0');
                                                $('#partners_id').val('0');
                                                $('#Document_Contract').val('');
                                                $('#addArticle2').modal('hide');
                                                $('#articles-wrap').removeClass('hidden').addClass('show');
                                                $('.alert').removeClass('show').addClass('hidden');
                                                var str = '<tr id="contract'+data['id']+'"><td title="'+data['title']+'">'+data['Name_Partners']+
                                                    '</td><td>'+data['Name_Contract_doc']+
                                                    '</td><td>'+data['Document_Contract']+
                                                    '</td><td>'+data['Salary']+
                                                    '</td><td  align="center">'+
                                                    '<span>'+
                                                    '<a href="" id="'+data['id']+'" data-toggle="modal" data-target="#addArticle2" onclick="index_tour_contract(this.id)"  title="Редактировать"><i  class="fa fa-pencil color-muted m-r-5"></i></a>'+
                                                    '<a  id="'+data['id']+'" style="cursor: pointer;"   data-toggle="tooltip" data-placement="top" onclick="if(confirm(\'Удалить?\')){return destroy_tour_contract(this.id)}else{return false}"  title="Удалить"><i class="fa fa-trash color-danger"></i></a>'+
                                                    '</span>'+
                                                    '</td></tr>';

                                                $('#table_for_contract > tbody:last').append(str);
                                                alert('Добавлено');
                                            },
                                            error: function (msg) {
                                                alert('Ошибка: заполните обязательные для ввода поля или данная запись уже существует.');
                                            }
                                        });
                                    };
                                    function update_tour_contract(id) {
                                        var Name_Contract_doc = $('#Name_Contract_doc').val();
                                        var Salary = $('#Salary').val();
                                        var Document_Contract = $('#Document_Contract').val();
                                        var partners_id = $('#partners_id').val();
                                        var tour_id = document.getElementById('idtour').dataset.idi;
                                        $.ajax({
                                            url: '{{ route('Contract.update') }}',
                                            type: "POST",
                                            data: {Name_Contract_doc:Name_Contract_doc, Salary:Salary, Document_Contract:Document_Contract, partners_id:partners_id, tours_id:tour_id, id:id},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success: function (data) {
                                                $('#addArticle2').modal('hide');
                                                $('#articles-wrap').removeClass('hidden').addClass('show');
                                                $('.alert').removeClass('show').addClass('hidden');
                                                $('#Name_Contract_doc').val('');
                                                $('#Salary').val('0');
                                                $('#partners_id').val('0');
                                                $('#Document_Contract').val('');
                                                var str = '<tr id="contract'+data['id']+'"><td title="'+data['title']+'">'+data['Name_Partners']+
                                                    '</td><td>'+data['Name_Contract_doc']+
                                                    '</td><td>'+data['Document_Contract']+
                                                    '</td><td>'+data['Salary']+
                                                    '</td><td  align="center">'+
                                                    '<span>'+
                                                    '<a href="" id="'+data['id']+'" data-toggle="modal" data-target="#addArticle2" onclick="index_tour_contract(this.id)"  title="Редактировать"><i  class="fa fa-pencil color-muted m-r-5"></i></a>'+
                                                    '<a  id="'+data['id']+'" style="cursor: pointer;"   data-toggle="tooltip" data-placement="top" onclick="if(confirm(\'Удалить?\')){return destroy_tour_contract(this.id)}else{return false}"  title="Удалить"><i class="fa fa-trash color-danger"></i></a>'+
                                                    '</span>'+
                                                    '</td></tr>';
                                                $('#save2').text('Добавить');
                                                $('#save2').attr("onclick","create_tour_contract()");
                                                document.getElementById('contract'+id).innerHTML = str;
                                                alert('Изменено');

                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };

                                    function close_chenge_tour_contract() {
                                        $('#Name_Contract_doc').val('');
                                        $('#Salary').val('0');
                                        $('#partners_id').val('0');
                                        $('#Document_Contract').val('');
                                        $('#save2').text('Добавить');
                                        $('#save2').attr("onclick","create_tour_contract()");
                                    }

                                    function index_tour_contract(id) {
                                        $('#save2').text('Редактировать');
                                       $.ajax({
                                            url: '{{ route('Contract.index') }}',
                                            type: "POST",
                                            data: {id:id},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success:function (data)
                                            {
                                                $('#Name_Contract_doc').val(data['Name_Contract_doc']);
                                                $('#Salary').val(data['Salary']);
                                                $('#partners_id').val(data['partners_id']);
                                                $('#Document_Contract').val(data['Document_Contract']);
                                                $('#save2').attr("onclick","update_tour_contract(this.dataset.idi)");
                                                $('#save2').attr("data-idi",id);
                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };
                                    function destroy_tour_contract(id) {
                                        var tour_id = document.getElementById('idtour').dataset.idi;
                                        $.ajax({
                                            url: '{{ route('Contract.destroy') }}',
                                            type: "POST",
                                            data: {id:id,tours_id:tour_id},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success:function (data)
                                            {
                                                document.getElementById('contract'+id).parentNode.removeChild(document.getElementById('contract'+id));
                                                alert('Удалено');
                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };

                                </script>
                                @if ($tour->Confirmation_Tours == 0)
                                    <a href="" data-toggle="modal" data-target="#addArticle2" class="btn btn-info btn-rounded btnheader" style="float: right;">Добавить</a>
                                @else
                                    <a href="" onclick="return false;" title="После подтверждения экскурсии, все её изменения запрещены" class="btn btn-info btn-rounded btnheader" style="cursor: default; color: currentColor; float: right;">Добавить</a>
                                @endif
                                <div class="modal fade" id="addArticle2" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addArticleLabel">Партнёры</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="Name_Contract_doc">Название<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('Name_Contract_doc') is-invalid @enderror" minlength="2" maxlength="191" id="Name_Contract_doc" placeholder="Название">
                                                    @error('Name_Contract_doc')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="Salary">Стоимость<span class="text-danger">*</span></label>
                                                    <input  type="number" class="form-control @error('Salary') is-invalid @enderror" min="0" max="2147483647" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" name="Salary" id="Salary" placeholder="Стоимость">
                                                    @error('Salary')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="Document_Contract">Договор</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="Document_Contract" accept=".txt,.pdf,.docx,.docm,.doc,.xls,.xml,.xlsx,.xlsm" onchange="
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
                                                        <label id="Fille_Conract_Partners" for="Document_Contract" class="custom-file-label">Файл не выбран</label>
                                                    </div>
                                                    @error('Document_Contract')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="partners_id">Партнёр<span class="text-danger">*</span></label>
                                                    <select class="custom-select @error('partners_id') is-invalid @enderror" id="partners_id" name="partners_id"  required>
                                                        <option value="0" disabled selected hidden>Партнёр</option>
                                                        @foreach($partners as $partner)
                                                            <option value="{{ $partner->id }}" id="{{ $partner->id }}" title="{{ $partner->INN . ' ' . $partner->type_activity->Name_Type_Activity }}">{{$partner->Name_Partners}} {{$partner->type_activity->Name_Type_Activity ?? ''}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('partners_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" onclick="close_chenge_tour_contract()"  data-dismiss="modal">Закрыть</button>
                                                <button type="button" id="save2" data-idi="" onclick="create_tour_contract()" class="btn btn-primary">Добавить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle text-center" id="table_for_contract">
                                <thead>
                                <tr>
                                    <th scope="col">Партнёр</th>
                                    <th scope="col">Название</th>
                                    <th scope="col">Договор</th>
                                    <th scope="col">Стоимость</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contracts as $contract)
                                    <tr id="contract{{$contract->id}}">
                                        <td title="{{ $contract->partner->INN . ' ' . $contract->partner->type_activity->Name_Type_Activity }}"> {{ $contract->partner->Name_Partners }}</td>
                                        <td> {{ $contract->Name_Contract_doc }} </td>
                                        <td> <a href="">{{ $contract->Document_Contract }}</a></td>
                                        <td> {{ $contract->Salary }} </td>
                                        @if ($tour->Confirmation_Tours == 0)
                                            <td align="center">
                                                <span>
                                                    <a href="" id="{{ $contract->id }}" data-toggle="modal" data-target="#addArticle2" onclick="index_tour_contract(this.id)"  title="Редактировать"><i  class="fa fa-pencil color-muted m-r-5"></i></a>
                                                    <a style="cursor: pointer;" id="{{ $contract->id }}" data-toggle="tooltip" data-placement="top" onclick="if(confirm('Удалить?')){return destroy_tour_contract(this.id)}else{return false}" title="Удалить"><i class="fa fa-trash color-danger"></i></a>
                                                </span>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($contracts->total() > $contracts->count())
                        <div class="row mt-3 justify-content-center">
                            <div class="bootstrap-pagination" >
                                <nav>
                                    <ul class="pagination">
                                        {{$contracts->links() }}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

                                            {{-- @if (!$voditel_dobavlen_answer  and $tour->bus)
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function(event) {
                                            $('#dobavit_employee').click();
                                            $('#employee_id').attr("style", "pointer-events: none;" + "background: #eee;" + "touch-action: none;"); 
                                            $('<div class="form-group" id="message_voditel" > <p style="font-weight: bold">Ранее при создании экскурсии вы указали водителя, добавить его в работники? Если вы хотите поменять водителя, зайдите пожалуйста в редактирование экскурсии {{$tour->Name_Tours}}.</p></div>').prependTo('#employee_div_modal_body');
                                            $('#employee_id').val({{ $tour->bus->employee_id }});
                                        }, {once: true});
                                        close3.addEventListener("click", function(event) {
                                            $('#message_voditel').detach();
                                            $('#employee_id').attr("style", ""); 
                                        }, {once: true});
                                    </script>
                                    @endif --}}

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row card-header" style="padding-bottom: 25px ">
                            <div class="col-sm-12 col-md-7" >
                                <h4 class="">{{$tour->Name_Tours}} - Работники</h4>
                            </div>
                            <div class="col-sm-12 col-md-5">
                                @if ($tour->Confirmation_Tours == 0)
                                    <a href="" id="dobavit_employee" data-toggle="modal" data-target="#addArticle3" class="btn btn-info btn-rounded btnheader" style="float: right;">Добавить</a>
                                @else
                                    <a href="" onclick="return false;" title="После подтверждения экскурсии, все её изменения запрещены" class="btn btn-info btn-rounded btnheader" style="cursor: default; color: currentColor; float: right;">Добавить</a>
                                @endif
                                <div class="modal fade" id="addArticle3" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" >
                                            <div class="modal-header" >
                                                <h4 class="modal-title" >Работники</h4>
                                            </div>
                                            <div class="modal-body" id="employee_div_modal_body">
                                                <div class="form-group" >
                                                    <label for="employee_id">Работники<span class="text-danger">*</span></label>
                                                    <select class="custom-select @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id"  required>
                                                        <option value="0" disabled selected hidden>Работник</option>
                                                        @foreach($employees as $employee)
                                                            <option value="{{ $employee->id }}" id="{{ $employee->id }}">{{ $employee->Surname . ' ' . mb_substr($employee->Name, 0, 1)  . '. ' . mb_substr($employee->Middle_Name, 0, 1) . ($employee->Middle_Name != '' ? '.' : '') }} {{ $employee->job->Job_Title ?? '' }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('employee_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="Salary1">Стоимость<span class="text-danger">*</span></label>
                                                    <input  type="number" class="form-control @error('Salary') is-invalid @enderror" min="0" max="2147483647" value="0" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" name="Salary1" id="Salary1" placeholder="Стоимость">
                                                    @error('Salary')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="partners_foremploye_id">Партнёр</label>
                                                    <select class="custom-select @error('partners_foremploye_id') is-invalid @enderror" id="partners_foremploye_id" name="partners_foremploye_id"  required>
                                                        <option value="0" disabled selected hidden>Партнёр</option>
                                                        @foreach($partners as $partner)
                                                            <option value="{{ $partner->id }}" id="{{ $partner->id }}" title="{{ $partner->INN . ' ' . $partner->type_activity->Name_Type_Activity }}">{{$partner->Name_Partners}} {{$partner->type_activity->Name_Type_Activity ?? ''}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('partners_foremploye_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                @if($place_transport and ($place_transport->bus->Type_Transport == 'Автобус' or $place_transport->bus->Type_Transport == 'Микроавтобус'))
                                                <div class="form-group">
                                                    <label for="Occupied_Place_Bus">Место</label>
                                                    <select class="custom-select @error('Occupied_Place_Bus') is-invalid @enderror" id="Occupied_Place_Bus" name="Occupied_Place_Bus"  required>
                                                        <option value="0" disabled selected hidden>Выберете место</option>
                                                        @for($i = 1; $i <= $place_transport->bus->Amount_Place_Bus; $i++)
                                                            <option value="{{ $i }}" id="{{ $i }}" @if(\App\Passenger::where('LogicalDelete',0)->where('Occupied_Place_Bus',$i)->exists()) hidden disabled @endif>{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                    @error('Occupied_Place_Bus')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                @endif
                                                <div class="form-group">
                                                    <label for="Confidentiality">Скрытый</label>
                                                    <input class="form-check-input" type="checkbox" id="Confidentiality" name="Confidentiality" style="margin-left: 5px !important; border: 1px solid #ced4da;" value="1" >
                                                    @error('Confidentiality')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" id="close3" onclick="close_chenge_tour_employee()"  data-dismiss="modal">Закрыть</button>
                                                <button type="button" id="save3" data-idi="" onclick="create_tour_employee()" class="btn btn-primary">Добавить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($tour->Confirmation_Tours == 0)
                                <script>
                                    function create_tour_employee() {
                                        var employee_id = $('#employee_id').val();
                                        var Salary = $('#Salary1').val();
                                        var partners_id = $('#partners_foremploye_id').val();
                                        var Occupied_Place_Bus = $('#Occupied_Place_Bus').val();
                                        if ($('#Confidentiality').prop('checked'))
                                            var Confidentiality = 1;
                                        else
                                            var Confidentiality = 0;
                                        var tour_id = document.getElementById('idtour').dataset.idi;
                                        $.ajax({
                                            url: '{{ route('touremployee.store') }}',
                                            type: "POST",
                                            data: {partners_id:partners_id, employee_id:employee_id, Salary:Salary, Occupied_Place_Bus:Occupied_Place_Bus, Confidentiality:Confidentiality, tour_id:tour_id},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },

                                            success: function (data) {
                                                $('#Salary1').val('0');
                                                $('#Occupied_Place_Bus').val('0');
                                                $('#employee_id').val('0');
                                                $('#partners_foremploye_id').val('0');
                                                $('#Confidentiality').prop('checked', false);
                                                $('#addArticle3').modal('hide');
                                                $('#articles-wrap').removeClass('hidden').addClass('show');
                                                $('.alert').removeClass('show').addClass('hidden');
                                                var str = '<tr id="tour_employee'+data['id']+'"><td title="'+data['FIO_Full']+'">'+data['FIO']+
                                                    '</td><td>'+data['Job']+
                                                    '</td><td>'+data['partners_id']+
                                                    '</td><td>'+data['Occupied_Place_Bus']+
                                                    '</td><td>'+data['Salary']+
                                                    '</td><td>'+
                                                    '<span class="'+data['Class_Style']+'">'+
                                                    data['Confidentiality']+
                                                    '</span>'+
                                                    '</td><td  align="center">'+
                                                    '<span>'+
                                                    '<a href="" id="'+data['id']+'" data-toggle="modal" data-target="#addArticle3" onclick="index_tour_employee(this.id)"  title="Редактировать"><i  class="fa fa-pencil color-muted m-r-5"></i></a>'+
                                                    '<a style="cursor: pointer;"  id="'+data['id']+'"  data-toggle="tooltip" data-placement="top" onclick="if(confirm(\'Удалить?\')){return destroy_tour_employee(this.id)}else{return false}"  title="Удалить"><i class="fa fa-trash color-danger"></i></a>'+
                                                    '</span>'+
                                                    '</td></tr>';

                                                $('#table_for_employees > tbody:last').append(str);
                                                alert('Добавлено');
                                            },
                                            error: function (msg) {
                                                alert('Ошибка: заполните обязательные для ввода поля или данная запись уже существует.');
                                            }
                                        });
                                    };
                                    function update_tour_employee(id) {
                                        var employee_id = $('#employee_id').val();
                                        var Salary = $('#Salary1').val();
                                        var partners_id = $('#partners_foremploye_id').val();
                                        var Occupied_Place_Bus = $('#Occupied_Place_Bus').val();
                                        if ($('#Confidentiality').prop('checked'))
                                            var Confidentiality = 1;
                                        else
                                            var Confidentiality = 0;
                                        var tour_id = document.getElementById('idtour').dataset.idi;

                                        $.ajax({
                                            url: "{{route('touremployee.update')}}",
                                            type: "POST",
                                            data: {id:id,partners_id:partners_id, employee_id:employee_id, Salary:Salary, Occupied_Place_Bus:Occupied_Place_Bus, Confidentiality:Confidentiality, tour_id:tour_id},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success: function (data) {
                                                $('#addArticle3').modal('hide');
                                                $('#articles-wrap').removeClass('hidden').addClass('show');
                                                $('.alert').removeClass('show').addClass('hidden');
                                                $('#Salary1').val('0');
                                                $('#partners_foremploye_id').val('0');
                                                $('#Occupied_Place_Bus').val('0');
                                                $('#employee_id').val('0');
                                                $('#Confidentiality').prop('checked', false);
                                                var str = '<tr id="tour_employee'+data['id']+'"><td title="'+data['FIO_Full']+'">'+data['FIO']+
                                                    '</td><td>'+data['Job']+
                                                    '</td><td>'+data['partners_id']+
                                                    '</td><td>'+data['Occupied_Place_Bus']+
                                                    '</td><td>'+data['Salary']+
                                                    '</td><td>'+
                                                    '<span class="'+data['Class_Style']+'">'+
                                                    data['Confidentiality']+
                                                    '</span>'+
                                                    '</td><td  align="center">'+
                                                    '<span>'+
                                                    '<a href="" id="'+data['id']+'" data-toggle="modal" data-target="#addArticle3" onclick="index_tour_employee(this.id)"  title="Редактировать"><i  class="fa fa-pencil color-muted m-r-5"></i></a>'+
                                                    '<a style="cursor: pointer;"  id="'+data['id']+'" data-toggle="tooltip" data-placement="top" onclick="if(confirm(\'Удалить?\')){return destroy_tour_employee(this.id)}else{return false}"  title="Удалить"><i class="fa fa-trash color-danger"></i></a>'+
                                                    '</span>'+
                                                    '</td></tr>';
                                                $('#save3').text('Добавить');
                                                $('#save3').attr("onclick","create_tour_employee()");
                                                document.getElementById('tour_employee'+id).innerHTML = str;
                                                alert('Изменено');

                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };

                                    function close_chenge_tour_employee() {
                                        $('#Salary1').val('0');
                                        $('#Occupied_Place_Bus').val('0');
                                        $('#employee_id').val('0');
                                        $('#partners_foremploye_id').val('0');
                                        $('#Confidentiality').prop('checked', false);
                                        $('#save3').text('Добавить');
                                        $('#save3').attr("onclick","create_tour_employee()");
                                    }

                                    function index_tour_employee(id) {
                                        $('#save3').text('Редактировать');
                                        $.ajax({
                                            url: "{{route('touremployee.index')}}",
                                            type: "POST",
                                            data: {id:id},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success:function (data)
                                            {
                                                $('#partners_foremploye_id').val(data['partners_id']);
                                                $('#Salary1').val(data['Salary']);
                                                $('#Occupied_Place_Bus').val(data['Occupied_Place_Bus']);
                                                $('#employee_id').val(data['employee_id']);
                                                $('#Confidentiality').prop('checked', data['Confidentiality']);
                                                $('#save3').attr("onclick","update_tour_employee(this.dataset.idi)");
                                                $('#save3').attr("data-idi",id);
                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };
                                    function destroy_tour_employee(id) {
                                        $.ajax({
                                            url: "{{route('touremployee.destroy')}}",
                                            type: "POST",
                                            data: {id:id},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success:function (data)
                                            {
                                                document.getElementById('tour_employee'+id).parentNode.removeChild(document.getElementById('tour_employee'+id));
                                                alert('Удалено');
                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };

                                </script>
                                @endif
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle text-center" id="table_for_employees">
                                <thead>
                                <tr>
                                    <th scope="col">ФИО</th>
                                    <th scope="col">Должность</th>
                                    <th scope="col">Партнёр</th>
                                    <th scope="col">Место</th>
                                    <th scope="col">Стоимость</th>
                                    <th scope="col">Скрытый</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tour_employees as $tour_employee)
                                    <tr id="tour_employee{{$tour_employee->id}}" >
                                        <td  title="{{ $tour_employee->employee->Surname . ' ' . $tour_employee->employee->Name  . ' ' . $tour_employee->employee->Middle_Name}}">
                                            <a href="{{ route('employees.edit', $tour_employee->employee->id) }}" title="Просмотреть">{{ $tour_employee->employee->Surname . ' ' . mb_substr($tour_employee->employee->Name, 0, 1)  . '. ' . mb_substr($tour_employee->employee->Middle_Name, 0, 1) . ($tour_employee->employee->Middle_Name != '' ? '.' : '') }}</a>
                                        </td>
                                        <td>
                                                @if($tour_employee->employee->jobs_id != null && isset($tour_employee->employee->job))
                                                    {{$tour_employee->employee->job->Company}} {{ $tour_employee->employee->job->Job_Title}} зп: {{( ($tour_employee->employee->job->Salary == null)? 'договорная': $tour_employee->employee->job->Salary . 'р')}}
                                                @else
                                                    Не назначена
                                                @endif
                                        </td>
                                        <td>
                                            {{ $tour_employee->partner->Name_Partners ?? 'Отсутствует' }}
                                        </td>
                                        <td>
                                            {{ $tour_employee->Occupied_Place_Bus }}
                                        </td>
                                        <td>
                                            {{ number_format($tour_employee->Salary, 0, ',', ' ') . '₽' }}
                                        </td>
                                        <td>
                                            @if($tour_employee->Confidentiality == 1)
                                                    Да
                                            @else
                                                    Нет
                                            @endif
                                        </td>
                                        @if ($tour->Confirmation_Tours == 0)
                                        <td align="center">
                                            <span>
                                                <a href="" id="{{ $tour_employee->id }}" data-toggle="modal" data-target="#addArticle3" onclick="index_tour_employee(this.id)"  title="Редактировать"><i  class="fa fa-pencil color-muted m-r-5"></i></a>
                                                <a style="cursor: pointer;" id="{{ $tour_employee->id }}" data-toggle="tooltip" data-placement="top" onclick="if(confirm('Удалить?')){return destroy_tour_employee(this.id)}else{return false}" title="Удалить"><i class="fa fa-trash color-danger"></i></a>
                                            </span>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($tour_employees->total() > $tour_employees->count())
                        <div class="row mt-3 justify-content-center">
                            <div class="bootstrap-pagination" >
                                <nav>
                                    <ul class="pagination">
                                        {{$tour_employees->links() }}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection