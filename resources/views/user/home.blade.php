@extends('user.layout')

@section('title')
    {{ trans('settings.title.homepage') }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        {{ trans('settings.text.user_infor') }}
                    </div>
                    <div class="panel-body">
                        <img src="{{ auth()->user()->avatar }}" class="img-responsive center-block" id='img-info'>
                        <p class="text-center" class="name-user">{{ auth()->user()->name }}</p>

                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="badge">11</span>
                                {{ trans('settings.text.learned_words') }}
                            </li>
                            <li class="list-group-item">
                                <span class="badge">12</span>
                                {{ trans('settings.text.followers') }}
                            </li>
                            <li class="list-group-item">
                                <span class="badge">13</span>
                                {{ trans('settings.text.following') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        {{ trans('settings.text.activities_user') }}
                    </div>
                    <div class="panel-body">
                        Basic panel example
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        {{ trans('settings.text.activities_of_followings') }}
                    </div>
                    <div class="panel-body">
                        Basic panel example
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
