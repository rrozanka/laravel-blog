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
                            Logowanie
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>
                        Logowanie
                    </h2>
                </div>
            </div>
        </div>
    </section>
@stop

@section('content')
    <div class="row featured-boxes login">
        <div class="col-md-6 col-md-push-3">
            <div class="featured-box featured-box-secundary default info-content">
                <div class="box-content">
                    <h4>
                        Witaj ponownie!
                    </h4>

                    {{ Form::open(['route' => 'sessions.store', 'id' => 'login-form', 'class' => 'form-horizontal']) }}
                        <div class="row">
                            <div class="form-group @if(Session::has('flash_message'))has-error@endif">
                                <div class="col-md-12">
                                    {{ Form::label('email', 'E-mail') }}

                                    {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'Wprowadź E-mail')) }}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group @if(Session::has('flash_message'))has-error@endif">
                                <div class="col-md-12">
                                    {{ Form::label('password', 'Hasło') }}

                                    {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Wprowadź Hasło')) }}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <button class="btn btn-primary push-bottom" type="submit">
                                <i class="icon icon-sign-in"></i> Zaloguj się
                            </button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop