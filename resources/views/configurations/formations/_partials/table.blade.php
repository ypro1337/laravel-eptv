<div class="table-responsive">
	<table class="table table-striped table-bordered mb-4">
		<thead>
			<tr>
				<th>{{ __("Designation") }}</th>
				<th>{{ __('Date De Debut') }}</th>
				<th>{{ __('Date De Fin') }}</th>
                <th>{{ __('Source') }}</th>

				<th>{{ __('#') }}</th>
			</tr>
		</thead>
		<tbody>
			@forelse($formations as $formation)
			<tr>
                <td> {{$formation->designation}}</td>
				<td>{{  date('d/m/Y', strtotime($formation->date_debut)) }}</td>
                <td>{{  date('d/m/Y', strtotime($formation->date_fin)) }}</td>
                <td> {{$formation->source}}</td>
				<td>
					{!! actionBtn(route('formations.edit', $formation->id), 'info', 'edit') !!}
					{!! actionBtn(route('formations.destroy', $formation->id), 'danger', 'trash', ["onclick='del(this)'"]) !!}
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
