@extends('layouts.app')

@section('nabar')
    <li class="dropdown">
        <a href="#">
            {{ trans('settings.text.nabar.start_lesson') }}
        </a>
    </li>

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{ trans('settings.text.nabar.list_word') }}
        </a>
    </li>
@endsection
