<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group row">
      <div class="col-xs-12">
            <label for="name">Name</label>
	      <input type="text" name="name" id="name" class="form-control" value="{{ isset($team) ? $team->name : old('name') }}" placeholder="" required>
      </div>
</div>

<div class="form-group row">
      <div class="col-xs-12">
        <label for="name">Notes</label>
          {!! Form::textarea('notes', null, ['class' => 'form-control textarea', 'id' => 'notes', 'rows' => '10']) !!}
      </div>
</div>

<div class="form-group row">
      <div class="col-sm-6 col-xs-12">
        <label for="name">Icon</label>
	      <input type="text" name="icon" id="icon" class="form-control" value="{{ isset($team) ? $team->icon : old('icon') }}" placeholder="" required>
      </div>
      <div class="col-sm-6 col-xs-12">
        <label for="name">Colour</label>
        <input type="text" name="colour" id="colour" class="pick-a-color form-control" value="{{ isset($team) ? $team->colour : old('colour') }}" placeholder="" required>
      </div>
</div>
