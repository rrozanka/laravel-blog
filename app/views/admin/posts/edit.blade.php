@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-2">
            @include('menu_Part')
        </div>

        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ URL::to('/') }}">
                        <i class="icon icon-home"></i> Strona główna
                    </a>
                </li>
                <li>
                    <a href="{{ URL::to('admin/index') }}">
                        <i class="icon icon-wrench"></i> Admin
                    </a>
                </li>
                <li>
                    <a href="{{ URL::route('admin.posts.index') }}">
                        <i class="icon icon-pencil"></i> Wpisy
                    </a>
                </li>
                <li class="active">
                    <i class="icon icon-pencil"></i> Edycja Wpisu: {{ $record->name }}
                </li>
            </ol>

            @include('admin/posts/form_Part')
        </div>
    </div>
@stop