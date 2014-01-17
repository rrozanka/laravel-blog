{{ Form::model($record, array('route' => ($record) ? ['admin.categories.update', $record->id] : ['admin.categories.store'], 'class' => 'form-horizontal', 'method' => ($record) ? 'put' : 'post')) }}
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
        {{ Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) }}

        <div class="col-sm-10">
            {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Name')) }}
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