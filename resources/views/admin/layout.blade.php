@extends('layouts.app')

@section('nabar')
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{ trans('settings.text.nabar.user_manage') }}
            <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li>
                <a href="#">
                    {{ trans('settings.text.nabar.list_user') }}
                </a>
            </li>
        </ul>
    </li>

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{ trans('settings.text.nabar.category_manage') }}
            <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li>
                <a href="{{ action('Admin\CategoryController@index') }}">
                    {{ trans('settings.text.nabar.list_category') }}
                </a>
            </li>

            <li>
                <a href="{{ action('Admin\CategoryController@create') }}">
                    {{ trans('settings.text.nabar.add_category') }}
                </a>
            </li>
        </ul>
    </li>

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{ trans('settings.text.nabar.word_manage') }}
            <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li>
                <a href="#">
                    {{ trans('settings.text.nabar.list_word') }}
                </a>
            </li>

            <li>
                <a href="#">
                    {{ trans('settings.text.nabar.add_word') }}
                </a>
            </li>
        </ul>
    </li>
@endsection
