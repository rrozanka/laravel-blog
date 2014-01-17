@if($about)
    <div class="sidebar-module sidebar-module-inset">
        <h4>About</h4>
        <p>
            {{ nl2br($about) }}
        </p>
    </div>
@endif

@if($categories->count())
    <div class="sidebar-module">
        <h4>Categories</h4>

        <ol class="list-unstyled">
            @foreach($categories as $category)
                <li>
                    <a href="{{ URL::to('home/category', $category->id) }}">
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
                    <a href="{{ URL::to('home/tag', $tag->id) }}">
                        {{ $tag->name }}
                    </a>
                </li>
            @endforeach
        </ol>
    </div>
@endif