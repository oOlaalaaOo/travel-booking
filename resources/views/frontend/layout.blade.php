@include('frontend._partials._header')
<body style="font-family: 'Open Sans', sans-serif;">

    @include('frontend._partials._navbar')

    <div class="container-fluid">
    	<br /><br /><br />
    	<div id="app">
	        @yield('content')
            <notifications group="frontend" position="top right" animation-type="velocity" />
	    </div>
    </div>
	
	@include('frontend._partials._footer')

  	@include('frontend._partials._scripts')

</body>

</html>