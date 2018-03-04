@extends('frontend.layout')
@section('content')
	<div class="row">
		<div class="col-sm-10 offset-sm-1">
			<br />
			<div class="card">
				<div class="card-body">
					<h2 class="text-center">Posts</h2>
					<hr>
					@foreach($posts as $post)
						<br />
						<h3><a href="{{ route('post.show', ['post_id' => $post->id]) }}">{{ $post->title }}</a></h3>
						<small>Post Created: {{ date('M d, Y', strtotime($post->created_at)) }} Post Updated: {{ date('M d, Y', strtotime($post->updated_at)) }}</small>
						
						<hr>
					@endforeach
					
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
