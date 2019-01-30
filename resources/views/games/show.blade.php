@extends('app')

@section('meta')
    <title>{{ $game->id }}</title>
@endsection

@section('head')
  <style>
	label input[type="checkbox"] ~ i.fa.fa-square-o{
		color: #c8c8c8;    display: inline;
	}
	label input[type="checkbox"] ~ i.fa.fa-user-times{
		display: none;
	}
	label input[type="checkbox"]:checked ~ i.fa.fa-square-o{
		display: none;
	}
	label input[type="checkbox"]:checked ~ i.fa.fa-user-times{
		color: #c61515;    display: inline;
	}
	label:hover input[type="checkbox"] ~ i.fa {
	color: #5d5d5d;
	}
  @foreach($statuses as $status)
		/* {{ $status->name }} CSS */
		label input[type="checkbox"] ~ i.fa.{{ $status->icon }}{
			display: none;
		}
		label input[type="checkbox"]:checked ~ i.fa.{{ $status->icon }}{
			color: #{{ $status->colour }};    display: inline;
		}
  @endforeach
  </style>
  <link href="{{ asset('/css/flipclock.css') }}" rel="stylesheet" />
@endsection

@section('content')  
<div class="row">
  <div class="col-xs-12">
    {!! Form::open(['url' => '/games/save']) !!}
      <div class="panel panel-shadow panel-{{ $game->time->status }}">
        <div class="panel-heading row" style="height: 55px;">
          <h1 class="panel-title col-xs-12 col-sm-5 col-md-6">
            @if($game->time->status == 'night')
              <input type="hidden" name="status" value="day">
              <i class="fa fa-moon-o fa-2x" style="color: #a17dd8;" aria-hidden="true"></i>
            @else
              <input type="hidden" name="status" value="night">
              <i class="fa fa-sun-o fa-2x" style="color: #efc600;" aria-hidden="true"></i>
            @endif
            <span style="font-size:30px;"><strong>Round {{ $game->time->round }}</strong></span>
          </h1>
          <div class="col-xs-12 col-sm-7 col-md-6">
            @if($game->status == 'started')
              <div class="pull-right btn-group">
				<button type="submit" class="btn btn-success">Next {{ $game->time->status == 'night' ? 'Day' : 'Night' }} <i class="fa fa-floppy-o"></i></button>
				<a id="show" class="btn btn-info">Show Names</a>
				<a id="hide" class="btn btn-info">Hide Names</a>
                <!--<a href="/games/$game->id/end" class="btn btn-danger" onclick="return confirm('Is the game over?');return false;">Finish <i class="fa fa-hourglass-end"></i></a>-->
                <a href="/games/{{ $game->id }}/winner" class="btn btn-danger">Finish <i class="fa fa-hourglass-end"></i></a>
              </div>
            @endif
          </div>
        </div>
        <div class="panel-body">
        @if($game->status == 'started')
          <input type="hidden" name="game" value="{{ $game->id }}">
          <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-7">
              <p class="storyFont">
                @if($game->time->round > 1)
                  @if($scenarios !== '')
                    {{ $scenarios->sortBy(DB::raw('RAND()'))->first()->description }}										 
                  @else
                    Everyone, close your eyes...
                  @endif
                @endif
              </p>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-5">
              <div class="clock" style="margin:2em;width: auto;"></div>
            </div>
          </div>
          <div class="row">
          <div class="col-sm-12">
            <div class="table-responsive" style="width: 20%;float: left;">
              <table class="table table-hover">
                <thead>
                  <tr height="55px" style="background-color: #f5f5f5;">
                    <th style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #dddddd;">Role</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $order = 0; ?>
                  @foreach($roles as $key => $role)
                      @if($role->night == -99 || $role->night == $game->time->round)
                        <tr style="background-color: #a17dd8;color:#fff;" height="55px">
                      @else
                        <tr style="background-color: #fff;color:#fff;" height="55px">
                      @endif
                        <td>
                          <button type="button" class="btn btn-sm btn-warning btn-block" data-toggle="modal" data-target="#{{ camel_case($role->name) }}">
                            {{ $role->name }}
                          </button>
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- Player side -->
            <div class="table-responsive" style="width: 80%;float: left;">
              <table class="table table-hover">
				<col width="20%" class="names">
				<col width="{{ 60 / (count($statuses) + 1) }}%">
				@foreach($statuses as $status)
					@if($status->icon)
					  <col width="{{ 60 / (count($statuses) + 1) }}%">
					@endif
				@endforeach
				<col width="20%">
                <thead>
                  <tr height="55px" style="background-color: #f5f5f5;">
                    <th class="names">Player</th>
                    <th class="text-center">
                        <i class="fa fa-user-times fa-1x" style="color: #c61515;" aria-hidden="true"></i>
                    </th>
                    @foreach($statuses as $status)
                      @if($status->icon)
                        <th class="text-center">
                          <i class="fa {{ $status->icon }} fa-1x" style="color: #{{ $status->colour }};" aria-hidden="true"></i>
                        </th>
                      @endif
                    @endforeach
                    <th class="text-center">
                       <i class="fa fa-users fa-1x" style="color: #000000;" aria-hidden="true"></i>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($players as $key => $player)
                    @if($player->pivot->status == 'dead')
                      <tr class="danger" height="55px">
                    @else
                      <tr class="success" height="55px">
                    @endif
                      <td class="names">{{ $player->name }}</td>
                      <td class="text-center">
                        @unless($player->pivot->status == 'dead')
							<div class="input-group">
								<a tabindex="0" role="button" class="input-group-addon btn btn-default status"
									  data-container="body"
									  data-trigger="focus"
									  data-toggle="popover"
									  data-placement="top"
									  data-content="Check this box to kill a player">
									<i class="fa fa-question" aria-hidden="true"></i>
								 </a>								
								<div class="input-group-addon" style="padding: 5px 0;">
									<label class="btn" style="padding: 0;font-size:10px;">
										<input type="checkbox" name="death_list[{{ $key }}]" style="display: none;">
										<i class="fa fa-square-o fa-2x"></i>
										<i class="fa fa-user-times fa-2x"></i>
									</label>
								</div>
							</div>
                        @endunless
                      </td>
                      @foreach($statuses as $status)
                        @if($status->icon)
							<td class="text-center">
								<div class="input-group">
									<a tabindex="0" role="button" class="input-group-addon btn btn-default {{ preg_replace('/\s+/', '-', lcfirst($status->name)) }}"
										  data-container="body"
										  data-toggle="popover"
										  data-placement="top"
										  data-trigger="focus"
										  data-content="{{ $status->notes }}">
										<i class="fa fa-question fa-1x" aria-hidden="true"></i>
									</a> 
									<div class="input-group-addon" style="padding: 5px 0;">
										<label class="btn" style="padding: 0;font-size:10px;">
											@if($player->statuses()->where('player_status.game_id', '=', $game->id)->where('statuses.name', '=', $status->name)->first())
												<input type="checkbox" name="status_list[{{ $status->id }}][{{ $key }}]" style="display: none;" value="{{ $key }}" checked>
											@else
												<input type="checkbox" name="status_list[{{ $status->id }}][{{ $key }}]" style="display: none;" value="{{ $key }}">
											@endif
											<i class="fa fa-square-o fa-2x"></i>
											<i class="fa {{ $status->icon }} fa-2x"></i>
										</label>
									</div>
								</div>
							</td>
                        @endif
                      @endforeach
                      <td>
                        <div class="input-group">
							<a tabindex="0" role="button" class="input-group-addon btn btn-default {{ lcfirst($game->teams()->where('game_team.position', '=', $key)->first()->name) }}"
									  data-container="body"
									  data-trigger="focus"
									  data-toggle="popover"
									  data-placement="top"
									  data-content="This player is on the {{ $game->teams()->where('game_team.position', '=', $key)->first()->name }} Team">
								<i class="fa {{ $game->teams()->where('game_team.position', '=', $key)->first()->icon }}" style="color: #{{ $game->teams()->where('game_team.position', '=', $key)->first()->colour }};" aria-hidden="true"></i>
							</a> 
                          <select name="team_list[{{ $key }}]" class="form-control">
                          @foreach($teams as $team)
                            @if($game->teams()->where('game_team.position', '=', $key)->first()->name == $team->name)
                              <option value="{{ $team->id }}" selected="selected">{{ $team->name }}</option>
                            @else
                              <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endif
                          @endforeach
                        </select>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- End -->
          </div>
        </div>
        @foreach($roles as $key => $role)
          <div class="modal fade" tabindex="-1" role="dialog" id="{{ camel_case($role->name) }}">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-xs-12 col-sm-6">
                      <img src="{{ $role->image }}" class="img-responsive" />
                    </div>
                    <div class="col-xs-12 col-sm-6">
                      <p>{!! $role->description !!}</p>
                    </div>
                  </div>
				  <div class="row">									
					<div class="col-xs-12">
					  <small>© All names and descriptions property of Bezier Games.</small>
					</div>
				  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
        @endforeach
      @else
        <div class="pull-right btn-back-top"><a href="/" class="btn btn-primary"><i class="fa fa-arrow-circle-o-left"></i> Back</a></div>
        <div style="clear:both;"></div>
        <div class="row">
        <div class="col-sm-12">
          <p class="storyFont">The game is over</p>
          <div class="table-responsive" style="width: 20%;float: left;">
            <table class="table table-hover">
              <thead>
                <tr height="55px" style="background-color: #f5f5f5;">
                  <th style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #dddddd;">Role</th>
                </tr>
              </thead>
              <tbody>
                <?php $order = 0; ?>
                @foreach($roles as $key => $role)
                    @if($role->night == -99 || $role->night == $game->time->round)
                      <tr style="background-color: #a17dd8;color:#fff;" height="55px">
                    @else
                      <tr style="background-color: #fff;color:#fff;" height="55px">
                    @endif
                      <td>
                        <button type="button" class="btn btn-sm btn-warning btn-block" data-toggle="modal" data-target="#{{ camel_case($role->name) }}">
                          {{ $role->name }}
                        </button>
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- Player side -->
          <div class="table-responsive" style="width: 80%;float: left;">
            <table class="table table-striped table-hover">
              <thead>
                <col width="50%">
                <col width="50%">
                <tr height="55px">
                  <th>Player</th>
                  <th class="text-center">
                    <a tabindex="0" role="button" style="padding: 2px 5px;" class="btn btn-default" id="team"
                        data-container="body"
                        data-trigger="focus"
                        data-toggle="popover"
                        data-placement="top"
                        data-content="Team affiliation">
                      <i class="fa fa-users fa-1x" style="color: #000000;" aria-hidden="true"></i>
                    </a>
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($players as $key => $player)
                  @if($player->pivot->status == 'dead')
                    <tr class="danger" height="55px">
                  @else
                    <tr class="success" height="55px">
                  @endif
                    <td>{{ $player->name }}</td>
                    <td>
                      <div class="input-group">
                        <div class="input-group-addon"><i class="fa {{ $game->teams()->where('game_team.position', '=', $key)->first()->icon }}" style="color: #{{ $game->teams()->where('game_team.position', '=', $key)->first()->colour }};" aria-hidden="true"></i></div>
                        <input class="form-control" id="disabledInput" type="text" placeholder="{{ $game->teams()->where('game_team.position', '=', $key)->first()->name }}" disabled>
                      </div>                      
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- End -->
        </div>
      </div>
      @endif
      </div>
    </div>
    @foreach($roles as $key => $role)
      <div class="modal fade" tabindex="-1" role="dialog" id="{{ camel_case($role->name) }}">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <div class="row">
                <div class="col-xs-12 col-sm-6">
                  <img src="{{ $role->image }}" class="img-responsive" />
                </div>
                <div class="col-xs-12 col-sm-6">
                  <p>{!! $role->description !!}</p>
                </div>
              </div>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    @endforeach
    {!! Form::close() !!}
  </div>
</div>
@endsection

@section('scripts')
  <script src="/js/flipclock.js"></script>
  <script>
	$(document).ready(function(){
		$("#show").hide();
		$("#hide").click(function(){
			$(".names").hide();
			$("#hide").hide();
			$("#show").show();
		});
		$("#show").click(function(){
			$(".names").show();
			$("#show").hide();
			$("#hide").show();
		});
	});
  </script>
  <script type="text/javascript">
    $(".clock").FlipClock({
        clockFace: 'MinuteCounter'
    });
	</script>
  <script>
    $('.status').popover()
  </script>
  @foreach($teams as $team)
    <script>
      $('.{{ lcfirst($team->name) }}').popover()
    </script>
  @endforeach
  @foreach($statuses as $status)
    <script>
      $('.{{ preg_replace('/\s+/', '-', lcfirst($status->name)) }}').popover()
    </script>
  @endforeach
@endsection
