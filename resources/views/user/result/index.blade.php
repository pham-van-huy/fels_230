@extends('user.layout')

@section('title')
    {{ trans('settings.title.lesson_test') }}
@endsection

@section('content')
    <div class="container">
    <div class="row">
        <div class="col col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    {{ trans('settings.text.well_done', [
                        'countIsCorrectWord' => $result['countIsCorrectWord'],
                        'countWords' => $result['countWordOfLesson'],
                    ]) }}
                </div>
                <div class="panel-body">
                    @foreach ($result['datas'] as  $data)
                    <div class="section-words">
                        <h4>{{ $loop->iteration }} . {{ $data['word']->word }}</h4>
                        @foreach ($data['word']->answers as $answer)
                            <div class="section-answer">
                                <div class="radio">
                                    <label class="{{ $answer->is_correct == config('settings.answer.is_correct_answer')
                                        ? 'is-correct' : 'not-correct' }}">
                                        {!! Form::radio($data['word'],
                                            $answer->id,
                                            $answer->id == $data['id_answer_choiced'] ? 1 : 0
                                        ) !!}
                                        {{ $answer->answer }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endforeach
                    <a class="btn btn-primary" href="{{ action('User\CategoryController@index') }}">
                        {{ trans('settings.button.back') }}
                    </a>
                </div>
              <!--END BODY PANEL -->
            </div>
        </div>
    </div>
</div>
@endsection
