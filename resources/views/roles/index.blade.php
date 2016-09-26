@extends('app')

@section('meta')
    <title>Roles</title>
@endsection

@section('head')
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<div class="panel panel-default panel-shadow">
			  <div class="panel-heading">
			    <h1 class="panel-title"><strong>Roles</strong></h1>
			  </div>
			  <div class="panel-body">
			  	<div class="pull-right"><a href="/roles/create" class="btn btn-primary">Create Role <i class="fa fa-plus-square"></i></a></div>
			  	<div style="clear:both;"></div>
			  	<div class="row">
					<div class="col-sm-12">
						<p><strong>Roles:</strong></p>
						<div class="table-responsive">
						  <table class="table dataTable table-striped table-hover">
						    <thead>
						    	<tr>
						    		<th>Name</th>
                    <th>Order</th>
                    <th>Impact</th>
                    <th>Expansion</th>
                    <th>Status</th>
						    		<th></th>
                    <th></th>
						    	</tr>
						    </thead>
						    <tbody>
						    	@foreach($roles as $role)
							      <tr>
                      <td scope="row">{{ $role->name }}</td>
                      <td scope="row">{{ $role->order }}</td>
                      <td scope="row">{{ $role->impact }}</td>
                      <td scope="row">{{ $role->expansion->name }}</td>
                      <td scope="row">
                        @if($role->status)
                          <i class="fa {{ $role->status->icon }} fa-2x" style="color: #{{ $role->status->colour }};" aria-hidden="true"></i>
                        @endif
						    		  <td><a href="/roles/{{ $role->id }}/edit" class="btn btn-warning">Edit <i class="fa fa-pencil-square-o"></i></a></td>
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

@section('scripts')

@endsection
