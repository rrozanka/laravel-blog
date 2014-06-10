@extends('layout')
@section('content')
    <h2 class="form-signin-heading">Login</h2>

    {{ Form::open(['route' => 'sessions.store', 'id' => 'login-form', 'class' => 'form-horizontal']) }}
        @if(Session::has('flash_message'))
            <div class="alert alert-danger">
                <i class="fa fa-info-circle"></i> {{ Session::get('flash_message') }}
            </div>
        @endif

        <div class="form-group @if(Session::has('flash_message'))has-error@endif">
            {{ Form::label('email', 'E-mail', ['class' => 'col-sm-3 control-label']) }}

            <div class="col-sm-9">
                {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'E-mail')) }}
            </div>
        </div>

        <div class="form-group @if(Session::has('flash_message'))has-error@endif">
            {{ Form::label('password', 'Password', ['class' => 'col-sm-3 control-label']) }}

            <div class="col-sm-9">
                {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-sign-in"></i> Login
                </button>
            </div>
        </div>
    {{ Form::close() }}
@stop