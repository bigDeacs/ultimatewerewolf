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
                  <col width="10%">
                  <col width="45%">
                  <col width="45%">
						    	<tr>
						    		<th>ID</th>
						    		<th>Role</th>
                    <th>Player</th>
						    	</tr>
						    </thead>
						    <tbody>
                  {!! Form::open(['url' => '/games/names']) !!}
  						    	@foreach($roles as $key => $role)
  							      <tr>
                        <td scope="row">{{ $key }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                          <select name="name_list[{{ $key }}]" class="name_list" class="form-control" style="width:100%;">
                            @foreach($players as $player)
                              <option value="{{ $player->id }}">{{ $player->name }}</option>
                            @endforeach
                          </select>
                          <input type="hidden" name="role_list[]" value="{{ $role->id }}"
                        </td>
  						    	  </tr>
  						    	@endforeach
                    <tr>
                      <td colspan="3"><button type="submit" class="btn btn-success btn-block">Next</button></td>
                    </tr>

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

@section('scripts')
      <script>
            $('.name_list').select2({
            	placeholder: 'Choose a name',
            	tags: true
            });
      </script>
@endsection
