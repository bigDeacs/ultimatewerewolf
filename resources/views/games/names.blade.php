@extends('app')

@section('meta')
    <title>Games</title>
@endsection

@section('head')
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default panel-shadow">
			  <div class="panel-heading">
			    <h1 class="panel-title"><strong>Games</strong></h1>
			  </div>
			  <div class="panel-body">
			  	<div class="row">
					<div class="col-sm-12">
            <p>Enter the name of each player next to there role, one way to do this is to have the players go to sleep and ask them to stick there thumb out when you call their role.</p>
						<div class="table-responsive">
						  <table class="table dataTable table-striped table-hover">
						    <thead>
                  <col width="10%">
                  <col width="30%">
                  <col width="30%">
                  <col width="30%">
						    	<tr>
						    		<th>Position</th>
						    		<th>Role</th>
                    <th>Player</th>
                    <th>Team</th>
						    	</tr>
						    </thead>
						    <tbody>
                  {!! Form::open(['url' => '/games/names']) !!}
                    <input type="hidden" name="game" value="{{ $game->id }}">
                    @unless($roles == null)
                      @foreach($roles as $key => $role)
    							      <tr>
                          <td scope="row">{{ $key+1 }}</td>
                          <td>{{ $role->name }}</td>
                          <td>
                            <select name="name_list[{{ $key }}]" class="name_list" class="form-control" style="width:100%;">
                              @foreach($players as $player)
                                <option value="{{ $player->id }}">{{ $player->name }}</option>
                              @endforeach
                            </select>
                          </td>
                          <td>
                            <select name="team_list[{{ $key }}]" class="form-control">
                              @foreach($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                              @endforeach
                            </select>
                          </td>
    						    	  </tr>
    						    	@endforeach
                    @endunless
                    <tr>
                      <td colspan="4"><button type="submit" class="btn btn-success btn-block">Next</button></td>
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
