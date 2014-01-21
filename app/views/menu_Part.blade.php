<ul class="nav nav-pills nav-stacked">
    <li class="@if(Request::is('admin/index'))active@endif">
        {{ HTML::link('admin/index', 'Dashboard') }}
    </li>

    @if(Auth::getUser()->role == \App\Models\User::$adminRole)
        <li class="@if(Request::is('admin/users*'))active@endif">
            {{ link_to_route('admin.users.index', 'Users') }}
        </li>
    @endif

    <li class="@if(Request::is('admin/categories*'))active@endif">
        {{ link_to_route('admin.categories.index', 'Categories') }}
    </li>
    <li class="@if(Request::is('admin/tags*'))active@endif">
        {{ link_to_route('admin.tags.index', 'Tags') }}
    </li>
    <li class="@if(Request::is('admin/posts*'))active@endif">
        {{ link_to_route('admin.posts.index', 'Posts') }}
    </li>

    @if(Auth::getUser()->role == \App\Models\User::$adminRole)
        <li class="@if(Request::is('admin/settings*'))active@endif">
            {{ HTML::link('admin/settings', 'Settings') }}
        </li>
        <li class="@if(Request::is('admin/comments*'))active@endif">
            {{ link_to_route('admin.comments.index', 'Comments') }}
        </li>
    @endif
</ul>