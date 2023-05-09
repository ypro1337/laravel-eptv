<x-app-layout title="Structure create">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Strucure create') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('structures.index') }}" class="btn btn-dark">
					{{ __('Back to list') }}
				</a>
			</div>

			@include('configurations.structures._partials.add')

		</div>
	</div>
	
</x-app-layout>
