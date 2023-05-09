<div class="table-responsive">
	<table class="table table-striped table-bordered mb-4">
		<thead>
			<tr>
				<th>{{ __('#') }}</th>
				<th>{{ __('Nname') }}</th>
				<th>{{ __('group_name') }}</th>
				<th>{{ __('guard_name') }}</th>
				<th>{{ __('#') }}</th>
			</tr>
		</thead>
		<tbody>
			@forelse($permissions as $permission)
			<tr>
				<td>{{ $permission->id }}</td>
				<td>{{ $permission->name }}</td>
				<td>{{ $permission->group_name }}</td>
				<td>{{ $permission->guard_name }}</td>
				<td>
					{!! actionBtn(route('permissions.edit', $permission->id), 'info', 'edit') !!}
					{!! actionBtn(route('permissions.destroy', $permission->id), 'danger', 'trash', ["onclick='del(this)'"]) !!}
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