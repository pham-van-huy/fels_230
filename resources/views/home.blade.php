@extends('layouts.app')

@section('title')
    {{ trans('settings.title.homepage') }}
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    {{ trans('settings.text.framgia_elearning_system') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
