@extends('layouts.default')
@section('content')
	<br>
	<div class='single_job card'>
		<h6><a href='{{route("firma.show", $job->companies()->first()->name)}}'>{{$job->companies()->first()->name}}</a></h6>
		<h4>{{$job->name}}</h4>
		<div class='row'>
			<div class='col-2'><a href='{{route("miasto.show",["city" => $job->cities()->first()->name])}}'><img src='{{url("img/location_blue.png")}}' alt='calendar' class='img_icon'> {{$job->cities()->first()->name}}</a></div>
			<div class='col-2'><img src='{{url("img/suitcase.png")}}' alt='calendar' class='img_icon'> {{$job->contracts()->first()->name}}</div>
			<div class='col-2'><img src='{{url("img/calendar.png")}}' alt='calendar' class='img_icon'> {{$job->created_at->toDateString()}}</div>
			<div class='col-2'><img src='{{url("img/money.png")}}' alt='calendar' class='img_icon'> {{$job->rate_min}}-{{$job->rate_max}} zł/h</div>
			@auth
				@if($saved==false)
					<div class='col-2'><a href='{{route("save_job_path", $job->id)}}'><img src='{{url("img/check.png")}}' alt='calendar' class='img_icon'> Zapisz ofertę pracy</a></div>
				@else
					<div class='col-3'><a class='text-danger' href='{{route("unsave_job_path", $job->id)}}'><img src='{{url("img/rejected.png")}}' alt='calendar' class='img_icon'> Usuń ofertę pracy z zapisanych</a></div>
				@endif
			@endauth
		</div>
		<div class='row'>
			<div class='col-2'>
				<img src='{{url("img/email.png")}}' alt='calendar' class='img_icon'>
				<a href='mailto:{{$job->companies()->first()->email}}'>				{{$job->companies()->first()->email}}</a>
			</div>
			<div class='col-2'>
				<img src='{{url("img/phone.png")}}' alt='calendar' class='img_icon'>
				{{$job->companies()->first()->phone}}
			</div>
		</div>
		<p class='description'>{{$job->description}}</p>
	</div>
	@auth
	@if(Auth::user()->id == $job->id_user)
		<a href="{{route('praca.edit', $job->id)}}" class="btn btn-primary">Edytuj ogloszenie</a>
	@endif	
	@endauth
@endsection