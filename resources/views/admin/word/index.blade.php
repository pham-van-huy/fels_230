@extends('admin.layout')

@section('title')
    {{ trans('settings.title.list_word') }}
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
                <h3 class="panel-title">
                    <p class='text-center'>{{ trans('settings.title.list_word') }}</p>
                </h3>
            </div>
            <div class="panel-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ trans('settings.text.id') }}</th>
                        <th>{{ trans('settings.text.word.name') }}</th>
                        <th>{{ trans('settings.text.category.name') }}</th>
                        <th>{{ trans('settings.text.created_at') }}</th>
                        <th>{{ trans('settings.text.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($words as $word)
                        <tr>
                            <td>{{ $word->id }}</td>
                            <td>{{ $word->word }}</td>
                            <td>{{ $word->category->name }}</td>
                            <td>{{ $word->created_at }}</td>
                            <td>
                                <ul class="list-category">
                                    <li>
                                        <a href="{{ action('Admin\WordController@edit', $word->id) }}" class="btn btn-success btn-xs">
                                            {{ trans('settings.button.edit') }}
                                        </a>
                                    </li>
                                    <li>
                                        {{ Form::open([
                                            'action' => ['Admin\WordController@destroy', $word->id],
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
            {{ $words->links() }}
            </div>
        </div>
    </div>
@endsection
