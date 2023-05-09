<x-app-layout title="Structures management">
<div class="row">

<div class="col-md-7">

	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Structures management') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('structures.create') }}" class="btn btn-primary">
					{{ __('Create new') }}
				</a>
			</div>
            @include('configurations.structures._partials.table')

		</div>
	</div>
</div>
<div class="col-md-5">

    <div class="card">
    <div class="card-header">Structures Treeview</div>

<div class="card-body">
    <ul id="structure-treeview">
        @foreach($structures as $structure)
            @if($structure->parent_id == null)
			
			@include('configurations/structures/structure-treeview-child', ['structure' => $structure])
            @endif
        @endforeach
    </ul>
</div>
</div>

		</div>
	</div>
</div>
</div>
</x-app-layout>

