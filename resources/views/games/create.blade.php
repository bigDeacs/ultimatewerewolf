@extends('app')

@section('meta')
    <title>Use a recipe or pick your roles</title>
@endsection

@section('head')
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default panel-shadow">
			  <div class="panel-heading">
			    <h1 class="panel-title"><strong>Use a recipe or pick your roles</strong></h1>
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
				{!! Form::open(['url' => '/games/build']) !!}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group row">
            <div class="col-xs-12">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Who is the Moderator?" required>
            </div>
          </div>
          <div class="row">
				<div class="col-xs-12">
					Do you want to use a premade list of roles? Or choose your own expansions and roles? 
				</div>
				<div class="col-xs-12">
					<small>Only choose one of the fields below</small>
				</div>
			</div>
			<div class="form-group row">
              <div class="col-sm-6 col-xs-12">
                  <label for="name">Chose a Recipe</label>
                  <select name="recipe" class="form-control" required>
                    <option></option>
                    @foreach($recipes as $recipe)
                      <option value="{{ $recipe->id }}">{{ $recipe->name }}</option>
                    @endforeach
                  </select>
              </div>
              <div class="col-sm-6 col-xs-12">
                <label for="name">Chose expansions</label>
                <select name="expansions[]" multiple class="form-control js-expansions" required>
                  <option></option>
                  @foreach($expansions as $expansion)
                    <option value="{{ $expansion->id }}">{{ $expansion->name }}</option>
                  @endforeach
                </select>
              </div>
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

@section('scripts')
  <script type="text/javascript">
    $(".js-expansions").select2();
    jQuery(function ($) {
        var $selects = $('select[name=recipe],select[name=expansions]');
        $selects.on('select', function () {
            // Set the required property of the other input to false if this input is not empty.
            $selects.not(this).prop('required', !$(this).val().length);
        });
    });
  </script>
@endsection
