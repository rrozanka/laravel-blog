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
                <li class="active">Users</li>
            </ol>

            <a class="btn btn-success margin-bottom-20" href="{{ URL::route('admin.users.create') }}">
                <i class="fa fa-plus"></i> Add New User
            </a>

            <div>
                <table id="users-table" class="table">
                    <thead>
                        <tr>
                            <td>id</td>
                            <td>first name</td>
                            <td>last name</td>
                            <td>e-mail</td>
                            <td>role</td>
                            <td>actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if($users->count())
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->firstname }}</td>
                                    <td>{{ $user->lastname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-xs" href="{{ URL::route('admin.users.edit', $user->id) }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        <a class="btn btn-danger btn-xs delete-record" href="{{ URL::route('admin.users.destroy', $user->id) }}">
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