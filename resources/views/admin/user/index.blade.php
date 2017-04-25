@extends('admin.layout')

@section('title')
    {{ trans('settings.title.list_user') }}
@endsection

@section('content')
    <div class="col-md-10 col-md-offset-1">
        @if (!empty(session('status')))
            <div class="alert alert-{{ session('status') }}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('message') }}
            </div>
        @endif
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class='row'>
                    <div class="col-md-6 text-heading">
                        {{ trans('settings.title.list_user') }}
                    </div>
                    <div class='col-md-6 text-right'>
                        {{ Form::open([
                            'action' => 'Admin\UserController@filterUser',
                            'method' => 'POST',
                            'class' => 'form-inline',
                        ]) }}
                            <div class="form-group">
                                {{ Form::text('key', $oldKey, [
                                    'class' => 'form-control input-sm',
                                    'placeholder' => trans('settings.text.search_by_email'),
                                ]) }}
                            </div>

                            {{ Form::submit(trans('settings.button.filter'), [
                                'class' => 'btn btn-primary form-control input-sm',
                            ]) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <div class="panel-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ trans('settings.text.user.id_user') }}</th>
                        <th>{{ trans('settings.text.user.name_user') }}</th>
                        <th>{{ trans('settings.text.user.email_user') }}</th>
                        <th>{{ trans('settings.text.created_at') }}</th>
                        <th>{{ trans('settings.text.user.avatar_user') }}</th>
                        <th>{{ trans('settings.text.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <img class="img-responsive img-list-user" src="{{ $user->avatar }}">
                            </td>
                            <td>
                                <ul class="list-category">
                                    <li>
                                        <a href="{{ action('Admin\UserController@edit', $user->id) }}" class="btn btn-success btn-xs">
                                            {{ trans('settings.button.edit') }}
                                        </a>
                                    </li>
                                    <li>
                                        {{ Form::open([
                                            'action' => ['Admin\UserController@destroy', $user->id],
                                            'method' => 'DELETE',
                                        ]) }}
                                            {{ Form::submit(trans('settings.button.delete'), [
                                                'class' => 'btn btn-danger btn-xs delete-admin',
                                                'data-confirm' => trans('settings.text.are_you_sure'),
                                            ]) }}
                                        {{ Form::close() }}
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
