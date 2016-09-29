@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>
				<a href="/games/create">Start New Game</a>
				<div class="panel-body">
					{{ $user->name }}<br />
					Games:
					@foreach($games as $game)
						@if($game->status == 'started')
							Finish the game you started
							<?php break; ?>
						@endif
					@endforeach
			    @foreach($games as $game)
						{{ $game->name }}
					  {{ $game->status }}<br />
					@endforeach
					<hr />
					Players:
					@foreach($players as $player)
						{{ $player->name }}
					@endforeach
					<br />
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<div class="panel panel-default panel-shadow">
			  <div class="panel-heading">
			    <h1 class="panel-title"><strong>Games</strong></h1>
			  </div>
			  <div class="panel-body">
			  	<div class="pull-right"><a href="/games/create" class="btn btn-primary">Create Game <i class="fa fa-plus-square"></i></a></div>
			  	<div style="clear:both;"></div>
			  	<div class="row">
					<div class="col-sm-12">
						<p><strong>Games:</strong></p>
						<div class="table-responsive">
						  <table class="table dataTable table-striped table-hover">
						    <thead>
						    	<tr>
						    		<th>ID</th>
						    		<th></th>
						    	</tr>
						    </thead>
						    <tbody>
						    	@foreach($games as $game)
									@if($game->status == 'started')
							    	<tr class="danger">
									@else
										<tr class="success">
									@endif
                      <td scope="row">{{ $game->id }}</td>
						    		  <td><a href="/games/{{ $game->id }}" class="btn btn-primary">View <i class="fa fa-pencil-square-o"></i></a></td>
						    	  </tr>
						    	@endforeach
						    </tbody>
						  </table>
						</div>
					</div>
				</div>
			  </div>
			</div>
		</div>
	</div>
</div>
@endsection
