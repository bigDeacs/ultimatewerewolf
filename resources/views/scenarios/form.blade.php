<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group row">
      <div class="col-sm-9 col-xs-12">
          <label for="name">Description</label>
	        {!! Form::textarea('description', null, ['class' => 'form-control textarea', 'id' => 'description', 'rows' => '10']) !!}
      </div>
      <div class="col-sm-3 col-xs-12">
          <label for="name">Deaths</label>
          <input type="text" name="deaths" id="deaths" class="form-control" value="{{ isset($scenario) ? $scenario->deaths : old('deaths') }}" placeholder="" required>
      </div>
</div>
