@extends('layouts.default')

@section('content')
	<form action='{{route("kategoria.update", $category->id)}}' method='POST'>
		{{ method_field('PUT') }}
		@csrf
		
		<div class='form-group'>
			<label for='name'>Nazwa kategorii:</label>
			<input type='text' name='name' class='form-control' required value='{{$category->name}}'>
			@error('name')
		 	   <div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>

		<div class='form-group'>
			<button type='submit' class='btn btn-outline-primary'>Edytuj kategorię</button>

			<a href='{{url()->previous()}}' class='btn btn-info'>Cofnij</a>
		</div>
	</form>
	<form action='{{route("kategoria.destroy", $category->id)}}' method="POST">
		{{ method_field('DELETE') }}
		{{ csrf_field() }}
		<button class='btn btn-danger'>Usuń kategorię</button>
	</form>
@endsection