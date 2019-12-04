@extends('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Работники</h4>

                <form class="form-valide" action="{{ route('jobsstore', $tour) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row align-items-center" style="margin-bottom: 10px; padding-left: 44% !important;">
                        <div class="col-auto my-1">
                            <select class="custom-select mr-sm-2" name="employee_id" id="inlineFormCustomSelect">
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->Name . ' ' . $employee->Surname .
                                ' ' . $employee->Middle_Name }} Должность:  @if($employee->jobs_id != null && isset($employee->job)){{$employee->job->Company}} {{ $employee->job->Job_Title}} зп: {{( ($employee->job->Salary == null)? 'договорная': $employee->job->Salary . 'р')}}
                                        @else
                                            Не назначен
                                        @endif</option>
                                @endforeach
                            </select>

                        </div>
                        <button type="submit" class="btn btn-info btn-rounded" style="">Добавить</button>
                    </div>

                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped verticle-middle">
                        <thead>
                        <tr>
                            <th scope="col">ФИО</th>
                            <th scope="col">Должность</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jobs_for_tour as $job_for_tour)
                        <tr>

                                <td> {{ ($job_for_tour)->employee->Name . ' ' . ($job_for_tour)->employee->Surname . ' ' . ($job_for_tour)->employee->Middle_Name  }}</td>
                            <td>
                                {{ ($job_for_tour)->employee->job->Job_Title }}
                            </td>
                            <td>
                                <span>
                                    <form onsubmit="if(confirm('Удалить?')){return true}else{return false}" action="{{route('jobsdestroy', [$tour, $job_for_tour])}}" method="post">
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
                </div>
            </div>
        </div>
    </div>


@endsection