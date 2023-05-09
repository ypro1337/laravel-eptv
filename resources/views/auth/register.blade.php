<x-auth-layout title="Register">
	<h4 class="mb-2">
		{{ __('Inscription') }}
	</h4>


	<form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
		@csrf
		<div class="mb-3">
			<x-label for="nom" :value="__('Nom')" />
			<x-input type="text" name="nom" id="nom" :placeholder="__('Nom')" :value="old('nom')" autofocus />
			<x-invalid error="nom" />
		</div>
	
		<div class="mb-3">
			<x-label for="prenom" :value="__('Prénom')" />
			<x-input type="text" name="prenom" id="prenom" :placeholder="__('Prénom')" :value="old('prenom')" autofocus />
			<x-invalid error="prenom" />
		</div>
	
		<div class="mb-3">
			<x-label for="matricule" :value="__('Matricule')" />
			<x-input type="text" name="matricule" id="matricule" :placeholder="__('Matricule')" :value="old('matricule')" autofocus />
			<x-invalid error="matricule" />
		</div>
		<div class="mb-3">
			<x-label for="email" :value="__('Email')" />
			<x-input type="email" name="email" id="email" :placeholder="__('Email')" :value="old('email')" />
			<x-invalid error="email" />
		</div>

		<div class="mb-3">
			<x-label for="affectation_date" :value="__('Date d affectation')" />
			<x-input type="date" name="affectation_date" id="affectation_date" :placeholder="__('Date d affectation')" :value="old('affectation_date')" autofocus />
			<x-invalid error="affectation_date" />
		</div>


		<div class="mb-3">
			<label for="structure_id">Affectation Structure</label>
								<select name="structure_id" id="js-example-basic-single" class="form-control js-example-basic-single">
									<option value="" >None</option>
									{!! recursiveAddStructureDropdown($structures,'',0,old('structure_id')) !!}
								</select>
			@error('structure_id')
			<span class="invalid-feedback">{{ $message }}</span>
			@enderror
		</div>


	
		<div class="mb-3 form-password-toggle">
			<div class="d-flex justify-content-between">
				<x-label for="password" :value="__('Password')" />
			</div>
			<div class="input-group input-group-merge">
				<x-input type="password" name="password" id="password" :placeholder="__('Password')" aria-describedby="password" />
				<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
				<x-invalid error="password" />
			</div>
		</div>
		<div class="mb-3 form-password-toggle">
			<div class="d-flex justify-content-between">
				<x-label for="password_confirmation" :value="__('Password confirmation')" />
			</div>
			<div class="input-group input-group-merge">
				<x-input type="password" name="password_confirmation" id="password_confirmation" :placeholder="__('Password confirmation')" aria-describedby="password" />
				<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
				<x-invalid error="password_confirmation" />
			</div>
		</div>
		<div class="mb-3">
			<div class="form-check">
				<input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" id="terms-conditions" name="terms" {{ old('terms') ? 'checked' : '' }}>
				<label class="form-check-label" for="terms-conditions">
					{{ __('I agree to') }}
					<a href="javascript:void(0);">{{ __('privacy policy & terms') }}</a>
				</label>
				<x-invalid error="terms" />
			</div>
		</div>
		<div class="mb-3">
			<x-button type="submit" class="btn btn-primary d-grid w-100" :value="__('Sign up')" onClickDisabled />
		</div>

		@if(Route::has('login'))
		<p class="text-center">
			<span>{{ __('Already have an account?') }}</span>
			<a href="{{ route('login') }}">
				<span>{{ __('Sign in instead') }}</span>
			</a>
		</p>
		@endif
	</form>
</x-auth-layout>