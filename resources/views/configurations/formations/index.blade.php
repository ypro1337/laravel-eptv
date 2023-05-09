<x-app-layout title="Formations management">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Formations management') }}

			</h5>

			<div class="mb-4">
				<a href="{{ route('formations.create') }}" class="btn btn-primary">
					{{ __('Create new') }}
				</a>
			</div>

			@include('configurations.formations._partials.table')

		</div>
	</div>
</x-app-layout>
