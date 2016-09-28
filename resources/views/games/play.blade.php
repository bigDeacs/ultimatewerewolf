@extends('app')

@section('meta')
    <title>Games</title>
@endsection

@section('head')
@endsection

@section('content')
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
                  <col width="5%">
                  <col width="10%">
                  @foreach($statuses as $status)
                    <col width="5%">
                  @endforeach
						    	<tr>
						    		<th>ID</th>
						    		<th>Role</th>
                    @foreach($statuses as $status)
                      <th><i class="fa {{ $status->icon }} fa-2x" style="color: #{{ $status->colour }};" aria-hidden="true"></i></th>
                    @endforeach
						    	</tr>
						    </thead>
						    <tbody>
                  {!! Form::open(['url' => '/games/build']) !!}
  						    	@foreach($roles as $key => $role)
  							      <tr>
                        <td scope="row">{{ $key }}</td>
                        <td>{{ $role->name }}</td>
                        @foreach($statuses as $status)
                          <td>{{ $status->name }} Check Box</td>
                        @endforeach
  						    	  </tr>
  						    	@endforeach
                  {!! Form::close() !!}
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
