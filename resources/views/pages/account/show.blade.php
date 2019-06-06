@extends('layouts.default')
@section('content')
	<br>
	<div class='row'>
		<div class='col-4'>
			<h4 class='text-center'>Zapisane oferty</h4>
			@foreach($jobs as $job)
			<div class='single_job_list'>
				<h5><a href='{{route("praca.show",["praca" => $job->id_job])}}'>{{$job->name}}</a></h5>
				<h6>{{$job->companies()->first()->name}}</h6>
				<div class='row'>
					<div class='col-12 align-middle'>
						<img src='{{url("img/calendar.png")}}' alt='calendar' class='img_icon'> {{$job->created_at}}
					</div>
					<div class='col-12 align-middle'>
						<img src='{{url("img/location_black.png")}}' alt='calendar' class='img_icon'> {{$job->cities()->first()->name}}
					</div>
				</div>
				<a href='{{route("praca.show",["job" => $job->id_job])}}' class="btn btn-primary">Więcej</a>
			</div>
			@endforeach
		</div>

		<div class='col-4'>
			<h4 class='text-center'>Firmy do których należysz</h4>
			<a href='{{route("firma.create")}}' class="btn btn-secondary">Załóż firmę</a><br>
			@foreach($companies as $company)
				<a href='{{route("firma.edit",$company->id)}}' class='btn btn-outline-primary'>{{$company->name}}</a>
			@endforeach
		</div>

		<div class='col-4'>
			<h4 class='text-center'>Oferty pracy dodane przez cb</h4>
			<a href='{{route("praca.create")}}' class="btn btn-secondary">Dodaj ofertę pracy</a><br>
			@foreach($added_jobs as $job)
			<div class='single_job_list'>
				<h5><a href='{{route("praca.show",["praca" => $job->id_job])}}'>{{$job->name}}</a></h5>
				<h6>{{$job->id_company}}</h6>
				<div class='row'>
					<div class='col-12 align-middle'>
						<img src='{{url("img/calendar.png")}}' alt='calendar' class='img_icon'> {{$job->created_at}}
					</div>
					<div class='col-12 align-middle'>
						<img src='{{url("img/location_black.png")}}' alt='calendar' class='img_icon'> {{$job->id_city}}
					</div>
				</div>
				<a href='{{route("praca.edit", $job->id)}}' class="btn btn-warning">Edytuj</a>
			</div>
			@endforeach
		</div>
	</div>
@endsection