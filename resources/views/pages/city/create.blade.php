@extends('layouts.default')

@section('content')
	<form action='{{route("miasto.store")}}' method='POST'>
		
		@csrf
		
		<div class='form-group'>
			<label for='name'>Nazwa miasta:</label>
			<input type='text' name='name' class='form-control' required value='{{old("name")}}'>
			@error('name')
		 	   <div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>

		<div class='form-group'>
			<button type='submit' class='btn btn-outline-primary'>Dodaj miasto</button>
			<a href='{{url("/admin")}}' class='btn btn-info'>Cofnij</a>
		</div>
	</form>
@endsection