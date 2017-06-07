@extends('app')

@section('meta')
    <title>Expansions</title>
@endsection

@section('head')
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default panel-shadow">
			  <div class="panel-heading">
			    <h1 class="panel-title"><strong>Expansions</strong></h1>
			  </div>
			  <div class="panel-body">
			  	<div class="pull-right"><a href="/expansions/create" class="btn btn-primary">Create Expansion <i class="fa fa-plus-square"></i></a></div>
			  	<div style="clear:both;"></div>
			  	<div class="row">
					<div class="col-sm-12">
						<p><strong>Expansions:</strong></p>
						<div class="table-responsive">
						  <table class="table dataTable table-striped table-hover">
			                <col width="40%">
                      <col width="20%">
			                <col width="20%">
			                <col width="20%">
						    <thead>
						    	<tr>
						    		<th>Name</th>
                    <th># of Roles</th>
                    <th></th>
						    		<th></th>
						    	</tr>
						    </thead>
						    <tbody>
						    	@foreach($expansions as $expansion)
							      <tr>
                      <td scope="row">{{ $expansion->name }}</td>
                      <td>{{ count($expansion->roles) }}</td>
                      <td><img src="{{ $expansion->image }}" class="img-responsive" /></td>
									  <td>
											<div class="btn-group" role="group" aria-label="...">
												<a href="/expansions/{{ $expansion->id }}/edit" class="btn btn-warning">Edit <i class="fa fa-pencil-square-o"></i></a>
												<a href="/expansions/{!! $expansion->id !!}/remove" class="btn btn-danger">Remove <i class="fa fa-minus-square"></i></a>
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
