<form action="{{ $user->id ? route('users.update', $user->id) : route('users.store') }}" method="POST">
	@csrf

	@if($user->id)
	@method("PUT")
	@endif

	<div class="mb-3">
		<x-label for="nom" :value="__('Nom')" />
		<x-input type="text" name="nom" id="nom" :placeholder="__('Nom')" :value="old('nom', $user->nom)" autofocus />
		<x-invalid error="nom" />
	</div>

	<div class="mb-3">
		<x-label for="prenom" :value="__('Prénom')" />
		<x-input type="text" name="prenom" id="prenom" :placeholder="__('Prénom')" :value="old('prenom', $user->prenom)" autofocus />
		<x-invalid error="prenom" />
	</div>

	<div class="mb-3">
		<x-label for="matricule" :value="__('Matricule')" />
		<x-input type="text" name="matricule" id="matricule" :placeholder="__('Matricule')" :value="old('matricule', $user->matricule)" autofocus />
		<x-invalid error="matricule" />
	</div>

	<div class="mb-3">
		<x-label for="email" :value="__('Email')" />
		<x-input type="email" name="email" id="email" :placeholder="__('Email')" :value="old('email', $user->email)" />
		<x-invalid error="email" />
	</div>

	@if($user->id)
	<div class="mb-3">
		<x-label for="password" :value="__('Password')" />
		<x-input type="password" name="password" id="password" :placeholder="__('Password')" />
		<x-invalid error="password">
			<small>{{ __('Empty if not change.') }}</small>
		</x-invalid>
	</div>

	<div class="mb-3">
		<x-label for="password_confirmation" :value="__('Password confirmation')" />
		<x-input type="password" name="password_confirmation" id="password_confirmation" :placeholder="__('Password confirmation')" />
		<x-invalid error="password_confirmation">
			<small>{{ __('Empty if not change.') }}</small>
		</x-invalid>
	</div>
	@else
	<div class="mb-3">
		<x-label for="password" :value="__('Password')" />
		<x-input type="password" name="password" id="password" :placeholder="__('Password')" />
		<x-invalid error="password" />
	</div>

	<div class="mb-3">
		<x-label for="password_confirmation" :value="__('Password confirmation')" />
		<x-input type="password" name="password_confirmation" id="password_confirmation" :placeholder="__('Password confirmation')" />
		<x-invalid error="password_confirmation" />
	</div>
	@endif


	<div class="mb-3">
                                <label for="password">Assign Roles</label>
                                <select name="roles[]" class="form-control js-example-basic-multiple" multiple>
								@foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
      </div>

	<div class="text-end">
		<x-button type="submit" class="btn btn-primary" :value="$user->id ? __('Update') : __('Create')" />
	</div>


</form>



