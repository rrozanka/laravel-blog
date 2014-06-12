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
                <li class="active">
                    <i class="icon icon-pencil"></i> Wpisy
                </li>
            </ol>

            <a class="btn btn-success margin-bottom-20" href="{{ URL::route('admin.posts.create') }}">
                <i class="icon icon-plus"></i> Dodaj Nowy Wpis
            </a>

            <div>
                <table id="posts-table" class="table">
                    <thead>
                        <tr>
                            <td>id</td>
                            <td>title</td>
                            <td>author</td>
                            <td>category</td>
                            <td>actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if($posts->count())
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->name }}</td>
                                    <td>{{ $post->user->firstname . ' ' . $post->user->lastname }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-xs" href="{{ URL::route('admin.posts.edit', $post->id) }}">
                                            <i class="icon icon-pencil"></i>
                                        </a>

                                        <a class="btn btn-danger btn-xs delete-record" href="{{ URL::route('admin.posts.destroy', $post->id) }}">
                                            <i class="icon icon-trash-o"></i>
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