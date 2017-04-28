<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="notes" value="null">

<div class="form-group row">
      <div class="col-xs-12">
            <label for="name">Name</label>
	      <input type="text" name="name" id="name" class="form-control" value="{{ isset($user) ? $user->name : old('name') }}" placeholder="" required>
      </div>
</div>
