<x-app-layout title="Affectations management">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Affectations management') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('affectations.create') }}" class="btn btn-primary">
					{{ __('Create new') }}
				</a>
			</div>
			@include('configurations.affectations._partials.table')

		</div>
	</div>
</x-app-layout>
