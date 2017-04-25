@extends('admin.layout')

@section('title')
    {{ trans('settings.title.edit_user') }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div>
                @if (!empty(session('status')))
                    <div class="alert alert-{{ session('status') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('message') }}
                    </div>
                @endif
                <div class="panel panel-info">
                    <div class="panel-heading text-heading">
                        {{ trans('settings.text.edit_user') }}
                    </div>
                    <div class="panel-body">
                        {{ Form::open([
                            'class' => 'form-horizontal',
                            'role' => 'form',
                            'method' => 'PATCH',
                            'action' => ['Admin\UserController@update', $user->id],
                            'enctype' => 'multipart/form-data',
                        ]) }}
                            {{ Form::hidden('userId', $user->id) }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">
                                    {{ trans('settings.label.name_user') }}
                                </label>

                                <div class="col-md-6">
                                    {{ Form::text('name', $user->name, [
                                        'class' => 'form-control',
                                        'id' => 'name',
                                        'required',
                                        'autofocus'
                                    ]) }}

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">
                                    {{ trans('settings.label.email_address') }}
                                </label>

                                <div class="col-md-6">
                                    {{ Form::email('email', $user->email, [
                                        'class' => 'form-control',
                                        'id' => 'email',
                                        'required',
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
                                    {{ trans('settings.label.new_password') }}
                                </label>

                                <div class="col-md-6">
                                    {{ Form::password('password', [
                                        'class' => 'form-control',
                                        'id' => 'password-new',
                                    ]) }}

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">
                                    {{ trans('settings.label.confirm_new_password') }}
                                </label>

                                <div class="col-md-6">
                                    {{ Form::password('password_confirmation', [
                                        'class' => 'form-control',
                                        'id' => 'password-new-confirm',
                                    ]) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="avatar" class="col-md-4 control-label">
                                    {{ trans('settings.label.avatar') }}
                                </label>

                                <div class="col-md-6">
                                    {{ Form::file('avatar', [
                                        'id' => 'avatar',
                                    ]) }}
                                    <img src="{{ $user->avatar }}" class="img-responsive center-block" id='img-info'>
                                </div>
                                @if ($errors->has('avatar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    {{ Form::submit(trans('settings.button.update'), [
                                        'class' => 'btn btn-primary',
                                        'id' => 'update-profile',
                                    ]) }}
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
