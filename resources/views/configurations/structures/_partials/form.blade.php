<form action="{{ $structure->slug ? route('structures.update', $structure->slug) : route('structures.store') }}" method="POST">

	@csrf

	@if($structure->slug)
	@method("PUT")
	@endif

	<div class="mb-3">
		<x-label for="name" :value="__('Name')" />
		<x-input type="text" name="name" id="name" :placeholder="__('Name')"  :placeholder="__('Name')" :value="old('name', $structure->name)" autofocus />
		<x-invalid error="name" />
	</div>
	<div class="mb-3">
		<x-label for="description" :value="__('Description')" />
		<x-input name="description" type="textarea" id="description" :value="old('description', $structure->description)" ></x-input>

		<x-invalid error="description" />
	</div>


	<div class="mb-3">
    <label class="form-label"> Select siège </label>
        <select class="form-control" name="siege_id">

		<option value="">Selectionner un siège </option>
			@foreach ($sieges as $siege)

				<option value="{{ $siege->id}}" {{ ( $siege->id == $structure->siege_id) ? 'selected' : '' }}>
				{{ $siege->designation }}
				</option>

          @endforeach	
        </select>


		<div class="text text-danger">
					@error('siege_id')
								
					Le siege doit etre selectionner <br>
					
					@enderror

		 </div>


   
</div>

	<div class="mb-3">
		<label for="parent_id">Parent Structure</label>
		<select name="parent_id" id="js-example-basic-single" class="form-control js-example-basic-single">
                                
							

                                  <option value="" {{ ( $structure->parent == null) ? 'selected' : '' }}>--no parent --</option>

														  

                                {!! recursiveStructureDropdown($structures,'',$structure->id) !!}
                            </select>
							@error('parent_id')


		<span class="invalid-feedback">{{ $message }}</span>
		@enderror
	</div>

	<div class="form-check form-switch mb-2">
		<input class="form-check-input" name='is_enabled' id='is_enabled'  type="checkbox"  {value="is_enabled" {{ old('is_enabled',1) ? 'checked' : '' }} />
		<label class="form-check-label" for="is_enabled">Is active</label>
    </div>


	<div class="text-end">
	<x-button type="submit" class="btn btn-primary" :value="$structure->slug ? __('Update') : __('Create')" />
	</div>


</form>

