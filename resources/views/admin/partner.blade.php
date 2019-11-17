@extends('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Партнёры <a href="{{ route('partners.create') }}" class="btn btn-info btn-rounded" style="margin-bottom: 10px; margin-left: 70%;">Создать</a></h4>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped verticle-middle">
                        <thead>
                        <tr>
                            <th scope="col">Название</th>
                            <th scope="col">Тип занятости</th>
                            <th scope="col">Адрес</th>
                            <th scope="col">Номер телефона</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($partners as $partner)
                        <tr>

                                <td> {{ $partner->Name_Partners }}</td>
                            <td>
                                {{ $partner->type_activity->Name_Type_Activity }}
                            </td>

                            <td {{ $index = 0 }}>
                                @foreach($partner->address as $addresses)
                                    <p>
                                        @if (count($partner->address) > 1)
                                      {{ ++$index }}.
                                        @endif
                                        {{ $addresses->Address }}@if (count($partner->address) > 1); @endif
                                    </p>
                                @endforeach
                            </td>

                            <td><span class="label gradient-1 btn-rounded">{{ $partner->Phone_Number }}</span>
                            </td>

                            <td>
                                <span>
                                    <form onsubmit="if(confirm('Удалить?')){return true}else{return false}" action="{{route('partners.destroy',$partner)}}" method="post">
                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf
                                        <a href="{{ route('partners.edit', $partner) }}" data-toggle="tooltip" data-placement="top" title="Редактировать"><i class="fa fa-pencil color-muted m-r-5"></i>
                                    </a>
                                        <button type="submit" style="padding: 0 !important; border: none !important; font: inherit !important; color: inherit !important; background-color: transparent !important;" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="fa fa-close color-danger"></i></button>
                                    </form>

                                </span>
                            </td>

                        </tr>
                            @endforeach
                        </tbody>

                    </table>
                    @if($partners->total() > $partners->count())
                        <div class="bootstrap-pagination">
                            <nav>
                                <ul class="pagination">
                                    {{ $partners->links() }}
                                </ul>
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection