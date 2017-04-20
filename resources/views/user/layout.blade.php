@extends('layouts.app')

@section('nabar')
    <li class="dropdown">
        <a href="{{ action('User\CategoryController@index') }}">
            {{ trans('settings.text.nabar.start_lesson') }}
        </a>
    </li>

    <li class="dropdown">
        <a href="{{ action('User\WordController@showList') }}">
            {{ trans('settings.text.nabar.list_word') }}
        </a>
    </li>
@endsection
