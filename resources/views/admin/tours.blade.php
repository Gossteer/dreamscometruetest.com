@extends('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Экскурсии <a href="{{ route('tours.create') }}" class="btn btn-info btn-rounded" style="margin-bottom: 10px; margin-left: 70%;">Создать</a></h4>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped verticle-middle">
                        <thead>
                        <tr>
                            <th scope="col">Название</th>
                            <th scope="col">Свободных мест</th>
                            <th scope="col">Дата</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tours as $tour)
                        <tr>

                            <td> {{ $tour->Name_Tours }}</td>
                            <td>
                                {{ ($tour->Amount_Place - $tour->Occupied_Place) }}
                            </td>
                            <td> {{ $tour->Start_Date_Tours }}</td>
                            <td><span class="label gradient-1 btn-rounded">{{ $tour->Price }} р</span>
                            </td>
                            <td>
                                <span><a href="#" data-toggle="tooltip" data-placement="top" title="Редактировать"><i class="fa fa-pencil color-muted m-r-5"></i>
                                    </a><a href="#" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="fa fa-close color-danger"></i></a>
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