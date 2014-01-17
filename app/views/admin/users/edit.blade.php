@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-2">
            @include('menu_Part')
        </div>

        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ URL::to('admin/index') }}">Home</a>
                </li>
                <li>
                    <a href="{{ URL::route('admin.users.index') }}">Users</a>
                </li>
                <li class="active">Edit User: {{ $record->firstname . ' ' . $record->lastname }}</li>
            </ol>

            @include('admin/users/form_Part')
        </div>
    </div>
@stop