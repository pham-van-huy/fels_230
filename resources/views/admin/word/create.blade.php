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
        <div class="col-md-6">
            {{ Form::open([
                'action' => 'Admin\WordController@store',
                'method' => 'POST',
                'class' => 'form-horizontal',
                'id' => 'form-create-words',
                'role' => 'form',
            ]) }}
                <legend>{{ trans('settings.text.word.add_word') }}</legend>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="textinput">{{ trans('settings.text.category.name') }}</label>
                <div class="col-sm-10">
                    {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
                </div>
              </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">{{ trans('settings.text.word.name') }}</label>
                    <div class="col-sm-10">
                        {{ Form::text('word', null, [
                            'class' => 'form-control',
                            'autofocus',
                        ]) }}
                    </div>
                </div>

                <div id="form-label">
                  <p class="alignleft"><b>{{ trans('settings.text.answer.answer') }}</b></p>
                  <p class="alignright"><b>{{ trans('settings.text.answer.answer_correct') }}</b></p>
                  <div style="clear: both;"></div>
              </div>

                <div class="form-group ">
                    @for($i=0; $i < config('settings.answer.number_answer'); $i++)
                        <div class="col-md-6 col-md-offset-3">
                            {{ Form::text('ans[' . $i . '][answer]', null, [
                                'class' => 'form-control',
                                'autofocus',
                            ]) }}
                        </div>

                        <label class="col-md-2 control-label">
                            {{ Form::checkbox('ans['.$i.'][is_correct]', config('settings.answer.is_correct_answer')) }}
                        </label>
                    @endfor
                </div>

                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="pull-right">
                            {{ Form::submit(trans('settings.button.create'), [
                                'class' => 'btn btn-success',
                            ]) }}
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
