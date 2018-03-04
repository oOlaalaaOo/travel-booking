@extends('backend.layout')

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2">Tour List</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
				<a href="{{ route('admin.tour.add-view') }}" class="btn btn-sm btn-outline-success"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
	</div>

	<tour-all></tour-all>

@endsection