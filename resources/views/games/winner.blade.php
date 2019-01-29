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
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            {!! Form::open(['url' => '/games/winners']) !!}
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
                                <a href="/games/{{ $game->id }}/end" class="btn btn-danger" onclick="return confirm('Is the game over?');return false;">Finish <i class="fa fa-hourglass-end"></i></a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="panel-body">
                        <div class="pull-right btn-back-top"><a href="/" class="btn btn-primary"><i class="fa fa-arrow-circle-o-left"></i> Back</a></div>
                        <div style="clear:both;"></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="storyFont">Is the game over? Who won?</p>
                                {!! Form::open(['url' => '/games/end']) !!}
                                    <input type="hidden" name="game" value="{{ $game->id }}">
                                    	<div class="form-group row">
                                            <div class="col-sm-8 col-xs-12">
                                            <select name="team_list[]" multiple class="form-control js-expansions">
                                                <option></option>
                                                @foreach($teams as $team)
                                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                            <div class="col-sm-4 col-xs-12">
                                                <button type="submit" class="btn btn-success btn-block">Submit</button>
                                            </div>
                                        </div>
                                {!! Form::close() !!}
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
    <script type="text/javascript">
        $(".js-expansions").select2();
    </script>
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
