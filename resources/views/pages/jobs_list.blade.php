@extends('layouts.default')

@section('content')
	@include('includes.search_job')
	<div class='row'>
		<div class='col-3'>
			<h4 class='result_search'>13 wyników dla IT</h4>
			<section class='categories_list'>
				<h5>Kategorie</h5>
				<div class='single_cat_list'><a href='#'>IT</a></div>
				<div class='single_cat_list'><a href='#'>Medycyna</a></div>
			</section>
		</div>

		<div class='col-9'>
			@foreach($jobs as $job)
			<div class='single_job_list'>
				<h5><a href='{{route("job_path",["job" => $job->id])}}'>{{$job->name}}</a></h5>
				<h6>Nazwa firmy</h6>
				<div class='row'>
					<div class='col-3 align-middle'>
						<img src='{{url("img/calendar.png")}}' alt='calendar' class='img_icon'> {{$job->created_at}}
					</div>
					<div class='col-3 align-middle'>
						<img src='{{url("img/location.png")}}' alt='calendar' class='img_icon'> {{$job->cities()->first()->name}}
					</div>
				</div>
				<p class='text-truncate'>
					{{$job->description}}
				</p>
				<a href='{{route("job_path",["job" => $job->id])}}'>Więcej</a>
			</div>
			@endforeach
		</div>
	</div>
@endsection