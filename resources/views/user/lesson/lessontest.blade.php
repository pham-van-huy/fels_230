@extends('layouts.app')

@section('content')
    {!! Form::open([
        'action' => ['User\ResultController@store', $idCategory],
        'method' => 'POST',
        'role' => 'form',
        'id' => 'form-logout',
    ]) !!}
    @foreach ($words as $key => $word)
    <div class="section-words">
        <h4>{{ $key + 1 }}. {{ $word->word }}</h4>
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
    {!! Form::submit('Check', ['class' => 'btn btn-primany']) !!}
    {!! Form::close() !!}
@endsection
