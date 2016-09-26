<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group row">
      <div class="col-sm-9 col-xs-12">
            <label for="name">Name</label>
	      <input type="text" name="name" id="name" class="form-control" value="{{ isset($expansion) ? $expansion->name : old('name') }}" placeholder="" required>
      </div>
      <div class="col-sm-3 col-xs-12">
            <label for="image">Featured Image</label>
            @if(isset($expansion))
                  <img src="{{ url('/') }}{!! $expansion->image !!}" class="img-responsive" id="imageUpload" style="margin-bottom:10px;" />
            @endif
            Browse:
            <input type="file" name="image" accept="image/*" onchange="loadImage(event)">
            <small>600px X 600px</small>
      </div>
</div>
