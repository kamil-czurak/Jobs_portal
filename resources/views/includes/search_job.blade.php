	<section class='search_job_form'>
		<h3 >Szukaj pracy</h3>
		<form action="{{route('search_path')}}" method='post'>
			@csrf
		  <div class="row">
		    <div class="col-5">
		      <input type="text" name='profession' class="form-control" placeholder="Stanowisko">
		    </div>
		    <div class="col-5">
		      <input type="text" name='city' class="form-control" placeholder="Miasto">
		    </div>
		    <div class='col-2'>
				<button type="submit" class="btn btn-primary">Szukaj</button>
		    </div>
		  </div>
		</form>
	</section>	