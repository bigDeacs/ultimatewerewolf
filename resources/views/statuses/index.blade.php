@extends('app')

@section('meta')
    <title>Statuses</title>
@endsection

@section('head')
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default panel-shadow">
			  <div class="panel-heading">
			    <h1 class="panel-title"><strong>Statuses</strong></h1>
			  </div>
			  <div class="panel-body">
			  	<div class="pull-right"><a href="/statuses/create" class="btn btn-primary">Create Status <i class="fa fa-plus-square"></i></a></div>
			  	<div style="clear:both;"></div>
			  	<div class="row">
					<div class="col-sm-12">
						<p><strong>Status:</strong></p>
						<div class="table-responsive">
						  <table class="table dataTable table-striped table-hover">
						    <thead>
						    	<tr>
						    		<th>Name</th>
                    <th>Notes</th>
                    <th>Icon</th>
						    		<th></th>
						    	</tr>
						    </thead>
						    <tbody>
						    	@foreach($statuses as $status)
							      <tr>
                      <td scope="row">{{ $status->name }}</td>
                      <td>{{ $status->notes }}</td>
                      <td>
                        @if($status->icon !== null)
                          <i class="fa {{ $status->icon }} fa-2x" style="color: #{{ $status->colour }};" aria-hidden="true"></i></td>
                        @endif
									  <td>
											<div class="btn-group" role="group" aria-label="...">
												<a href="/statuses/{{ $status->id }}/edit" class="btn btn-warning">Edit <i class="fa fa-pencil-square-o"></i></a>
												<a href="/statuses/{!! $status->id !!}/remove" class="btn btn-danger">Remove <i class="fa fa-minus-square"></i></a>
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
