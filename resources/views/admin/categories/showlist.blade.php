@extends('admin.layoutadmin')

@section('title')
    List Categories
@endsection('title')

@section('content')
    <div class="col-md-10 col-md-offset-1">
        @if (!empty(session('status')))
            <div class="alert alert-{{ session('status') }}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('message') }}
            </div>
        @endif
        <div class="panel panel-info">
    	    <div class="panel-heading">
    	    	<h3 class="panel-title">
    		         <center>List Categories</center>
    		    </h3>
    	    </div>
    	    <div class="panel-body">
    		    <table class="table table-hover">
    		        <thead>
    		        	<tr>
    		        		<th>ID</th>
    		        		<th>Name Category</th>
    		        		<th>Created at</th>
    		        		<th>Updated at</th>
    		        		<th>Number Words</th>
    		        		<th>Action</th>
    		        	</tr>
    		        </thead>
    		    	<tbody>
    		    		@foreach ($list as $category)
    		    		    <tr>
    		    		    	<td>{{ $category->id }}</td>
    		    		    	<td>{{ $category->name }}</td>
    		    		    	<td>{{ $category->created_at }}</td>
    		    		    	<td>{{ $category->Updated_at }}</td>
    		    		    	<td>{{ count($category->words) }}</td>
    		    		    	<td>
    		    		    		<ul class="list-category">
    		    		    		    <li>
    		    		    		        <a href="{{ action('Admin\CategoriesController@edit', $category->id) }}" class="btn btn-success btn-xs">
    		    		    			        Edit
    		    		    		        </a>
    		    		    		    </li>
    		    		    		    <li>
    		    		    		    	<form action="{{ action('Admin\CategoriesController@destroy', $category->id) }}" method="POST">
    		    		    		    	    {{ method_field('DELETE') }}
    		    		    		    	    {{ csrf_field()}}
    		    		    		    		<input type="submit" name="delete" value="Delete" class="btn btn-danger btn-xs">
    		    		    		    	</form>
    		    		    		    </li>
    		    		    		</ul>
    		    		    	</td>
    		    		    </tr>
    		    		@endforeach
    		    	</tbody>
    		    </table>
    		    {{ $list->links() }}
    	    </div>
        </div>
    </div>
@endsection('content')