@extends('admin.layout')

@section('title')
    {{ trans('settings.title.list_category') }}
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
                    <center>{{ trans('settings.text.nabar.list_category') }}</center>
                </h3>
            </div>
            <div class="panel-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ trans('settings.text.id') }}</th>
                        <th>{{ trans('settings.text.category.name') }}</th>
                        <th>{{ trans('settings.text.created_at') }}</th>
                        <th>{{ trans('settings.text.updated_at') }}</th>
                        <th>{{ trans('settings.text.category.number_word') }}</th>
                        <th>{{ trans('settings.text.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->Updated_at }}</td>
                            <td>{{ count($category->words) }}</td>
                            <td>
                                <ul class="list-category">
                                    <li>
                                        <a href="{{ action('Admin\CategoryController@edit', $category->id) }}" class="btn btn-success btn-xs">
                                        {{ trans('settings.button.edit') }}
                                        </a>
                                    </li>
                                    <li>
                                        {{ Form::open([
                                            'action' => ['Admin\CategoryController@destroy', $category->id],
                                            'method' => 'DELETE',
                                        ]) }}
                                            {{ Form::submit('Delete', [
                                                'class' => 'btn btn-danger btn-xs',
                                            ]) }}
                                        {{ Form::close() }}
                                    </li>
                                </ul>
                                </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
