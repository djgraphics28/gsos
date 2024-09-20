@section('title', 'Create New Building')
<x-app-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('Create New Building') }}</h1>
        <a href="{{ route('buildings.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
        </a>
    </div>

    <div class="py-12 mb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Form for creating a new building -->
            <div class="card shadow">
                <div class="card-header">
                    {{ __('Building Information') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('buildings.store') }}" method="POST">
                        @csrf
                        <!-- Name field -->
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter building name" required>
                        </div>

                        <!-- Is Active switch -->
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active">
                            <label class="form-check-label" for="is_active">{{ __('Is Active') }}</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary">{{ __('Create Building') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
