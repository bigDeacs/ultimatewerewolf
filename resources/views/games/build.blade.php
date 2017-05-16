@extends('app')

@section('meta')
    <title>Choose Roles</title>
@endsection

@section('head')
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default panel-shadow">
			  <div class="panel-heading">
			    <h1 class="panel-title"><strong>Choose which roles are in the game</strong></h1>
			  </div>
			  <div class="panel-body">
			  	<div class="pull-right btn-back-top"><a href="/" class="btn btn-primary"><i class="fa fa-arrow-circle-o-left"></i> Back</a></div>
			  	<div style="clear:both;"></div>
				@if(count($errors) > 0)
					<div class="alert alert-danger">
						<ul>
							@foreach($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

				{!! Form::open(['url' => '/games/start']) !!}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="name" value="{{ $name }}">
          <div class="form-group row">
              @foreach($roles as $role)
                  <div class="col-sm-3 col-xs-12">
                    <img src="{{ $role->image }}" class="img-responsive" alt="{{ $role->name }}" />
                    <select name="role_list[{{ $role->id }}]" class="form-control">
                      @for($x = 0; $x <= $role->max; $x++)
                          <option value="{{ $x }}">{{ $x }}</option>
                      @endfor
                    </select>
                    <br />
                  </div>
              @endforeach
          </div>
          <div class="form-group btn-submit-top">
            <button type="submit" class="btn btn-success btn-block">Next</button>
          </div>
				{!! Form::close() !!}

			  </div>
			</div>
		</div>
	</div>
@endsection
