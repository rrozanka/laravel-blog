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
                    <a href="{{ URL::route('categories.index') }}">Categories</a>
                </li>
                <li class="active">Edit Category: {{ $record->name }}</li>
            </ol>

            {{ Form::model($record, array('route' => ['categories.update', $record->id], 'class' => 'form-horizontal', 'method' => 'put')) }}
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
                    {{ Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) }}

                    <div class="col-sm-10">
                        {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Name')) }}
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