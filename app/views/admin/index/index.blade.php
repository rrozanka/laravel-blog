@extends('layout')
@section('content')
    <div class="row">
        @if(Session::has('message'))
            <div class="alert alert-{{ Session::get('messageType') }}">
                <i class="fa fa-info-circle"></i> {{ Session::get('message') }}
            </div>
        @endif

        <div class="col-lg-2">
            @include('menu_Part')
        </div>

        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/index') }}">Home</a></li>
                <li class="active">Dashboard</li>
            </ol>

            Dashboard, perhaps nice to have some stats?
        </div>
    </div>
@stop