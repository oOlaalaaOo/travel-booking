@extends('frontend.layout')
@section('content')
	<div class="row">
		<div class="col-sm-10 offset-sm-1">
			<br />
			<div class="card">
				<div class="card-body">
					{!! $company->content !!}
				</div>
			</div>
		</div>
	</div>
@endsection