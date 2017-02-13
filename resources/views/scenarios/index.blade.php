@extends('app')

@section('meta')
    <title>Scenarios</title>
@endsection

@section('head')
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default panel-shadow">
			  <div class="panel-heading">
			    <h1 class="panel-title"><strong>Scenarios</strong></h1>
			  </div>
			  <div class="panel-body">
			  	<div class="pull-right"><a href="/scenarios/create" class="btn btn-primary">Create Scenario <i class="fa fa-plus-square"></i></a></div>
			  	<div style="clear:both;"></div>
			  	<div class="row">
					<div class="col-sm-12">
						<p><strong>Scenarios:</strong></p>
						<div class="table-responsive">
						  <table class="table dataTable table-striped table-hover">
						    <thead>
						    	<tr>
						    		<th>Description</th>
                    <th># of Deaths</th>
						    		<th></th>
						    	</tr>
						    </thead>
						    <tbody>
						    	@foreach($scenarios as $scenario)
							      <tr>
                      <td scope="row">{{ $scenario->description }}</td>
                      <td>{{ $scenario->deaths }}</td>
						    		  <td><a href="/scenarios/{{ $scenario->id }}/edit" class="btn btn-warning">Edit <i class="fa fa-pencil-square-o"></i></a></td>
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
