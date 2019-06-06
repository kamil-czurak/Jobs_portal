@extends('layouts.default')
@section('content')
	<br>
	<a href='{{url("/admin")}}' class='btn btn-info'>Cofnij</a><br>
	@foreach($companies as $company)
		<a href='{{route("firma.edit",$company->id)}}' class='btn btn-outline-primary'>{{$company->name}}</a>
	@endforeach
	
@endsection