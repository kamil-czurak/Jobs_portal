<!doctype html>
<html>
	<head>
		<title>Oferty pracy</title>
		<meta charset="urf-8">
		<link rel='stylesheet' href='{{url("css/app.css")}}'>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	</head>

	<body>
		@include('includes.header')
		<div class='container'>
			@if(session()->has('notif'))
				<div class='row'>
					<div class='alert alert-success'>
						<button type="button" class='close' data-dismiss='alert' aria-label='close'>&times;</button>
						<strong>{{session()->get('notif')}}</strong>
					</div>
				</div>	
			@endif		
			@yield('content')
		</div>
	</body>
</html>