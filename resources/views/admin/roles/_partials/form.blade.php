<form action="{{ $role->id ? route('roles.update', $role->id) : route('roles.store') }}" method="POST">
	@csrf

	@if($role->id)
	@method("PUT")
	@endif

	<div class="mb-3">
		<x-label for="name" :value="__('Role designation')" />
		<x-input type="text" name="name" id="name" :placeholder="__('Role designation')" :value="old('name', $role->name)" autofocus />
		<x-invalid error="name" />
	</div>


	@php $i = 1; @endphp
                            @foreach ($permission_groups as $group)
                                <div class="row">
                                    @php
                                        $permissions = App\Models\User::getpermissionsByGroupName($group->name);
                                        $j = 1;
                                    @endphp                                    
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $group->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)"
                                             {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="checkPermission">{{ $group->name }}</label>
                                        </div>
                                    </div>

                                    <div class="col-9 role-{{ $i }}-management-checkbox">
                                        @php
                                            $permissions = App\Models\User::getpermissionsByGroupName($group->name);
                                            $j = 1;
                                        @endphp
                                        @foreach ($permissions as $permission)
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="permissions[]" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}">
                                                <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                            @php  $j++; @endphp
                                        @endforeach
                                        <br>
                                    </div>

                                </div>
                                @php  $i++; @endphp
                            @endforeach
	

	<div class="text-end">
		<x-button type="submit" class="btn btn-primary" :value="$role->id ? __('Update') : __('Create')" />
	</div>


</form>

@push('js')

     @include('admin.roles._partials.scripts')


@endpush