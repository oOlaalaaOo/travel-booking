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
		<br /><br />
		
		<div class="row">
		<div class="col-sm-12 col-md-12">
			<h3>Tour Packages</h3>
			<hr>
		</div>
		@foreach($tours as $t)
			<div class="col-sm-12 col-md-3">
				<a href="{{ URL::to('/tour-packages/' . $t->id) }}">
					<img src="{{ $t->main_image }}" class="img-responsive" style="height: 150px; width: 100%" />
				</a>
				<hr>
				<p>{{ $t->name }}</p>
				<small>{{ 'From: ' . date('M-d-Y', strtotime($t->from_date)) . ' To: ' . date('M-d-Y', strtotime($t->to_date)) }}</small>
				
			</div>
		@endforeach
		</div>
	</div>
	<div class="col-sm-12 col-md-4">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Book Now!</h4>
				<h5 class="card-title">Different Choices for Tour Packages!</h5>
				<p class="card-text">You can easily set a schedule for your tours</p>
				<a href="#" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#book_guide"><i class="fa fa-calendar-check-o"></i> Book Guide?</a>

				<!-- Modal -->
				<div class="modal fade" id="book_guide" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Book Guide</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        {!! $book_guide !!}
				      </div>
				      
				    </div>
				  </div>
				</div>
			</div>
		</div>
		
		<br />
		<div class="card">
			<h5 class="card-header">Latest News/Updates</h5>
			<div class="card-body">
				<ul class="list-unstyled">
					@foreach($posts as $p)
					<li class="media">
						<i class="fa fa-gg fa-3x mr-3"></i>
						<div class="media-body">
							<h5 class="mt-0 mb-1"><a href="{{ URL::to('/news/show/' . $p->id) }}">{{ $p->title }}</a></h5>
							<small>Posted Date: {{ date('M d, Y h:i:s a', strtotime($p->created_at)) }}</small>
						</div>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection