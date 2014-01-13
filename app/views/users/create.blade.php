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
                    <a href="{{ URL::route('users.index') }}">Users</a>
                </li>
                <li class="active">Add New User</li>
            </ol>

            {{ Form::open(array('route' => 'users.store', 'class' => 'form-horizontal')) }}
                @if($errors->all())
                    <div class="alert alert-danger">
                        <i class="fa fa-info-circle"></i> The following errors occurred:
                        <ul class="padding-left-15">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group @if($errors->has('firstname'))has-error@endif">
                    {{ Form::label('firstname', 'First name', ['class' => 'col-sm-2 control-label']) }}

                    <div class="col-sm-10">
                        {{ Form::text('firstname', null, array('class' => 'form-control', 'placeholder' => 'First Name')) }}
                    </div>
                </div>

                <div class="form-group @if($errors->has('lastname'))has-error@endif">
                    {{ Form::label('lastname', 'Last name', ['class' => 'col-sm-2 control-label']) }}

                    <div class="col-sm-10">
                        {{ Form::text('lastname', null, array('class' => 'form-control', 'placeholder' => 'Last Name')) }}
                    </div>
                </div>

                <div class="form-group @if($errors->has('email'))has-error@endif">
                    {{ Form::label('email', 'E-mail', ['class' => 'col-sm-2 control-label']) }}

                    <div class="col-sm-10">
                        {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'E-mail')) }}
                    </div>
                </div>

                <div class="form-group @if($errors->has('password'))has-error@endif">
                    {{ Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) }}

                    <div class="col-sm-10">
                        {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
                    </div>
                </div>

                <div class="form-group @if($errors->has('password_confirmation'))has-error@endif">
                    {{ Form::label('password_confirmation', 'Re-password', ['class' => 'col-sm-2 control-label']) }}

                    <div class="col-sm-10">
                        {{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Re-password')) }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-check"></i> Submit
                        </button>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@stop