@extends('app')

@section('meta')
    <title>Recipes</title>
@endsection

@section('head')
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default panel-shadow">
			  <div class="panel-heading">
			    <h1 class="panel-title"><strong>Recipes</strong></h1>
			  </div>
			  <div class="panel-body">
			  	<div class="pull-right"><a href="/recipes/create" class="btn btn-primary">Create Recipe <i class="fa fa-plus-square"></i></a></div>
			  	<div style="clear:both;"></div>
			  	<div class="row">
					<div class="col-sm-12">
						<p><strong>Recipes:</strong></p>
						<div class="table-responsive">
						  <table class="table dataTable table-striped table-hover">
						    <thead>
						    	<tr>
						    		<th>Name</th>
                    <th>Roles</th>
						    		<th>Players</th>
                    <th></th>
						    	</tr>
						    </thead>
						    <tbody>
						    	@foreach($recipes as $recipe)
							      <tr>
                      <td scope="row">{{ $recipe->name }}</td>
                      <td>
                        @foreach($recipe->roles as $role)
                          @if($recipe->roles()->wherePivot('total','>', 0)->wherePivot('role_id','=', $role->id)->get())
                            {{ $role->name }},
                          @endif
                        @endforeach
                      </td>
                      <td>{{ $recipe->players }}</td>
									  <td>
											<div class="btn-group" role="group" aria-label="...">
												<a href="/recipes/{{ $recipe->id }}/edit" class="btn btn-warning">Edit <i class="fa fa-pencil-square-o"></i></a>
												<a href="/recipes/{!! $recipe->id !!}/remove" class="btn btn-danger">Remove <i class="fa fa-minus-square"></i></a>
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
