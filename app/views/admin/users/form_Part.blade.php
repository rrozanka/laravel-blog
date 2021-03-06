{{ Form::model($record, array('route' => ($record) ? ['admin.users.update', $record->id] : ['admin.users.store'], 'class' => 'form-horizontal', 'method' => ($record) ? 'put' : 'post')) }}
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

    <div class="form-group @if($errors->has('firstname'))has-error@endif">
        {{ Form::label('firstname', 'First name', ['class' => 'col-sm-2 control-label']) }}

        <div class="col-sm-10">
            {{ Form::text('firstname', null, array('class' => 'form-control', 'placeholder' => 'First Name')) }}
        </div>
    </div>

    <div class="form-group @if($errors->has('lastname'))has-error@endif">
        {{ Form::label('lastname', 'Last name', ['class' => 'col-sm-2 control-label']) }}

        <div class="col-sm-10">
            {{ Form::text('lastname', null, array('class' => 'form-control', 'placeholder' => 'Last Name')) }}
        </div>
    </div>

    <div class="form-group @if($errors->has('email'))has-error@endif">
        {{ Form::label('email', 'E-mail', ['class' => 'col-sm-2 control-label']) }}

        <div class="col-sm-10">
            {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'E-mail')) }}
        </div>
    </div>

    <div class="form-group @if($errors->has('password'))has-error@endif">
        {{ Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) }}

        <div class="col-sm-10">
            {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
        </div>
    </div>

    <div class="form-group @if($errors->has('password_confirmation'))has-error@endif">
        {{ Form::label('password_confirmation', 'Re-password', ['class' => 'col-sm-2 control-label']) }}

        <div class="col-sm-10">
            {{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Re-password')) }}
        </div>
    </div>

    <div class="form-group @if($errors->has('role'))has-error@endif">
        {{ Form::label('role', 'Role', ['class' => 'col-sm-2 control-label']) }}

        <div class="col-sm-10">
            {{ Form::select('role', ['' => 'Select role', \Acme\User::$adminRole => 'Administrator', \Acme\User::$authorRole => 'Author'], null, array('class' => 'form-control', 'placeholder' => 'Role')) }}
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