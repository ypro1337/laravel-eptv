<form action="{{ $siege->slug ? route('sieges.update', $siege->slug) : route('sieges.store') }}" method="POST">
	@csrf

	@if($siege->slug)
	@method("PUT")
	@endif

	<div class="mb-3">
		<x-label for="designation" :value="__('Designation')" />
		<x-input type="text" name="designation" id="name" :placeholder="__('Designation')" :value="old('designation', $siege->designation)" autofocus />
		<x-invalid error="designation" />
	</div>

	<div class="mb-3">
		<x-label for="adresse" :value="__('Adresse')" />
		<x-input name="adresse" type="textarea" id="adresse" :value="old('adresse', $siege->adresse)"></x-input>

		<x-invalid error="adresse" />
	</div>

	

	<div class="text-end">
		<x-button type="submit" class="btn btn-primary" :value="$siege->slug ? __('Update') : __('Create')" />
	</div>


</form>