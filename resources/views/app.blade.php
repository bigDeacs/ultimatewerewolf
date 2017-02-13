<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ultimate Werewolf</title>
	@yield('head')

	<link rel="stylesheet" href="/css/pick-a-color-1.2.3.min.css">
	<link href="{{ asset('/css/app.css') }}?v=3" rel="stylesheet">
	<link href="{{ asset('/css/jquery-ui.min.css') }}" rel="stylesheet">

	<link href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Marck+Script" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-md-5 col-sm-8 col-xs-9 bhoechie-tab-container">
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
				  <div class="list-group">
					@if(Auth::check())
						<a href="{{ url('/players') }}" class="list-group-item active text-center">
						  <h4 class="fa fa-users"></h4><br/>Players
						</a>
						@if(Auth::user()->role == 'b')
							<a href="{{ url('/roles') }}" class="list-group-item active text-center">
							  <h4 class="fa fa-users"></h4><br/>Roles
							</a>
							<a href="{{ url('/teams') }}" class="list-group-item active text-center">
							  <h4 class="fa fa-users"></h4><br/>Teams
							</a>
							<a href="{{ url('/statuses') }}" class="list-group-item active text-center">
							  <h4 class="fa fa-users"></h4><br/>Statuses
							</a>
							<a href="{{ url('/expansions') }}" class="list-group-item active text-center">
							  <h4 class="fa fa-users"></h4><br/>Expansions
							</a>
							<a href="{{ url('/recipes') }}" class="list-group-item active text-center">
							  <h4 class="fa fa-users"></h4><br/>Recipes
							</a>
							<a href="{{ url('/scenarios') }}" class="list-group-item active text-center">
							  <h4 class="fa fa-users"></h4><br/>Scenarios
							</a>
						@endif
					@endif
					@if(Auth::guest())
						<a href="{{ url('/auth/login') }}" class="list-group-item text-center">
							<h4 class="fa fa-sign-in"></h4><br/>Sign In
						</a>
						<a href="{{ url('/auth/register') }}" class="list-group-item text-center">
							<h4 class="fa fa-user-plus"></h4><br/>Sign Up
						</a>
					@else
						<a href="{{ url('/auth/logout') }}" class="list-group-item text-center">
							<h4 class="fa fa-sign-out"></h4><br/>Sign Out
						</a>
					@endif
				  </div>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
					@yield('content')
				</div>
			</div>
	  </div>
	</div>
	
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="/js/jquery-ui.min.js"></script>
	<script src="/js/jquery.ui.touch-punch.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
	<script src="/js/select2.min.js"></script>
	<script src="/js/pick-a-color-1.2.3.min.js"></script>
	<script src="/js/tinycolor-0.9.15.min.js"></script>
	<script>
		$(document).ready(function() {
			$('.dataTable').DataTable( {
			  stateSave: true,
			  "pagingType": "full_numbers",
						"pageLength": 500
			});
			$("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
				e.preventDefault();
				$(this).siblings('a.active').removeClass("active");
				$(this).addClass("active");
				var index = $(this).index();
				$("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
				$("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
			});
		});
		$(".pick-a-color").pickAColor({
			showSavedColors : false,
			showBasicColors : false,
			inlineDropdown	: true
		});
    </script>
		@yield('scripts')
</body>
</html>
