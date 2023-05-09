<div class="table-responsive">
	<table class="table table-striped table-bordered mb-4">
		<thead>
			<tr>
				<th>{{ __('#') }}</th>
				<th>{{ __('Name') }}</th>
				<th>{{ __('Permissions') }}</th>
				<th>{{ __('#') }}</th>
			</tr>
		</thead>
		<tbody>
			@forelse($roles as $role)
			<tr>
				<td>{{ $role->id }}</td>
				<td>{{ $role->name }}</td>
				<td>
					@foreach ($role->permissions as $perm)
						<span class="badge">
							{{ $perm->name }}
						</span>
					@endforeach


				</td>
				<td>

					{!! actionBtn(route('roles.edit', $role->id), 'info', 'edit') !!}

					{!! actionBtn(route('roles.destroy', $role->id), 'danger', 'trash', ["onclick='del(this)'"]) !!}

				</td>
			</tr>
			@empty
			<tr>
				<td colspan="100%" class="text-center">
					{{ __('No data to display.') }}
				</td>
			</tr>
			@endforelse
		</tbody>
	</table>

	<!-- Delete forms with javascript -->
	<form method="POST" class="d-none" id="delete-form">
		@csrf
		@method("DELETE")
	</form>

	
</div>

@push('js')
<script>
	function del(element) {
		event.preventDefault()
		let form = document.getElementById('delete-form');
		form.setAttribute('action', element.getAttribute('href'))
		swalConfirm('Are you sure ?', `You won't be able to revert this.`, 'Yes, delete it!', () => {
			form.submit()
		})
	}
</script>


@endpush