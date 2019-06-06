@extends('layouts.default')
@section('content')
	<br>
	<a href='{{url("/admin")}}' class='btn btn-info'>Cofnij</a><br>
	@foreach($cities as $city)
		<a href='{{route("miasto.edit",$city->id)}}' class='btn btn-outline-primary'>{{$city->name}}</a>
	@endforeach
	
@endsection