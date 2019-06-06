@extends('layouts.default')

@section('content')
	<form action='{{route("firma.update",$company->id)}}' method='POST'>
		{{ method_field('PUT') }}
		@csrf
		
		<div class='form-group'>
			<label for='name'>Nazwa firmy:</label>
			<input type='text' name='name' class='form-control' required value='{{$company->name}}'>
			@error('name')
		 	   <div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>
		
		<div class='form-group'>
			<label for='email'>Adres e-mail firmy:</label>
			<input type='email' name='email' class='form-control' required value='{{$company->email}}'>
			@error('email')
		 	   <div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>

		<div class='form-group'>
			<label for='phone'>Telefon kontaktowy firmy:</label>
			<input type='tel' name='phone' class='form-control' required value='{{$company->phone}}'>
			@error('phone')
		 	   <div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>
		
		
		<div class='form-group'>
			<button type='submit' class='btn btn-outline-primary'>Edytuj firmę</button>
			<a href='{{url()->previous()}}' class='btn btn-info'>Cofnij</a>
		</div>
	</form>
	<form action='{{route("firma.destroy", $company->id)}}' method="POST">
		{{ method_field('DELETE') }}
		{{ csrf_field() }}
		<button class='btn btn-danger'>Usuń firmę</button>
	</form>
@endsection