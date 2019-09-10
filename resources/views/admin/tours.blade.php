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
                            <th scope="col">Сотрудники</th>
                            <th scope="col">Партнёры</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tours as $tour)
                        <tr>

                                <td> <a href="{{ route('tours.show', $tour) }}">{{ $tour->Name_Tours }}</a></td>
                            <td>
                                {{ ($tour->Amount_Place - $tour->Occupied_Place) }}
                            </td>
                            <td> {{ $tour->Start_Date_Tours }}</td>
                            <td><span class="label gradient-1 btn-rounded">{{ $tour->Price }} ₽</span>
                            </td>
                            <td>
                                <a class="label gradient-1 btn-rounded" href="{{ route('jobsindex', [$tour]) }}">Посмотреть</a>
                            </td>
                            <td>
                                <a class="label gradient-1 btn-rounded" href="{{ route('contractsindex', [$tour]) }}">Посмотреть</a>
                            </td>
                            <td>
                                <span>
                                    <form onsubmit="if(confirm('Удалить?')){return true}else{return false}" action="{{route('tours.destroy',$tour)}}" method="post">
                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf
                                        <a href="{{ route('tours.edit', $tour) }}" data-toggle="tooltip" data-placement="top" title="Редактировать"><i class="fa fa-pencil color-muted m-r-5"></i>
                                    </a>
                                        <button type="submit" style="padding: 0 !important; border: none !important; font: inherit !important; color: inherit !important; background-color: transparent !important;" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="fa fa-close color-danger"></i></button>
                                    </form>

                                </span>
                            </td>

                        </tr>
                            @endforeach
                        </tbody>

                    </table>
                    @if($tours->total() > $tours->count())
                        <div class="bootstrap-pagination">
                            <nav>
                                <ul class="pagination">
                                    {{ $tours->links() }}
                                </ul>
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection