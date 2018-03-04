@extends('backend.layout')

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2">Add New Tour Package</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
				<a href="{{ route('admin.tour.all') }}" class="btn btn-sm btn-outline-success"><i class="fa fa-arrow-left"></i> Back</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-10">
			
			<tour-add></tour-add>		
	
		</div>
	</div>
@endsection