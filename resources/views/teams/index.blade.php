@extends('app')

@section('meta')
    <title>Teams</title>
@endsection

@section('head')
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default panel-shadow">
			  <div class="panel-heading">
			    <h1 class="panel-title"><strong>Teams</strong></h1>
			  </div>
			  <div class="panel-body">
			  	<div class="pull-right"><a href="/teams/create" class="btn btn-primary">Create Team <i class="fa fa-plus-square"></i></a></div>
			  	<div style="clear:both;"></div>
			  	<div class="row">
					<div class="col-sm-12">
						<p><strong>Team:</strong></p>
						<div class="table-responsive">
						  <table class="table dataTable table-striped table-hover">
							<col width="20%">
						  	<col width="40%">
			                <col width="20%">
			                <col width="20%">
						    <thead>
						    	<tr>
						    		<th>Name</th>                    
                    <th>Notes</th>
                    <th>Icon</th>
						    		<th></th>
						    	</tr>
						    </thead>
						    <tbody>
						    	@foreach($teams as $team)
							      <tr>
                      <td scope="row">{{ $team->name }}</td>
                      <td>{{ $team->notes }}</td>
                      <td>
                        @if($team->icon !== null)
                          <i class="fa {{ $team->icon }} fa-2x" style="color: #{{ $team->colour }};" aria-hidden="true"></i></td>
                        @endif
									  <td>
											<div class="btn-group" role="group" aria-label="...">
												<a href="/teams/{{ $team->id }}/edit" class="btn btn-warning">Edit <i class="fa fa-pencil-square-o"></i></a>
												<a href="/teams/{!! $team->id !!}/remove" class="btn btn-danger">Remove <i class="fa fa-minus-square"></i></a>
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
