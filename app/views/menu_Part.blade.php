<ul class="nav nav-pills nav-stacked">
    <li class="@if(Request::is('admin/index'))active@endif">
        {{ HTML::link('admin/index', 'Dashboard') }}
    </li>
    <li class="@if(Request::is('users*'))active@endif">
        {{ link_to_route('users.index', 'Users') }}
    </li>
    <li class="@if(Request::is('categories*'))active@endif">
        {{ link_to_route('categories.index', 'Categories') }}
    </li>
    <li class="@if(Request::is('tags*'))active@endif">
        {{ link_to_route('tags.index', 'Tags') }}
    </li>
    <li class="@if(Request::is('posts*'))active@endif">
        {{ link_to_route('posts.index', 'Posts') }}
    </li>
    <li class="@if(Request::is('settings*'))active@endif">
        {{ HTML::link('settings/index', 'Settings') }}
    </li>
</ul>