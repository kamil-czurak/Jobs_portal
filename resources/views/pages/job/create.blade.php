@extends('layouts.default')

@section('content')
	<form action='{{route("praca.store")}}' method='POST'>
		
		@csrf
		
		<div class='form-group'>
			<label for='title'>Tytuł ogłoszenia:</label>
			<input type='text' name='title' class='form-control' required value="{{old('title')}}">
			@error('title')
		 	   <div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>
		
		<div class='form-group'>
			<label for='description'>Opis ogłoszenia:</label>
			<textarea name='description' rows='8' class="form-control" required>{{old('description')}}</textarea>
			@error('description')
		 	   <div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>
		
		<div class='form-group'>
			<div class='row'>
				<label for='rate_min' class='col-3'>Minimalna stawka za godzinę:</label>
				<input type='number' name='rate_min' class='form-control col-2' value='{{old("rate_min")}}'>
				<label for='rate_max' class='col-3'>Maksymalna stawka za godzinę:</label>
				<input type='number' name='rate_max' class='form-control col-2' value='{{old("rate_max")}}'>
			</div>
		</div>

		<div class="form-group">
		    <label for="contract">Rodzaj umowy:</label>
		    <select class="form-control" id="contract" name='contract' required>
		    	@foreach($contracts as $contract)
					<option value='{{$contract->id}}'>{{$contract->name}}</option>
		    	@endforeach
			</select>
			@error('contract')
		 	   <div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>

		<div class="form-group">
		    <label for="category">Kategoria rynku:</label>
		    <select class="form-control" id="category" name='category' required>
		    	@foreach($categories as $category)
					<option value='{{$category->id}}'>{{$category->name}}</option>
		    	@endforeach
			</select>
			@error('category')
		 	   <div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>

		<div class="form-group">
			<label>Miasto pracy:</label>
		    <input list='city' name='city' class="form-control" required value='{{old("city")}}'>
		    <datalist id="city">
		    	@foreach($cities as $city)
					<option>{{$city->name}}</option>
		    	@endforeach
			</datalist>
			@error('city')
		 	   <div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>

		<div class="form-group">
		    <label for="company">Wybierz firmę tworzącą ogłoszenie:</label>
		    <select class="form-control" id="company" name='company' required>
		    	@foreach($companies as $company)
					<option value='{{$company->id}}'>{{$company->name}}</option>
		    	@endforeach
			</select>
			@error('company')
		 	   <div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>

		<div class='form-group'>
			<button type='submit' class='btn btn-outline-primary'>Dodaj ogłoszenie</button>
			<a href='{{url()->previous()}}' class='btn btn-info'>Cofnij</a>
		</div>
	</form>
@endsection