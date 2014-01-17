@extends('layout')
@section('content')
    <h2 class="form-signin-heading">Login</h2>

    {{ Form::open(array('url' => 'home/login', 'id' => 'login-form', 'class' => 'form-horizontal')) }}
        @if(Session::has('message'))
            <div class="alert alert-{{ Session::get('messageType') }}">
                <i class="fa fa-info-circle"></i> {{ Session::get('message') }}
            </div>
        @endif

        <div class="form-group @if(Session::has('message'))has-error@endif">
            {{ Form::label('email', 'E-mail', ['class' => 'col-sm-3 control-label']) }}

            <div class="col-sm-9">
                {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'E-mail')) }}
            </div>
        </div>

        <div class="form-group @if(Session::has('message'))has-error@endif">
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