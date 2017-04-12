@extends('admin.layout')

@section('title')
    {{ trans('settings.title.add_category') }}
@endsection

@section('content')
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    {{ trans('settings.text.nabar.add_category') }}
                </h3>
            </div>
            <div class="panel-body">
                @if (!empty(session('status')))
                    <div class="alert alert-{{ session('status') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('message') }}
                    </div>
                @endif

                {{ Form::open([
                    'action' => 'Admin\CategoryController@store',
                    'method' => 'POST',
                    'role' => 'form',
                ])}}
                    <div class="form-group">
                        <label for="name">
                            {{ trans('settings.text.category.name') }}
                        </label>

                        @if ($errors->has('name'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif

                        {{ Form::text('name', null, [
                            'class' => 'form-control',
                            'id' => 'name',
                            'required',
                            'autofocus',
                        ]) }}
                    </div>
                    {{ Form::submit(trans('settings.button.create'), [
                        'class' => 'btn btn-primary',
                    ]) }}
                    <a href="{{ action('Admin\HomeAdminController@index') }}" class="btn btn-default">
                        {{ trans('settings.button.back') }}
                    </a>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
