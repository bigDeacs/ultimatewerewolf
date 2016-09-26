<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
<input type="hidden" name="total" value="null">
<input type="hidden" name="balance" value="null">
<input type="hidden" name="status" value="null">
