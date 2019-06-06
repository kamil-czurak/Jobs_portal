@extends('layouts.default')
@section('content')
	@include('includes.search_job')
	<h1 class='text-center'>Nie znaleziono pracy w podanych kryteriach</h1>
	<div class='text-center'>
		<a href='{{route("jobs_path")}}' class='btn btn-primary'>Zobacz inne ogłoszenia</a>
	</div>	
@endsection