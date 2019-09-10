@extends('layouts.admin')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Работники</h4>

                <form class="form-valide" action="{{ route('contractsstore', $tour) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row align-items-center" style="margin-bottom: 10px; padding-left: 44% !important;">
                        <div class="col-auto my-1">
                            <select class="custom-select mr-sm-2" name="partners_id" id="inlineFormCustomSelect">
                                @foreach($partners as $partner)
                                    <option value="{{ $partner->id }}">{{ $partner->Name_Partners }}</option>
                                @endforeach
                            </select>

                        </div>
                        <button type="submit" class="btn btn-info btn-rounded" style="">Добавить</button>
                    </div>

                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped verticle-middle">
                        <thead>
                        <tr>
                            <th scope="col">Наименование</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($partner_for_tour as $partner_for_tour)
                            <tr>

                                <td> {{ ($partner_for_tour)->partner->Name_Partners }}</td>
                                <td>
                                <span>
                                    <form onsubmit="if(confirm('Удалить?')){return true}else{return false}" action="{{route('contractsdestroy', [$tour, $partner_for_tour])}}" method="post">
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
                </div>
            </div>
        </div>
    </div>


@endsection