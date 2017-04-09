@extends('layouts.app')

@section('title')
    {{ trans('settings.title.login') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    {{ trans('settings.title.login') }}
                </div>
                <div class="panel-body">
                    {{ Form::open([
                        'method' => 'POST',
                        'class' => 'form-horizontal',
                        'action' => 'Auth\LoginController@login',
                        'role' => 'form',
                    ]) }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">
                                {{ trans('settings.label.email_address') }}
                            </label>

                            <div class="col-md-6">
                                {{ Form::email('email', old('email'), [
                                    'class' => 'form-control',
                                    'id' => 'email',
                                    'required'
                                ]) }}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">
                                {{ trans('settings.label.password') }}
                            </label>

                            <div class="col-md-6">
                                {{ Form::password('password', [
                                    'class' => 'form-control',
                                    'id' => 'password',
                                    'required',
                                ]) }}

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('remember', null) }}
                                        {{ trans('settings.label.remember_me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                {{ Form::submit(trans('settings.button.login'), ['class' => 'btn btn-primary']) }}

                                <a class="btn btn-link" href="{{ action('Auth\ForgotPasswordController@showLinkRequestForm') }}">
                                    {{ trans('settings.button.forgot_password') }}
                                </a>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
