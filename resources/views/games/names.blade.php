@extends('app')

@section('meta')
    <title>Games</title>
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
				@if($recipe)
					{!! $recipe->description !!}
					<p><small>© All names and descriptions property of Bezier Games.</small></p>
				@endif                
              </p>
            </div>
          </div>
			  	<div class="row">
					<div class="col-sm-12">
						<div class="table-responsive">
						  <table class="table dataTable table-striped table-hover">
						    <thead>
				  <col width="10%">
                  <col width="20%">
                  @foreach($statuses as $status)
                    @if($status->icon)
                      <col width="{{ 50 / (count($statuses)) }}%">
                    @endif
                  @endforeach
                  <col width="20%">
						    	<tr style="background-color: #f5f5f5;">
						    		<th>Role</th>
                    <th>Player</th>
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
                  {!! Form::open(['url' => '/games/names']) !!}
                    <input type="hidden" name="game" value="{{ $game->id }}">
                    @unless($roles == null)
                      @foreach($roles as $key => $role)
    							      <tr>
                          <td>
							  <button type="button" class="btn btn-sm btn-warning btn-block" data-toggle="modal" data-target="#{{ camel_case($role->name) }}">
								{{ $role->name }}
							  </button>
						  </td>
                          <td>
                            <select name="name_list[{{ $key }}]" id="name_list_{{ $key }}" class="name_list" class="form-control" style="width:100%;" required>
							  <option></option>
                              @foreach($players as $player)
                                <option value="{{ $player->id }}">{{ $player->name }}</option>
                              @endforeach
                            </select>
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
												<input type="checkbox" name="status_list[{{ $status->id }}][{{ $key }}]" style="display: none;" value="{{ $key }}">
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
							<a tabindex="0" role="button" style="padding: 2px 5px;" class="input-group-addon btn btn-default team" 
								  data-container="body"
								  data-trigger="focus"
								  data-toggle="popover"
								  data-placement="top"
								  data-content="Team affiliation">
								<i class="fa fa-users fa-1x" style="color: #000000;" aria-hidden="true"></i>
							  </a>
                          <select name="team_list[{{ $key }}]" class="form-control">
                          @foreach($teams as $team)
                            @if($team->name == 'Villagers')
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
                    @endunless
                    <tr>
                      <td colspan="{{ 4 + count($statuses)}}"><button type="submit" class="btn btn-success btn-block">Next</button></td>
                    </tr>
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
              placeholder: 'Choose a player',
              tags: true
          });
	  </script>
	  <script>
		  $('.name_list').change(function(){
		      console.log($(this));
		  	var val = $(this).val();
		  	var thisId = $(this).data.id;
              console.log(thisId);
		  	var sel = $(this);

		  	if(val != "")
		  	{
		  		if(sel.data("selected"))
		  		{
		  			var oldval = sel.data("selected");
		  			sel
		  			.siblings('select')
		  			.append($('<option/>').attr("value", oldval).text(oldval));
		  		}

		  		sel
				  .data("selected", val)
				  .siblings('select')
				  .children('option[value=' + val + ']')
				  .remove();
		  	}
		  	else if(val == "")
		  	{
		  		if(sel.data("selected"))
		  		{
		  			var oldval = sel.data("selected");
					  sel
					  .removeData("selected")
					  .siblings('select')
					  .append($('<option/>').attr("value", oldval).text(oldval));
		  		}
		  	}
		  });
	  </script>
	  <script>
		$('.team').popover()
	  </script>
	  @foreach($statuses as $status)
		<script>
		  $('.{{ preg_replace('/\s+/', '-', lcfirst($status->name)) }}').popover()
		</script>
	  @endforeach
@endsection
