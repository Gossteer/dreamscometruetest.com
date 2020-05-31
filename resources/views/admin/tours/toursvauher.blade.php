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
            <h1 style="padding-bottom: 20px !important;">Мечты сбываются </h1>
            <table class="table" >
                <tr><th>Название</th><th>Стоимость</th><th>Место отправления</th><th>Дата</th></tr>
                @foreach($tours as $tour)
                    <tr><td>{{ $tour->Name_Tours }}</td>
                        <td>{{ number_format((($tour->Privilegens_Price > $tour->Children_price and $tour->Children_price != null) ? $tour->Children_price : $tour->Privilegens_Price) ?? $tour->Price, 0, ',', ' ') }}₽{{(($tour->Privilegens_Price > $tour->Children_price and $tour->Children_price != null) ? '*' : '*') ?? ''}}</td>
                        <td>{{ $tour->Start_point ?? "ДК МИР" }}</td>
                        <td>{{ date('Y.m.d H:i', strtotime($tour->Start_Date_Tours)) }}</td> </tr>
                @endforeach
            </table>
        </center>
        <h5>Номер телефон: +7(903)222-76-59</h5>
        <h5>Социальные сети:</h5>
        <h6 style="padding-left: 10px">1. Вконтакте: Мечты Сбываются | Домодедово | Видное </h6>
        <h6 style="padding-left: 10px">2. Инстаграмм: elena_mehtu_sbuvaytsa</h6>
        <h6 style="padding-left: 10px">3. Facebook: Турагенство Мечты Сбываются</h6>
        <h6 style="padding-left: 10px">4. Одноклассники: Турагентство Мечты Сбываются, г.Домодедово</h6>
        
    </div>
</div>
</body>
</html>