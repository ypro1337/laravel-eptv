<x-app-layout title="Users create">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Permissions create') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('permissions.index') }}" class="btn btn-dark">
					{{ __('Back to list') }}
				</a>
			</div>

			@include('admin.permissions._partials.form')

		</div>
	</div>
</x-app-layout>