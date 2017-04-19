@extends('user.layout')

@section('title')
    {{ trans('settings.title.list_category') }}
@endsection

@section('content')
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <b>{{ trans('settings.text.category.list_category') }}</b>
            </div>
            <div class="panel-body">
                @foreach ($categories as $category)
                    <div class="row border-bottom">
                        <div class='col-md-8'>
                            <h3>
                                <b>
                                    {{ $category->name }}
                                    <small>
                                        {{ trans('settings.text.have') }}
                                        {{ $category->words->count() }}
                                        {{ trans('settings.text.word.words') }}
                                    </small>
                                </b>
                            </h3>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ action('User\LessonController@showLessonTest', $category->id) }}" class="btn btn-info start-lesson">
                                {{ trans('settings.button.start_lesson') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
