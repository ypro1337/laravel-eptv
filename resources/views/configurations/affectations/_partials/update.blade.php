<form action="{{ $affectation->id ? route('affectations.update', $affectation->id) : route('affectations.store') }}" method="POST">
	@csrf

	@if($affectation->id)
	@method("PUT")
	@endif

	<div class="mb-3">
		<x-label for="affectation_date" :value="__('Date d affectation')" />
		<x-input type="date" name="affectation_date" id="affectation_date" :placeholder="__('Date d affectation')" :value="old('affectation_date', $affectation->affectation_date)" autofocus />
		<x-invalid error="affectation_date" />
	</div>

	<div class="mb-3">
		<label class="form-label"> Selectionner employée </label>
			<select class="form-control" name="user_id">
	
			<option value="">Selectionner un employée </option>
				@foreach ($users as $user)
	
					<option value="{{ $user->id}}" {{ ( $user->id == $affectation->user_id) ? 'selected' : '' }}>
					{{ $user->nom }}-{{ $user->prenom }}
					</option>
	
			  @endforeach	
			</select>
	
	
			<div class="text text-danger">
						@error('user_id')
									
						un employée doit etre selectionner <br>
						
						@enderror
	
			 </div>

	   
	</div>




	<div class="mb-3">
		<label for="structure_id">Parent Structure</label>
                            <select name="structure_id" id="js-example-basic-single" class="form-control js-example-basic-single">
                                <option value="" >None</option>
                                {!! recursiveStructureDropdown($structures,'',$affectation->structure_id) !!}
                            </select>
		@error('structure_id')
		<span class="invalid-feedback">{{ $message }}</span>
		@enderror
	</div>

	

	<div class="text-end">
		<x-button type="submit" class="btn btn-primary" :value="$affectation->id ? __('Update') : __('Create')" />
	</div>


</form>