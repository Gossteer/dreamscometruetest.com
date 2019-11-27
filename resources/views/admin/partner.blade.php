@extends('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">


                <div class="table-responsive">
                    <table class="table table-bordered table-striped verticle-middle">
                        <thead>
                        <tr>
                            <td colspan="4" style="border:none"><h4 class="card-title">Партнёры</h4></td>
                            <td colspan="3" align="right" style="border:none"><a href="{{ route('partners.create') }}" class="btn btn-info btn-rounded" style="margin-bottom: 10px; ">Создать</a></td>
                        </tr>
                        <tr align="center">
                            <th scope="col">Название</th>
                            <th scope="col">Тип занятости</th>
                            <th scope="col">Адрес</th>
                            <th scope="col">Номер телефона</th>
                            <th scope="col">Email</th>
                            <th scope="col">Сайт</th>
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
                                    <p style="margin-bottom: 0;">
                                        @if (count($partner->address) > 1)
                                      {{ ++$index }}.
                                        @endif
                                        {{ $addresses->Address }}@if (count($partner->address) > 1); @endif
                                    </p>
                                @endforeach
                            </td>

                            <td {{ $index = 0 }}>
                                @foreach($partner->phone_nomber as $phone_nombers)
                                    <p style="margin-bottom: 0;">

                                        @if (count($partner->phone_nomber) > 1)
                                            {{ ++$index }}.
                                        @endif
                                           {{ $phone_nombers->Phone_Number }} - {{ $phone_nombers->Representative }} @if (count($partner->phone_nomber) > 1); @endif
                                    </p>
                                @endforeach

                            </td>

                            <td {{ $index = 0 }}>
                                @foreach($partner->email as $emails)
                                    <p style="margin-bottom: 0;">

                                        @if (count($partner->email) > 1)
                                                 {{ ++$index }}.
                                             @endif
                                            {{  $emails->Email }} - {{  $emails->Representative_Email }}@if (count($partner->email) > 1); @endif
                                    </p>
                                @endforeach
                            </td>

                            <td {{ $index = 0 }}>
                                @foreach($partner->website as $websites)
                                    <p style="margin-bottom: 0;">
                                        @if (count($partner->website) > 1)
                                            {{ ++$index }}.
                                        @endif
                                        {{ $websites->Site }}@if (count($partner->website) > 1); @endif
                                    </p>
                                @endforeach
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