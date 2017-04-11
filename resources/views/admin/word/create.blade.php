@extends('admin.layoutadmin')

@section('title')
    Create add word
@endsection

@section('content')
	<div class="col-md-6 col-md-offset-3">

        @if (!empty(session('status')))
            <div class="alert alert-{{ session('status') }}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('message') }}
            </div>
        @endif
        <div class="panel panel-info">
    	    <div class="panel-heading">
    		    <h3 class="panel-title">
                    <center>Add new word</center>
                </h3>
    	    </div>
    	    <div class="panel-body">
    		    <form action="{{ action('Admin\WordController@store') }}" method="POST" role="form">
    		        {{ csrf_field() }}
    		    	<div class="form-group">
    		    		<label>Category:</label>
    		    		<select name='category_id'>
    		    		    <option value='default' selected="selected">[--Categories--]</option>
    		    			@foreach ($listCategory as $category)
    		    			   <option value={{ $category->id }}>{{ $category->name }}</option>
    		    			@endforeach
    		    		</select>
    		    	</div>

    		        <div class="form-group">
    		    		<label for="word">Word:</label>
    		    		<input type="text" name="word" id="word" class="form-control" required="required" maxlength=20 minlength=3>
                        @if ($errors->has('word'))
                            <span class="help-block">
                                <strong>{{ $errors->first('word') }}</strong>
                            </span>
                        @endif
    		    	</div>

    		    	<div class="form-group">
    		    		<label for="word">Answer:</label>

                        @for ($i=1; $i<=3; $i++)
                        <div>
                        <input type="text" name="answer[{{ $i }}][answer]">
                        <input type="checkbox" name="answer[{{ $i }}][is_correct]" value="{{ config('settings.answer.is_correct_answer') }}">
                        </div>
                        @endfor
    		    	</div>

    		    	<button type="submit" class="btn btn-primary">Submit</button>
    		    </form>
    	    </div>
        </div>
    </div>
@endsection
