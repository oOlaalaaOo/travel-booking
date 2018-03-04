@include('backend._partials._header')
<body style="font-family: 'Open Sans', sans-serif;">
	
    @include('backend._partials._navbar')

    <div class="container-fluid">
    	<div class="row">
			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    		@include('backend._partials._sidebar')
				<div id="app">
			        @yield('content')
			        <notifications group="backend" position="top right" animation-type="velocity" />
	
			    </div>
			</main>
	    </div>
    </div>
	
	
	@include('backend._partials._footer')

  	@include('backend._partials._scripts')
	
</body>

</html>