@extends('layouts.default')

@section('content')
	<form action='{{route("praca.update", $job->id)}}' method='POST'>
		{{ method_field('PUT') }}
		@csrf
		
		<div class='form-group'>
			<label for='title'>Tytuł ogłoszenia:</label>
			<input type='text' name='title' class='form-control' required value='{{$job->name}}'>
			@error('title')
		 	   <div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>
		
		<div class='form-group'>
			<label for='description'>Opis ogłoszenia:</label>
			<textarea name='description' rows='8' class="form-control" required>{{$job->description}}</textarea>
			@error('description')
		 	   <div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>
		
		<div class='form-group'>
			<div class='row'>
				<label for='rate_min' class='col-3'>Minimalna stawka za godzinę:</label>
				<input type='number' name='rate_min' class='form-control col-2' value='{{$job->rate_min}}'>
				<label for='rate_max' class='col-3'>Maksymalna stawka za godzinę:</label>
				<input type='number' name='rate_max' class='form-control col-2' value='{{$job->rate_max}}'>
			</div>
		</div>

		<div class="form-group">
		    <label for="contract">Rodzaj umowy:</label>
		    <select class="form-control" id="contract" name='contract' required>
		    	@foreach($contracts as $contract)
					<option value='{{$contract->id}}'
					@if($job->contracts()->first()->id==$contract->id)
						selected="selected"
   					@endif
					>{{$contract->name}}</option>
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
					<option value='{{$category->id}}'
					@if($job->categories()->first()->id==$category->id)
						selected="selected"
   					@endif
					>{{$category->name}}</option>
		    	@endforeach
			</select>
			@error('category')
		 	   <div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>

		<div class="form-group">
			<label>Miasto pracy:</label>
		    <input list='city' name='city' class="form-control" required value='{{$job->cities()->first()->name}}'>
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
					<option value='{{$company->companies()->first()->name}}'
					@if($job->companies()->first()->id==$company->companies()->first()->id)
						selected="selected"
   					@endif
					>{{$company->companies()->first()->name}}</option>
		    	@endforeach
			</select>
			@error('company')
		 	   <div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>

		<div class='form-group'>
			<button type='submit' class='btn btn-outline-primary'>Edytuj ogłoszenie</button>
			<a href='{{url()->previous()}}' class='btn btn-info'>Cofnij</a>
		</div>
	</form>
	<form action='{{route("praca.destroy", $job->id)}}' method="POST">
		{{ method_field('DELETE') }}
		{{ csrf_field() }}
		<button class='btn btn-danger'>Usuń ogłoszenie</button>
	</form>

@endsection