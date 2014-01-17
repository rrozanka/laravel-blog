@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-2">
            @include('menu_Part')
        </div>

        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ URL::to('admin/index') }}">Home</a>
                </li>
                <li class="active">Posts</li>
            </ol>

            <a class="btn btn-success margin-bottom-20" href="{{ URL::route('admin.posts.create') }}">
                <i class="fa fa-plus"></i> Add New Post
            </a>

            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <td>id</td>
                            <td>title</td>
                            <td>author</td>
                            <td>category</td>
                            <td>actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if($records->count())
                            @foreach($records as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->name }}</td>
                                    <td>{{ $post->user->firstname . ' ' . $post->user->lastname }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-xs" href="{{ URL::route('admin.posts.edit', $post->id) }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        <a class="btn btn-danger btn-xs delete-record" href="{{ URL::route('admin.posts.destroy', $post->id) }}">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">
                                    <i class="fa fa-info-circle"></i> No posts found.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('.delete-record').click(function() {
            if (confirm('Do you really want to delete this post?')) {
                $.ajax({
                    url: $(this).attr('href'),
                    type: 'DELETE',
                    success: function() {
                        location.reload();
                    }
                });
            }

            return false;
        });
    });
</script>
@stop