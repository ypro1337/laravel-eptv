<form action="{{ $permission->id ? route('permissions.update', $permission->id) : route('permissions.store') }}" method="POST">
	@csrf

	@if($permission->id)
	@method("PUT")
	@endif

	<div class="mb-3">
		<x-label for="group_name" :value="__('Group_name')" />
		<x-input name="group_name" type="text" id="group_name" :value="old('group_name', $permission->group_name)"></x-input>

		<x-invalid error="group_name" />
	</div>

	<div class="mb-3">
		<x-label for="name" :value="__('Name permission')" />
		<x-input type="text" name="name" id="name" :placeholder="__('Name permission')" :value="old('name', $permission->name)" autofocus />
		<x-invalid error="name" />
	</div>


<input type="hidden" name="guard_name" value="web">
	

	<div class="text-end">
		<x-button type="submit" class="btn btn-primary" :value="$permission->id ? __('Update') : __('Create')" />
	</div>


</form>