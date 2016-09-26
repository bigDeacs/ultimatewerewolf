<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
<input type="hidden" name="team_id" value="null">
<input type="hidden" name="role_id" value="null">
<input type="hidden" name="notes" value="null">
<input type="hidden" name="status" value="null">

<div class="form-group row">
      <div class="col-xs-12">
            <label for="name">Name</label>
	      <input type="text" name="name" id="name" class="form-control" value="{{ isset($player) ? $player->name : old('name') }}" placeholder="" required>
      </div>
</div>
