
<input type="hidden" name="staff_id" value="{{ $staff_id }}">
@foreach($permission as $value)
	@php
	$checked = '';
	@endphp
	@foreach($user_permission as $permission_id)
		@if($permission_id->permission_id ==  $value->id)
		@php
		$checked = 'checked';
		@endphp
		@endif
	@endforeach	

<div class="col-md-6">
	<div class="form-group">
	    <label><input type="checkbox" {{ $checked }} name="permission[]" value="{{ $value->id }}"> {{ $value->name }}</label>
	</div>
</div>
@endforeach

<div style="clear: both;"></div>
