@extends('layouts.admin')

@section('content')
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="row card-title">Работники
                        <a href="{{ route('employees.create') }}" class="col-2 btn btn-info btn-rounded" style="margin-bottom: 10px; margin-left: 70%;">Добавить работника</a>
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped verticle-middle">
                            <thead>
                            <tr>
                                <th scope="col">ФИО</th>
                                <th scope="col">Дата рождения</th>
                                <th scope="col">Номер телефона</th>
                                <th scope="col">Должность</th>
                                <th scope="col">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                <tr>

                                    <td title="{{ $employee->Surname . ' ' . $employee->Name  . ' ' . $employee->Middle_Name}}">
                                        <a data-toggle="modal" data-target="#addArticle" class="selectedbutton" style="cursor: pointer" >{{ $employee->Surname . ' ' . mb_substr($employee->Name, 0, 1)  . '. ' . mb_substr($employee->Middle_Name, 0, 1) . ($employee->Middle_Name != '' ? '.' : '') }}</a>
                                    </td>
                                    <td>
                                        {{  date('d.m.Y', strtotime($employee->Byrthday)) }}
                                    </td>
                                    <td> {{ $employee->Phone_Number }}</td>

                                    <td><span class="label gradient-1 btn-rounded">
                                           @if($employee->jobs_id != null)
                                                {{$employee->job->Company}} {{ $employee->job->Job_Title}} зп: {{( ($employee->job->Salary == null)? 'договорная': $employee->job->Salary . 'р')}}
                                               @else
                                               Неназначен
                                               @endif

                                        </span>
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
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addArticleLabel"> ФИО</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="Job_Title">Договор</label>
                                            </div>
                                            <div class="form-group">
                                                <label for="Salary">Совместных экскурсий: </label>
                                                {{--Разварачивать список с совместными экскурсиями, с пагинацией--}}
                                            </div>
                                            <div class="form-group">
                                                <label for="Company">Разрешение на набор: </label>
                                            </div>
                                            <div class="form-group">
                                                <label for="Company">Приведено клиентов: </label>
                                            </div>
                                            <div class="form-group">
                                                <label for="Company">Название компании</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" id="close" name="close" data-dismiss="modal">Закрыть</button>
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


@endsection
