@extends('admin.layout')

@section('title')
    {{ trans('settings.title.home_admin') }}
@endsection

@section('content')
    <center>
        <h3> {{ trans('settings.text.hello') }} {{ Auth::user()->name }}</h3>
        <h3> {{ trans('settings.text.home_admin') }}</h3>
    </center>
@endsection
