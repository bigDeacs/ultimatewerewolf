<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group row">
      <div class="col-sm-9 col-xs-12">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" class="form-control" value="{{ isset($role) ? $role->name : old('name') }}" placeholder="" required>
          <br />
          <label for="name">Description</label>
          {!! Form::textarea('description', null, ['class' => 'form-control textarea', 'id' => 'description', 'rows' => '10']) !!}
      </div>
      <div class="col-sm-3 col-xs-12">
            <label for="image">Featured Image</label>
            @if(isset($expansion))
                  <img src="{{ url('/') }}{!! $role->image !!}" class="img-responsive" id="imageUpload" style="margin-bottom:10px;" />
            @endif
            Browse:
            <input type="file" name="image" accept="image/*" onchange="loadImage(event)">
            <small>600px X 600px</small>
            <br />
            <label for="name">Expansion</label>
            {!! Form::select('expansion_id', $expansions, null, ['id' => 'expansion_id', 'class' => 'form-control', 'multiple', 'style' => 'width: 100%']) !!}
      </div>
</div>

<div class="form-group row">
      <div class="col-sm-3 col-xs-12">
            <label for="name">Impact</label>
	          <input type="text" name="impact" id="impact" class="form-control" value="{{ isset($role) ? $role->impact : old('impact') }}" placeholder="" required>
      </div>
      <div class="col-sm-3 col-xs-12">
            <label for="name">Night</label>
	          <input type="text" name="night" id="night" class="form-control" value="{{ isset($role) ? $role->night : old('night') }}" placeholder="" required>
      </div>
      <div class="col-sm-3 col-xs-12">
            <label for="name">Max</label>
	          <input type="text" name="max" id="max" class="form-control" value="{{ isset($role) ? $role->max : old('max') }}" placeholder="" required>
      </div>
      <div class="col-sm-3 col-xs-12">
            <label for="name">Position</label>
	          <input type="text" name="position" id="position" class="form-control" value="{{ isset($role) ? $role->position : old('position') }}" placeholder="">
      </div>
</div>
