@extends('admin.layoutadmin')

@section('title')
	Add Category
@endsection('title')

@section('content')
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-info">
    	    <div class="panel-heading">
    		    <h3 class="panel-title">
                     <center>Add Category</center>
                </h3>
    	    </div>
    	    <div class="panel-body">
    	        @if (!empty(session('status')))
                    <div class="alert alert-{{ session('status') }}">
                    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    	{{ session('message') }}
                    </div>
    	        @endif
    		    <form action="{{ action('Admin\CategoriesController@store') }}" method="POST" role="form">
    			    {{ csrf_field() }}

    			    <div class="form-group">
    				    <label for="name">Name:</label>

    				    @if ($errors->has('name'))
                            <span class="text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif

    				    <input type="text" class="form-control" id="name" name="name" required="required">
    			    </div>

    			    <button type="submit" class="btn btn-primary">Create</button>
    			    <a href="{{ action('Admin\HomeAdminController@index') }}" class="btn btn-default">
    			    	Go back
    			    </a>
    		    </form>
    	    </div>
        </div>
    </div>
@endsection('content')
