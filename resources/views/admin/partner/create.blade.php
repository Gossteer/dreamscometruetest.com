@extends('layouts.admin')

@section('content')
    <link href="{{ asset('js/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
    <!-- Page plugins css -->
    <link href="{{ asset('js/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet') }}">
    <!-- Color picker plugins css -->
    <link href="{{ asset('js/plugins/jquery-asColorPicker-master/css/asColorPicker.css') }}" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="{{ asset('js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <!-- Daterange picker plugins css -->
    <link href="{{ asset('js/plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" action="{{ route('partners.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Name_Partners">Наименование <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control"  name="Name_Partners" placeholder="Наименование" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Phone_Number">Номер телефона <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="tel" class="form-control" id="Phone_Number"  name="Phone_Number" required placeholder="Номер телефона">
                                    </div>
                                    <script>
                                        $(function() {
                                            $("#Phone_Number").mask("+7 (999) 999-99-99");
                                        });
                                    </script>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="type_activities_id">Тип экскурсии <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control"  name="type_activities_id" required>
                                            @foreach($type_activities as $type_activitie)
                                                <option value="{{ $type_activitie->id }}">{{ $type_activitie->Name_Type_Activity }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Address">Адрес
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control"  name="Address" placeholder="Адрес">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">Создать</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection