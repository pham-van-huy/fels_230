@extends('admin.layout')

@section('title')
    {{ trans('settings.title.edit_word') }}
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
                'action' => ['Admin\WordController@update', $word->id],
                'method' => 'PUT',
                'class' => 'form-horizontal',
                'role' => 'form',
            ]) }}
                <legend>{{ trans('settings.text.word.edit_word') }}</legend>

              <div class="form-group">
                <label class="col-sm-3 control-label {{ $errors->has('category_id') ? ' has-error' : '' }}">
                    {{ trans('settings.text.category.name') }}
                </label>
                <div class="col-sm-9">
                    {{ Form::select('category_id', $categories, $word->category_id, ['class' => 'form-control']) }}

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
                        {{ Form::text('word', $word->word, [
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
                    <div style="clear: both;"></div>
                 </div>

                <div class="form-group">
                    @foreach($word->answers as $answer)
                        <div class="col-md-6 col-md-offset-3">
                            {!! Form::text('ans['.$answer->id.'][answer]', $answer->answer, [
                                'class' => 'form-control',
                                'autofocus',
                            ]) !!}

                            @if ($errors->has('ans.'.$answer->id.'.answer'))
                                <p class="text-danger">{{ $errors->first('ans.'.$answer->id.'.answer') }}</p>
                            @endif
                        </div>

                        <label class="col-md-2 control-label only-correct">
                            {{ Form::checkbox('ans['.$answer->id.'][is_correct]', config('settings.answer.is_correct_answer'), $answer->is_correct) }}
                        </label>
                    @endforeach
                </div>

                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="pull-right">
                            {{ Form::submit(trans('settings.button.save_change'), [
                                'class' => 'btn btn-success',
                                'id' => 'create-word',
                            ]) }}
                            <a href="{{ action('Admin\WordController@index') }}" class="btn btn-default">
                                {{ trans('settings.button.back') }}
                            </a>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
