@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row card-header" style="padding-bottom: 25px ">
                            <div class="col-sm-12 col-md-3" >
                                <h4 class="" >Экскурсии</h4>
                            </div>
                            <div class="col-sm-12 col-md-9">
                                <a href="{{ route('prnpriviewvauher') }}" id="prinvauher" class="btn btn-info btn-rounded btnheader" style="float: right" >Ваучер</a>
                                <a href="{{ route('prnpriviewspisok') }}" class="btn btn-info btn-rounded btnheader" style="float: right; margin-right: 3px">Список</a>
                                <a href="{{ route('tours.create') }}" class="btn btn-info btn-rounded btnheader"  style="float: right; margin-right: 3px">Создать Экскурсию</a>
                            </div>
                        </div>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $("#prinvauher").printPage({
                                    message:"Пожалуйста ожидайте!"
                                });
                            });

                            $("#search").keypress(function (e) {
                                if (e.which == 13) {
                                    $("#sadasd").submit();
                                    return false;    //<---- Add this line
                                }
                            });
                        </script>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle">
                                <thead>
                                <tr align="center">
                                    <th scope="col">Название</th>
                                    <th scope="col">Места</th>
                                    <th scope="col">Дата</th>
                                    <th scope="col">Цена</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($tours as $tour)
                                        <tr align="center">

                                            <td style="font-weight: bold"> <a href="{{ route('tours.show', $tour) }}">{{ $tour->Name_Tours }}</a></td>
                                            <td>
                                                <span title="Всего мест" style="font-weight: bold">{{ $tour->Amount_Place }}</span> : <span style="font-weight: bold; color: red;" title="Занято мест">{{ $tour->Occupied_Place }}</span> : <span style="font-weight: bold; color: green" title="Свободно мест">{{ ($tour->Amount_Place - $tour->Occupied_Place) }}</span>
                                            </td>
                                            <td style="{{ $tour->Start_Date_Tours < now()->subDay() ? 'color: green' : 'color: black' }}">@if($tour->End_Date_Tours != null) c @endif {{  date('d.m.Y H:i', strtotime($tour->Start_Date_Tours)) }} @if($tour->End_Date_Tours != null) <p style="margin: 0">по {{date('d.m.Y H:i', strtotime($tour->End_Date_Tours))}}</p> @endif</td>
                                            <td>{{ number_format($tour->Price, 0, ',', ' ') }}₽
                                                @if($tour->Privilegens_Price != null)<p title="Пенсионная цена" style="margin: 0">ПЦ: {{ number_format($tour->Privilegens_Price, 0, ',', ' ') }}₽</p> @endif
                                                @if($tour->Children_price != null) <p title="Цена для детей" style="margin: 0">ЦДД: {{ number_format($tour->Children_price, 0, ',', ' ') }}₽</p> @endif
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
        </div>
    </div>

@endsection