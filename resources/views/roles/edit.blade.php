@extends('app')

@section('meta')
    <title>Edit {{ $role->name }}</title>
@endsection

@section('head')
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<div class="panel panel-default panel-shadow">
			  <div class="panel-heading">
			    <h1 class="panel-title"><strong>Edit {{ $role->name }}</strong></h1>
			  </div>
			  <div class="panel-body">
			  	<div class="pull-right btn-back-top"><a href="/roles" class="btn btn-primary"><i class="fa fa-arrow-circle-o-left"></i> Back</a></div>
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
				{!! Form::model($role, ['files'=> true, 'method' => 'PATCH', 'action' => ['RoleController@update', $role->id]]) !!}
					<input type="hidden" name="id" value="{{ $role->id }}">
					@include('roles.form')
					<div class="form-group btn-submit-top">
						<button type="submit" class="btn btn-success btn-block">Update</button>
					</div>
				{!! Form::close() !!}
			  </div>
			</div>
		</div>
	</div>
@endsection
