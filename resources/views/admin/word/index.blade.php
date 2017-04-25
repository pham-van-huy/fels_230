@extends('admin.layout')

@section('title')
    {{ trans('settings.title.list_word') }}
@endsection

@section('content')
    <div class="container">

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
                        {{ trans('settings.title.list_word') }}
                    </div>
                    <div class='col-md-6 text-right'>
                        {{ Form::open([
                            'action' => 'Admin\WordController@filerWord',
                            'method' => 'POST',
                            'class' => 'form-inline',
                        ]) }}
                            <div class="form-group">
                                <label>{{ trans('settings.text.key_search') }}</label>
                                {{ Form::text('key', $oldKey, [
                                    'class' => 'form-control input-sm',
                                    'id' => 'key',
                                    'maxlength' => "10",
                                ]) }}
                            </div>

                            <div class="form-group">
                                {{ Form::select('categoryId',
                                    $categories,
                                    $oldCategory,
                                    ['class' => 'form-control input-sm']
                                ) }}
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
