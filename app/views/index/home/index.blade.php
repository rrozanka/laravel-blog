@extends('layout')
@section('content')
    @if(Session::has('message'))
        <div class="alert alert-{{ Session::get('messageType') }} margin-bottom-none">
            <i class="fa fa-info-circle"></i> {{ Session::get('message') }}
        </div>
    @endif

    <div class="blog-header">
        <h1 class="blog-title">Laravel Blog</h1>
        <p class="lead blog-description">The example of creating a blog with Laravel & Bootstrap.</p>
    </div>

    <ol class="breadcrumb">
        <li class="active">
            Home
        </li>
    </ol>

    <div class="row">
        <div class="col-sm-8 blog-main">
            @if($posts->count())
                @foreach($posts as $key => $post)
                    @include('index.home.post_Part', ['post' => $post])

                    @if($key != $posts->count() - 1)
                        <hr class="dotted" />
                    @endif
                @endforeach
            @else
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> No posts found.
                </div>
            @endif

            {{ $posts->links() }}
        </div>

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            @include('index.home.sidebar_Part')
        </div>
    </div>
@stop