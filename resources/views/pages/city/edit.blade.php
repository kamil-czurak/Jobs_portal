@extends('layouts.default')

@section('content')
	<form action='{{route("miasto.update", $city->id)}}' method='POST'>
		{{ method_field('PUT') }}
		@csrf
		
		<div class='form-group'>
			<label for='name'>Nazwa miasta:</label>
			<input type='text' name='name' class='form-control' required value='{{$city->name}}'>
			@error('name')
		 	   <div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>

		<div class='form-group'>
			<button type='submit' class='btn btn-outline-primary'>Edytuj miasto</button>
			
			<a href='{{url()->previous()}}' class='btn btn-info'>Cofnij</a>
		</div>
	</form>

	<form action='{{route("miasto.destroy", $city->id)}}' method="POST">
		{{ method_field('DELETE') }}
		{{ csrf_field() }}
		<button class='btn btn-danger'>Usuń miasto</button>
	</form>
@endsection