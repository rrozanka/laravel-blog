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
        <li>
            <a href="{{ URL::to('/') }}">Home</a>
        </li>
        <li class="active">
            {{ $post->name }}
        </li>
    </ol>

    <div class="row">
        <div class="col-sm-8 blog-main">
            @include('home.post_Part', ['post' => $post, 'singlePage' => true])
        </div>

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            @include('home.sidebar_Part')
        </div>
    </div>
@stop