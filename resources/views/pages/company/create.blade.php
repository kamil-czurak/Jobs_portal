@extends('layouts.default')

@section('content')
	<form action='{{route("firma.store")}}' method='POST'>
		
		@csrf
		
		<div class='form-group'>
			<label for='name'>Nazwa firmy:</label>
			<input type='text' name='name' class='form-control' required value='{{old("name")}}'>
			@error('name')
		 	   <div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>
		
		<div class='form-group'>
			<label for='email'>Adres e-mail firmy:</label>
			<input type='email' name='email' class='form-control' required value='{{old("email")}}'>
			@error('email')
		 	   <div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>

		<div class='form-group'>
			<label for='phone'>Telefon kontaktowy firmy:</label>
			<input type='tel' name='phone' class='form-control' required value='{{old("phone")}}'>
			@error('phone')
		 	   <div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>
		
		
		<div class='form-group'>
			<button type='submit' class='btn btn-outline-primary'>Utwórz firmę</button>
			<a href='{{url()->previous()}}' class='btn btn-info'>Cofnij</a>
		</div>
	</form>
@endsection