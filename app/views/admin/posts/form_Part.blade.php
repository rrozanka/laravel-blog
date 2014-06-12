{{ Form::model($record, array('route' => ($record) ? ['admin.posts.update', $record->id] : ['admin.posts.store'], 'class' => 'form-horizontal', 'method' => ($record) ? 'put' : 'post')) }}
    @if($errors->all())
        <div class="alert alert-danger">
            <i class="icon icon-info-circle"></i> Wystąpiły błędy w formularzu:

            <ul>
                @foreach($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group @if($errors->has('name'))has-error@endif">
        {{ Form::label('name', 'Tytuł', ['class' => 'col-sm-2 control-label']) }}

        <div class="col-sm-10">
            {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Wprowadź Tytuł')) }}
        </div>
    </div>

    <div class="form-group @if($errors->has('category'))has-error@endif">
        {{ Form::label('category', 'Kategoria', ['class' => 'col-sm-2 control-label']) }}

        <div class="col-sm-10">
            {{ Form::select('category', $categories, ($record) ? $record->category->id : null, array('class' => 'form-control', 'autocomplete' => 'off')) }}
        </div>
    </div>

    <div class="form-group @if($errors->has('tags'))has-error@endif">
        {{ Form::label('tags', 'Tagi', ['class' => 'col-sm-2 control-label']) }}

        <div class="col-sm-10">
            {{ Form::select('tags[]', $tags, ($record) ? $tagsIds : null, array('class' => 'form-control', 'autocomplete' => 'off', 'multiple' => 'multiple')) }}
        </div>
    </div>

    <div class="form-group @if($errors->has('short_body'))has-error@endif">
        {{ Form::label('short_body', 'Krótka Treść', ['class' => 'col-sm-2 control-label']) }}

        <div class="col-sm-10">
            {{ Form::textarea('short_body', null, array('class' => 'form-control', 'placeholder' => 'Wprowadź Krótką Treść', 'rows' => 5)) }}
        </div>
    </div>

    <div class="form-group @if($errors->has('body'))has-error@endif">
        {{ Form::label('body', 'Treść', ['class' => 'col-sm-2 control-label']) }}

        <div class="col-sm-10">
            {{ Form::textarea('body', null, array('class' => 'form-control', 'placeholder' => 'Treść')) }}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <button class="btn btn-success" type="submit">
                <i class="icon icon-check"></i> Zapisz
            </button>
        </div>
    </div>
{{ Form::close() }}