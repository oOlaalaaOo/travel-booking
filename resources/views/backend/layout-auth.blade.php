@include('backend._partials._header')
<body style="background-color: #f8f8f8; font-family: 'Open Sans', sans-serif;">
	
    <div class="container">
		<div id="app">
			@yield('content')
			<notifications group="backend" position="top right" animation-type="velocity" />
		</div>
    </div>
	
	
	@include('backend._partials._footer')

  	@include('backend._partials._scripts')
	
</body>

</html>