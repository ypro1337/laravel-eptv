<x-app-layout title="affectations edit">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ __('affectations edit') }}
            </h5>

            <div class="mb-4">
                <a href="{{ route('affectations.index') }}" class="btn btn-dark">
                    {{ __('Back to list') }}
                </a>
            </div>

            @include('configurations.affectations._partials.update')

        </div>
    </div>
</x-app-layout>