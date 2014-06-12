@extends('layout-frontend')
@section('breadcrumb')
    <section class="page-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li>
                            <a href="{{ URL::to('home/index') }}">
                                Strona główna
                            </a>
                        </li>
                        <li class="active">
                            Post
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>
                        {{ $post->name }}
                    </h2>
                </div>
            </div>
        </div>
    </section>
@stop

@section('content')
    <div class="blog-posts single-post">
        <article class="post post-large blog-single-post">
            <div class="post-date">
                <span class="day">
                    {{ DateTime::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('d') }}
                </span>

                <span class="month">
                    {{ DateTime::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('F') }}
                </span>
            </div>

            <div class="post-content">
                <h2>
                    <a href="{{ URL::to('home/post', [$post->id, Str::slug($post->name)]) }}">
                        {{ $post->name }}
                    </a>
                </h2>

                <div class="post-meta">
                    <span>
                        <i class="icon icon-user"></i>

                        <a href="{{ URL::to('home/author', [$post->user->id, Str::slug($post->user->firstname . ' ' . $post->user->lastname)]) }}">
                            {{ $post->user->firstname . ' ' . $post->user->lastname }}
                        </a>
                    </span>

                    <span>
                        <i class="icon icon-folder"></i>

                        <a href="{{ URL::to('home/category', [$post->category->id, Str::slug($post->category->name)]) }}">
                            {{ $post->category->name }}
                        </a>
                    </span>

                    @if($post->tags->count())
                        <span>
                            <i class="icon icon-tag"></i>

                            @foreach($post->tags as $key => $tag)
                                <a href="{{ URL::to('home/tag', [$tag->id, Str::slug($tag->name)]) }}">
                                    {{ $tag->name }}
                                </a>

                                @if($key != $post->tags->count() - 1)
                                    ,
                                @endif
                            @endforeach
                        </span>
                    @endif

                    <span>
                        <i class="icon icon-comments"></i>

                        <a href="{{ URL::to('home/post', [$post->id, Str::slug($post->name)]) }}">
                            {{ $post->comments->count() }} Komentarzy
                        </a>
                    </span>
                </div>

                {{ nl2br($post->body) }}

                @if($post->comments->count())
                    <div class="post-block post-comments clearfix">
                        <h3>
                            <i class="icon icon-comments"></i> Komentarze ({{ $post->comments->count() }})
                        </h3>

                        <ul class="comments">
                            @foreach($post->comments as $comment)
                                <li>
                                    <div class="comment">
                                        <div class="comment-block">
                                            <span class="comment-by">
                                                <strong>
                                                    {{ $comment->name }}
                                                </strong>
                                            </span>

                                            <p>
                                                {{ nl2br($comment->body) }}
                                            </p>

                                            <span class="date pull-right">
                                                {{ ViewHelper::outputDate($comment->created_at, 'F d, Y \a\t H:i:s') }}
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="post-block post-leave-comment">
                    <h3>
                        Skomentuj
                    </h3>

                    {{ Form::open(array('action' => ['App\Controllers\HomeController@postStore', $post->id])) }}
                        <div class="row">
                            <div class="form-group @if($errors->has('name'))has-error@endif">
                                <div class="col-md-6">
                                    {{ Form::label('name', 'Imię *') }}

                                    {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Wprowadź Imię')) }}

                                    @if($errors->has('name'))
                                        @foreach($errors->get('name') as $error)
                                            <span class="help-block margin-bottom-none">
                                                {{ $error }}
                                            </span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group @if($errors->has('email'))has-error@endif">
                                <div class="col-md-6">
                                    {{ Form::label('email', 'E-mail *') }}

                                    {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'Wprowadź E-mail')) }}

                                    @if($errors->has('email'))
                                        @foreach($errors->get('email') as $error)
                                            <span class="help-block margin-bottom-none">
                                                {{ $error }}
                                            </span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group @if($errors->has('body'))has-error@endif">
                                <div class="col-md-12">
                                    {{ Form::label('comment', 'Komentarz *') }}

                                    {{ Form::textarea('comment', null, array('name' => 'body', 'class' => 'form-control', 'rows' => '10', 'placeholder' => 'Wprowadź Komentarz')) }}

                                    @if($errors->has('body'))
                                        @foreach($errors->get('body') as $error)
                                            <span class="help-block margin-bottom-none">
                                                {{ $error }}
                                            </span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-lg" type="submit">
                                    <i class="icon icon-envelope-o"></i> Dodaj komentarz
                                </button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </article>
    </div>
@stop