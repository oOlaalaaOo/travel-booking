@extends('frontend.layout')
@section('content')
<div class="row">
	<div class="col-sm-12 col-md-8">
		
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img class="d-block w-100 rounded" style="height: 320px" src="{{ asset('img/home-carousel-1-1024x768.jpg') }}" alt="First slide">
				</div>
				<div class="carousel-item">
					<img class="d-block w-100 rounded" style="height: 320px" src="{{ asset('img/home-carousel-2-1024x768.jpg') }}" alt="Second slide">
				</div>
				<div class="carousel-item">
					<img class="d-block w-100 rounded" style="height: 320px" src="{{ asset('img/home-carousel-3-1024x768.jpg') }}" alt="Third slide">
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
		
		<hr>
		
		<h3 class="text-center">Lorem Ipsum</h3>
		<div class="card">
			<div class="card-body">
				<p>
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
				</p>
			</div>
		</div>
		<br />
	</div>
	<div class="col-sm-12 col-md-4">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Book Now!</h4>
				<h5 class="card-title">Different Choices for Tour Packages!</h5>
				<p class="card-text">You can easily set a schedule for your tours</p>
				<a href="#" class="btn btn-danger btn-lg"><i class="fa fa-calendar-check-o"></i> Book Guide?</a>
			</div>
		</div>
		
		<br />
		<div class="card">
			<h5 class="card-header">Latest News</h5>
			<div class="card-body">
				<ul class="list-unstyled">
					<li class="media">
						<i class="fa fa-gg fa-3x mr-3"></i>
						<div class="media-body">
							<h5 class="mt-0 mb-1">List-based media object</h5>
							Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
						</div>
					</li>
					<li class="media my-4">
						<i class="fa fa-gg fa-3x mr-3"></i>
						<div class="media-body">
							<h5 class="mt-0 mb-1">List-based media object</h5>
							Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
						</div>
					</li>
					<li class="media">
						<i class="fa fa-gg fa-3x mr-3"></i>
						<div class="media-body">
							<h5 class="mt-0 mb-1">List-based media object</h5>
							Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection