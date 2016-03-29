<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/plain; charset=utf-8" />
	    <title>@yield('title')</title>
	    <meta name="keywords" content="" />
	    <meta name="description" content="" />

	    @yield('head-script')

	    <meta name="viewport" content="width = device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

		{!! HTML::style('css/main.css') !!} 
		{!! HTML::style('css/bootstrap/bootstrap.css') !!}
		{!! HTML::style('js/jquery-ui-1.11.4/jquery-ui.css') !!}

		{!! HTML::script('js/jquery-ui-1.11.4/external/jquery/jquery.js') !!}
		{!! HTML::script('js/bootstrap/bootstrap.min.js') !!}
		{!! HTML::script('js/jquery-ui-1.11.4/jquery-ui.min.js') !!}

		@yield('page-script')
	</head>
<body>

	@yield('content')

</body>
</html>
