@extends('app')

@section('meta')
    <title>Games</title>
@endsection

@section('head')
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default panel-shadow">
			  <div class="panel-heading">
			    <h1 class="panel-title"><strong>Games</strong></h1>
			  </div>
			  <div class="panel-body">
          <div class="row">
            <div class="col-xs-12">
              <p class="storyFont">
                The Town of Salem was a prosperous village, children would laugh and play, families would gather together over delicious meals and for years now they have all lived in perfect harmony, until now. Everyone, close your eyes.
              </p>
            </div>
          </div>
			  	<div class="row">
					<div class="col-sm-12">
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
                            <select name="name_list[{{ $key }}]" class="name_list" class="form-control" style="width:100%;" required>
                              @foreach($players as $player)
                                <option value="{{ $player->id }}">{{ $player->name }}</option>
                              @endforeach
                            </select>
                          </td>
						  @foreach($statuses as $status)
							@if($status->icon)
							  <td class="text-center">
								<label class="btn" style="padding: 0;">
									<input type="checkbox" name="status_list[{{ $status->id }}][{{ $key }}]" style="display: none;" value="{{ $key }}">
								  <i class="fa fa-square-o fa-2x"></i>
								  <i class="fa fa-check-square-o fa-2x"></i>
								</label>
							  </td>
							@endif
						  @endforeach
                          <td>
                            <select name="team_list[{{ $key }}]" class="form-control">
                              @foreach($teams as $team)
                                @if($team->name == 'Villagers')
                                  <option value="{{ $team->id }}" selected="selected">{{ $team->name }}</option>
                                @else
                                  <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endif
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
