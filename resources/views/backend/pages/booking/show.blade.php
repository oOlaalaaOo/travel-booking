@extends('backend.layout')

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2">Booking No. {{ $booking->booking_no }}</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			
		</div>
		
	</div>
	<div class="row">
			<div class="col-sm-10">
				<div class="card">
					<div class="card-body">
						@if(session()->has('status'))
							<div class="alert alert-warning alert-dismissible fade show" role="alert">
							  <strong>Booking Status Updated!</strong>
							 
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							</div>
						@endif
						<form action="{{ route('booking.status.update') }}" method="post">
							{{ csrf_field() }}
							<input type="hidden" name="booking_id" value="{{ $booking->id }}">
						<h4>Selected Tour Details</h4>
						<hr>
						<p>Tour Package: <a href="{{ route('admin.tour.show-view', ['tour_id' => $booking->tour_id]) }}">{{ $booking->tour->name }}</a></p>
						<p>Price: {{ ucwords($booking->tour_price->type . ' ' . $booking->tour_price->price) }}</p>
						<p>Travel Date: {{ $booking->travel_date }}</p>
						<hr>
						<h4>Guest Details</h4>
						<p>Name: {{ ucfirst($booking->firstname) . ' ' . ucfirst($booking->middlename) . ' ' . ucfirst($booking->lastname) }}</p>
						<p>Email: {{ $booking->email }}</p>
						<p>Mobile No.: {{ $booking->contact_no }}</p>
						<p>Nationality: {{ $booking->nationality }}</p>
						<hr>
						<p><u>Reservation Status: <strong>{{ ucfirst($booking->status) }}</strong></u></p>
						<p>Control No.: <strong><u>{{ $booking->control_no }}</u></strong></p>
						<p>Payed In: <strong><u>{{ $booking->payed_in }}</u></strong></p>
						<br />
						<div class="form-group">
							<h5>Please select a status for this booking:</h5>
							<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" id="pending" name="status" class="custom-control-input" @if($booking->status == 'pending') checked @endif value="pending">
							  <label class="custom-control-label" for="pending">Pending</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" id="payed" name="status" class="custom-control-input" @if($booking->status == 'payed') checked @endif value="payed">
							  <label class="custom-control-label" for="payed">Payed</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" id="confirmed" name="status" class="custom-control-input" @if($booking->status == 'confirmed') checked @endif value="confirmed">
							  <label class="custom-control-label" for="confirmed">Confirmed</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" id="finished" name="status" class="custom-control-input" @if($booking->status == 'finished') checked @endif value="finished">
							  <label class="custom-control-label" for="finished">Mark as Finished</label>
							</div>
						</div>
						{{-- @if($booking->status == 'payed')
							<button class="btn btn-primary">Confirm Booking</button>
						@elseif($booking->status == 'pending')
							<button class="btn btn-primary">Payed?</button>
						@else
							<button class="btn btn-primary">Mark as Done</button>
						@endif --}}
						<div class="form-group">
							<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#booking_modal">Update Booking Status</button>
							<!-- Modal -->
							<div class="modal fade" id="booking_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title">Action: Update Booking Status</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							        <h4>Confirmation</h4>
							        <p>Do you sure?</p>
							      </div>
							      <div class="modal-footer">
							       
							        <button type="submit" class="btn btn-primary">Update Status</button>
							      </div>
							    </div>
							  </div>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
@endsection