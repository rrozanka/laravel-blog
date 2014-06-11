<article class="post post-large">
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

        <p>
            @if(isset($singlePage) && $singlePage)
                {{ nl2br($post->body) }}
            @else
                {{ nl2br($post->short_body) }}
            @endif
        </p>

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

            @if(!isset($singlePage) || !$singlePage)
                <a href="{{ URL::to('home/post', [$post->id, Str::slug($post->name)]) }}" class="btn btn-xs btn-primary pull-right">
                    Read more <i class="icon icon-long-arrow-right"></i>
                </a>
            @endif
        </div>
    </div>
</article>