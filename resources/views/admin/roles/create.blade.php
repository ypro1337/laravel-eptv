<x-app-layout title="Users create">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Roles create') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('roles.index') }}" class="btn btn-dark">
					{{ __('Back to list') }}
				</a>
			</div>

			@include('admin.roles._partials.form')

		</div>
	</div>
</x-app-layout>

