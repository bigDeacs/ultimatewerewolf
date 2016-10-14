<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group row">
      <div class="col-xs-12">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" class="form-control" value="{{ isset($recipe) ? $recipe->name : old('name') }}" placeholder="" required>
          <br />
          <label for="name">Description</label>
	        {!! Form::textarea('description', null, ['class' => 'form-control textarea', 'id' => 'description', 'rows' => '10']) !!}
      </div>
      <div class="col-xs-12">
        <div class="row">
          @foreach($roles as $role)
            <div class="col-sm-3 col-xs-12">
              {{ $role->name }}
              <select name="role_list[{{ $role->id }}]" class="form-control">
                @for($x = 0; $x <= $role->max; $x++)
                  @if(isset($recipe))
                    @if(!$recipe->roles()->wherePivot('total','=', $x)->wherePivot('role_id','=', $role->id)->get()->isEmpty())
                      <option value="{{ $x }}" selected="selected">{{ $x }}</option>
                    @else
                      <option value="{{ $x }}">{{ $x }}</option>
                    @endif
                  @else
                    <option value="{{ $x }}">{{ $x }}</option>
                  @endif
                @endfor
              </select>
              <br />
            </div>  
          @endforeach
        </div>
      </div>
</div>
