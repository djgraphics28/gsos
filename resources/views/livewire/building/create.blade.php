<div>
    @section('title', 'Create New Building')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('Create New Building') }}</h1>
        <a href="{{ route('buildings.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
        </a>
    </div>

    <div class="py-12 mb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Card for Building Creation -->
            <div class="card shadow">
                <div class="card-body">
                    <form wire:submit.prevent="createBuilding">
                        <!-- User Name -->
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" wire:model="name" class="form-control">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Building
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
