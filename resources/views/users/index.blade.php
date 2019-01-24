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
			  	<div style="clear:both;"></div>
			  	<div class="row">
					<div class="col-sm-12">
						<p><strong>Users:</strong></p>
						<div class="table-responsive">
						  <table class="table dataTable table-striped table-hover">
						    <thead>
						    	<tr>
									<th>Id</th>
						    		<th>Name</th>
									<th>Email</th>
						    		<th>Games</th>
									<th></th>
						    	</tr>
						    </thead>
						    <tbody>
						    	@foreach($users as $user)
									<tr>
										<td scope="row">{{ $user->id }}</td>
										<td scope="row">{{ $user->name }}</td>
										<td scope="row">{{ $user->email }}</td>
										<td><span class="badge" style="background-color: #e62929;">{{ $user->games->count() }}</span></td>
										<td>
											<div class="btn-group" role="group" aria-label="...">
												<a href="/users/{{ $user->id }}/edit" class="btn btn-warning">Edit <i class="fa fa-pencil-square-o"></i></a>
												<a href="/users/{!! $user->id !!}/remove" class="btn btn-danger">Remove <i class="fa fa-minus-square"></i></a>
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
