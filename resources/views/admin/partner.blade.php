@extends('layouts.admin')

@section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body" style="padding: 1.88rem 0rem;">
                        <div class="row card-header headercard" style="padding: 0.75rem 1.8rem;">
                            <div class="col-sm-12 col-md-6" >
                                <h4 class="" >Партнёры</h4>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <a href="{{ route('partners.create') }}" class="btn btn-info btn-rounded btnheader" style="float: right">Добавить партнёра</a>
                            </div>
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
                                                <select  class="custom-select  @error('select_type_activitie') is-invalid @enderror" data-idi="{{$i}}" id="select_type_activitie{{$i++}}"  data-value="{{ $partner->id }}" onchange="cheng_type_activities(this.id);disable_disabled(this.dataset.idi) " name="select_type_activitie" required>
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
                                                <div class="input-group-append">
                                                    <a  data-toggle="modal" data-target="#addArticle" class="btn input-group-text selectedbutton" data-idi="{{$o = $i-1}}" onclick="createType_Activity(this.dataset.idi)" title="Добавить" style="color: #495057;" ><i class="fa fa-plus-circle color-muted m-r-5"></i></a>
                                                </div>
                                                <div class="input-group-append" id="div_updatebutton">
                                                    <a class="btn input-group-text selectedbutton diableddeletedbutton" data-toggle="modal" data-target="#addArticle1" onclick="updatebutton_type_activitie({{$o}})" id="updatebutton{{$o}}" style="" name="updatebutton{{$o}}" title="Изменить"><i class="fa fa-pencil color-danger"></i></a>
                                                </div>
                                                <div class="input-group-append">
                                                    <a class="btn input-group-text selectedbutton diableddeletedbutton" id="deletedbutton{{$o}}" onclick="delete_Type_Activity({{$o}})" name="deletedbutton" title="Удалить" ><i class="fa fa-trash color-danger"></i></a>
                                                </div>
                                            </div>
                                        </td>

                                        <div class="modal fade" id="addArticle" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="addArticleLabel">Добавление типа занятости</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="title">Название типа занятости <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control @error('Name_Type_Activity') is-invalid @enderror" minlength="2" maxlength="191" id="Name_Type_Activity" placeholder="Название">
                                                            @error('Name_Type_Activity')
                                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"  data-dismiss="modal">Закрыть</button>
                                                        <button type="button" id="save" data-idi="" onclick="create_Type_Activity()" class="btn btn-primary">Сохранить</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="addArticle1" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="addArticleLabel">Изменение типа занятости</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="title">Название типа занятости <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control @error('Name_Type_Activity1') is-invalid @enderror" minlength="2" maxlength="191" id="Name_Type_Activity1" placeholder="Название">
                                                            @error('Name_Type_Activity1')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" id="delete_Type_Activity" name="delete_Type_Activity" data-dismiss="modal">Закрыть</button>
                                                        <button type="button" id="ubdate_Type_Activity" data-idi="" onclick="ubdate_Type_Activity(this.dataset.idi)" name="ubdate_Type_Activity" class="btn btn-primary">Изменить</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            function createType_Activity(id) {
                                                document.getElementById('save').dataset.idi = id;
                                            };

                                            function updatebutton_type_activitie(idi){
                                            var id = $('#select_type_activitie' + idi).val();

                                            $.ajax({
                                                url: "{{route('typeactivity.index')}}",
                                                type: "POST",
                                                data: {id:id},
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success:function (data)
                                                {
                                                    document.getElementById('ubdate_Type_Activity').dataset.idi = idi;
                                                    $('#Name_Type_Activity1').val(data['Name_Type_Activity']);
                                                },
                                                error: function (msg) {
                                                    alert('Ошибка');
                                                }
                                            });
                                        };

                                                function create_Type_Activity() {
                                                    var Name_Type_Activity = $('#Name_Type_Activity').val();
                                                    $.ajax({
                                                        url: '{{ route('typeactivity.store') }}',
                                                        type: "POST",
                                                        data: {Name_Type_Activity: Name_Type_Activity},
                                                        headers: {
                                                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                        },

                                                        success: function (data) {
                                                            $('#Name_Type_Activity').val(' ');
                                                            $('#addArticle').modal('hide');
                                                            $('#articles-wrap').removeClass('hidden').addClass('show');
                                                            $('.alert').removeClass('show').addClass('hidden');
                                                            document.getElementsByName('select_type_activitie').forEach(function (select_select) {
                                                                select_select[select_select.length] = new Option(data['Name_Type_Activity'], data['id']);
                                                            });
                                                            alert('Добавлено');
                                                        },
                                                        error: function (msg) {
                                                            alert('Ошибка: заполните обязательные для ввода поля или данная запись уже существует.');
                                                        }
                                                    });
                                                };

                                            function ubdate_Type_Activity(id){
                                            var id = document.getElementById('select_type_activitie' + id).value;
                                            var Name_Type_Activity = $('#Name_Type_Activity1').val();

                                            $.ajax({
                                                url: "{{route('typeactivity.update')}}",
                                                type: "POST",
                                                data: {id:id,Name_Type_Activity:Name_Type_Activity},
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success:function (data)
                                                {
                                                    $('#addArticle1').modal('hide');
                                                    $('#articles-wrap').removeClass('hidden').addClass('show');
                                                    $('.alert').removeClass('show').addClass('hidden');
                                                    document.getElementsByName('select_type_activitie').forEach(function (select_select) {
                                                                    $('select[id='+select_select.id+'] option[value='+id+']').text(data['Name_Type_Activity']);
                                                                    $('select[id='+select_select.id+'] option[value='+id+']').prop('id', data['id']);
                                                                    $('select[id='+select_select.id+'] option[value='+id+']').prop('value', data['id']);
                                                                    // select_select.options[select_select.selectedIndex].text = data['Name_Type_Activity'];
                                                                    // select_select.options[select_select.selectedIndex].id = data['id'];
                                                                    // select_select.options[select_select.selectedIndex].value = data['id'];
                                                            });

                                                    alert('Изменено');
                                                },
                                                error: function (msg) {
                                                    alert('Ошибка: заполните обязательные для ввода поля или данная запись уже существует.');
                                                }
                                            });
                                        };

                                            function delete_Type_Activity(id) {
                                                    var typeactivity = document.getElementById('select_type_activitie' + id);

                                                    $.ajax({
                                                        url: "{{route('typeactivity.destroy')}}",
                                                        type: "POST",
                                                        data: {typeactivity:typeactivity.value},
                                                        headers: {
                                                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                        },
                                                        success: function (datas) {
                                                            document.getElementsByName('select_type_activitie').forEach(function (select_select) {
                                                                if (select_select.value != typeactivity.value) {
                                                                    select_select.removeChild(select_select.querySelector('[value="'+ typeactivity.value +'"]'));
                                                                }
                                                            });
                                                            var info = '. Данный тип занятости находится ещё в: ';
                                                            typeactivity.removeChild(typeactivity.querySelector('[value="'+ typeactivity.value +'"]'));
                                                            document.getElementById('select_type_activitie' + id).value = 0;
                                                            document.getElementById('deletedbutton' + id).classList.add("diableddeletedbutton");
                                                            document.getElementById('updatebutton' + id).classList.add("diableddeletedbutton");
                                                            datas.forEach((element) => {
                                                                info += ' ' + element['Name_Partners'] + '; '
                                                                });
                                                            alert('Удалено' + (datas.length != 0 ? info : ""));

                                                        },
                                                        error: function (msg) {
                                                            alert('Ошибка');
                                                        }
                                                    });
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

                                            $(function() {
                                                document.getElementsByName('select_type_activitie').forEach(function (select_select) {
                                                    disable_disabled(select_select.dataset.idi)
                                                });
                                            });
                                            function disable_disabled(id) {
                                                var deletedbutton = document.getElementById('deletedbutton' + id)
                                                var updatebutton = document.getElementById('updatebutton' + id)

                                                if(document.getElementById('select_type_activitie' + id).value == "0") {
                                                    deletedbutton.classList.add("diableddeletedbutton")
                                                    updatebutton.classList.add("diableddeletedbutton")
                                                } else {
                                                    deletedbutton.classList.remove("diableddeletedbutton")
                                                    updatebutton.classList.remove("diableddeletedbutton")
                                                }
                                            };

                                        </script>

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
                                    <form onsubmit="if(confirm('Удалить?')){return true}else{return false}" action="{{route('partners.destroy',$partner)}}" method="post">
                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf
                                        <a href="{{ route('partners.edit', $partner) }}" data-toggle="tooltip" data-placement="top" title="Редактировать"><i  class="fa fa-pencil color-muted m-r-5"></i>
                                    </a>
                                        <button type="submit" style="padding: 0 !important; border: none !important; font: inherit !important; color: inherit !important; background-color: transparent !important;" data-toggle="tooltip" data-placement="top" title="Удалить"><i style="cursor: pointer !important;" class="fa fa-trash color-danger"></i></button>
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
@endsection