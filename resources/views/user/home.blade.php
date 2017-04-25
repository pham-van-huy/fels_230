@extends('user.layout')

@section('title')
    {{ trans('settings.title.homepage') }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading text-heading">
                        {{ trans('settings.text.user_infor') }}
                    </div>
                    <div class="panel-body show-info-homepage">
                        <img src="{{ auth()->user()->avatar }}" class="img-responsive center-block" id='img-info'>
                        <p class="text-center" class="name-user">
                            <b> {{ auth()->user()->name }} </b>
                        </p>

                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="badge">
                                    {{ $numberWordsLearned }}
                                </span>
                                {{ trans('settings.text.learned_words') }}
                            </li>
                            <li class="list-group-item">
                                <span class="badge">
                                    {{ $numberFollowers }}
                                </span>
                                {{ trans('settings.text.followers') }}
                            </li>
                            <li class="list-group-item">
                                <span class="badge">
                                    {{ $numberFollowings }}
                                </span>
                                {{ trans('settings.text.following') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-5 user-history">
                <div class="panel panel-info">
                    <div class="panel-heading text-heading">
                        {{ trans('settings.text.activities_user') }}
                    </div>
                    <div class="panel-body show-info-homepage history">
                        <div class="section-history">
                            @if (count($userActivities) > 0)
                                @foreach ($userActivities as $time => $userActivity)
                                <p>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    {{ $time }}
                                </p>
                                    <ul>
                                        @foreach ($userActivity as $lesson)
                                        <li>
                                            <p>
                                                <span class="label label-info">
                                                    {{ $lesson->created_at->format('H:i A') }}
                                                </span>
                                                <span class="infor-history">
                                                    <a href="{{ action('User\ResultController@getResult', $lesson->id) }}">
                                                        {{ trans('settings.text.words_learned_category', [
                                                            'countLearnedWord' => $lesson->answers->count(),
                                                            'nameCagory' => $lesson->category->name,
                                                        ]) }}
                                                    </a>
                                                </span>
                                            </p>
                                        </li>
                                        @endforeach
                                    </ul>
                                @endforeach
                            @else
                                <p class="text-info">{{ trans('settings.text.no_activity') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 following-history">
                <div class="panel panel-info">
                    <div class="panel-heading text-heading">
                        {{ trans('settings.text.activities_of_followings') }}
                    </div>
                    <div class="panel-body show-info-homepage history">
                        <div class="section-history">
                            @if (count($followingActivities) > 0)
                                @foreach ($followingActivities as $nameUser => $followingActivity)
                                <p>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <b class="text-primary"> {{ $nameUser }} </b>
                                </p>
                                    <ul>
                                        @foreach ($followingActivity as $lesson)
                                        <li>
                                            <p>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <span class="label label-info">
                                                    {{ $lesson->created_at->format('d/m/Y') }}
                                                </span>
                                                <span class="infor-history">
                                                    {{ trans('settings.text.words_learned_category', [
                                                        'countLearnedWord' => $lesson->answers->count(),
                                                        'nameCagory' => $lesson->category->name,
                                                    ]) }}
                                                </span>
                                            </p>
                                        </li>
                                        @endforeach
                                    </ul>
                                @endforeach
                            @else
                                <p class="text-info">{{ trans('settings.text.no_activity') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
