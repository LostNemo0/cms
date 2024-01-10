<!DOCTYPE html>
<html lang="en">
	<head>
		@include('layout.header')
		@yield('pageTitle')
		@yield('metaCSRF')
	</head>
	<body>
			@include('layout.nav')
			<div style="padding:20px;">
				@yield('contents')
			</div>
	</body>
</div>
	@yield('js')
	<script>
	$('#logoutbtn').on('click',function(event){
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: {type: 'logout'},
  			success:function(e){
  					if(e){
  						console.log(e);
							//alert("User successfully logged out.");
              window.location.href = "/login";
  					}
  			},
  	})
  });
	</script>
</html>
