<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Bootstrap core CSS -->
    <?= stylesheet_link_tag() ?>
</head>
<body>
    <div class="body">
        <header>
            <div class="container">
                <h1 class="logo">
                    <a href="{{ URL::to('home/index') }}">
                        <img alt="Porto" width="111" height="54" data-sticky-width="82" data-sticky-height="40" src="/assets/logo2.png">
                    </a>
                </h1>
                <div class="search">
                    {{ Form::open(array('action' => 'App\Controllers\HomeController@getSearch', 'method' => 'get')) }}
                        <div class="input-group">
                            {{ Form::text('q', Input::get('q'), array('class' => 'form-control search', 'placeholder' => 'Szukaj...')) }}

                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="icon icon-search"></i>
                                </button>
                            </span>
                        </div>
                    {{ Form::close() }}
                </div>
                <button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
                    <i class="icon icon-bars"></i>
                </button>
            </div>

            <div class="navbar-collapse nav-main-collapse collapse">
                <div class="container">
                    <div class="social-icons">
                        <ul class="social-icons">
                            <li class="facebook">
                                <a href="http://www.facebook.com/" target="_blank" title="Facebook">
                                    Facebook
                                </a>
                            </li>
                            <li class="twitter">
                                <a href="http://www.twitter.com/" target="_blank" title="Twitter">
                                    Twitter
                                </a>
                            </li>
                            <li class="linkedin">
                                <a href="http://www.linkedin.com/" target="_blank" title="Linkedin">
                                    Linkedin
                                </a>
                            </li>
                        </ul>
                    </div>

                    <nav class="nav-main mega-menu">
                        <ul class="nav nav-pills nav-main" id="mainMenu">
                            <li class="@if(Request::is('/') || Request::is('home/index') || Request::is('home/post/*'))active@endif">
                                <a href="{{ URL::to('/') }}">
                                    <i class="icon icon-home"></i> Strona główna
                                </a>
                            </li>
                            <li class="dropdown @if(Request::is('home/author/*'))active@endif">
                                <a href="#" class="dropdown-toggle">
                                    <i class="icon icon-users"></i> Autorzy <i class="icon icon-angle-down"></i>
                                </a>

                                @if($authors)
                                    <ul class="dropdown-menu">
                                        @foreach($authors as $author)
                                            <li>
                                                <a href="{{ URL::to('home/author', [$author->id, Str::slug($author->firstname . ' ' . $author->lastname)]) }}">
                                                    {{ $author->firstname . ' ' . $author->lastname }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                            <li class="dropdown @if(Request::is('home/category/*'))active@endif">
                                <a href="#" class="dropdown-toggle">
                                    <i class="icon icon-folder"></i> Kategorie <i class="icon icon-angle-down"></i>
                                </a>

                                @if($categories)
                                    <ul class="dropdown-menu">
                                        @foreach($categories as $category)
                                            <li>
                                                <a href="{{ URL::to('home/category', [$category->id, Str::slug($category->name)]) }}">
                                                    {{ $category->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                            <li class="dropdown @if(Request::is('home/tag/*'))active@endif">
                                <a href="#" class="dropdown-toggle">
                                    <i class="icon icon-tag"></i> Tagi <i class="icon icon-angle-down"></i>
                                </a>

                                @if($tags)
                                    <ul class="dropdown-menu">
                                        @foreach($tags as $tag)
                                            <li>
                                                <a href="{{ URL::to('home/tag', [$tag->id, Str::slug($tag->name)]) }}">
                                                    {{ $tag->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>

                            @if(Auth::check())
                                <li>
                                    <a href="{{ URL::to('admin/index') }}">
                                        <i class="icon icon-cogs"></i> Admin
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ URL::to('logout') }}">
                                        <i class="icon icon-sign-out"></i> Wyloguj się
                                    </a>
                                </li>
                            @else
                                <li class="@if(Request::is('login'))active@endif">
                                    <a href="{{ URL::to('login') }}">
                                        <i class="icon icon-sign-in"></i> Logowanie
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </header>

        <div class="main" role="main">
            @yield('breadcrumb')

            <div class="container">
                @if(!isset($hideSidebar))
                    <div class="row">
                        <div class="col-md-9">
                            @yield('content')
                        </div>

                        <div class="col-md-3">
                            <aside class="sidebar">
                                <h4>
                                    Kategorie
                                </h4>

                                @if($categories)
                                    <ul class="nav nav-list primary push-bottom">
                                        @foreach($categories as $category)
                                            <li>
                                                <a href="{{ URL::to('home/category', [$category->id, Str::slug($category->name)]) }}">
                                                    {{ $category->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                <hr>

                                <h4>
                                    Tagi
                                </h4>

                                @if($tags)
                                    <ul class="nav nav-list primary push-bottom">
                                        @foreach($tags as $tag)
                                            <li>
                                                <a href="{{ URL::to('home/tag', [$tag->id, Str::slug($tag->name)]) }}">
                                                    {{ $tag->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                <hr />

                                <h4>
                                    O mnie
                                </h4>

                                <p>
                                    {{ $about }}
                                </p>
                            </aside>
                        </div>
                    </div>
                @else
                    @yield('content')
                @endif
            </div>
        </div>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="footer-ribon">
                        <span>
                            Kontakt
                        </span>
                    </div>

                    <div class="col-md-10">
                        <div class="newsletter">
                            <h4>
                                Ostatnie wpisy
                            </h4>

                            <ul>
                                <li>
                                    <a href="#">
                                        Pierwszy wpis
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Drugi wpis
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Trzeci wpis
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <h4>
                            Mój profil na ...
                        </h4>

                        <div class="social-icons">
                            <ul class="social-icons">
                                <li class="facebook">
                                    <a href="http://www.facebook.com/" target="_blank" data-placement="bottom" rel="tooltip" title="Facebook">
                                        Facebook
                                    </a>
                                </li>
                                <li class="twitter">
                                    <a href="http://www.twitter.com/" target="_blank" data-placement="bottom" rel="tooltip" title="Twitter">
                                        Twitter
                                    </a>
                                </li>
                                <li class="linkedin">
                                    <a href="http://www.linkedin.com/" target="_blank" data-placement="bottom" rel="tooltip" title="Linkedin">
                                        Linkedin
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-1">
                            <a class="logo" href="index.html">
                                <img alt="Porto Website Template" class="img-responsive" src="/assets/logo-footer2.png">
                            </a>
                        </div>

                        <div class="col-md-7">
                            <p>
                                © Copyright 2014 &middot; Rafał Różanka
                            </p>
                        </div>

                        <div class="col-md-4">
                            <nav id="sub-menu">
                                <ul>
                                    <li>
                                        <a href="page-faq.html">
                                            Strona główna
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript">
        var flashMessage = "{{ Session::get('flash_message') }}";
        var flashMessageType = "{{ Session::get('flash_type') }}"
    </script>
    <?= javascript_include_tag() ?>
    @yield('scripts')
</body>
</html>