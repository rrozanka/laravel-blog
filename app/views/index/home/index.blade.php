@extends('layout-frontend')
@section('breadcrumb')
    <section class="page-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="active">
                            Strona główna
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>
                        Strona główna
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

    <div class="blog-posts">
        @if($posts->count())
            @foreach($posts as $key => $post)
                @include('index.home.post_Part2')
            @endforeach
        @endif

        {{ $posts->links() }}
    </div>
@stop