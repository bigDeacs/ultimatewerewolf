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
			    <h1 class="panel-title"><strong>Players</strong></h1>
			  </div>
			  <div class="panel-body">
			  	<div class="pull-right"><a href="/players/create" class="btn btn-primary">Create Player <i class="fa fa-plus-square"></i></a></div>
			  	<div style="clear:both;"></div>
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
						    	@foreach($players as $player)
							      <tr>
										<td scope="row">{{ $player->name }}</td>
										<td>
											<div class="btn-group" role="group" aria-label="...">
												<a href="/players/{{ $player->id }}/edit" class="btn btn-warning">Edit <i class="fa fa-pencil-square-o"></i></a>
												<a href="/players/{!! $player->id !!}/remove" class="btn btn-danger">Remove <i class="fa fa-minus-square"></i></a>
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
