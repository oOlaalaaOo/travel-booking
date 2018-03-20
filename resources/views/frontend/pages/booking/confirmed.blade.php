@extends('frontend.layout')
@section('content')
	<div class="row">
		<div class="col-sm-6 offset-sm-1">
			<br />
			<div class="card">
				<div class="card-body">
					<h4>Booking Details: </h4>
						<div class="form-group">
							<table class="table table-bordered table-responsive">
								<thead>
									<tr>
										<th>Tour Package</th>
										<th>Tour Option</th>
										<th>Travel Date</th>
										<th>Guest Name</th>
										<th>Email</th>
										<th>Contact No.</th>
										<th>Status</th>
										<th>Date</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>{{ $b->tour->name }}</td>
										<td>{{ ucwords($b->tour_price->type . ' ' . $b->tour_price->price) }}</td>
										<td>{{ date('M d, Y', strtotime($b->travel_date)) }}</td>
										<td>{{ $b->firstname . ' ' . $b->middlename . ' ' . $b->lastname }}</td>
										<td>{{ $b->email }}</td>
										<td>{{ $b->contact_no }}</td>
										<td>{{ ucfirst($b->status) }}</td>
										<td>{{ date('M d, Y H:i:s', strtotime($b->created_at)) }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					
				</div>
			</div>
		</div>

		<div class="col-sm-4">
			<br />
			<div class="card">
				<div class="card-body">
					<h5>CONTACT DETAILS</h5>
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