<div class="table-responsive">
	<table class="table table-striped table-bordered mb-4">
		<thead>
			<tr>
				<th>{{ __('#') }}</th>
				<th>{{ __('Name') }}</th>
				<th>{{ __('is_enabled') }}</th>
				<th>{{ __('Parent') }}</th>
				<th>{{ __('#') }}</th>
			</tr>
		</thead>
		<tbody>
			@forelse($structures as $structure)
			<tr>
				<td>{{ $structure->id }}</td>
				<td>{{ $structure->name }}</td>
				<td>
					<span class="badge bg-{{ $structure->is_enabled ? 'success' : 'danger' }}">
						{{ $structure->is_enabled ? __('Verify') : __('Not verify') }}
					</span>
				</td>
				<td>@if ($structure->parent) {{ $structure->parent->name }} @else None @endif</td>
				<td>
					{!! actionBtn(route('structures.edit', $structure->slug), 'info', 'edit') !!}
					{!! actionBtn(route('structures.destroy', $structure->slug), 'danger', 'trash', ["onclick='del(this)'"]) !!}
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