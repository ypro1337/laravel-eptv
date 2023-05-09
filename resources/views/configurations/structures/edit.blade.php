<x-app-layout title="Users edit">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ __('Structure edit') }}
            </h5>

            <div class="mb-4">
                <a href="{{ route('structures.index') }}" class="btn btn-dark">
                    {{ __('Back to list') }}
                </a>
            </div>

            @include('configurations.structures._partials.form')

        </div>
    </div>
</x-app-layout>


