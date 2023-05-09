<x-app-layout title="Users create">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Sieges create') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('sieges.index') }}" class="btn btn-dark">
					{{ __('Back to list') }}
				</a>
			</div>

			@include('configurations.sieges._partials.form')

		</div>
	</div>
</x-app-layout>