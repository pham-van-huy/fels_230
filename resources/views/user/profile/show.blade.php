@extends('user.layout')

@section('title')
    {{ trans('settings.title.detail_profile') }}
@endsection

@section('content')
<div class="col-md-6 col-md-offset-3">
    <div class="panel panel-info">
        <div class="panel-heading">
            {{ trans('settings.text.detail_profile') }}
        </div>
        <div class="panel-body">
            <div class="row">
                <label for="name" class="col-md-4">
                    {{ trans('settings.label.name_user') }}
                </label>

                <div class="col-md-6">
                    <b>{{ auth()->user()->name }}</b>
                </div>
            </div>
            <div class="row">
                <label for="email" class="col-md-4">
                    {{ trans('settings.label.email_address') }}
                </label>

                <div class="col-md-6">
                    <b>{{ auth()->user()->email }}</b>
                </div>
            </div>
            <div class="row">
                <label for="email" class="col-md-4">
                    {{ trans('settings.text.created_at') }}
                </label>

                <div class="col-md-6">
                    <b>{{ auth()->user()->created_at }}</b>
                </div>
            </div>
            <div class="row">
                <label class="col-md-4">
                    {{ trans('settings.label.avatar') }}
                </label>

                <div class="col-md-6">
                    <img src="{{ auth()->user()->avatar }}" class="img-responsive center-block" id='img-info'>
                </div>
            </div>
            <a href="{{ action('User\UserController@editProfile') }}" class="btn btn-success center-block">
                {{ trans('settings.button.edit') }}
            </a>
        </div>
    </div>
</div>
@endsection
