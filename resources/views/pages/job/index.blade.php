@extends('layouts.default')

@section('content')
	@include('includes.search_job')
	<div class='row'>
		<div class='col-3'>
			<h4 class='result_search'>{{count($jobs)}} rezultatów {{$request}}</h4>
			<section class='categories_list'>
				<h5>Kategorie</h5>
				@foreach($categories as $category)
					<div class='single_cat_list'><a href='{{route("kategoria.show",["category" => $category->name])}}'>{{$category->name}}</a></div>
				@endforeach	
			</section>
		</div>

		<div class='col-9'>
			@foreach($jobs as $job)
			<div class='single_job_list'>
				<h5><a href='{{route("praca.show",["praca" => $job->id])}}'>{{$job->name}}</a></h5>
				<h6>{{$job->companies()->first()->name}}</h6>
				<div class='row'>
					<div class='col-3 align-middle'>
						<img src='{{url("img/calendar.png")}}' alt='calendar' class='img_icon'> {{$job->created_at}}
					</div>
					<div class='col-3 align-middle'>
						<img src='{{url("img/location_black.png")}}' alt='calendar' class='img_icon'> {{$job->cities()->first()->name}}
					</div>
				</div>
				<p class='text-truncate'>
					{{$job->description}}
				</p>
				<a href='{{route("praca.show",["job" => $job->id])}}' class="btn btn-primary">Więcej</a>
				@auth
				@if(Auth::user()->id == $job->id_user)
					<a href="{{route('praca.edit', $job->id)}}" class="btn btn-primary">Edytuj ogloszenie</a>
				@endif	
				@endauth
			</div>
			@endforeach
		</div>
	</div>
@endsection