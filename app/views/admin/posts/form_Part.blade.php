{{ Form::model($record, array('route' => ($record) ? ['admin.posts.update', $record->id] : ['admin.posts.store'], 'class' => 'form-horizontal', 'method' => ($record) ? 'put' : 'post')) }}
    @if($errors->all())
        <div class="alert alert-danger">
            <i class="fa fa-info-circle"></i> The following errors occurred:
            <ul class="padding-left-15">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group @if($errors->has('name'))has-error@endif">
        {{ Form::label('name', 'First name', ['class' => 'col-sm-2 control-label']) }}

        <div class="col-sm-10">
            {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Title')) }}
        </div>
    </div>

    <div class="form-group @if($errors->has('category'))has-error@endif">
        {{ Form::label('category', 'Category', ['class' => 'col-sm-2 control-label']) }}

        <div class="col-sm-10">
            {{ Form::select('category', $categories, ($record) ? $record->category->id : null, array('class' => 'form-control', 'placeholder' => 'Category', 'autocomplete' => 'off')) }}
        </div>
    </div>

    <div class="form-group @if($errors->has('tags'))has-error@endif">
        {{ Form::label('tags', 'Tags', ['class' => 'col-sm-2 control-label']) }}

        <div class="col-sm-10">
            {{ Form::select('tags[]', $tags, ($record) ? $tagsIds : null, array('class' => 'form-control', 'placeholder' => 'Tags', 'autocomplete' => 'off', 'multiple' => 'multiple')) }}
        </div>
    </div>

    <div class="form-group @if($errors->has('short_body'))has-error@endif">
        {{ Form::label('short_body', 'Short content', ['class' => 'col-sm-2 control-label']) }}

        <div class="col-sm-10">
            {{ Form::textarea('short_body', null, array('class' => 'form-control', 'placeholder' => 'Short content', 'rows' => 5)) }}
        </div>
    </div>

    <div class="form-group @if($errors->has('body'))has-error@endif">
        {{ Form::label('body', 'Content', ['class' => 'col-sm-2 control-label']) }}

        <div class="col-sm-10">
            {{ Form::textarea('body', null, array('class' => 'form-control', 'placeholder' => 'Content')) }}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <button class="btn btn-primary" type="submit">
                <i class="fa fa-check"></i> Submit
            </button>
        </div>
    </div>
{{ Form::close() }}