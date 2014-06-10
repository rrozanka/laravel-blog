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
                <li class="active">Categories</li>
            </ol>

            <a class="btn btn-success margin-bottom-20" href="{{ URL::route('admin.categories.create') }}">
                <i class="fa fa-plus"></i> Add New Category
            </a>

            <div>
                <table id="categories-table" class="table">
                    <thead>
                        <tr>
                            <td>id</td>
                            <td>name</td>
                            <td>actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if($categories->count())
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-xs" href="{{ URL::route('admin.categories.edit', $category->id) }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        <a class="btn btn-danger btn-xs delete-record" href="{{ URL::route('admin.categories.destroy', $category->id) }}">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop