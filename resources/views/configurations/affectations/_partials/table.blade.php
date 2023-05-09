<div class="table-responsive">
	<table class="table table-striped table-bordered mb-4">
		<thead>
			<tr>
				<th>{{ __("Date d'affectation") }}</th>
				<th>{{ __('Employee') }}</th>
				<th>{{ __('Structure') }}</th>

				<th>{{ __('#') }}</th>
			</tr>
		</thead>
		<tbody>
			@forelse($affectations as $affectation)
			<tr>
				<td>{{  date('d/m/Y', strtotime($affectation->affectation_date)) }}</td>
				<td>{{ $affectation->user->nom }} {{ $affectation->user->prenom }}</td>
				<td><b>
				{{ \App\Models\configuration\Structures::getDepth($affectation->structure_id,$chemin='')}}
				</b>
				</td>
				<td>
					{!! actionBtn(route('affectations.edit', $affectation->id), 'info', 'edit') !!}
					{!! actionBtn(route('affectations.destroy', $affectation->id), 'danger', 'trash', ["onclick='del(this)'"]) !!}
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