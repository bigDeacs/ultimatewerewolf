<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group row">
      <div class="col-sm-9 col-xs-12">
          <label for="name">Description</label>
	        {!! Form::textarea('description', null, ['class' => 'form-control textarea', 'id' => 'description', 'rows' => '10']) !!}
      </div>
      <div class="col-sm-3 col-xs-12">
          <label for="players">Players</label>
          <input type="text" name="players" id="players" class="form-control" value="{{ isset($recipe) ? $recipe->players : old('players') }}" placeholder="" required>
      </div>
</div>

<div class="form-group row">
      <div class="col-xs-12">
            <label for="role_list">Roles</label>
            {!! Form::select('role_list[]', $roles, null, ['id' => 'role_list', 'class' => 'form-control', 'multiple', 'style' => 'width: 100%']) !!}
      </div>
</div>
