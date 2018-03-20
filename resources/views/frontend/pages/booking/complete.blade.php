@extends('frontend.layout')
@section('content')
	<div class="row">
		<div class="col-sm-6 offset-sm-1">
			<br />
			<div class="card">
				<div class="card-body">
					<form action="{{ route('booking.complete') }}" method="post">
						{{ csrf_field() }}
						<input type="hidden" name="booking_no" value="{{ $b->booking_no }}">
						<div class="form-group">
							<p>Some informations here!</p>
						</div>
						<div class="form-group">
							<label for="payed_in">Payed In: </label>
							<select class="form-control" name="payed_in" id="payed_in">
								<option value="">Select</option>
								<option value="Palawan Pawnshop">Palawan Pawnshop</option>
								<option value="Cebuana Lhuillier">Cebuana Lhuillier</option>
								<option value="Mlhuillier">Mlhuillier</option>
							</select>
							@if($errors->has('control_no'))
							<p class="help-block" style="margin-top: 5px; margin-left: 6px">Please enter control no.</p>
							@endif
						</div>
						<div class="form-group">
							<label for="control_no">Any Control No.: </label>
							<input type="text" name="control_no" class="form-control" placeholder="Please enter your control no. here...">
							@if($errors->has('control_no'))
							<p class="help-block" style="margin-top: 5px; margin-left: 6px">Please enter control no.</p>
							@endif
						</div>
						<div class="form-group">
							<button class="btn btn-block btn-primary"><i class="fa fa-send"></i>&nbsp; Submit</button>
						</div>
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
					</form>
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