@extends('layouts.admin')

@section('content')
    <div class="container-fluid" id="idtour" data-idi="{{$tour->id}}">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row card-header" style="padding-bottom: 25px ">
                            <div class="col-sm-12 col-md-3" >
                                <h4 class="">{{$tour->Name_Tours}} - Пассажиры</h4>
                            </div>
                            <div class="col-sm-12 col-md-9">
                                <a href="{{ route('printpastour', [$tour]) }}" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-rounded btnheader" style="float: right;">Список</a>
                                <a href="" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-rounded btnheader" style="float: right; margin-right: 3px">Добавить</a>
                            </div>
                        </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped verticle-middle">
                            <thead>
                            <tr>
                                <th scope="col">ФИО</th>
                                <th scope="col">Льготник</th>
                                <th scope="col">Дата записи</th>
                                <th scope="col">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($passengers as $passenger)
                            <tr>
                                {{--Модельное окно для партнёров и работников--}}


                                <td style="{{ ( ($passenger->Presence == 1) ?
                                           'color: green !important;' :
                                            (($passenger->Presence == -1) ?
                                           'color: red !important;' : 'lol')) }}"> {{ $passenger->customer->Name . ' ' . $passenger->customer->Surname . ' ' . $passenger->customer->Middle_Name }}</td>
                                <td>
                                    {{ ($passenger->Preferential_Terms == 1) ? 'Да' : 'Нет' }}
                                </td>
                                <td> {{ $passenger->tour->created_at }}</td>
                                <td>
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
                                    <span>
                                        <form id="Precence_True" action="{{ route('passengers.update', $passenger) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="_method" value="put">
                                            <input id="" type="hidden" name="Presence" value="1">
                                             <a  style="padding: 0 !important; border: none !important; font: inherit !important; color: inherit !important; background-color: transparent !important;"
                                                     onclick="{{ (
                                            ($passenger->Presence == 1) ?
                                           'alert_precence_true ()' :
                                            (($passenger->Presence == -1) ?
                                           'alert_occupaid_true_forfalse ()' : 'Precence_True_submit (Precence_True)'))
                                               }}"
                                                data-toggle="tooltip" data-placement="top" title="Присутствовал"><i class="fa fa-check color-muted m-r-5"></i>
                                             </a>

                                        </form>

                                        <form id="Precence_False" action="{{ route('passengers.update', $passenger) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input id="" type="hidden" name="Presence" value="-1">
                                            <input type="hidden" name="_method" value="put">
                                             <a style="padding: 0 !important; border: none !important; font: inherit !important; color: inherit !important; background-color: transparent !important;"
                                                     onclick="{{ (
                                            ($passenger->Presence == -1) ?
                                           'alert_occupaid_false ()' :
                                            (($passenger->Presence == 1) ?
                                           'alert_occupaid_false_fortrue ()' : 'Precence_True_submit (Precence_False)'))
                                               }}"
                                                     data-toggle="tooltip" data-placement="top" title="Отсутствовал"><i class="fa fa-upload color-muted m-r-5"></i>
                                        </a>
                                        </form>



                                        <form onsubmit="if(confirm('Удалить?')){return true}else{return false}" action="{{route('passengers.destroy',$passenger)}}" method="post">
                                            <input type="hidden" name="_method" value="DELETE">
                                            @csrf


                                            <button type="submit" style="padding: 0 !important; border: none !important; font: inherit !important; color: inherit !important; background-color: transparent !important;" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="fa fa-close color-danger"></i></button>
                                        </form>

                                    </span>
                                </td>

                            </tr>
                                @endforeach
                            </tbody>

                        </table>
                        @if($passengers->total() > $passengers->count())
                            <div class="bootstrap-pagination">
                                <nav>
                                    <ul class="pagination">
                                        {{ $passengers->links() }}
                                    </ul>
                                </nav>
                            </div>
                        @endif
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row card-header" style="padding-bottom: 25px ">
                            <div class="col-sm-12 col-md-3" >
                                <h4 class="">{{$tour->Name_Tours}} - Партнёры</h4>
                            </div>
                            <div class="col-sm-12 col-md-9">
                                <a href="" data-toggle="modal" data-target="#addArticle" class="btn btn-info btn-rounded btnheader" style="float: right;">Добавить</a>
                                <div class="modal fade" id="addArticle" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
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
                                                            <option value="{{ $partner->id }}" id="{{ $partner->id }}">{{$partner->Name_Partners}} {{$partner->type_activity->Name_Type_Activity ?? ''}}</option>
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
                                                <button type="button" class="btn btn-default"  data-dismiss="modal">Закрыть</button>
                                                <button type="button" id="save" data-idi="" onclick="create_Type_Activity()" class="btn btn-primary">Добавить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle">
                                <thead>
                                <tr>
                                    <th scope="col">Название</th>
                                    <th scope="col">Партнёр</th>
                                    <th scope="col">Договор</th>
                                    <th scope="col">Стоимость</th>
                                    <th scope="col">Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($passengers as $passenger)
                                    <tr>
                                        {{--Модельное окно для партнёров и работников--}}


                                        <td style="{{ ( ($passenger->Presence == 1) ?
                                           'color: green !important;' :
                                            (($passenger->Presence == -1) ?
                                           'color: red !important;' : 'lol')) }}"> {{ $passenger->customer->Name . ' ' . $passenger->customer->Surname . ' ' . $passenger->customer->Middle_Name }}</td>
                                        <td>
                                            {{ ($passenger->Preferential_Terms == 1) ? 'Да' : 'Нет' }}
                                        </td>
                                        <td> {{ $passenger->tour->created_at }}</td>
                                        <td>
                                            <script>
                                                function createType_Activity(id) {
                                                    document.getElementById('save').dataset.idi = id;
                                                };
                                                function create_Type_Activity() {
                                                    var Name_Type_Activity = $('#Name_Type_Activity').val();
                                                    $.ajax({
                                                        url: '{{ route('typeactivity.store') }}',
                                                        type: "POST",
                                                        data: {Name_Type_Activity: Name_Type_Activity},
                                                        headers: {
                                                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                        },

                                                        success: function (data) {
                                                            $('#Name_Type_Activity').val(' ');
                                                            $('#addArticle').modal('hide');
                                                            $('#articles-wrap').removeClass('hidden').addClass('show');
                                                            $('.alert').removeClass('show').addClass('hidden');
                                                            document.getElementsByName('select_type_activitie').forEach(function (select_select) {
                                                                select_select[select_select.length] = new Option(data['Name_Type_Activity'], data['id']);
                                                            });
                                                            alert('Добавлено');
                                                        },
                                                        error: function (msg) {
                                                            alert('Ошибка: заполните обязательные для ввода поля или данная запись уже существует.');
                                                        }
                                                    });
                                                };
                                                function delete_Type_Activity(id) {
                                                    var typeactivity = document.getElementById('select_type_activitie' + id).value;

                                                    $.ajax({
                                                        url: "{{route('typeactivity.destroy')}}",
                                                        type: "POST",
                                                        data: {typeactivity: typeactivity},
                                                        headers: {
                                                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                        },
                                                        success: function (datas) {
                                                            document.getElementsByName('select_type_activitie').forEach(function (select_select) {
                                                                select_select.removeChild(select_select.querySelector('[value="'+ typeactivity +'"]'));
                                                            });
                                                            document.getElementById('select_type_activitie' + id).value = 0;
                                                            document.getElementById('deletedbutton' + id).classList.add("diableddeletedbutton");
                                                            alert('Удалено');

                                                        },
                                                        error: function (msg) {
                                                            alert('Ошибка');
                                                        }
                                                    });
                                                };


                                                function cheng_type_activities(id) {
                                                    var type_activities_id = document.getElementById(id).value;
                                                    var partner_id = document.getElementById(id).dataset.value;

                                                    $.ajax({
                                                        url: "{{route('typeactivity.partner.update')}}",
                                                        type: "POST",
                                                        data: {type_activities_id:type_activities_id,partner_id:partner_id},
                                                        headers: {
                                                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                        },
                                                        success:function (data)
                                                        {
                                                        },
                                                        error: function (msg) {
                                                            alert('Ошибка');
                                                        }
                                                    });
                                                };

                                                $(function() {
                                                    document.getElementsByName('select_type_activitie').forEach(function (select_select) {
                                                        disable_disabled(select_select.dataset.idi)
                                                    });
                                                });
                                                function disable_disabled(id) {
                                                    var deletedbutton = document.getElementById('deletedbutton' + id);
                                                    if(document.getElementById('select_type_activitie' + id).value == "0") {
                                                        deletedbutton.classList.add("diableddeletedbutton");
                                                    } else {
                                                        deletedbutton.classList.remove("diableddeletedbutton");
                                                    }
                                                };
                                            </script>
                                            <span>
                                        <form id="Precence_True" action="{{ route('passengers.update', $passenger) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="_method" value="put">
                                            <input id="" type="hidden" name="Presence" value="1">
                                             <a  style="padding: 0 !important; border: none !important; font: inherit !important; color: inherit !important; background-color: transparent !important;"
                                                 onclick="{{ (
                                            ($passenger->Presence == 1) ?
                                           'alert_precence_true ()' :
                                            (($passenger->Presence == -1) ?
                                           'alert_occupaid_true_forfalse ()' : 'Precence_True_submit (Precence_True)'))
                                               }}"
                                                 data-toggle="tooltip" data-placement="top" title="Присутствовал"><i class="fa fa-check color-muted m-r-5"></i>
                                             </a>

                                        </form>

                                        <form id="Precence_False" action="{{ route('passengers.update', $passenger) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input id="" type="hidden" name="Presence" value="-1">
                                            <input type="hidden" name="_method" value="put">
                                             <a style="padding: 0 !important; border: none !important; font: inherit !important; color: inherit !important; background-color: transparent !important;"
                                                onclick="{{ (
                                            ($passenger->Presence == -1) ?
                                           'alert_occupaid_false ()' :
                                            (($passenger->Presence == 1) ?
                                           'alert_occupaid_false_fortrue ()' : 'Precence_True_submit (Precence_False)'))
                                               }}"
                                                data-toggle="tooltip" data-placement="top" title="Отсутствовал"><i class="fa fa-upload color-muted m-r-5"></i>
                                        </a>
                                        </form>



                                        <form onsubmit="if(confirm('Удалить?')){return true}else{return false}" action="{{route('passengers.destroy',$passenger)}}" method="post">
                                            <input type="hidden" name="_method" value="DELETE">
                                            @csrf


                                            <button type="submit" style="padding: 0 !important; border: none !important; font: inherit !important; color: inherit !important; background-color: transparent !important;" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="fa fa-close color-danger"></i></button>
                                        </form>

                                    </span>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                            @if($passengers->total() > $passengers->count())
                                <div class="bootstrap-pagination">
                                    <nav>
                                        <ul class="pagination">
                                            {{ $passengers->links() }}
                                        </ul>
                                    </nav>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row card-header" style="padding-bottom: 25px ">
                            <div class="col-sm-12 col-md-3" >
                                <h4 class="">{{$tour->Name_Tours}} - Работники</h4>
                            </div>
                            <div class="col-sm-12 col-md-9">
                                <a href="" data-toggle="modal" data-target="#addArticle1" class="btn btn-info btn-rounded btnheader" style="float: right;">Добавить</a>
                                <div class="modal fade" id="addArticle1" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addArticleLabel">Работники</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="employee_id">Работники<span class="text-danger">*</span></label>
                                                    <select class="custom-select @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id"  required>
                                                        <option value="0" disabled selected hidden>Партнёр</option>
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
                                                    <input  type="number" class="form-control @error('Salary') is-invalid @enderror" min="0" max="2147483647" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" name="Salary1" id="Salary1" placeholder="Стоимость">
                                                    @error('Salary')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="Occupied_Place_Bus">Место<span class="text-danger">*</span></label>
                                                    <input  type="number" class="form-control @error('Occupied_Place_Bus') is-invalid @enderror" min="0" max="32767" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==5) return false;" name="Occupied_Place_Bus" id="Occupied_Place_Bus" placeholder="Место">
                                                    @error('Occupied_Place_Bus')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="Confidentiality">Скрытый<span class="text-danger">*</span></label>
                                                    <input class="form-check-input" type="checkbox" id="Confidentiality" name="Confidentiality" style="margin-left: 5px !important; border: 1px solid #ced4da;" value="1" >
                                                    @error('Confidentiality')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"  data-dismiss="modal">Закрыть</button>
                                                <button type="button" id="save1" data-idi="" onclick="create_tour_employee()" class="btn btn-primary">Добавить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    function create_tour_employee() {
                                        var employee_id = $('#employee_id').val();
                                        var Salary = $('#Salary1').val();
                                        var Occupied_Place_Bus = $('#Occupied_Place_Bus').val();
                                        if ($('#Confidentiality').checked)
                                            var Confidentiality = 1;
                                        else
                                            var Confidentiality = 0;
                                        var tour_id = document.getElementById('idtour').dataset.idi;
                                        $.ajax({
                                            url: '{{ route('touremployee.store') }}',
                                            type: "POST",
                                            data: {employee_id:employee_id, Salary:Salary, Occupied_Place_Bus:Occupied_Place_Bus, Confidentiality:Confidentiality, tour_id:tour_id},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },

                                            success: function (data) {
                                                $('#Salary1').val('');
                                                $('#Occupied_Place_Bus').val('');
                                                $('#employee_id').val('0');
                                                $('#Confidentiality').attr('checked', false);
                                                $('#addArticle1').modal('hide');
                                                $('#articles-wrap').removeClass('hidden').addClass('show');
                                                $('.alert').removeClass('show').addClass('hidden');
                                                // document.getElementsByName('select_type_activitie').forEach(function (select_select) {
                                                //     select_select[select_select.length] = new Option(data['Name_Type_Activity'], data['id']);
                                                // });
                                                alert('Добавлено');
                                            },
                                            error: function (msg) {
                                                alert('Ошибка: заполните обязательные для ввода поля или данная запись уже существует.');
                                            }
                                        });
                                    };
                                    function delete_Type_Activity(id) {
                                        var typeactivity = document.getElementById('select_type_activitie' + id).value;

                                        $.ajax({
                                            url: "{{route('typeactivity.destroy')}}",
                                            type: "POST",
                                            data: {typeactivity: typeactivity},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success: function (datas) {
                                                document.getElementsByName('select_type_activitie').forEach(function (select_select) {
                                                    select_select.removeChild(select_select.querySelector('[value="'+ typeactivity +'"]'));
                                                });
                                                document.getElementById('select_type_activitie' + id).value = 0;
                                                document.getElementById('deletedbutton' + id).classList.add("diableddeletedbutton");
                                                alert('Удалено');

                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };


                                    function cheng_type_activities(id) {
                                        var type_activities_id = document.getElementById(id).value;
                                        var partner_id = document.getElementById(id).dataset.value;

                                        $.ajax({
                                            url: "{{route('typeactivity.partner.update')}}",
                                            type: "POST",
                                            data: {type_activities_id:type_activities_id,partner_id:partner_id},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success:function (data)
                                            {
                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };

                                    $(function() {
                                        document.getElementsByName('select_type_activitie').forEach(function (select_select) {
                                            disable_disabled(select_select.dataset.idi)
                                        });
                                    });
                                    function disable_disabled(id) {
                                        var deletedbutton = document.getElementById('deletedbutton' + id);
                                        if(document.getElementById('select_type_activitie' + id).value == "0") {
                                            deletedbutton.classList.add("diableddeletedbutton");
                                        } else {
                                            deletedbutton.classList.remove("diableddeletedbutton");
                                        }
                                    };
                                </script>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle">
                                <thead>
                                <tr>
                                    <th scope="col">ФИО</th>
                                    <th scope="col">Должность</th>
                                    <th scope="col">Место</th>
                                    <th scope="col">Стоимость</th>
                                    <th scope="col">Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($passengers as $passenger)
                                    <tr>
                                        <td style="{{ ( ($passenger->Presence == 1) ?
                                           'color: green !important;' :
                                            (($passenger->Presence == -1) ?
                                           'color: red !important;' : 'lol')) }}">
                                            {{ $passenger->customer->Name . ' ' . $passenger->customer->Surname . ' ' . $passenger->customer->Middle_Name }}
                                        </td>
                                        <td>
                                            {{ ($passenger->Preferential_Terms == 1) ? 'Да' : 'Нет' }}
                                        </td>
                                        <td>
                                            {{ $passenger->tour->created_at }}
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if($passengers->total() > $passengers->count())
                                <div class="bootstrap-pagination">
                                    <nav>
                                        <ul class="pagination">
                                            {{ $passengers->links() }}
                                        </ul>
                                    </nav>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection