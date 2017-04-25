@extends('user.layout')

@section('title')
    {{ trans('settings.title.list_member') }}
@endsection

@section('content')
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-7 text-heading">{{ trans('settings.text.list_member') }}</div>
                    <div class="col-md-5">
                        {{ Form::open([
                            'method' => 'GET',
                            'class' => 'form-inline',
                            'action' => 'User\UserController@memberFilter',
                        ]) }}
                            <div class="form-group">
                                {{ Form::select('notOrFollow', $options, $oldOption, [
                                    'class' => 'form-control',
                                ]) }}
                            </div>
                            <div class="form-group">
                                {{ Form::text('keyName', $oldKeyName, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('settings.text.search'),
                                ]) }}
                            </div>
                            <div class="form-group">
                                {{ Form::submit(trans('settings.button.search'), [
                                    'class' => 'btn btn-primary',
                                ]) }}
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('settings.text.user.name_user') }}</th>
                            <th>{{ trans('settings.text.user.email_user') }}</th>
                            <th>{{ trans('settings.text.user.avatar_user') }}</th>
                            <th>{{ trans('settings.text.user.lesson') }}</th>
                            <th>{{ trans('settings.text.user.followers') }}</th>
                            <th>{{ trans('settings.text.user.followings') }}</th>
                            <th>{{ trans('settings.text.user.follow') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($members))
                            @foreach ($members as $member)
                                <tr>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>
                                        <img class="img-responsive img-list-user" src="{{ $member->avatar }}">
                                    </td>
                                    <td>{{ $member->lessons->count() }}</td>
                                    <td>{{ $member->followers->count() }}</td>
                                    <td>{{ $member->followings->count() }}</td>
                                    <td class="show-member">
                                        @if (auth()->user()->followings->contains('id', $member->id))
                                            <a class="btn btn-warning action-relationship-user" href="javascript:void(0)"
                                                data-trans="{{ trans('settings.text.user.follow') }}"
                                                data-url-user= "{{ action('User\UserController@addRelationship', [
                                                    'id' => $member->id,
                                                ]) }}">
                                                {{ trans('settings.text.user.unfollow') }}
                                            </a>
                                        @else
                                            <a class="btn btn-success action-relationship-user" href="javascript:void(0)"
                                                data-trans="{{ trans('settings.text.user.unfollow') }}"
                                                data-url-user= "{{ action('User\UserController@addRelationship', $member->id) }}">
                                                {{ trans('settings.text.user.follow') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>{{ trans('settings.text.category_empty') }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                @if(!empty($members))
                    {{ $members->appends([
                        'notOrFollow' => $oldOption,
                        'keyName' => $oldKeyName,
                    ])->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection
