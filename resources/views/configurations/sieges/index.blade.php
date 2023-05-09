<x-app-layout title="Sieges management">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Sieges management') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('sieges.create') }}" class="btn btn-primary">
					{{ __('Create new') }}
				</a>
			</div>

			@include('configurations.sieges._partials.table')

		</div>
	</div>
</x-app-layout>