<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Laravel tutorial blog">
        <meta name="author" content="Polcode">
        <title>Blog | Admin</title>

        <!-- Bootstrap core CSS -->
        <?= stylesheet_link_tag() ?>
    </head>
    <body>
        <div class="container content-container">
            <a href="{{ URL::to('/') }}" style="display: block; margin-top: 25px;">
                <img src="/assets/logo2.png">
            </a>

            <div class="content-container-inner">
                @yield('content')
            </div>
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