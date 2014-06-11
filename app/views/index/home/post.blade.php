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
    @if(Session::has('message'))
        <div class="alert alert-{{ Session::get('messageType') }} margin-bottom-none">
            <i class="fa fa-info-circle"></i> {{ Session::get('message') }}
        </div>
    @endif

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
                        <i class="icon icon-user"></i> Autor

                        <a href="#">
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

                <div class="post-block post-comments clearfix">
                    <h3>
                        <i class="icon icon-comments"></i> Komentarze (1)
                    </h3>

                    <ul class="comments">
                        <li>
                            <div class="comment">
                                <div class="img-thumbnail">
                                    <img class="avatar" alt="" src="http://placehold.it/80x80">
                                </div>

                                <div class="comment-block">
                                    <div class="comment-arrow"></div>

                                    <span class="comment-by">
                                        <strong>
                                            John Doe
                                        </strong>
                                    </span>

                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim ornare nisi, vitae mattis nulla ante id dui.
                                    </p>

                                    <span class="date pull-right">
                                        January 12, 2013 at 1:38 pm
                                    </span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="post-block post-leave-comment">
                    <h3>
                        Skomentuj
                    </h3>

                    {{ Form::open(array('action' => ['App\Controllers\HomeController@postStore', $post->id])) }}
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    {{ Form::label('name', 'Imię *') }}

                                    {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Wprowadź Imię')) }}
                                </div>

                                <div class="col-md-6">
                                    {{ Form::label('email', 'E-mail *') }}

                                    {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'Wprowadź E-mail')) }}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    {{ Form::label('comment', 'Komentarz *') }}

                                    {{ Form::textarea('comment', null, array('class' => 'form-control', 'rows' => '10', 'placeholder' => 'Wprowadź Komentarz')) }}
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