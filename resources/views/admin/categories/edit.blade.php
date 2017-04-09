@extends('admin.layoutadmin')

@section('title')
	Edit Category
@endsection('title')

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
                     <center>
                         Edit Category "{{ $category->name }}"
                     </center>
                </h3>
    	    </div>
    	    <div class="panel-body">
    		    <form action="{{ action('Admin\CategoriesController@update', $category->id) }}" method="POST" role="form">
                    {{method_field('PUT')}}
    			    {{ csrf_field() }}

    			    <div class="form-group">
    				    <label for="name">Name:</label>

    				    @if ($errors->has('name'))
                            <span class="text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif

    				    <input type="text" class="form-control" id="name" name="name" required="required" value="{{ $category->name }}">
    			    </div>

    			    <button type="submit" class="btn btn-primary">Update</button>
    			    <a href="{{ action('Admin\HomeAdminController@index') }}" class="btn btn-default">
    			    	Go back
    			    </a>
    		    </form>
    	    </div>
        </div>
    </div>
@endsection('content')
