@extends('layouts.admin')

@section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body" style="padding: 1.88rem 0rem;">
                        <div class="row card-header headercard" style="padding: 0.75rem 1.8rem;">
                            <div class="col-sm-12 col-md-6" >
                                <h4 class="" >Удалённые партнёры</h4>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="input-group"  style="float: right; width: 210px !important;">
                                    <select  class="custom-select  @error('select_type_activitie') is-invalid @enderror" onchange="disable_disabled_first()" id="select_type_activitie"   >
                                        <option value="0" disabled selected hidden>Не незначен</option>
                                        @foreach($type_activities as $type_activitie)
                                            <option style="width: auto" value="{{$type_activitie->id}}" id="{{$type_activitie->id}}">{{$type_activitie->Name_Type_Activity}}</option>
                                        @endforeach
                                    </select>
                                    @error('select_type_activitie')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="input-group-append">
                                        <a  class="btn input-group-text selectedbutton diableddeletedbutton" id="removedeletedbutton"  onclick="removedeletedbutton_Type_Activity()" title="Восстановление" style="color: #495057;" ><i class="fa fa-check color-danger m-r-5"></i></a>
                                    </div>
                                    <div class="input-group-append">
                                        <a class="btn input-group-text selectedbutton diableddeletedbutton" id="fulldeletedbutton" onclick="fulldeletedbutton_Type_Activity()" name="fulldeletedbutton" title="Полное удаление" ><i class="fa fa-trash color-danger"></i></a>
                                    </div>
                                </div>
                            </div>
                            <script>
                               
                            </script>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration" id="tablepartner" {{$i = 0}} {{ $o = 0 }} style="padding: 0">
                                <thead>
                                <tr align="center">
                                    <th>Название</th>
                                    <th>Тип занятости</th>
                                    <th>Адрес</th>
                                    <th>Номер телефона</th>
                                    <th>Email</th>
                                    <th>Сайт</th>
                                    <th id="activite"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($partners as $partner)
                                    <tr>

                                        <td align="center"> {{ $partner->Name_Partners }}</td>
                                        <td align="center">
                                            {{--                                {{ $partner->type_activity->Name_Type_Activity ?? "Не назначена" }}--}}

                                            <div class="input-group" style="width: 210px !important;">
                                                <select  class="custom-select  @error('select_type_activitie') is-invalid @enderror" data-idi="{{$i}}" id="select_type_activitie{{$i++}}"  data-value="{{ $partner->id }}" onchange="cheng_type_activities(this.id)" name="select_type_activitie" required>
                                                    <option value="0" disabled selected hidden>Не незначен</option>
                                                    @foreach($type_activities as $type_activitie)
                                                        <option style="width: auto" value="{{$type_activitie->id}}" @if($partner->type_activities_id == $type_activitie->id) selected @endif id="{{$type_activitie->id}}">{{$type_activitie->Name_Type_Activity}}</option>
                                                    @endforeach
                                                </select>
                                                @error('select_type_activitie')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                            </div>
                                        </td>

                                        <td {{ $index = 0 }}>
                                            @if(count($partner->address) == 0)
                                                Отсуствует
                                            @else
                                                @foreach($partner->address as $addresses)
                                                    <p style="margin-bottom: 0;">
                                                        @if (count($partner->address) > 1)
                                                            {{ ++$index }}.
                                                        @endif
                                                        {{ $addresses->Address}}@if (count($partner->address) > 1); @endif
                                                    </p>
                                                @endforeach
                                            @endif
                                        </td>

                                        <td {{ $index = 0 }}>
                                            @if(count($partner->phone_nomber) == 0)
                                                Отсуствует
                                            @else
                                                @foreach($partner->phone_nomber as $phone_nombers)
                                                    <p style="margin-bottom: 0;">
                                                        @if (count($partner->phone_nomber) > 1)
                                                            {{ ++$index }}.
                                                        @endif
                                                        {{ $phone_nombers->Phone_Number }} - {{ $phone_nombers->Representative }} @if (count($partner->phone_nomber) > 1); @endif
                                                    </p>
                                                @endforeach
                                            @endif
                                        </td>

                                        <td {{ $index = 0 }}>
                                            @if(count($partner->email) == 0)
                                                Отсуствует
                                            @else
                                                @foreach($partner->email as $emails)
                                                    <p style="margin-bottom: 0;">

                                                        @if (count($partner->email) > 1)
                                                            {{ ++$index }}.
                                                        @endif
                                                        {{  $emails->Email }} - {{  $emails->Representative_Email }}@if (count($partner->email) > 1); @endif
                                                    </p>
                                                @endforeach
                                            @endif
                                        </td>

                                        <td {{ $index = 0 }}>
                                            @if(count($partner->website) == 0)
                                                Отсуствует
                                            @else
                                                @foreach($partner->website as $websites)
                                                    <p style="margin-bottom: 0;">
                                                        @if (count($partner->website) > 1)
                                                            {{ ++$index }}.
                                                        @endif
                                                        {{ $websites->Site }}@if (count($partner->website) > 1); @endif
                                                    </p>
                                                @endforeach
                                            @endif
                                        </td>

                                        <td align="center">
                                            <span>
                                                <form onsubmit="if(confirm('Воcстановить запись партнёра?')){return true}else{return false}" action="{{route('partners.destroyremuve',$partner)}}" method="post">
                                                    <input type="hidden" name="_method" value="PUT">
                                                    @csrf
                                                    <a  data-toggle="tooltip" data-placement="top" onclick="if(confirm('Полное удаление партнёра приведёт к полному удалению его записей (записей на мероприятия, отзывы и т.д), что может нарушить правильность статистических данных, вы уверены, что полностью хотите удалить запись партнёра?')){document.getElementById('form1').submit();}else{return false}"  style="cursor: pointer !important;" title="Полное удаление"><i class="fa fa-trash color-muted m-r-5"></i></a>
                                                    <button  type="submit" style="cursor: pointer !important; padding: 0 !important; border: none !important; font: inherit !important; color: inherit !important; background-color: transparent !important;" data-toggle="tooltip" data-placement="top" title="Восстановить"><i class="fa fa-check color-danger"></i></button>
                                                </form>
                                                <form  action="{{route('partners.fulldestroy',$partner)}}" id="form1" method="post" hidden>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    @csrf
                                                </form>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($partners->total() > $partners->count())
                        <div class="row mt-3 justify-content-center">
                            <div class="bootstrap-pagination" >
                                <nav>
                                    <ul class="pagination">
                                        {{ $partners->links() }}
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
<script>
 function createType_Activity(id) {
                                    document.getElementById('save').dataset.idi = id;
                                };

                                    function removedeletedbutton_Type_Activity() {
                                        var select_type_activitie = document.getElementById('select_type_activitie');
                                        $.ajax({
                                            url: "{{route('typeactivity.removedeleted')}}",
                                            type: "POST",
                                            data: {id: select_type_activitie.value},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },

                                            success: function (data) {
                                                document.getElementById('fulldeletedbutton').classList.add("diableddeletedbutton");
                                                document.getElementById('removedeletedbutton').classList.add("diableddeletedbutton");
                                                document.getElementsByName('select_type_activitie').forEach(function (select_select) {
                                                                if (select_select.value != select_type_activitie.value) {
                                                                    select_select.removeChild(select_select.querySelector('[value="'+ select_type_activitie.value +'"]'));
                                                                }
                                                            });
                                                select_type_activitie.removeChild(select_type_activitie.querySelector('[value="'+ select_type_activitie.value +'"]'));
                                                select_type_activitie.value = 0;
                                                alert('Восстановлено');
                                            },
                                            error: function (msg) {
                                                alert('Ошибка: заполните обязательные для ввода поля или данная запись уже существует.');
                                            }
                                        });
                                    };

                                function fulldeletedbutton_Type_Activity(id_Type_Activity) {
                                        var select_type_activitie = document.getElementById('select_type_activitie');
                                        $.ajax({
                                            url: "{{route('typeactivity.fulldeleted')}}",
                                            type: "POST",
                                            data: {id: select_type_activitie.value},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success: function (datas) {
                                                
                                                if (datas != 1) {
                                                    info = 'Данный тип занятости невозможно удалить, т.к он находится ещё в:'
                                                    datas.forEach((element) => {
                                                                info += ' ' + element['Name_Partners'] + '; '
                                                                });
                                                    alert(info);
                                                } else{
                                                    document.getElementById('fulldeletedbutton').classList.add("diableddeletedbutton");
                                                document.getElementById('removedeletedbutton').classList.add("diableddeletedbutton");
                                                document.getElementsByName('select_type_activitie').forEach(function (select_select) {
                                                                if (select_select.value != select_type_activitie.value) {
                                                                    select_select.removeChild(select_select.querySelector('[value="'+ select_type_activitie.value +'"]'));
                                                                }
                                                            });
                                                select_type_activitie.removeChild(select_type_activitie.querySelector('[value="'+ select_type_activitie.value +'"]'));
                                                select_type_activitie.value = 0;
                                                alert('Удалено');
                                                }
                                                

                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };


                                

                                function disable_disabled_first() {
                                    document.getElementById('fulldeletedbutton').classList.remove("diableddeletedbutton");
                                    document.getElementById('removedeletedbutton').classList.remove("diableddeletedbutton");
                                };

                                function cheng_type_activities(id) {
                                        var type_activities_id = document.getElementById(id).value;
                                        var partner_id = document.getElementById(id).dataset.value;

                                        $.ajax({
                                            url: "{{route('typeactivity.partner.update')}}",
                                            type: "POST",
                                            data: {type_activities_id:type_activities_id,partner_id:partner_id},
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success:function (data)
                                            {
                                            },
                                            error: function (msg) {
                                                alert('Ошибка');
                                            }
                                        });
                                    };
</script>
@endsection