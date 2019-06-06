@extends('layouts.default')
@section('content')
	@include('includes.search_job')
	<h4 class="text-center">Kategorie:</h4>
	<div class='row'>
	@foreach($categories as $category)
		<a href='{{route("kategoria.show", $category->name)}}' class='btn btn-outline-primary col-4'>{{$category->name}}</a>	
	@endforeach
	</div>
@endsection