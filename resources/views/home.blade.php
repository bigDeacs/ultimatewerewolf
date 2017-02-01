@extends('app')

@section('content')
<div class="container">
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
										<col width="40%">
										<col width="10%">
										<col width="25%">
										<col width="25%">
						    		<th>Game</th>
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
                      				  	<td>{{ $game->created_at }}</td>
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
</div>
@endsection
