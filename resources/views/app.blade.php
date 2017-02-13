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
	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-md-5 col-sm-8 col-xs-9 bhoechie-tab-container">
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
				  <div class="list-group">
					<a href="#" class="list-group-item active text-center">
					  <h4 class="glyphicon glyphicon-plane"></h4><br/>Flight
					</a>
					<a href="#" class="list-group-item text-center">
					  <h4 class="glyphicon glyphicon-road"></h4><br/>Train
					</a>
					<a href="#" class="list-group-item text-center">
					  <h4 class="glyphicon glyphicon-home"></h4><br/>Hotel
					</a>
					<a href="#" class="list-group-item text-center">
					  <h4 class="glyphicon glyphicon-cutlery"></h4><br/>Restaurant
					</a>
					<a href="#" class="list-group-item text-center">
					  <h4 class="glyphicon glyphicon-credit-card"></h4><br/>Credit Card
					</a>
				  </div>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
					<!-- flight section -->
					<div class="bhoechie-tab-content active">
						<center>
						  <h1 class="glyphicon glyphicon-plane" style="font-size:14em;color:#55518a"></h1>
						  <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
						  <h3 style="margin-top: 0;color:#55518a">Flight Reservation</h3>
						</center>
					</div>
					<!-- train section -->
					<div class="bhoechie-tab-content">
						<center>
						  <h1 class="glyphicon glyphicon-road" style="font-size:12em;color:#55518a"></h1>
						  <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
						  <h3 style="margin-top: 0;color:#55518a">Train Reservation</h3>
						</center>
					</div>
		
					<!-- hotel search -->
					<div class="bhoechie-tab-content">
						<center>
						  <h1 class="glyphicon glyphicon-home" style="font-size:12em;color:#55518a"></h1>
						  <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
						  <h3 style="margin-top: 0;color:#55518a">Hotel Directory</h3>
						</center>
					</div>
					<div class="bhoechie-tab-content">
						<center>
						  <h1 class="glyphicon glyphicon-cutlery" style="font-size:12em;color:#55518a"></h1>
						  <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
						  <h3 style="margin-top: 0;color:#55518a">Restaurant Diirectory</h3>
						</center>
					</div>
					<div class="bhoechie-tab-content">
						<center>
						  <h1 class="glyphicon glyphicon-credit-card" style="font-size:12em;color:#55518a"></h1>
						  <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
						  <h3 style="margin-top: 0;color:#55518a">Credit Card</h3>
						</center>
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
