@extends('layouts.app')

@section('navbar')
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Manage User  <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li>
                <a href="">
                    List User
                </a>
            </li>
        </ul>
    </li>

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Manage Categories  <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li>
                <a href="{{ action('Admin\CategoriesController@index') }}">
                    List Categories
                </a>
            </li>

            <li>
                <a href="{{ action('Admin\CategoriesController@create') }}">
                    Add Category
                </a>
            </li>
        </ul>
    </li>

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Manage Word  <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li>
                <a href="{{ action('Admin\WordController@index') }}">
                    List Word
                </a>
            </li>

            <li>
                <a href="{{ action('Admin\WordController@create') }}">
                    Add Word
                </a>
            </li>
        </ul>
    </li>
@endsection('navbar')
