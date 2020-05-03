@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body" >
                        <div class="row card-header" style="padding-bottom: 25px ">
                            <div class="col-sm-12 col-md-6" >
                                <h4 class="" >Работники</h4>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <a href="{{ route('employees.create') }}" class="btn btn-info btn-rounded btnheader" style="float: right">Добавить работника</a>
                            </div>
                        </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped verticle-middle">
                            <thead>
                            <tr align="center">
                                <th scope="col" colspan="2">ФИО</th>
                                <th scope="col">Дата рождения</th>
                                <th scope="col">Номер телефона</th>
                                <th scope="col">Должность</th>
                                <th scope="col">Уровень</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                <tr align="center"  >
                                    <td style="border-right: #fff0ff; width: 50px"><img style="float: left" src="{{ asset('images/2.jpg') }}" alt=""></td>
                                    <td style="border-left: #fff0ff; width: 150px; padding-left: 0px" title="{{ $employee->Surname . ' ' . $employee->Name  . ' ' . $employee->Middle_Name}}">
                                    <a href="" style="float: left" data-toggle="modal" data-target="#addArticle" id="fullindex" data-id="{{ $employee->id }}" onclick="indexfull(this.dataset.id)">{{ $employee->Surname . ' ' . mb_substr($employee->Name, 0, 1)  . '. ' . mb_substr($employee->Middle_Name, 0, 1) . ($employee->Middle_Name != '' ? '.' : '') }}</a>
                                    </td>
                                    <script>
                                        function indexfull(id){
                                            $.ajax({
                                                url: "{{route('employees.index.full')}}",
                                                type: "POST",
                                                data: {employeeid:id},
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success:function (data)
                                                {
                                                    Joint_excursions.innerHTML = data['Joint_excursions'];
                                                    if(data['Set_Permission'] == 0 ){
                                                        Set_Permission.style.color = "red";
                                                        Set_Permission.innerHTML = 'Нет';
                                                    }
                                                    else{
                                                        Set_Permission.style.color = "green";
                                                        Set_Permission.innerHTML = 'Нет';
                                                    }

                                                    Man_brought.innerHTML = data['Man_brought'];
                                                    FIO.innerHTML = data['FIO'];
                                                    Description_employee.innerHTML = data['Description'];
                                                    login_employee.innerHTML = data['login'];
                                                    email_employee.innerHTML = data['email'];
                                                    type_user_employee.innerHTML = data['Type_User'];
                                                },
                                                error: function (msg) {
                                                    alert('Ошибка');
                                                }
                                            });
                                        };
                                        function closeindexfull(){
                                            Joint_excursions.innerHTML = '';
                                            Set_Permission.innerHTML = '';
                                            Man_brought.innerHTML = '';
                                            FIO.innerHTML = '';
                                            Description_employee.innerHTML = '';
                                            login_employee.innerHTML = '';
                                            email_employee.innerHTML = '';
                                            type_user_employee.innerHTML = '';
                                        };
                                    </script>
                                    <td>
                                        {{  date('d.m.Y', strtotime($employee->Byrthday)) }}
                                    </td>
                                    <td> {{ $employee->Phone_Number }}</td>

                                    <td>
                                        <span class="label gradient-1 btn-rounded">
                                           @if($employee->jobs_id != null && isset($employee->job))
                                                {{$employee->job->Company}} {{ $employee->job->Job_Title}} зп: {{(($employee->job->Salary == null)? 'договорная': number_format($employee->job->Salary, 0, ',', ' ') . '₽')}}
                                               @else
                                               Не назначена
                                               @endif
                                        </span>
                                    </td>

                                    <td>
                                        {{  $employee->Level }}
                                    </td>

                                    <td>
                                <span>
                                    <form onsubmit="if(confirm('Удалить?')){return true}else{return false}" action="{{route('employees.destroy',$employee)}}" method="post">
                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf
                                        <a href="{{ route('employees.edit', $employee) }}" data-toggle="tooltip" data-placement="top" title="Редактировать"><i class="fa fa-pencil color-muted m-r-5"></i>
                                    </a>
                                        <button type="submit" data-toggle="tooltip" style="padding: 0 !important; border: none !important; font: inherit !important; color: inherit !important; background-color: transparent !important;" data-placement="top" title="Удалить"><i class="fa fa-close color-danger"></i></button>
                                    </form>
                                </span>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>

                            <div class="modal fade" id="addArticle" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
                                <div class="modal-dialog"  role="document">
                                    <div class="modal-content" style="">
                                        <div class="modal-header" style="justify-content: center; text-align: center;">
                                            <h4 class="modal-title"  id="FIO"></h4>
                                        </div>
                                        <div class="row modal-body" style="padding-bottom: 0">
                                            <div class="col dialogfontsize" style="font-size: 15px;">
                                                <div class="form-group">
                                                    <label>Договор</label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Совместных экскурсий: <label id="Joint_excursions"></label></label>
                                                    {{--Разварачивать список с совместными экскурсиями, с пагинацией--}}
                                                </div>
                                                <div class="form-group">
                                                    <label>Разрешение на набор: <label id="Set_Permission"></label></label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Приведено клиентов: <label id="Man_brought"></label></label>
                                                </div>

                                            </div>
                                            <div class="col dialogfontsize" style="font-size: 15px;">
                                                <div class="form-group" >
                                                    <label >Логин: <label  id="login_employee"></label></label>
                                                </div>
                                                <div class="form-group">
                                                    <label >Почта: <label  id="email_employee"></label></label>
                                                </div>
                                                <div class="form-group">
                                                    <label >Доступ к административной панели: <label  id="type_user_employee"></label></label>
                                                </div>
                                                <div class="form-group">
                                                    <label >Описание: <label style="display: contents;" id="Description_employee"></label></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row modal-footer" style="justify-content: center; margin: 0;">
                                            <button type="button" class="col-md-10 btn btn-default" id="close" name="close" onclick="closeindexfull()" data-dismiss="modal">Закрыть</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </table>
                        @if($employees->total() > $employees->count())
                            <div class="bootstrap-pagination">
                                <nav>
                                    <ul class="pagination">
                                        {{ $employees->links() }}
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
