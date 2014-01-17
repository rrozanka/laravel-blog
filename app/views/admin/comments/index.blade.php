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
                <li class="active">Comments</li>
            </ol>

            <div>
                <table class="table">
                    <thead>
                    <tr>
                        <td>id</td>
                        <td>author</td>
                        <td>post</td>
                        <td>comment</td>
                        <td>actions</td>
                    </tr>
                    </thead>
                    <tbody>
                        @if($records->count())
                            @foreach($records as $record)
                                <tr>
                                    <td>{{ $record->id }}</td>
                                    <td>{{ $record->name }}</td>
                                    <td>{{ $record->post->name }}</td>
                                    <td>{{ ViewHelper::short($record->body, 75) }}</td>
                                    <td>
                                        <a class="btn btn-danger btn-xs delete-record" href="{{ URL::route('admin.comments.destroy', $record->id) }}">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">
                                    <i class="fa fa-info-circle"></i> No comments found.
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
                if (confirm('Do you really want to delete this comment?')) {
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