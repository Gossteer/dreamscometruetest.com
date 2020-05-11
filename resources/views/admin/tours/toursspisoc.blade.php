<html>
<head>
    <link href="{{ asset('css/bootstrap.css') }}" rel='stylesheet' type='text/css' /><!-- bootstrap css -->

    <script src="{{ asset('js/bootstrap.js') }}" defer></script>

</head>
<body>

<div class="container">
    <div class="col-md-12">
        <center>
            <br><br>
        </center>
        <center>
            <h1 style="padding-bottom: 20px !important;" >Мечты сбываются </h1>
            <table class="table" >
                <tr><th>Название</th><th>Стоимость</th><th>Место посадки</th><th>Дата</th><th>Работники</th><th>Партнёры</th></tr>
                @foreach($tours as $tour)
                    <tr>
                        <td>{{ $tour->Name_Tours }}</td>
                        <td>{{ $tour->Price }}</td>
                        <td>{{ $tour->Privilegens_Price ?? "ДК МИР" }}</td>
                        <td>{{ date('Y.m.d H:i', strtotime($tour->Start_Date_Tours)) }}</td>

                        <td width="33">
                            @if($tour->tour_employees->count() != 0)
                            @foreach($tour->tour_employees as $lol)
                            <br>{{ $lol->employee->Name . ' ' . $lol->employee->Surname . ' ' . $lol->employee->Middle_Name . ';'}}
                            @endforeach
                            @else
                                Отсутствуют
                            @endif
                        </td>

                        <td width="33">
                            @if($tour->contract->count() != 0)
                            @foreach($tour->contract as $lol)
                                <br>{{ $lol->partner->Name_Partners .';'}}
                            @endforeach
                                @else
                            Отсутствуют
                                @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </center>
    </div>
</div>
</body>
</html>