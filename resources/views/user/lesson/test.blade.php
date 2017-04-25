@extends('user.layout')

@section('title')
    {{ trans('settings.title.lesson_test') }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading text-heading">{{ trans('settings.text.test') }}</div>
                    <div class="panel-body">
                        @if ($words->isNotEmpty())
                            {!! Form::open([
                                'action' => ['User\ResultController@store', $categoryId],
                                'method' => 'POST',
                                'role' => 'form',
                            ]) !!}
                                @foreach ($words as $word)
                                    <div class="border-bottom">
                                        <h4 class="question">{{ $loop->iteration }} . {{ $word->word }}</h4>
                                        <div class="section-answer">
                                            @foreach ($word->answers as $answer)
                                            <div class="radio">
                                                <label>
                                                    {!! Form::radio($word->id, $answer->id) !!}
                                                    {{ $answer->answer }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                                {!! Form::submit(trans('settings.button.check'), ['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        @else
                            <p class="text-success">
                                {{ trans('settings.text.not_word_to_check') }}
                            </p>
                        @endif
                    </div>
                  <!--END BODY PANEL -->
                </div>
            </div>
        </div>
    </div>
@endsection
