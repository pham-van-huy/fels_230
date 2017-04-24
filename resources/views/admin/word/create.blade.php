@extends('admin.layout')

@section('title')
    {{ trans('settings.title.add_word') }}
@endsection

@section('content')
<div class="container">
    <div class="row">

    @if (!empty(session('status')))
        <div class="alert alert-{{ session('status') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('message') }}
        </div>
    @endif
        <div class="col-md-6 col-md-offset-3">
            {{ Form::open([
                'action' => 'Admin\WordController@store',
                'method' => 'POST',
                'class' => 'form-horizontal',
                'role' => 'form',
            ]) }}
                <legend>{{ trans('settings.text.word.add_word') }}</legend>

                <div class="form-group">
                    <label class="col-sm-3 control-label {{ $errors->has('category_id') ? ' has-error' : '' }}">
                        {{ trans('settings.text.category.name') }}
                    </label>
                    <div class="col-sm-9">
                        {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}

                        @if ($errors->has('category_id'))
                            <p class="text-danger">{{ $errors->first('category_id') }}</p>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label {{ $errors->has('word') ? ' has-error' : '' }}">
                        {{ trans('settings.text.word.name') }}
                    </label>
                    <div class="col-sm-9">
                        {{ Form::text('word', null, [
                            'class' => 'form-control',
                            'autofocus',
                            'required'
                        ]) }}

                        @if ($errors->has('word'))
                            <p class="text-danger">{{ $errors->first('word') }}</p>
                        @endif
                    </div>
                </div>

                <div id="form-label" class="row">
                  <p class="col-sm-3 text-right"><b>{{ trans('settings.text.answer.answer') }}</b></p>
                  <p class="alignright answer-correct"><b>{{ trans('settings.text.answer.answer_correct') }}</b></p>
                </div>

                <div class="form-group group-answer">
                    @for ($i=0; $i < config('settings.answer.number_answer'); $i++)
                        <div class="wrap-answer">
                            <div class="col-md-6 col-md-offset-3">
                                {{ Form::text('ans[' . $i . '][answer]', null, [
                                    'class' => 'form-control',
                                    'autofocus',
                                ]) }}
                                <span class="form-control-feedback delete-answer">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </span>
                                @if ($errors->has('ans.' . $i . '.answer'))
                                    <p class="text-danger">{{ $errors->first('ans.' . $i . '.answer') }}</p>
                                @endif
                            </div>

                            <label class="col-md-2 control-label only-correct">
                                {{ Form::checkbox('ans[' . $i . '][is_correct]', config('settings.answer.is_correct_answer')) }}
                            </label>
                            <br/><br/>
                        </div>
                    @endfor
                </div>

                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="pull-right">
                            {{ Form::submit(trans('settings.button.create'), [
                                'class' => 'btn btn-success',
                                'id' => 'create-word',
                            ]) }}
                            <a href="{{ action('Admin\WordController@index') }}" class="btn btn-default">
                                {{ trans('settings.button.back') }}
                            </a>
                            <a href="javascript:void(0)" id="add-answer" class="btn btn-primary">
                                {{ trans('settings.button.add_answer') }}
                            </a>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
