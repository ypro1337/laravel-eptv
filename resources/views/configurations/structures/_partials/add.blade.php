<form action="{{ route('structures.store') }}" method="POST">

	@csrf



	<div class="mb-3">
		<x-label for="name" :value="__('Name')" />
		<x-input type="text" name="name" id="name" :placeholder="__('Name')"  :placeholder="__('Name')" :value="old('name')" autofocus />
		<x-invalid error="name" />
	</div>

	<div class="mb-3">
		<x-label for="description" :value="__('Description')" />
		<x-input name="description" type="textarea" id="description" :value="old('description')"></x-input>

		<x-invalid error="description" />
	</div>



	<div class="mb-3">
    <label class="form-label"> Select siège </label>
        <select class="form-control" name="siege_id">

		<option value="">Selectionner un siège </option>
			@foreach ($sieges as $siege)

				<option value="{{ $siege->id}}" {{ ( $siege->id == old('siege_id')) ? 'selected' : '' }}>
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
                                <option value="" >None</option>
                                {!! recursiveAddStructureDropdown($structures,'',0,old('parent_id')) !!}
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
	<x-button type="submit" class="btn btn-primary" :value="__('Create')" />
	</div>


</form>
