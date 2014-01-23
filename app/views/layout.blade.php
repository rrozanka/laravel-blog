<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Laravel tutorial blog">
        <meta name="author" content="Polcode">
        <title>Laravel Blog</title>

        <!-- Bootstrap core CSS -->
        <?= stylesheet_link_tag() ?>
    </head>
    <body>
        <div class="blog-masthead">
            <div class="container">
                <nav class="blog-nav">
                    <a class="blog-nav-item @if((Request::is('/*') || Request::is('home/*')) && !Request::is('home/login'))active@endif" href="{{ URL::to('/') }}">
                        <i class="fa fa-home"></i> Home
                    </a>

                    @if(!Auth::check())
                        <a class="blog-nav-item pull-right @if(Request::is('home/login'))active@endif" href="{{ URL::to('home/login') }}">
                            <i class="fa fa-sign-in"></i> Login
                        </a>
                    @else
                        <a class="blog-nav-item @if(!Request::is('/*') && !Request::is('home/*'))active@endif" href="{{ URL::to('admin/index') }}">
                            <i class="fa fa-user"></i> @if(Auth::getUser()->role == \App\Models\User::$adminRole){{ 'Admin' }}@else{{ 'Author' }}@endif
                        </a>

                        <a class="blog-nav-item pull-right" href="{{ URL::to('home/logout') }}">
                            <i class="fa fa-power-off"></i> Logout
                        </a>
                    @endif
                </nav>
            </div>
        </div>

        <div class="container content-container">
            <div class="content-container-inner">
                @yield('content')
            </div>
        </div>

        <div class="blog-footer">
            <p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
            <p>
                <a href="#">Back to top</a>
            </p>
        </div>

        <!-- Placed at the end of the document so the pages load faster -->
        <?= javascript_include_tag() ?>
        @yield('scripts')
    </body>
</html>