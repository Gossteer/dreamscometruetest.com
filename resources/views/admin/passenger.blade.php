@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row card-header" style="padding-bottom: 25px ">
                            <div class="col-sm-12 col-md-3" >
                                <h4 class="">{{$tour->Name_Tours}}</h4>
                            </div>
                            <div class="col-sm-12 col-md-9">
                                <a href="{{ route('jobsindex', [$tour]) }}" class="btn btn-info btn-rounded btnheader" style="float: right">Работники</a>
                                <a href="{{ route('contractsindex', [$tour]) }}" class="btn btn-info btn-rounded btnheader" style="float: right; margin-right: 3px">Партнёры</a>
                                <a href="{{ route('printpastour', [$tour]) }}" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-rounded btnheader" style="float: right; margin-right: 3px">Список пассажиров</a>
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

                                <td style="{{ ( ($passenger->Presence == 1) ?
                                           'color: green !important;' :
                                            (($passenger->Presence == -1) ?
                                           'color: red !important;' : 'lol')) }}"> {{ $passenger->customer->Name . ' ' . $passenger->customer->Surname . ' ' . $passenger->customer->Middle_Name }}</td>
                                <td>
                                    {{ ($passenger->Preferential_Terms == 1) ? 'Да' : 'Нет' }}
                                </td>
                                <td> {{ $passenger->tour->created_at }}</td>
                                <td>
                                    <span>
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
    </div>


@endsection