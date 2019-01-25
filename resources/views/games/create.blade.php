@extends('app')

@section('meta')
    <title>Use a recipe or pick your roles</title>
@endsection

@section('head')
    <style>
        .radio {

            display: block;
            position: relative;
            padding-left: 30px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 20px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none
        }

        /* Hide the browser's default radio button */
        .radio input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Create a custom radio button */
        .checkround {

            position: absolute;
            top: 6px;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #fff ;
            border-color:#f8204f;
            border-style:solid;
            border-width:2px;
            border-radius: 50%;
        }


        /* When the radio button is checked, add a blue background */
        .radio input:checked ~ .checkround {
            background-color: #fff;
        }

        /* Create the indicator (the dot/circle - hidden when not checked) */
        .checkround:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the indicator (dot/circle) when checked */
        .radio input:checked ~ .checkround:after {
            display: block;
        }

        /* Style the indicator (dot/circle) */
        .radio .checkround:after {
            left: 2px;
            top: 2px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background:#f8204f;
        }
    </style>
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
                    <label for="name">Recipe or Expansions?</label>
                    <label class="radio">Recipes
                        <input type="radio" name="choice" value="recipe" required>
                        <span class="checkround"></span>
                    </label>
                    <label class="radio">Expansions
                        <input type="radio" name="choice" value="expansions">
                        <span class="checkround"></span>
                    </label>
                </div>
              <div class="col-sm-6 col-xs-12 hidden">
                  <label for="name">Chose a Recipe</label>
                  <select name="recipe" class="form-control">
                    <option></option>
                    @foreach($recipes as $recipe)
                      <option value="{{ $recipe->id }}">{{ $recipe->name }}</option>
                    @endforeach
                  </select>
              </div>
              <div class="col-sm-6 col-xs-12 hidden">
                <label for="name">Chose expansions</label>
                <select name="expansions[]" multiple class="form-control js-expansions">
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
    $( document ).ready(function() {
        var choice = $('input:radio[name=choice]');
        var recipe = $('select[name="recipe"]').parent();
        var expansions = $('select[name="expansions[]"]').parent();
        var all=recipe.add(expansions);
        choice.change(function(){
            var value=this.value;
            all.addClass('hidden');
            if (value == 'recipe'){
                recipe.removeClass('hidden');
            }
            if (value == 'expansions'){
                expansions.removeClass('hidden');
            }
        });
    });
  </script>
@endsection
