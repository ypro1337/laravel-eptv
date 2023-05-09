<form action="{{ $formation->id ? route('formations.update', $formation->id) : route('formations.store') }}" method="POST">
	@csrf

	@if($formation->id)
	@method("PUT")
	@endif

	<div class="mb-3">
		<x-label for="designation" :value="__('Designation')" />
		<x-input type="text" name="designation" id="name" :placeholder="__('Designation')" :value="old('designation', $formation->designation)" autofocus />
		<x-invalid error="designation" />
	</div>

    <div class="mb-3">
		<x-label for="date_debut" :value="__('Date De Debut')" />
		<x-input name="date_debut" type="date" id="date_debut" :value="old('date_debut', $formation->date_debut)"></x-input>

		<x-invalid error="date_debut" />
	</div>

    <div class="mb-3">
		<x-label for="date_fin" :value="__('Date De Fin')" />
		<x-input name="date_fin" type="date" id="date_fin" :value="old('date_fin', $formation->date_fin)"></x-input>

		<x-invalid error="date_fin" />
	</div>

    <div class="mb-3">
		<label class="form-label"> Selectionner employée </label>
			<select class="form-control" name="user_id">

			<option value="">Selectionner un employée </option>
				@foreach ($users as $user)

					<option value="{{ $user->id}}" {{ ( $user->id == $formation->user_id) ? 'selected' : '' }}>
					{{ ucfirst($user->nom) }} {{ ucfirst($user->prenom) }}
					</option>

			  @endforeach
			</select>


			<div class="text text-danger">
						@error('user_id')

						un employée doit etre selectionner <br>

						@enderror

			 </div>


	</div>



	<div class="text-end">
		<x-button type="submit" class="btn btn-primary" :value="$formation->id ? __('Update') : __('Create')" />
	</div>


</form>
