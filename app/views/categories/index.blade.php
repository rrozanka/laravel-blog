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
                <li class="active">Categories</li>
            </ol>

            <a class="btn btn-success margin-bottom-20" href="{{ URL::route('categories.create') }}">
                <i class="fa fa-plus"></i> Add New Category
            </a>

            <div>
                <table class="table">
                    <thead>
                    <tr>
                        <td>id</td>
                        <td>name</td>
                        <td>actions</td>
                    </tr>
                    </thead>
                    <tbody>
                        @if($records->count())
                            @foreach($records as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-xs" href="{{ URL::route('categories.edit', $category->id) }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        <a class="btn btn-danger btn-xs delete-record" href="{{ URL::route('categories.destroy', $category->id) }}">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">
                                    <i class="fa fa-info-circle"></i> No categories found.
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
                if (confirm('Do you really want to delete this category?')) {
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