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
					<div class="col-sm-7 col-md-8">
						Welcome to the Ultimate Werewolf Toolkit! This tool will help Ultimate Werewolf Moderators track and control games of Werewolf. You can store player names, use premade role recipes and stack everything throughout the game. Just click the "Create Game" button above to start playing!
					</div>
					<div class="col-sm-5 col-md-4">
						<div class="pull-right btn-group">
							<a class="btn btn-info" data-toggle="modal" data-target="#myModal">How To</a>							
							<a href="/games/create" class="btn btn-primary">Create Game <i class="fa fa-plus-square"></i></a>
						 </div>
					</div>					
				</div>
			  	<div class="row">
					<div class="col-sm-12">
						<p><strong>Games:</strong></p>
						<div class="table-responsive">
						  <table class="table dataTable table-striped table-hover">
						    <thead>
						    	<tr>
										<col width="35%">
										<col width="20%">
										<col width="10%">
										<col width="10%">
										<col width="25%">
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
									  <td>
											<div class="btn-group" role="group" aria-label="...">
												<a href="/games/{{ $game->id }}/edit" class="btn btn-warning">View <i class="fa fa-pencil-square-o"></i></a>
												<a href="/games/{!! $game->id !!}/remove" class="btn btn-danger">Remove <i class="fa fa-minus-square"></i></a>
											</div>
										</td>
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

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">How to Use Toolkit</h4>
		  </div>
		  <div class="modal-body">
				<!-- 16:9 aspect ratio -->
				<div class="embed-responsive embed-responsive-16by9">
				  <iframe class="embed-responsive-item" width="100%" height="auto" src="https://www.youtube.com/embed/kuuVq45mHkc?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
				</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
@endsection
