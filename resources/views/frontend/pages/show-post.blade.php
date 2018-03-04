@extends('frontend.layout')
@section('content')
	<div class="row">
{{-- 		<div class="col-sm-10 offset-sm-1 text-right">
			<a href="{{ route('news') }}" class="btn btn-outline-dark"><i class="fa fa-arrow-left"></i> Back</a>
		</div> --}}
		<div class="col-sm-10 offset-sm-1">
			<br />
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-10">
							<h2>{{ $post->title }}</h2>
						</div>
						<div class="col-sm-2 text-right">
							<a href="{{ route('news') }}" class="btn btn-outline-dark"><i class="fa fa-arrow-left"></i> Back</a>
						</div>
					</div>
					<hr>
					{!! $post->content !!}
					<small>Post Created: {{ date('M d, Y', strtotime($post->created_at)) }} Post Updated: {{ date('M d, Y', strtotime($post->updated_at)) }}</small>
				</div>
			</div>
		</div>

		{{-- <div class="col-sm-12 col-md-6">
			<br />
			<div class="card">
				<div class="card-body">
					<h2>Updates</h2>
					<hr>
					@foreach($updates as $update)
						<br />
						<h3>{{ $update->title }}</h3>
						{!! $update->content !!}
						<hr>
					@endforeach
					
				</div>
			</div>
		</div> --}}
	</div>
@endsection
