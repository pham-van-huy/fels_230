@extends('admin.layoutadmin')

@section('title')
    Home Admin
@endsection('title')

@section('content')
    <center>
    	<h3>Hello! {{ Auth::user()->name }}</h3>
    	<h3>This is page admin. You can manage Word, Category and User of this page</h3>
    </center>
@endsection('content')
