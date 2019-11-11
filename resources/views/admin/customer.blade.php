@extends('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Клиенты <a href="{{ route('customer.create') }}" class="btn btn-info btn-rounded" style="margin-bottom: 10px; margin-left: 70%;">Создать</a></h4>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped verticle-middle">
                        <thead>
                        <tr>
                            <th scope="col">ФИО</th>
                            <th scope="col">Номер телефона</th>
                            <th scope="col">День рождение</th>
                            <th scope="col">Дни</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $customer)
                            <tr>

                                <td> {{ $customer->Name . ' ' . $customer->Surname . ' ' . $customer->Middle_Name }}</td>
                                <td>
                                    {{ $customer->Phone_Number_Customer  }}
                                </td>
                                <td> {{  date('d-m-Y', strtotime($customer->Date_Birth_Customer)) }}</td>
                                <td><span style="color: #0b0b0b">{{ $customer->Black_Days }} ;</span> <span style="color: #00FFFF">{{ $customer->White_Days }}</span>
                                </td>
                                <td>
                                <span>

                                     <form onsubmit="if(confirm('Удалить?')){return true}else{return false}" action="{{route('customer.destroy',$customer)}}" method="post">
                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf
                                         <a href="{{ route('customer.edit', $customer) }}" data-toggle="tooltip" data-placement="top" title="Редактировать"><i class="fa fa-pencil color-muted m-r-5"></i></a>
                                        <button id="buttonfordeleted" type="submit" style="padding: 0 !important; border: none !important; font: inherit !important; color: inherit !important; background-color: transparent !important;" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="fa fa-close color-danger"></i></button>
                                    </form>
                                </span>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    @if($customers->total() > $customers->count())
                        <div class="bootstrap-pagination">
                            <nav>
                                <ul class="pagination">
                                    {{ $customers->links() }}
                                </ul>
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection