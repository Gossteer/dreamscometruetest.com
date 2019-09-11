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
                <tr><th>Название</th><th>Стоимость</th><th>Место посадки</th><th>Дата</th></tr>
                @foreach($tours as $tour)
                    <tr><td>{{ $tour->Name_Tours }}</td>
                        <td>{{ $tour->Price }}</td>
                        <td>Около 'ДК МИР'</td>
                        <td>{{ $tour->Start_Date_Tours }}</td> </tr>
                @endforeach
            </table>
        </center>
        <h4>Номер телефон: 213123123</h4>
        <h4>Группа вконтакте: Мечты Сбываются</h4>
    </div>
</div>
</body>
</html>