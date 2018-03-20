@extends('backend.layout')

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2">Dashboard</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
				<button class="btn btn-sm btn-outline-secondary">Share</button>
				<button class="btn btn-sm btn-outline-secondary">Export</button>
			</div>
			<button class="btn btn-sm btn-outline-secondary dropdown-toggle">
			<span data-feather="calendar"></span>
			This week
			</button>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8">
			<report></report>
		</div>
		<div class="col-sm-4">
			<div class="card">
				<div class="card-body"> 
					@if(count($bookings_today) > 0)
					<h4>Bookings Today</h4>
					<hr>
					<ul class="list-group">
						
						@foreach($bookings_today as $bt)
					  		<li class="list-group-item">
					  			{{ $bt->tour->name }}
					  			<br />
					  			<small>{{ ucfirst($bt->status) }}</small>
					  			<br />
					  			<small>{{ date('M-d-Y', strtotime($bt->travel_date)) }}</small>
					  			<br />
					  			<small>{{ ucfirst($bt->firstname) . ' ' . ucfirst($bt->middlename) . ' ' . ucfirst($bt->lastname) . ' - ' . ucfirst($bt->nationality) }}</small>
					  		</li>
						@endforeach
						

					</ul>
					@else
						<h4 class="text-center">No Bookings Today</h4>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection