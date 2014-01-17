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
                <li class="active">Settings</li>
            </ol>

            {{ Form::open(array('url' => 'admin/settings/store', 'class' => 'form-horizontal')) }}
                @if(Session::has('message'))
                    <div class="alert alert-{{ Session::get('messageType') }}">
                        <i class="fa fa-info-circle"></i> {{ Session::get('message') }}
                    </div>
                @endif

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

                <div class="form-group @if($errors->has('name'))has-error@endif">
                    {{ Form::label('about', 'About', ['class' => 'col-sm-2 control-label']) }}

                    <div class="col-sm-10">
                        {{ Form::textarea('settings[about]', (isset($settings['about'])) ? $settings['about'] : null, array('class' => 'form-control', 'placeholder' => 'About')) }}
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