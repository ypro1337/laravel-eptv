<x-app-layout title="Users management">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Roles management') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('roles.create') }}" class="btn btn-primary">
					{{ __('Create new') }}
				</a>
			</div>

			@include('admin.roles._partials.table')

		</div>
	</div>
</x-app-layout>