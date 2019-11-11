@extends('layouts.admin')

@section('content')
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="row card-title">Работники
                        <a href="{{ route('employees.create') }}" class="col-2 btn btn-info btn-rounded" style="margin-bottom: 10px; margin-left: 70%;">Добавить работника</a>
                                    <form id="sadasd" action="{{route('employees.index')}}" class="col-2" method="get">
                                        <select class="custom-select mr-sm-2 form-control" name="search" id="inlineFormCustomSelect">
                                            <option  value="" disabled selected>Фильтрация</option>
                                            <option  value="">Отменить</option>
                                            @foreach($jobs as $job)
                                                <option  value="{{ $job->id }}">{{ $job->Job_Title . ' зп: ' .  $job->Salary}}</option>
                                            @endforeach
                                        </select>
                                    </form>
                        <script>
                            $('select[name="search"]').change(function () {
                                $("#sadasd").submit();
                            });
                        </script>
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

                                    <td> {{ $employee->Name . ' ' . $employee->Surname . ' ' . $employee->Middle_Name}}</td>
                                    <td>
                                        {{  date('d-m-Y', strtotime($employee->Byrthday)) }}
                                    </td>
                                    <td> {{ $employee->Phone_Number }}</td>

                                    <td><span class="label gradient-1 btn-rounded">
                                           @if($employee->jobs_id != null)
                                                {{ $employee->job->Job_Title . ' зп: ' . $employee->job->Salary }}
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
