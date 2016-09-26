<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="description" value="null">

<div class="form-group row">
      <div class="col-sm-6 col-xs-12">
        <label for="name">Name</label>
	      <input type="text" name="name" id="name" class="form-control" value="{{ isset($status) ? $status->name : old('name') }}" placeholder="" required>
      </div>
      <div class="col-sm-6 col-xs-12">
        <label for="name">Role</label>
        {!! Form::select('role_id', $roles, null, ['id' => 'role_id', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
      </div>
</div>

<div class="form-group row">
      <div class="col-sm-6 col-xs-12">
        <label for="name">Icon</label>
	      <input type="text" name="icon" id="icon" class="form-control" value="{{ isset($status) ? $status->icon : old('icon') }}" placeholder="" required>
      </div>
      <div class="col-sm-6 col-xs-12">
        <label for="name">Colour</label>
        <input type="text" name="colour" id="colour" class="pick-a-color form-control" value="{{ isset($status) ? $status->colour : old('colour') }}" placeholder="" required>
      </div>
</div>
