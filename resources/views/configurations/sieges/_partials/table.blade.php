<div class="table-responsive">
	<table class="table table-striped table-bordered mb-4">
		<thead>
			<tr>
				<th>{{ __('#') }}</th>
				<th>{{ __('Designation') }}</th>
				<th>{{ __('Adresse') }}</th>
				<th>{{ __('Slug') }}</th>
				<th>{{ __('#') }}</th>
			</tr>
		</thead>
		<tbody>
			@forelse($sieges as $siege)
			<tr>
				<td>{{ $siege->id }}</td>
				<td>{{ $siege->designation }}</td>
				<td>{{ $siege->adresse }}</td>
				<td>{{ $siege->slug }}</td>
				<td>
					{!! actionBtn(route('sieges.edit', $siege->slug), 'info', 'edit') !!}
					{!! actionBtn(route('sieges.destroy', $siege->slug), 'danger', 'trash', ["onclick='del(this)'"]) !!}
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