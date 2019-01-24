@extends('app')

@section('meta')
    <title>Games</title>
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
						    		<th>Name</th>
						    		<th>Date</th>
						    		<th></th>
						    	</tr>
						    </thead>
						    <tbody>
						    	@foreach($games as $game)
							      <tr>
                      				  <td scope="row">{{ $game->id }}</td>
                      				  <td>{{ $game->name }} ({{ $game->user }})</td>
                      				  <td>{{ $game->created_at }}</td>
									  <td>
											<div class="btn-group" role="group" aria-label="...">
												<a href="/games/{{ $game->id }}" class="btn btn-warning">View <i class="fa fa-pencil-square-o"></i></a>
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
@endsection
