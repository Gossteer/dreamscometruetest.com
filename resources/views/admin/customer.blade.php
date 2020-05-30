@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row card-header" style="padding-bottom: 25px ">
                            <div class="col-sm-12 col-md-6" >
                                <h4 class="" >Работники</h4>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <a href="{{ route('customer.create') }}" class="btn btn-info btn-rounded btnheader" style="float: right">Добавить Клиента</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle">
                                <thead>
                                <tr align="center">
                                    <th scope="col" colspan="2">ФИО</th>
                                    <th scope="col">Номер телефона</th>
                                    <th scope="col">Состояние</th>
                                    <th scope="col">Предпочтения</th>
                                    <th scope="col">Дата рождение</th>
                                    <th scope="col">Дни</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td style="border-right: #fff0ff; width: 50px"><img style="float: left;" src="{{ asset('images/2.jpg') }}" alt=""></td>
                                        <td style="border-left: #fff0ff; padding-left: 0px; width: 150px" title="{{ $customer->Surname . ' ' . $customer->Name  . ' ' . $customer->Middle_Name}}">
                                            <a href="" style="float: left" data-toggle="modal" data-target="#addArticle" id="fullindex" data-id="{{ $customer->id }}" onclick="indexfull(this.dataset.id)">{{ $customer->Surname . ' ' . mb_substr($customer->Name, 0, 1)  . '. ' . mb_substr($customer->Middle_Name, 0, 1) . ($customer->Middle_Name != '' ? '.' : '') }}</a>
                                        </td>
                                        <td align="center">
                                            {{ $customer->Phone_Number_Customer  }}
                                        </td>
                                        <td align="center">
                                            @switch($customer->Condition)
                                                @case(-1)
                                                <span style="color: red;"><strong>Ненадёжный</strong></span>
                                                    @break
                                                @case(0)
                                                <span style="">Неподтверждён</span>
                                                @break
                                                @case(1)
                                                <span style="color: green;"><strong>Подверждён</strong></span>
                                                @break
                                                @case(2)
                                                <span style="color: gold;"><strong>Золотой клиент</strong></span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td align="center">
                                            @if($customer->Preferred_Type_Tours == null)
                                                Неопределены
                                                @else
                                                {{$customer->Preferred_Type_Tours}}
                                            @endif
                                        </td>
                                        <td align="center"> {{  date('d-m-Y', strtotime($customer->Date_Birth_Customer)) }}</td>
                                        <td align="center"><span style="color:">{{ $customer->Black_Days }} ;</span> <span style="color: green"><strong>{{ $customer->White_Days }}</strong> </span>
                                        </td>
                                        <td>
                                        <span>
                                            <form onsubmit="if(confirm('Удалить?')){return true}else{return false}" action="{{route('customer.destroy',$customer)}}" method="post">
                                                <input type="hidden" name="_method" value="DELETE">
                                                @csrf
                                                <a href="{{ route('customer.edit', $customer) }}" data-toggle="tooltip" data-placement="top" title="Редактировать"><i class="fa fa-pencil color-muted m-r-5"></i></a>
                                                <button id="buttonfordeleted" type="submit" style="padding: 0 !important; border: none !important; font: inherit !important; color: inherit !important; background-color: transparent !important;" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="fa fa-trash color-danger"></i></button>
                                            </form>
                                        </span>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                                <script>
                                    function indexfull(id){
                                        $.ajax({
                                            url: "{{route('customer.index.full')}}",
                                            type: "POST",
                                            data: {customer:id},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success:function (data)
                                            {
                                                if (data['Phone_Customer_Inviter'] != null)
                                                {
                                                    Phone_Customer_Inviter_div.hidden = false;
                                                    Phone_Customer_Inviter.innerHTML = data['Phone_Customer_Inviter'];
                                                    Phone_Customer_Inviter.title = data['Phone_Customer_Inviter_Title'];
                                                }
                                                else
                                                {
                                                    Phone_Customer_Inviter_div.hidden = true;
                                                }

                                                if ((data['Age_customer'] >= 65 && data['floor'] == 'М') || (data['Age_customer'] >= 60 && data['floor'] == 'Ж'))
                                                {
                                                    Age_Group.style.color = 'red';
                                                    Age_Group.innerHTML = 'Да';
                                                }
                                                else
                                                {
                                                    Age_Group.style.color = 'black';
                                                    Age_Group.innerHTML = 'Нет';
                                                }

                                                if (data['sources_customer'] != null)
                                                {
                                                    sources_customer_div.hidden = false;
                                                    sources_customer.innerHTML = data['sources_customer'];
                                                }
                                                else
                                                {
                                                    sources_customer_div.hidden = true;
                                                }

                                                White_Days.innerHTML = data['White_Days'];
                                                The_amount_of_tokens_spent.innerHTML = data['The_amount_of_tokens_spent'];
                                                Amount_Customers_Listed.innerHTML = data['Amount_Customers_Listed'];
                                                floor.innerHTML = data['floor'];
                                                Description_customer.innerHTML = data['Description'] == null ? 'Отсутствует' : data['Description'];
                                                login_customer.innerHTML = data['login'];
                                                email_customer.innerHTML = data['email'];
                                                Debt.innerHTML = data['Debt'];
                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };
                                    function closeindexfull(){
                                        White_Days.innerHTML = '';
                                        The_amount_of_tokens_spent.innerHTML = '';
                                        Amount_Customers_Listed.innerHTML = '';
                                        Phone_Customer_Inviter.innerHTML = '';
                                        Phone_Customer_Inviter.title = '';
                                        Age_Group.innerHTML = '';
                                        Description_customer.innerHTML = '';
                                        login_customer.innerHTML = '';
                                        email_customer.innerHTML = '';
                                        Debt.innerHTML = '';
                                        floor.innerHTML ='';
                                    };
                                </script>

                                <div class="modal fade" id="addArticle" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
                                    <div class="modal-dialog"  role="document">
                                        <div class="modal-content" style="">
                                            <div class="modal-header" style="justify-content: center; text-align: center;">
                                                <h4 class="modal-title"  id="FIO"></h4>
                                            </div>
                                            <div class="row modal-body" style="padding-bottom: 0">
                                                <div class="col dialogfontsize" style="font-size: 15px;">
                                                    <div class="form-group" id="Phone_Customer_Inviter_div">
                                                        <label>Кто пригласил: <label id="Phone_Customer_Inviter" title=""></label></label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Совместных экскурсий: <label id="White_Days"></label></label>
                                                        {{--Разварачивать список с совместными экскурсиями, с пагинацией--}}
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Потраченных билетов: <label id="The_amount_of_tokens_spent"></label></label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Приведено клиентов: <label id="Amount_Customers_Listed"></label></label>
                                                        {{--Списком выводить - кого пригласили--}}
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Пол: <label id="floor" ></label></label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Задолжности: <label id="Debt"></label>₽</label>
                                                    </div>
                                                </div>
                                                <div class="col dialogfontsize" style="font-size: 15px;">
                                                    <div class="form-group" >
                                                        <label >Логин: <label  id="login_customer"></label></label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label >Почта: <label  id="email_customer"></label></label>
                                                    </div>
                                                    <div class="form-group" id="sources_customer_div">
                                                        <label >Откуда узнали: <label  id="sources_customer"></label></label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Льготник: <label id="Age_Group"></label></label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label >Описание: <label style="display: contents;" id="Description_customer"></label></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row modal-footer" style="justify-content: center; margin: 0;">
                                                <button type="button" class="col-md-10 btn btn-default" id="close" name="close" onclick="closeindexfull()" data-dismiss="modal">Закрыть</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </table>
                        </div>
                        @if($customers->total() > $customers->count())
                        <div class="row mt-3 justify-content-center">
                            <div class="bootstrap-pagination" >
                                <nav>
                                    <ul class="pagination">
                                        {{ $customers->links() }}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
