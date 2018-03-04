@extends('frontend.layout')
@section('content')
<div class="row">
	<div class="col-sm-12 text-right">
		<a href="{{ route('tour-packages') }}" class="btn btn-outline-dark"><i class="fa fa-arrow-left"></i> Back</a>
		<hr>
	</div>
	<div class="col-sm-12 mt-2">
		<tour-package-show :tour_id="{{ $tour->id }}"></tour-package-show>
	</div>
</div>
@endsection