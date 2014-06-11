@extends('layout-frontend')
@section('breadcrumb')
    <section class="page-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li>
                            <a href="{{ URL::to('home/index') }}">
                                Strona główna
                            </a>
                        </li>
                        <li class="active">
                            Kategoria
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>
                        {{ $category->name }}
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