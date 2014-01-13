@extends('layout')
@section('content')
    @if(Session::has('message'))
        <div class="alert alert-{{ Session::get('messageType') }} margin-bottom-none">
            <i class="fa fa-info-circle"></i> {{ Session::get('message') }}
        </div>
    @endif

    <div class="blog-header">
        <h1 class="blog-title">Laravel Blog</h1>
        <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p>
    </div>

    <div class="row">
        <div class="col-sm-8 blog-main">
            @if($posts->count())
                @foreach($posts as $post)
                    <div class="blog-post">
                        <h2 class="blog-post-title">
                            {{ $post->name }}
                        </h2>
                        <p class="blog-post-meta">
                            <?php
                                $date = new \DateTime($post->created_at);
                            ?>
                            {{ $date->format('M d, Y') }} by {{ $post->user->firstname . ' ' . $post->user->lastname }} in {{ $post->category->name }}

                            @if(Auth::check())
                                <small>
                                    <a href="{{ URL::route('posts.edit', $post->id) }}">
                                        #Edit
                                    </a>
                                </small>
                            @endif

                            <br />

                            @if($post->tags->count())
                                <small>
                                    @foreach($post->tags as $key => $tag)
                                        <a href="#">
                                            #{{ $tag->name }}@if($key != $post->tags->count() - 1), @endif
                                        </a>
                                    @endforeach
                                </small>
                            @endif
                        </p>

                        <p>
                            {{ nl2br($post->body) }}
                        </p>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> No posts found.
                </div>
            @endif

            {{ $posts->links() }}
        </div>

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            <div class="sidebar-module sidebar-module-inset">
                <h4>About</h4>
                <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
            </div>

            @if($categories->count())
                <div class="sidebar-module">
                    <h4>Categories</h4>

                    <ol class="list-unstyled">
                        @foreach($categories as $category)
                            <li>
                                <a href="#">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ol>
                </div>
            @endif

            @if($tags->count())
                <div class="sidebar-module">
                    <h4>Tags</h4>

                    <ol class="list-unstyled">
                        @foreach($tags as $tag)
                            <li>
                                <a href="#">
                                    {{ $tag->name }}
                                </a>
                            </li>
                        @endforeach
                    </ol>
                </div>
            @endif
        </div>
    </div>
@stop