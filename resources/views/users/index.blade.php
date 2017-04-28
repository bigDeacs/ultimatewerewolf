@extends('app')

@section('meta')
    <title>Users</title>
@endsection

@section('head')
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default panel-shadow">
			  <div class="panel-heading">
			    <h1 class="panel-title"><strong>Users</strong></h1>
			  </div>
			  <div class="panel-body">
			  	<div class="pull-right"><a href="/users/create" class="btn btn-primary">Create User <i class="fa fa-plus-square"></i></a></div>
			  	<div style="clear:both;"></div>
			  	<div class="row">
					<div class="col-sm-12">
						<p><strong>Users:</strong></p>
						<div class="table-responsive">
						  <table class="table dataTable table-striped table-hover">
						    <thead>
						    	<tr>
						    		<th>Name</th>
						    		<th></th>
						    	</tr>
						    </thead>
						    <tbody>
						    	@foreach($users as $user)
									<tr>
										<td scope="row">{{ $user->name }}</td>
										<td><a href="/users/{{ $user->id }}/edit" class="btn btn-warning">Edit <i class="fa fa-pencil-square-o"></i></a></td>
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
