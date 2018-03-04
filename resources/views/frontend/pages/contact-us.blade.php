@extends('frontend.layout')
@section('content')
	<div class="row">
		<div class="col-sm-12 col-md-6">
			<br />
			<div class="card">
				<div class="card-body">
					<h3>Please fill up the form if you want to contact us</h3>
					<hr>
					<form>
						<div class="form-group">
							<label for="name">Name: </label>
							<input type="text" name="name" class="form-control" />
						</div>
						<div class="form-group">
							<label for="email">Email: </label>
							<input type="text" name="email" class="form-control" />
						</div>
						<div class="form-group">
							<label for="subject">Subject: </label>
							<input type="text" name="subject" class="form-control" />
						</div>
						<div class="form-group">
							<label for="name">Message: </label>
							<textarea class="form-control" name="message"></textarea>
						</div>

						<br />
						<button class="btn btn-primary btn-lg">Submit Request</button>
					</form>
					
				</div>
			</div>
		</div>

		<div class="col-sm-12 col-md-6">
			<br />
			<div class="card">
				<div class="card-body">
					<h2>CONTACT DETAILS</h2>
					<hr>
					<ul>
						<li><i class="fa fa-map-marker"></i> Golden City Salawag, Dasmariñas, 4114 Cavite</li>
						<li><i class="fa fa-phone"></i> (046) 5068146</li>
						<li><i class="fa fa-mobile"></i> (63) 925-586-0110</li>
						<li><i class="fa fa-mobile"></i> (63) 917-717-3448</li>
						<li><i class="fa fa-mobile"></i> (63) 917-302-4506</li>
						<li><i class="fa fa-envelope"></i> travelbooking2018@gmail.com</li>
					</ul>
					
				</div>
			</div>
		</div>
	</div>
@endsection
