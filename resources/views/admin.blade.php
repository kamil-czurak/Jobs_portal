@extends('layouts.default')
@section('content')
	<br>
	<a href='{{route("kategoria.create")}}' class='btn btn-outline-primary'>Stwórz kategorię</a>
	<a href='{{route("kategoria.index")}}' class='btn btn-outline-primary'>Zobacz kategorię</a>
	<br>
	<a href='{{route("miasto.create")}}' class='btn btn-outline-primary'>Stwórz miasto</a>
	<a href='{{route("miasto.index")}}' class='btn btn-outline-primary'>Zobacz miasta</a>
	<br>
	<a href='{{route("praca.create")}}' class='btn btn-outline-primary'>Stwórz ogłoszenie</a>
	<a href='{{route("praca.index")}}' class='btn btn-outline-primary'>Zobacz ogłoszenia</a>
	<br>
	<a href='{{route("firma.create")}}' class='btn btn-outline-primary'>Stwórz firmę</a>
	<a href='{{route("firma.index")}}' class='btn btn-outline-primary'>Zobacz firmy</a>
@endsection