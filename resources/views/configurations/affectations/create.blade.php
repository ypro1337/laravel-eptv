<x-app-layout title="affectations create">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('affectations create') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('affectations.index') }}" class="btn btn-dark">
					{{ __('Back to list') }}
				</a>
			</div>

			@include('configurations.affectations._partials.add')

		</div>
	</div>
</x-app-layout>
