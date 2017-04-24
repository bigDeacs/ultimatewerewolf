@extends('app')

@section('meta')
    <title>Players</title>
@endsection

@section('head')
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default panel-shadow">
			  <div class="panel-heading">
			    <h1 class="panel-title"><strong>Games</strong></h1>
			  </div>
			  <div class="panel-body">		
				<div class="row">
					<div class="col-sm-9 col-md-10">
						Welcome to the Ultimate Werewolf Toolkit! This tool will help Ultimate Werewolf Moderators track and control games of Werewolf. You can store player names, use premade role recipes and stack everything throughout the game. Just click the "Create Game" button above to start playing!
					</div>
					<div class="col-sm-3 col-md-2"><a href="/games/create" class="btn btn-primary">Create Game <i class="fa fa-plus-square"></i></a></div>					
				</div>
			  	<div class="row">
					<div class="col-sm-12">
						<p><strong>Games:</strong></p>
						<div class="table-responsive">
						  <table class="table dataTable table-striped table-hover">
						    <thead>
						    	<tr>
										<col width="50%">
										<col width="20%">
										<col width="10%">
										<col width="10%">
										<col width="10%">
						    		<th>Moderator</th>
						    		<th>Date</th>
						    		<th><i class="fa fa-moon-o" style="color: #6e00b3;" aria-hidden="true"></i>/<i class="fa fa-sun-o" style="color: #efc600;" aria-hidden="true"></i></th>
										<th>Round</th>
										<th></th>
						    	</tr>
						    </thead>
						    <tbody>
						    	@foreach($games as $game)
									@if($game->status == 'started')
							    	<tr class="success">
									@else
										<tr class="danger">
									@endif
                      					<td scope="row">{{ $game->name }}</td>
                      				  	<td>{{ $game->created_at->diffForHumans() }}</td>
											@if($game->time->status == 'night')
												<td><i class="fa fa-moon-o" style="color: #6e00b3;" aria-hidden="true"></i></td>
											@else
												<td><i class="fa fa-sun-o" style="color: #efc600;" aria-hidden="true"></i></td>
											@endif
											<td>{{ $game->time->round }}</td>
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
@endsection
