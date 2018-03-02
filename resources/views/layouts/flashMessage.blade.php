@if(session()->has("flash_message"))
	<div class="alert alert-dismissible alert-{{ session()->get("flash_level") }}">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <p>{{ session()->get("flash_message") }}</p>
	</div>
@endif