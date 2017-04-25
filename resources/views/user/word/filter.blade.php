@extends('user.layout')

@section('title')
    {{ trans('settings.title.result_search') }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-12">
                <div class="panel panel-info box-filter">
                    <div class="panel-heading">{{ trans('settings.text.filter_words') }}</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col col-md-8 col-md-offset-3">
                                {{ Form::open([
                                    'action' => 'User\WordController@wordsFilter',
                                    'method' => 'GET',
                                    'class' => 'form-inline',
                                ]) }}
                                    <div class="form-group">
                                        <label>Key search</label>
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
                                            ['class' => 'form-control col-md-6']
                                        ) }}
                                    </div>

                                    <div class="form-group group-radio">
                                        <label class="checkbox-inline">
                                            {{ Form::radio('rdOption', config('settings.filter.no_learned'),
                                                $oldRdOption === config('settings.filter.no_learned') ? true : null)
                                            }} {{ trans('settings.text.un_learned') }}
                                        </label>
                                        <label class="checkbox-inline">
                                            {{ Form::radio('rdOption', config('settings.filter.learned'),
                                                    $oldRdOption === config('settings.filter.learned') ? true : null)
                                            }} {{ trans('settings.text.learned') }}
                                        </label>
                                    </div>
                                    {{ Form::submit(trans('settings.button.filter'), [
                                        'class' => 'btn btn-primary form-control',
                                    ]) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                  <!--END BODY PANEL -->
                </div>

                <div class="panel panel-default word-list">
                    <div class="panel-body">
                        <h4>
                            <b>{{ trans('settings.text.word.result_search') }}</b>
                        </h4>
                        <div class="row">
                            <div class="col col-md-10 col-md-offset-1">
                                @if (!empty($wordsGroup))
                                    <ol class="section-filter-words">
                                        @foreach ($wordsGroup as $alpha => $words)
                                            <div class="section-alpha">
                                                <h1>{{ strtoupper($alpha) }}</h1>
                                                @foreach ($words as $item)
                                                    <li>
                                                        <p class="word-show">
                                                            {{ $item->word}}
                                                            <span class="answer-show">{{ $item->answers[0]->answer }}</span>
                                                        </p>
                                                    </li>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </ol>
                                @else
                                    <h5 class="text-center text-danger">{{ trans('settings.text.word.word_empty') }}</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{ $wordsPaginate->appends([
                        'key' => $oldKey,
                        'categoryId' => $oldCategory,
                        'rdOption' => $oldRdOption,
                    ])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
