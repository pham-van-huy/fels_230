@extends('layouts.app')

@section('content')
    @foreach ($categories as $category)
        <div class='row'>
            <div class='col-md-8'>{{ $category->name }}</div>
            <div class='col-md-4'>
                <a href="{{ action('User\LessonController@lessontest', $category->id) }}">create new a test</a>
            </div>
        </div>
    @endforeach
@endsection
