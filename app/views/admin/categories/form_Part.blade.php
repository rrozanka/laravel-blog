{{ Form::model($record, array('route' => ($record) ? ['admin.categories.update', $record->id] : ['admin.categories.store'], 'class' => 'form-horizontal', 'method' => ($record) ? 'put' : 'post')) }}
    @if($errors->all())
        <div class="alert alert-danger">
            <i class="fa fa-info-circle"></i> Wystąpiły błędy w formularzu:

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group @if($errors->has('name'))has-error@endif">
        {{ Form::label('name', 'Nazwa', ['class' => 'col-sm-2 control-label']) }}

        <div class="col-sm-10">
            {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Wprowadź Nazwę')) }}
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