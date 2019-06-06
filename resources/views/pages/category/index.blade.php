@extends('layouts.default')
@section('content')
	<br>
	<a href='{{url("/admin")}}' class='btn btn-info'>Cofnij</a><br>
	@foreach($categories as $category)
		<a href='{{route("kategoria.edit",$category->id)}}' class='btn btn-outline-primary'>{{$category->name}}</a>
	@endforeach
	
@endsection