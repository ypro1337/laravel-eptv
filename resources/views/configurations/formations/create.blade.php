<x-app-layout title="Formations create">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Formations create') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('formations.index') }}" class="btn btn-dark">
					{{ __('Back to list') }}
				</a>
			</div>
			@include('configurations.formations._partials.form')

		</div>
	</div>
</x-app-layout>
