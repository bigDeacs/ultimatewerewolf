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
</div>
@endsection
