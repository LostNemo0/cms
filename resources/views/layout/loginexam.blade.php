<!DOCTYPE html>
<html lang="en">
	<head>
		@include('layout.header')
		@yield('pageTitle')
		@yield('metaCSRF')
	</head>
	<body>
			<div style="padding:20px;">
				@yield('contents')
			</div>
	</body>
</div>
	@yield('js')
</html>
