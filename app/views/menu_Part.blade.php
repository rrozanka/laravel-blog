<ul class="nav nav-pills nav-stacked">
    <li>
        <a href="{{ URL::to('/') }}">
            <i class="icon icon-home"></i> Strona główna
        </a>
    </li>

    @if(Auth::getUser()->role == \Acme\User::$adminRole)
        <li class="@if(Request::is('admin/users*'))active@endif">
            <a href="{{ URL::route('admin.users.index') }}">
                <i class="icon icon-users"></i> Użytkownicy
            </a>
        </li>
        <li class="@if(Request::is('admin/settings*'))active@endif">
            <a href="{{ URL::to('admin/settings') }}">
                <i class="icon icon-cogs"></i> Ustawienia
            </a>
        </li>
        <li class="@if(Request::is('admin/comments*'))active@endif">
            <a href="{{ URL::route('admin.comments.index') }}">
                <i class="icon icon-comments"></i> Komentarze
            </a>
        </li>
    @endif

    <li class="@if(Request::is('admin/categories*'))active@endif">
        <a href="{{ URL::route('admin.categories.index') }}">
            <i class="icon icon-folder"></i> Kategorie
        </a>
    </li>
    <li class="@if(Request::is('admin/tags*'))active@endif">
        <a href="{{ URL::route('admin.tags.index') }}">
            <i class="icon icon-tags"></i> Tagi
        </a>
    </li>
    <li class="@if(Request::is('admin/posts*'))active@endif">
        <a href="{{ URL::route('admin.posts.index') }}">
            <i class="icon icon-pencil"></i> Wpisy
        </a>
    </li>
    <li>
        <a href="{{ URL::to('logout') }}">
            <i class="icon icon-sign-out"></i> Wyloguj się
        </a>
    </li>
</ul>