@extends('app')

@section('meta')
    <title>{{ $user->name }}</title>
@endsection

@section('head')
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default panel-shadow">
			  <div class="panel-heading">
			    <h1 class="panel-title"><strong>{{ $user->name }}<small>({{ $user->email }})</small></strong></h1>
			  </div>			  
			  <div class="panel-body">
			  	<div class="pull-right"><a href="/admin/{{ (Auth::check()) ? 'posts' : '' }}" class="btn btn-primary"><i class="fa fa-arrow-circle-o-left"></i> Back</a></div>
			  	<div style="clear:both;"></div>
				<!-------------------------->
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
						    	@foreach($user->games as $game)
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
				<div class="row">
					<div class="col-sm-12">
						<p><strong>Players:</strong></p>
						<div class="table-responsive">
						  <table class="table dataTable table-striped table-hover">
						    <thead>
						    	<tr>
						    		<th>Name</th>
						    		<th></th>
						    	</tr>
						    </thead>
						    <tbody>
						    	@foreach($user->players as $player)
							      <tr>
										<td scope="row">{{ $player->name }}</td>
						    		  <td><a href="/players/{{ $player->id }}/edit" class="btn btn-warning">Edit <i class="fa fa-pencil-square-o"></i></a></td>
						    	  </tr>
						    	@endforeach
						    </tbody>
						  </table>
						</div>
					</div>
				</div>
				<!-------------------------->
			  </div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
@endsection
