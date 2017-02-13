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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
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
	<div class="row affix-row">
		<div class="col-sm-3 col-md-2 affix-sidebar">
			<div class="sidebar-nav">
				<div class="navbar navbar-default" role="navigation">
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
					  <span class="sr-only">Toggle navigation</span>
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					  </button>
					  <span class="visible-xs navbar-brand">Sidebar menu</span>
					</div>
					<div class="navbar-collapse collapse sidebar-navbar-collapse">
						<ul class="nav navbar-nav" id="sidenav01">
							<li class="active">
							  <a href="/" data-toggle="collapse" data-target="#toggleDemo0" data-parent="#sidenav01" class="collapsed">
								<img src="/logo.png" class="img-responsive" />
							  </a>
							</li>
							@if(Auth::check())								
								<li><a href="{{ url('/players') }}"><h4 class="glyphicon glyphicon-lock"></h4><br/>Players</a></li>
								@if(Auth::user()->role == 'b')
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Roles <span class="caret"></span></a>
										<ul class="dropdown-menu" role="menu">
											<li><a href="{{ url('/roles') }}">Role Cards</a></li>
											<li><a href="{{ url('/teams') }}">Teams</a></li>
											<li><a href="{{ url('/statuses') }}">Statuses</a></li>
										</ul>
									</li>
									<li><a href="{{ url('/expansions') }}">Expansions</a></li>
									<li><a href="{{ url('/recipes') }}">Recipes</a></li>
									<li><a href="{{ url('/scenarios') }}">Scenarios</a></li>
								@endif
							@endif
							
							<li>
							  <a href="#" data-toggle="collapse" data-target="#toggleDemo" data-parent="#sidenav01" class="collapsed">
							  <h4 class="glyphicon glyphicon-cloud"></h4><br/>Flight
							  </a>
							  <div class="collapse" id="toggleDemo" style="height: 0px;">
								<ul class="nav nav-list">
								  <li><a href="#">Submenu1.1</a></li>
								  <li><a href="#">Submenu1.2</a></li>
								  <li><a href="#">Submenu1.3</a></li>
								</ul>
							  </div>
							</li>
							<li class="active">
							  <a href="#" data-toggle="collapse" data-target="#toggleDemo2" data-parent="#sidenav01" class="collapsed">
							  <span class="glyphicon glyphicon-inbox"></span> Submenu 2 <span class="caret pull-right"></span>
							  </a>
							  <div class="collapse" id="toggleDemo2" style="height: 0px;">
								<ul class="nav nav-list">
								  <li><a href="#">Submenu2.1</a></li>
								  <li><a href="#">Submenu2.2</a></li>
								  <li><a href="#">Submenu2.3</a></li>
								</ul>
							  </div>
							</li>
							<li><a href="#"><span class="glyphicon glyphicon-lock"></span> Normalmenu</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-calendar"></span> WithBadges <span class="badge pull-right">42</span></a></li>
							<li><a href=""><span class="glyphicon glyphicon-cog"></span> PreferencesMenu</a></li>
							@if(Auth::guest())
								<li><a href="{{ url('/auth/login') }}">Login</a></li>
								<li><a href="{{ url('/auth/register') }}">Register</a></li>
							@else
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							@endif
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>
		<div class="col-sm-9 col-md-10 affix-content">
			<div class="container">
				<div class="page-header">
					Content goes here
				</div>
			</div>
		</div>
	</div>
	
	
	
	
	
	<nav class="navbar navbar-inverse" style="margin-bottom: 0;">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/') }}">Ultimate Werewolf Moderator Tools</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					@if(Auth::check())
						<li><a href="{{ url('/players') }}">Players</a></li>
						@if(Auth::user()->role == 'b')
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Roles <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('/roles') }}">Role Cards</a></li>
									<li><a href="{{ url('/teams') }}">Teams</a></li>
									<li><a href="{{ url('/statuses') }}">Statuses</a></li>
								</ul>
							</li>
							<li><a href="{{ url('/expansions') }}">Expansions</a></li>
							<li><a href="{{ url('/recipes') }}">Recipes</a></li>
							<li><a href="{{ url('/scenarios') }}">Scenarios</a></li>
						@endif
					@endif
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if(Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

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
