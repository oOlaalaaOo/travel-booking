@extends('backend.layout')

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2">Bookings</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			
		</div>
		
	</div>
	<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>#</th>
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
									@foreach($bookings as $b)
										<td>{{ $loop->index + 1 }}</td>
										<td>{{ $b->tour->name }}</td>
										<td>{{ ucwords($b->tour_price->type . ' ' . $b->tour_price->price) }}</td>
										<td>{{ date('M d, Y', strtotime($b->travel_date)) }}</td>
										<td>{{ $b->firstname . ' ' . $b->middlename . ' ' . $b->lastname }}</td>
										<td>{{ $b->email }}</td>
										<td>{{ $b->contact_no }}</td>
										<td>{{ ucfirst($b->status) }}</td>
										<td>{{ date('M d, Y H:i:s', strtotime($b->created_at)) }}</td>
									@endforeach
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
@endsection