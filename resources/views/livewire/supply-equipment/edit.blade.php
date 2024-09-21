<div>
    @section('title', 'Edit Supply & Equipment')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('Edit Supply & Equipment') }}</h1>
        <a href="{{ route('supply-and-equipments.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
        </a>
    </div>

    <div class="py-12 mb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Card for Supply & Equipment Editing -->
            <div class="card shadow">
                <div class="card-body">
                    <form wire:submit.prevent="updateSupply">

                        <!-- Name -->
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" wire:model="name" class="form-control">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Category -->
                        <div class="form-group">
                            <label for="category" class="form-label">Category</label>
                            <select id="category" wire:model="category" class="form-control">
                                <option value="">Select Category</option>
                                <option value="supply">Supply</option>
                                <option value="equipment">Equipment</option>
                            </select>
                            @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Quantity -->
                        <div class="form-group">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" id="quantity" wire:model="quantity" class="form-control">
                            @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Unit -->
                        <div class="form-group">
                            <label for="unit" class="form-label">Unit</label>
                            <input type="text" id="unit" wire:model="unit" class="form-control">
                            @error('unit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Building -->
                        <div class="form-group">
                            <label for="building_id" class="form-label">Building</label>
                            <select id="building_id" wire:model="building_id" class="form-control">
                                <option value="">Select Building</option>
                                @foreach($buildings as $building)
                                    <option value="{{ $building->id }}">{{ $building->name }}</option>
                                @endforeach
                            </select>
                            @error('building_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
