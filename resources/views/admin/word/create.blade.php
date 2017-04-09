@extends('admin.layoutadmin')

@section('title')
    Create add word
@endsection

@section('content')
	<div class="col-md-6 col-md-offset-3">
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
    		    		<select name='category'>
    		    		    <option value='' selected="selected">[--Categories--]</option>
    		    			@foreach ($listCategory as $category)
    		    			   <option value={{ $category->id }}>{{ $category->name }}</option>
    		    			@endforeach
    		    		</select>
    		    	</div>

    		        <div class="form-group">
    		    		<label for="word">Word:</label>
    		    		<input type="text" name="word" id="word" class="form-control" required="required" maxlength=20 minlength=3>
    		    	</div>

    		    	<div class="form-group">
    		    		<label for="word">Answer:</label>
    		    		<input type="text" name="word" id="word" class="form-control " required="required">
    		    		<input type="text" name="word" id="word" class="form-control" required="required">
    		    	</div>

    		    	<button type="submit" class="btn btn-primary">Submit</button>
    		    </form>
    	    </div>
        </div>
    </div>
@endsection
