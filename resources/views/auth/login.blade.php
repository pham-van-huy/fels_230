@extends('layouts.app')

@section('title')
    {{ trans('settings.title.login') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('settings.button.login') }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">
                                {{ trans('settings.label.email_address') }}
                            </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

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
                                <input id="password" type="password" class="form-control" name="password" required>

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
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}>
                                        {{ trans('settings.label.remember_me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('settings.button.login') }}
                                </button>

                                <a class="btn btn-link" href="{{ action('Auth\ForgotPasswordController@showLinkRequestForm') }}">
                                    {{ trans('settings.button.forgot_password') }}
                                </a>
                            </div>
                        </div>
                        <center>
                            <a class="btn" href="">
                                <i class="fa fa-facebook"></i>
                                {{ trans('settings.text.social.facebook') }}
                            </a>

                            <a class="btn" href="">
                                <i class="fa fa-google-plus-square" aria-hidden="true"></i>
                                {{ trans('settings.text.social.google') }}
                            </a>

                            <a class="btn" href="">
                                <i class="fa fa-google-plus-square" aria-hidden="true"></i>
                                {{ trans('settings.text.social.twitter') }}
                            </a>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
