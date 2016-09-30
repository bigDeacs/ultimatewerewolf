@extends('app')

@section('meta')
    <title>{{ $game->id }}</title>
@endsection

@section('head')
@endsection

@section('content')
<div class="row">
  <div class="col-sm-10 col-sm-offset-1">
    <div class="panel panel-default panel-shadow">
      <div class="panel-heading">
        <h1 class="panel-title"><strong>{{ $game->id }}</strong></h1>
      </div>
      <div class="panel-body">
        <div class="pull-right"><a href="#" class="btn btn-success">Save <i class="fa fa-floppy-o"></i></a></div>
        <div style="clear:both;"></div>
        <div class="row">
        <div class="col-sm-12">
          <p><strong>Games:</strong></p>
          <div class="table-responsive" style="width: 25%;float: left;">
            <table class="table dataTable table-striped table-hover">
              <thead>
                <col width="10%">
                <col width="45%">
                <tr>
                  <th>ID</th>
                  <th>Role</th>
                </tr>
              </thead>
              <tbody>
                <?php $order = 0; ?>
                @foreach($roles as $key => $role)
                  @for($x = 1; $x <= $role->pivot->total; $x++)
                    <tr>
                      <?php $order++; ?>
                      <td scope="row">{{ $order }}</td>
                      <td>{{ $role->name }}</td>
                    </tr>
                  @endfor
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="table-responsive" style="width: 75%;float: left;">
            <table class="table dataTable table-striped table-hover">
              <thead>
                <col width="45%">
                <tr>
                  <th>Player</th>
                  @foreach($statuses as $status)
                    @if($status->icon)
                      <th><i class="fa {{ $status->icon }} fa-1x" style="color: #{{ $status->colour }};" aria-hidden="true"></i></th>
                    @endif
                  @endforeach
                </tr>
              </thead>
              <tbody>
                @foreach($players as $key => $player)
                  <tr>
                    <td>{{ $player->name }}</td>
                    @foreach($statuses as $status)
                      @if($status->icon)
                        <td><input type="checkbox" style="margin:0;"></td>
                      @endif
                    @endforeach
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
