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
						<table class="table table-hover table-responsive">
							<thead>
								<tr>
									<th>#</th>
									<th>Guest Name</th>
									<th>Status</th>
									<th>Tour Package</th>
									<th>Travel Date</th>
									
									
									<th>Date</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								
								@foreach($bookings as $b)
								<tr>
									<td>{{ $loop->index + 1 }}</td>
									<td>{{ ucfirst($b->firstname) . ' ' . ucfirst($b->middlename) . ' ' . ucfirst($b->lastname) }}</td>
									<td><strong>{{ ucfirst($b->status) }}</strong></td>
									<td>{{ $b->tour->name }}</td>
{{-- 									<td>{{ ucwords($b->tour_price->type . ' ' . $b->tour_price->price) }}</td> --}}
									<td>{{ date('M d, Y', strtotime($b->travel_date)) }}</td>
									
									
									<td>{{ date('M d, Y g:i:s a', strtotime($b->created_at)) }}</td>
									<td>
										<a href="{{ route('booking.show', ['booking_id' => $b->id]) }}" class="btn btn-sm btn-dark"><i class="fa fa-wrench"></i></a>
											{{-- @if($b->status == 'pending')
												<a href="{{ route('booking.show', ['booking_id' => $b->id]) }}" class="btn btn-sm btn-success">Payed?</a>
											@elseif($b->status == 'payed')
												<a href="{{ route('booking.show', ['booking_id' => $b->id]) }}" class="btn btn-sm btn-primary">Confirm</a>
											@elseif($b->status == 'confirmed')
												<a href="{{ route('booking.show', ['booking_id' => $b->id]) }}" class="btn btn-sm btn-success">Waiting..</a>
											@endif --}}
										
									</td>
								</tr>
								@endforeach

								<tr>
									<td colspan="9">{{ $bookings->links('vendor.pagination.bootstrap-4') }}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
@endsection