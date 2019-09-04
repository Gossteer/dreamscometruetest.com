@extends('layouts.admin')

@section('content')
    <div class="container">
        <form class="form-horizontal" action="{{route('employees.store')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            @include('admin.employees.partials.form')
        </form>
    </div>
@endsection
