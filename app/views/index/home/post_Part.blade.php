<div class="blog-post">
    <h2 class="blog-post-title">
        @if(isset($singlePage) && $singlePage)
            {{ $post->name }}
        @else
            <a href="{{ URL::to('home/post', $post->id) }}">
                {{ $post->name }}
            </a>
        @endif
    </h2>
    <p class="blog-post-meta">
        {{ ViewHelper::outputDate($post->created_at) }} by {{ $post->user->firstname . ' ' . $post->user->lastname }} in <a href="{{ URL::to('home/category', $post->category->id) }}">{{ $post->category->name }}</a>

        @if(Auth::check())
            <small>
                <a href="{{ URL::route('admin.posts.edit', $post->id) }}">
                    #Edit
                </a>
            </small>
        @endif

        <br />

        @if($post->tags->count())
            <small>
                @foreach($post->tags as $key => $tag)
                    <a href="{{ URL::to('home/tag', $tag->id) }}">
                        #{{ $tag->name }}@if($key != $post->tags->count() - 1), @endif
                    </a>
                @endforeach
            </small>
        @endif
    </p>

    <p class="margin-bottom-30">
        @if(isset($singlePage) && $singlePage)
            {{ nl2br($post->body) }}
        @else
            {{ nl2br($post->short_body) }}

            <br />
            <br />

            <a href="{{ URL::to('home/post', $post->id) }}">
                ...read more
            </a>
        @endif
    </p>

    @if(isset($singlePage) && $singlePage)
        <h3>Comments</h3>
        <hr class="dotted" />

        <div id="comments-container">
            @if($post->comments()->count())
                @foreach($post->comments()->get() as $key => $comment)
                    <div class="comment">
                        <p>
                            {{ $comment->name }} says: <br />
                            <em>{{ ViewHelper::outputDate($comment->created_at, 'M d, Y H:i:s') }}</em> <br /><br />
                            {{ nl2br($comment->body) }}
                        </p>
                    </div>

                    @if($key != $post->comments->count() - 1)
                        <hr class="dotted" style="width: 75%;" />
                    @endif
                @endforeach
            @else
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> No comments so far.
                </div>
            @endif
        </div>

        <h3>Add Comment</h3>
        <hr class="dotted" />

        {{ Form::open(array('action' => ['App\Controllers\Index\HomeController@postStore', $post->id], 'class' => 'form-horizontal')) }}
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

            <div class="form-group @if($errors->has('name'))has-error@endif">
                {{ Form::label('email', 'E-mail', ['class' => 'col-sm-2 control-label']) }}

                <div class="col-sm-10">
                    {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'E-mail')) }}
                </div>
            </div>

            <div class="form-group @if($errors->has('name'))has-error@endif">
                {{ Form::label('body', 'Comment', ['class' => 'col-sm-2 control-label']) }}

                <div class="col-sm-10">
                    {{ Form::textarea('body', null, array('class' => 'form-control', 'placeholder' => 'Comment')) }}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <button class="btn btn-primary" type="submit">
                        <i class="fa fa-check"></i> Add Comment
                    </button>
                </div>
            </div>
        {{ Form::close() }}
    @endif
</div>