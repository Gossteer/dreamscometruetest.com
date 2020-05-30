@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if ($tour->Confirmation_Tours == 0)
                        <div class="card-body">
                            <div class="row card-header" style="padding-bottom: 25px ">
                                <div class="col-sm-12 col-md-7" >
                                    <h4 class=""><a href="{{ route('tours.edit', $tour) }}">{{ $tour->Name_Tours }}</a></h4>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle text-center">
                                    <thead>
                                    <tr>
                                        <th scope="col">ФИО</th>
                                        <th scope="col" title="Способ оплаты">С.О.</th>
                                        <th scope="col">Оплата</th>
                                        <th scope="col">Присутствие</th>
                                        <th scope="col" title="Ваш комментарий">В.К.</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Passengers as $Passenger)
                                        <tr>
                                            <td> <a href="{{ route('customer.edit', $Passenger->customer->id) }}" title="Просмотреть">{{ $Passenger->customer->Name . ' ' . $Passenger->customer->Surname . ' ' . $Passenger->customer->Middle_Name ?? '' }}</a></td>
                                            <td>
                                                <div class="input-group" style="">
                                                    <select  class="custom-select  @error('Payment_method') is-invalid @enderror" data-idi="{{$Passenger->id}}" id="Payment_method{{$Passenger->id}}"  data-value="" onchange="chenchatribut(this.value,this.dataset.idi,0,this.id)" name="Payment_method" required>
                                                        <option style="width: auto" value="1" @if($Passenger->Payment_method == 1) selected @endif id="">Безнал.</option>
                                                        <option style="width: auto" value="2" @if($Passenger->Payment_method == 2) selected @endif id="">Нал.</option>
                                                    </select>
                                                    @error('Payment_method')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group" style="">
                                                    <select  class="custom-select  @error('Paid') is-invalid @enderror" data-idi="{{$Passenger->id}}" id="Paid{{$Passenger->id}}"  data-value="" onchange="chenchatribut(this.value,this.dataset.idi,1,this.id)" name="Paid" required>
                                                        <option style="width: auto" value="0" @if($Passenger->Paid == 0) selected @endif id="">Ожидаем</option>
                                                        <option style="width: auto" value="1" @if($Passenger->Paid == 1) selected @endif id="">Оплатил</option>
                                                    </select>
                                                    @error('Paid')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group" style="">
                                                    <select  class="custom-select  @error('Presence') is-invalid @enderror" @if($Passenger->Paid == 0) disabled @endif data-idi="{{$Passenger->id}}" id="Presence{{$Passenger->id}}"  data-value="" onchange="chenchatribut(this.value,this.dataset.idi,2,this.id)" name="Presence" required>
                                                        <option style="width: auto" value="0" @if($Passenger->Presence == 0) selected @endif id="">Нет</option>
                                                        <option style="width: auto" value="1" @if($Passenger->Presence == 1) selected @endif id="">Да</option>
                                                    </select>
                                                    @error('Presence')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group" style="">
                                                <textarea  type="text" class="form-control @error('Comment_Employee') is-invalid @enderror" name="Comment_Employee" data-idi="{{$Passenger->id}}" id="Comment_Employee{{$Passenger->id}}"  onblur="if(this.value != ''){chenchatribut(this.value,this.dataset.idi,3,this.id)}" onkeyup="if(this.value != ''){if(event.keyCode == 13){chenchatribut(this.value,this.dataset.idi,3,this.id)}}" placeholder="Описание">{{$Passenger->Comment_Employee}}</textarea>
                                                    @error('Comment_Employee')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </td> 
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if($Passengers->total() > $Passengers->count())
                            <div class="row mt-4 justify-content-center">
                                <div class="bootstrap-pagination" >
                                    <nav>
                                        <ul class="pagination">
                                            {{ $Passengers->links() }}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            @endif
                            <form class="form-valide" action="{{route('tourcomplitesubmit', $tour->id)}}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_method" value="put">
                                @csrf
                                <input type="number" hidden value="1" name="answer">
                                <div class="form-group row mt-4 text-center">
                                    <label class="col-lg-5 col-form-label" for="Expenses" >Прибыль</label>
                                    <div class="col-lg-5">
                                        <input  type="number" class="form-control @error('Profit') is-invalid @enderror" min="0" max="2147483647" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" value="{{ $tour->Profit }}" name="Profit" id="Profit" placeholder="Прибыль">
                                        @error('Profit')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mt-4 text-center">
                                    <label class="col-lg-5 col-form-label" for="Expenses" >Затраты</label>
                                    <div class="col-lg-5">
                                        <input  type="number" class="form-control @error('Expenses') is-invalid @enderror" min="0" max="2147483647" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" value="{{ $tour->Expenses }}" name="Expenses" id="Expenses" placeholder="Прибыль">
                                        @error('Expenses')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mt-4 text-center">
                                    <label class="col-lg-5 col-form-label" for="Assessment" >Оценка</label>
                                    <div class="col-lg-5">
                                        <input  type="number" class="form-control @error('Assessment') is-invalid @enderror" min="0" max="10" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;" value="{{ $tour->Assessment }}" name="Assessment" id="Assessment" placeholder="Оценка">
                                        @error('Assessment')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row text-center">
                                    <label class="col-lg-5 col-form-label" for="Confidentiality" >Скрытый</label>
                                    <div class="col-lg-5">
                                        <select class="custom-select mr-sm-2" id="Confidentiality" name="Confidentiality" required>
                                            <option value="0" @if($tour->Confidentiality == 0) selected @endif>Нет</option>
                                            <option value="1" @if($tour->Confidentiality == 1) selected @endif>Да</option>
                                        </select>
                                        @error('Confidentiality')
                                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row text-center mt-3">
                                    <div class="col-lg-12 ">
                                        <button type="submit" onclick="" class="btn btn-primary">Подтвердить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                    <div class="card-body">
                        <div class="row card-header" style="padding-bottom: 25px ">
                            <div class="col-sm-12 col-md-7" >
                                <h4 class="">{{ $tour->Name_Tours }}</h4>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle text-center">
                                <thead>
                                <tr>
                                    <th scope="col">ФИО</th>
                                    <th scope="col" title="Способ оплаты">С.О.</th>
                                    <th scope="col">Оплата</th>
                                    <th scope="col">Присутствие</th>
                                    <th scope="col" title="Ваш комментарий">В.К.</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Passengers as $Passenger)
                                    <tr>
                                        <td> {{ $Passenger->customer->Name . ' ' . $Passenger->customer->Surname . ' ' . $Passenger->customer->Middle_Name ?? '' }}</td>
                                        <td>
                                            <div class="input-group" style="">
                                                <select  class="custom-select  @error('Payment_method') is-invalid @enderror" disabled data-idi="{{$Passenger->id}}" style="color: #6c757d;" id="Payment_method{{$Passenger->id}}"  data-value="" onchange="chenchatribut(this.value,this.dataset.idi,0,this.id)" name="Payment_method" required>
                                                    <option style="width: auto" value="1" @if($Passenger->Payment_method == 1) selected @endif id="">Безнал.</option>
                                                    <option style="width: auto" value="2" @if($Passenger->Payment_method == 2) selected @endif id="">Нал.</option>
                                                </select>
                                                @error('Payment_method')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group" style="">
                                                <select  class="custom-select  @error('Paid') is-invalid @enderror" disabled data-idi="{{$Passenger->id}}" style="color: #6c757d;" id="Paid{{$Passenger->id}}"  data-value="" onchange="chenchatribut(this.value,this.dataset.idi,1,this.id)" name="Paid" required>
                                                    <option style="width: auto" value="0" @if($Passenger->Paid == 0) selected @endif id="">Ожидаем</option>
                                                    <option style="width: auto" value="1" @if($Passenger->Paid == 1) selected @endif id="">Оплатил</option>
                                                </select>
                                                @error('Paid')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group" style="">
                                                <select  class="custom-select  @error('Presence') is-invalid @enderror" disabled data-idi="{{$Passenger->id}}" style="color: #6c757d;" id="Presence{{$Passenger->id}}"  data-value="" onchange="chenchatribut(this.value,this.dataset.idi,2,this.id)" name="Presence" required>
                                                    <option style="width: auto" value="0" @if($Passenger->Presence == 0) selected @endif id="">Нет</option>
                                                    <option style="width: auto" value="1" @if($Passenger->Presence == 1) selected @endif id="">Да</option>
                                                </select>
                                                @error('Presence')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group" style="">
                                            <textarea  type="text" class="form-control @error('Comment_Employee') is-invalid @enderror" disabled name="Comment_Employee" data-idi="{{$Passenger->id}}" id="Comment_Employee{{$Passenger->id}}"  onblur="if(this.value != ''){chenchatribut(this.value,this.dataset.idi,3,this.id)}" onkeyup="if(this.value != ''){if(event.keyCode == 13){chenchatribut(this.value,this.dataset.idi,3,this.id)}}" placeholder="Описание">{{$Passenger->Comment_Employee}}</textarea>
                                                @error('Comment_Employee')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </td> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($Passengers->total() > $Passengers->count())
                        <div class="row mt-4 justify-content-center">
                            <div class="bootstrap-pagination" >
                                <nav>
                                    <ul class="pagination">
                                        {{ $Passengers->links() }}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        @endif
                        <form class="form-valide" action="{{route('tourcomplitesubmit', $tour->id)}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="put">
                            @csrf
                            <input type="number" hidden value="0" name="answer">
                            <div class="form-group row mt-4 text-center">
                                <label class="col-lg-5 col-form-label" for="Expenses" >Прибыль</label>
                                <div class="col-lg-5">
                                    <input  type="number" class="form-control @error('Profit') is-invalid @enderror" min="0" max="2147483647" disabled pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" value="{{ $tour->Profit }}" name="Profit" id="Profit" placeholder="Прибыль">
                                    @error('Profit')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-4 text-center">
                                <label class="col-lg-5 col-form-label" for="Expenses" >Затраты</label>
                                <div class="col-lg-5">
                                    <input  type="number" class="form-control @error('Expenses') is-invalid @enderror" min="0" max="2147483647" disabled pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" value="{{ $tour->Expenses }}" name="Expenses" id="Expenses" placeholder="Прибыль">
                                    @error('Expenses')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-4 text-center">
                                <label class="col-lg-5 col-form-label" for="Assessment" >Оценка</label>
                                <div class="col-lg-5">
                                    <input  type="number" class="form-control @error('Assessment') is-invalid @enderror" min="0" max="10" pattern="/^-?\d+\.?\d*$/" disabled onKeyPress="if(this.value.length==2) return false;" value="{{ $tour->Assessment }}" name="Assessment" id="Assessment" placeholder="Оценка">
                                    @error('Assessment')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row text-center">
                                <label class="col-lg-5 col-form-label" for="Confidentiality" >Скрытый</label>
                                <div class="col-lg-5">
                                    <select class="custom-select mr-sm-2" id="Confidentiality" style="color: #6c757d;" disabled name="Confidentiality" required>
                                        <option value="0" @if($tour->Confidentiality == 0) selected @endif>Нет</option>
                                        <option value="1" @if($tour->Confidentiality == 1) selected @endif>Да</option>
                                    </select>
                                    @error('Confidentiality')
                                    <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row text-center mt-3">
                                <div class="col-lg-12 ">
                                    <button type="submit" onclick="" class="btn btn-primary">Отменить подтверждение</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if ($tour->Confirmation_Tours == 0)
    <script type="text/javascript">

    function chenchatribut(valueselect, Passenger_id, params, idselect){
                                            $.ajax({
                                                url: '{{ route('complitetourforcustomer') }}',
                                                type: "POST",
                                                data: {valueselect:valueselect, Passenger_id:Passenger_id, params:params, tour_id:{{$tour->id}}},
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success: function (data) {
                                                    Profit.value =  data;
                                                   if (params == 1 && valueselect == 1) {
                                                    document.getElementById('Presence' + Passenger_id).disabled = false;
                                                   } else if(params == 1 && valueselect == 0 &&  document.getElementById('Presence' + Passenger_id).value == 0) {
                                                    chenchatribut(0, Passenger_id, 2, ('Presence' + Passenger_id));
                                                    document.getElementById('Presence' + Passenger_id).value = 0;
                                                    document.getElementById('Presence' + Passenger_id).disabled = true;
                                                   }
                                                },
                                                error: function (msg) {
                                                    alert('Ошибка');
                                                }
                                            });
                        };
    
    </script>
    @endif

@endsection