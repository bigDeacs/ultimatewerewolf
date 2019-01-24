<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Werewolf Toolkit - The Ultimate Werewolf tool for Moderators</title>
	@yield('head')
	<meta name="description" content="A online tool for Ultimate Werewolf Moderators to use. It allows you track everything that happens throughout the game.">

	<link rel="stylesheet" href="/css/pick-a-color-1.2.3.min.css">
	<link href="{{ asset('/css/app.css') }}?v=18" rel="stylesheet">
	<link href="{{ asset('/css/jquery-ui.min.css') }}" rel="stylesheet">

	<link href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

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
			<div class="col-lg-1 col-md-1 col-sm-2 col-xs-12 bhoechie-tab-menu">
			  <div class="list-group">
				<a href="/" class="list-group-item text-center hidden-xs" style="background-color:#5A55A3;border-color:#555555;">
				  <img src="/logo.png" class="img-responsive" alt="Werewolf Toolkit Logo" />
				</a>
				@if(Auth::check())
				    @if(Auth::user()->role == 'b')
					    <a href="{{ url('/games') }}" class="list-group-item text-center {{ Request::url() == 'http://werewolftoolkit.com' ||Request::url() == 'http://werewolftoolkit.com/home' ? 'active' : '' }}" style="font-size: 12px;">
					      <i class="fa fa-trophy fa-2x"></i><br/>Games
				 	    </a>
				    @else
					    <a href="{{ url('/') }}" class="list-group-item text-center {{ Request::url() == 'http://werewolftoolkit.com' ||Request::url() == 'http://werewolftoolkit.com/home' ? 'active' : '' }}" style="font-size: 12px;">
						  <i class="fa fa-trophy fa-2x"></i><br/>Games
						</a>
					@endif
					<a href="{{ url('/players') }}" class="list-group-item text-center {{ Request::url() == 'http://werewolftoolkit.com/players' ? 'active' : '' }}" style="font-size: 12px;">
					  <i class="fa fa-users fa-2x"></i><br/>Players
					</a>
					@if(Auth::user()->role == 'b')
						<a href="{{ url('/roles') }}" class="list-group-item text-center {{ Request::url() == 'http://werewolftoolkit.com/roles' ? 'active' : '' }}" style="font-size: 12px;">
						  <i class="fa fa-user-secret fa-2x"></i><br/>Roles
						</a>
						<a href="{{ url('/teams') }}" class="list-group-item text-center {{ Request::url() == 'http://werewolftoolkit.com/teams' ? 'active' : '' }}" style="font-size: 12px;">
						  <i class="fa fa-handshake-o fa-2x"></i><br/>Teams
						</a>
						<a href="{{ url('/statuses') }}" class="list-group-item text-center {{ Request::url() == 'http://werewolftoolkit.com/statuses' ? 'active' : '' }}" style="font-size: 12px;">
						  <i class="fa fa-users fa-2x"></i><br/>Statuses
						</a>
						<a href="{{ url('/expansions') }}" class="list-group-item text-center {{ Request::url() == 'http://werewolftoolkit.com/expansions' ? 'active' : '' }}" style="font-size: 12px;">
						  <i class="fa fa-plug fa-2x"></i><br/>Expansions
						</a>
						<a href="{{ url('/recipes') }}" class="list-group-item text-center {{ Request::url() == 'http://werewolftoolkit.com/recipes' ? 'active' : '' }}" style="font-size: 12px;">
						  <i class="fa fa-cutlery fa-2x"></i><br/>Recipes
						</a>
						<a href="{{ url('/scenarios') }}" class="list-group-item text-center {{ Request::url() == 'http://werewolftoolkit.com/scenarios' ? 'active' : '' }}" style="font-size: 12px;">
						  <i class="fa fa-book fa-2x"></i><br/>Scenarios
						</a>
						<a href="{{ url('/users') }}" class="list-group-item text-center {{ Request::url() == 'http://werewolftoolkit.com/users' ? 'active' : '' }}" style="font-size: 12px;">
						  <i class="fa fa-lock fa-2x"></i><br/>Users
						</a>
					@endif
				@endif
				@if(Auth::guest())
					<a href="{{ url('/auth/login') }}" class="list-group-item text-center {{ Request::url() == 'http://werewolftoolkit.com/auth/login' ? 'active' : '' }}" style="font-size: 12px;">
						<i class="fa fa-sign-in fa-2x"></i><br/>Sign In
					</a>
					<a href="{{ url('/auth/register') }}" class="list-group-item text-center {{ Request::url() == 'http://werewolftoolkit.com/auth/register' ? 'active' : '' }}" style="font-size: 12px;">
						<i class="fa fa-user-plus fa-2x"></i><br/>Sign Up
					</a>
				@else
					<a href="{{ url('/auth/logout') }}" class="list-group-item text-center" style="font-size: 12px;">
						<i class="fa fa-sign-out fa-2x"></i><br/>Sign Out
					</a>
				@endif
			  </div>
			</div>
			<div class="col-lg-11 col-md-11 col-sm-10 col-xs-12 bhoechie-tab">
				@yield('content')
				<hr />
				<div class="row">
					<div class="col-xs-12">
						<!-- Home Page Horizon Ad -->
						<div class="text-center">
							<a href="https://t.cfjump.com/33917/b/26467" rel="noindex,nofollow" target="_blank"><img style="border: none; vertical-align: middle;" class="img-responsive" alt="Buy amazing Board Games from Oz Game Shop" src="https://img.ozboardgamer.com/img/d2b546c6-bf54-41c4-bdc9-d5f64bd45508.gif" /></a>
						</div>
					</div>
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
			  "pageLength": 10
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
